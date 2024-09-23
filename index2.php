<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit();
}

include('conexion.php');

$search = isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '';
$searchQuery = $search ? "WHERE tareas.nombre LIKE ? OR tareas.descripcion LIKE ? OR tareas.codigo LIKE ? OR colaborador.nombres LIKE ? OR colaborador.apellidos LIKE ? OR tareas.estado LIKE ?" : '';

$limit = 10; // Número de tareas por página
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $limit;

// Preparar la consulta para contar tareas
$stmt = $conn->prepare("SELECT COUNT(tareas.id) AS id FROM tareas 
                        LEFT JOIN colaborador ON tareas.responsable = colaborador.id 
                        $searchQuery");
if ($search) {
    $searchParam = "%$search%";
    $stmt->bind_param('ssssss', $searchParam, $searchParam, $searchParam, $searchParam, $searchParam, $searchParam);
}
$stmt->execute();
$result = $stmt->get_result();
$taskCount = $result->fetch_assoc();
$total = $taskCount['id'];
$pages = ceil($total / $limit);

// Preparar la consulta para obtener tareas
$stmt = $conn->prepare("SELECT tareas.id, tareas.nombre, tareas.codigo, CONCAT(colaborador.nombres, ' ', colaborador.apellidos) AS responsable, tareas.estado, tareas.adjunto, tareas.fecha_de_registro
                        FROM tareas
                        LEFT JOIN colaborador ON tareas.responsable = colaborador.id
                        $searchQuery
                        LIMIT ?, ?");
if ($search) {
    $stmt->bind_param('ssssssii', $searchParam, $searchParam, $searchParam, $searchParam, $searchParam, $searchParam, $start, $limit);
} else {
    $stmt->bind_param('ii', $start, $limit);
}
$stmt->execute();
$result = $stmt->get_result();

// Obtener las últimas 5 tareas de cada estado
$estados = ['nuevo', 'en curso', 'culminado', 'revisado'];
$tareasPorEstado = [];

foreach ($estados as $estado) {
    $stmt = $conn->prepare("SELECT tareas.id, tareas.nombre, tareas.codigo, CONCAT(colaborador.nombres, ' ', colaborador.apellidos) AS responsable, tareas.estado, tareas.adjunto, tareas.fecha_de_registro, tareas.fecha_culminacion
                            FROM tareas
                            LEFT JOIN colaborador ON tareas.responsable = colaborador.id
                            WHERE tareas.estado = ?
                            ORDER BY tareas.fecha_de_registro DESC
                            LIMIT 5");
    $stmt->bind_param('s', $estado);
    $stmt->execute();
    $result = $stmt->get_result();
    $tareasPorEstado[$estado] = $result->fetch_all(MYSQLI_ASSOC);
}
?>

<?php
function getColorClass($estado)
{
    switch (strtolower($estado)) {
        case 'nuevo':
            return 'badge text-white bg-warning';
        case 'en curso':
            return 'badge text-white bg-primary';
        case 'culminado':
            return 'badge text-white bg-success';
        case 'revisado':
            return 'badge text-white bg-secondary';
        default:
            return 'badge text-white bg-secondary';
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Tareas</title>
    <link href="https://bootswatch.com/5/litera/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body class="bg-body-secondary">
    <?php include('recursos/navbar.php'); ?>
    <div class="container mt-2">
        <div class="row">
            <h2 class="col-md-10 text-dark"><b>Tareas</b></h2>

            <a href="create.php" class="btn btn-primary col-md-2 mb-2">Crear Nueva Tarea</a>
        </div>
        <div class="d-flex justify-content-end">
            <a href="index.php" class='btn btn-success btn-md mb-1'><i class="bi bi-view-list"></i></a>

        </div>
        <div class="row">
            <?php foreach ($estados as $estado): ?>
                <div class="col-md-3">
                    <h5><?= ucfirst($estado) ?></h5>
                    <ul class="list-group">
                        <?php foreach ($tareasPorEstado[$estado] as $tarea): ?>
                            <li class="list-group-item rounded">
                                <strong><?= $tarea['nombre'] ?></strong><br>
                                <small>Responsable: <?= $tarea['responsable'] ?></small><br>
                                <small>Fecha de vencimiento: <?= $tarea['fecha_culminacion'] ?></small>
                                <br>
                                <small><a href="#" class="btn btn-success btn-sm view-btn" data-id="<?= $tarea['id'] ?>"><i class="bi bi-eye-fill"></i></a>
                                    <a href="edit.php?id=<?= $tarea['id'] ?>" class="btn btn-primary btn-sm"><i class="bi bi-pencil-fill"></i></a>
                                    <button class="btn btn-danger btn-sm delete-btn" data-id="<?= $tarea['id'] ?>" data-toggle="modal" data-target="#confirmDeleteModal"><i class="bi bi-x-lg"></i></button>
                                    <?php if (!empty($tarea['adjunto'])): ?>
                                        <a href="files/<?= $tarea['adjunto'] ?>" class="btn btn-warning btn-sm" target="_blank"><i class="bi bi-file-earmark-text"></i></a>
                                    <?php endif; ?></small>

                            </li>
                            <br>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Paginación -->
        <!-- <nav>
            <ul class="pagination">
                <li class="page-item <?php if ($page <= 1) {
                                            echo 'disabled';
                                        } ?>">
                    <a class="page-link" href="<?php if ($page > 1) {
                                                    echo "?page=" . ($page - 1) . "&search=" . $search;
                                                } ?>">Anterior</a>
                </li>
                <?php for ($i = 1; $i <= $pages; $i++): ?>
                    <li class="page-item <?php if ($page == $i) {
                                                echo 'active';
                                            } ?>">
                        <a class="page-link" href="index2.php?page=<?= $i; ?>&search=<?= $search; ?>"><?= $i; ?></a>
                    </li>
                <?php endfor; ?>
                <li class="page-item <?php if ($page >= $pages) {
                                            echo 'disabled';
                                        } ?>">
                    <a class="page-link" href="<?php if ($page < $pages) {
                                                    echo "?page=" . ($page + 1) . "&search=" . $search;
                                                } ?>">Siguiente</a>
                </li>
            </ul>
        </nav> -->
    </div>

    <!-- Modal de Confirmación eliminar tarea -->
    <!-- <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmar Eliminación</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de que deseas eliminar esta tarea?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <a href="#" class="btn btn-danger" id="confirmDeleteButton">Eliminar</a>
                </div>
            </div>
        </div>
    </div> -->

    <!-- modal tarea -->
    <div id="modalTarea" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Información de la tarea</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <!-- <span aria-hidden="true">&times;</span> -->
                    </button>
                </div>
                <div class="modal-body">
                    <p><strong>Código:</strong> <span id="codigo"></span></p>
                    <p><strong>Nombre:</strong> <span id="nombre"></span></p>
                    <p><strong>Descripción:</strong> <span id="descripcion"></span></p>
                    <p><strong>Fecha de registro:</strong> <span id="fecha_de_registro"></span></p>
                    <p><strong>Fecha de culminación:</strong> <span id="fecha_culminacion"></span></p>
                    <p><strong>Fecha de finalización:</strong> <span id="fecha_finalizacion"></span></p>
                    <p><strong>Responsable:</strong> <span id="responsable"></span></p>
                    <p><strong>Estado:</strong> <span id="estado"></span></p>
                    <p><strong>Adjunto:</strong> <span id="adjunto"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.delete-btn').forEach(function(button) {
                button.addEventListener('click', function() {
                    var id = this.getAttribute('data-id');
                    Swal.fire({
                        title: '¿Estás seguro?',
                        text: "No podrás revertir esto.",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Sí, eliminar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = 'delete.php?id=' + id;
                        }
                    });
                });
            });

            document.querySelectorAll('.view-btn').forEach(function(button) {
                button.addEventListener('click', function(event) {
                    event.preventDefault(); // Evita la redirección
                    var id = this.getAttribute('data-id');
                    fetch('get_task_info.php?id=' + id)
                        .then(response => response.json())
                        .then(data => {
                            if (data.error) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: data.error
                                });
                            } else {
                                document.getElementById('codigo').textContent = data.codigo;
                                document.getElementById('nombre').textContent = data.nombre;
                                document.getElementById('descripcion').textContent = data.descripcion;
                                document.getElementById('fecha_de_registro').textContent = data.fecha_de_registro;
                                document.getElementById('fecha_culminacion').textContent = data.fecha_culminacion;
                                document.getElementById('fecha_finalizacion').textContent = data.fecha_finalizacion;
                                document.getElementById('responsable').textContent = data.responsable;
                                document.getElementById('estado').textContent = data.estado;
                                document.getElementById('adjunto').innerHTML = data.adjunto ? `<a href="files/${data.adjunto}" target="_blank">Ver adjunto</a>` : 'Sin adjunto';
                                $('#modalTarea').modal('show');
                            }
                        })
                        .catch(error => {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Hubo un error al cargar la información de la tarea.'
                            });
                        });
                });
            });
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>