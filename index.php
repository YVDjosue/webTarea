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
$sql = "SELECT id, nombre, codigo, responsable, estado FROM tareas $searchQuery LIMIT $start, $limit";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Tareas</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include('navbar.php'); ?>
<div class="container mt-5">
    <h2 class="mb-4">Lista de Tareas</h2>
    <a href="create.php" class="btn btn-primary mb-3">Crear Nueva Tarea</a>
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
                    <th>Responsable</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['nombre']}</td>
                                <td>{$row['codigo']}</td>
                                <td>{$row['responsable']}</td>
                                <td>{$row['estado']}</td>
                                <td>
                                    <a href='edit.php?id={$row['id']}' class='btn btn-warning btn-sm'>Editar</a>
                                    <button class='btn btn-danger btn-sm delete-btn' data-id='{$row['id']}' data-toggle='modal' data-target='#confirmDeleteModal'>Eliminar</button>
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
            <li class="page-item <?php if($page <= 1){ echo 'disabled'; } ?>">
                <a class="page-link" href="<?php if($page > 1){ echo "?page=".($page - 1) . "&search=" . $search; } ?>">Anterior</a>
            </li>
            <?php for($i = 1; $i <= $pages; $i++): ?>
                <li class="page-item <?php if($page == $i){ echo 'active'; } ?>">
                    <a class="page-link" href="index.php?page=<?= $i; ?>&search=<?= $search; ?>"><?= $i; ?></a>
                </li>
            <?php endfor; ?>
            <li class="page-item <?php if($page >= $pages){ echo 'disabled'; } ?>">
                <a class="page-link" href="<?php if($page < $pages){ echo "?page=".($page + 1) . "&search=" . $search; } ?>">Siguiente</a>
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
</body>
</html>
