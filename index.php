<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit();
}
include('conexion.php');


$search = isset($_GET['search']) ? $_GET['search'] : '';
$searchQuery = $search ? "WHERE nombre LIKE '%$search%' OR descripcion LIKE '%$search%' OR codigo LIKE '%$search%' OR responsable LIKE '%$search%' OR estado LIKE '%$search%'" : '';

$limit = 10; // Número de tareas por página
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;

// Obtener el total de tareas
$result = $conn->query("SELECT COUNT(id) AS id FROM tareas $searchQuery");
$taskCount = $result->fetch_assoc();
$total = $taskCount['id'];
$pages = ceil($total / $limit);

// Obtener las tareas para la página actual
$sql = "SELECT id, nombre, codigo, responsable, estado, adjunto, fecha_de_registro FROM tareas $searchQuery LIMIT $start, $limit";
$result = $conn->query($sql);

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
            return ' badge text-white bg-secondary';
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
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <?php include('navbar.php'); ?>
    <div class="container mt-5">
        <div class="row">
            <h2 class="col-md-10"><b>Lista de Tareas</b></h2>
            <a href="create.php" class="btn btn-primary col-mb-2">Crear Nueva Tarea</a>
        </div>
        <br>
        <form method="GET" action="index.php">
            <input class="form-control mb-3" id="searchInput" name="search" type="text" placeholder="Buscar..." value="<?php echo $search; ?>">
        </form>
        <div class="table-responsive">
            <table class="table table-bordered" id="tasksTable">
                <thead>
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
                                    <a href='view.php?id={$row['id']}' class='btn btn-info btn-sm'><i class='bi bi-eye-fill'></i></a>
                                     <a href='edit.php?id={$row['id']}' class='btn btn-primary btn-sm'><i class='bi bi-pencil-fill'></i></a>
                                     <button class='btn btn-danger btn-sm delete-btn' data-id='{$row['id']}' data-toggle='modal' data-target='#confirmDeleteModal'><i class='bi bi-x-lg'></i></button>
                                     " . (!empty($adjunto) ? "<a href='files/{$adjunto}' class='btn btn-secondary btn-sm' target='_blank'><i class='bi bi-file-earmark-text'></i></a>" : "") . "
                                     
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

    <!-- Modal de Confirmación -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
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
    </div>

    <!-- modal tarea -->
    <div id="modalTarea" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Información de la tarea</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
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
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.delete-btn').forEach(function(button) {
                button.addEventListener('click', function() {
                    var id = this.getAttribute('data-id');
                    document.getElementById('confirmDeleteButton').setAttribute('href', 'delete.php?id=' + id);
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