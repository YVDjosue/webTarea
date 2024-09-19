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

<body>
    <?php include('recursos/navbar.php'); ?>
    <div class="container mt-5">
        <div class="row">
            <h2 class="col-md-10 text-dark"><b>LISTA DE TAREAS</b></h2>
            <a href="create.php" class="btn btn-primary col-md-2 mb-2">Crear Nueva Tarea</a>
        </div>
        <br>
        <!-- <form method="GET" action="index.php">
            <input class="form-control mb-3" id="searchInput" name="search" type="text" placeholder="Buscar..." value="<?php echo $search; ?>">
        </form> -->
        <div class="table-responsive">
            <table class="table table-bordered" id="tasksTable">
                <thead class="table-primary">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Código</th>
                        <th>fecha de registro</th>
                        <th>Responsable</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $colorClass = getColorClass($row['estado']);
                            $adjunto = htmlspecialchars($row['adjunto']);
                            echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['nombre']}</td>
                                <td>{$row['codigo']}</td>
                                <td>{$row['fecha_de_registro']}</td>
                                <td>{$row['responsable']}</td>
                                <td><span class='{$colorClass}'>{$row['estado']}</span></td>
                                <td>
                                    <a href='#' class='btn btn-success btn-sm view-btn' data-id='{$row['id']}'><i class='bi bi-eye-fill'></i></a>
                                    <a href='edit.php?id={$row['id']}' class='btn btn-primary btn-sm'><i class='bi bi-pencil-fill'></i></a>
                                    <button class='btn btn-danger btn-sm delete-btn' data-id='{$row['id']}' data-toggle='modal' data-target='#confirmDeleteModal'><i class='bi bi-x-lg'></i></button>
                                    " . (!empty($adjunto) ? "<a href='files/{$adjunto}' class='btn btn-warning btn-sm' target='_blank'><i class='bi bi-file-earmark-text'></i></a>" : "") . "
                                </td>
                              </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6' class='text-center'>No hay tareas</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Paginación -->
        <nav>
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
                        <a class="page-link" href="index.php?page=<?= $i; ?>&search=<?= $search; ?>"><?= $i; ?></a>
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
        </nav>
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
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
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
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
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
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>