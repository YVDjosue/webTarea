<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit();
}
include('conexion.php');

$sql = "SELECT id, nombre, codigo, responsable, estado FROM tareas";
$result = $conn->query($sql);
$tareas = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $tareas[] = $row;
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
</head>

<body>
    <?php include('navbar.php'); ?>
    <div class="container mt-5">
        <h2 class="mb-4">Lista de Tareas</h2>
        <a href="create.php" class="btn btn-primary mb-3">Crear Nueva Tarea</a>
        <input class="form-control mb-3" id="searchInput" type="text" placeholder="Buscar...">
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
                    foreach ($tareas as $row) {
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
                    ?>
                </tbody>
            </table>
        </div>
        <nav>
            <ul class="pagination" id="pagination">
                <!-- Paginación generada dinámicamente -->
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
            const rows = Array.from(document.querySelectorAll('#tasksTable tbody tr'));
            const rowsPerPage = 10;
            let currentPage = 1;

            function displayRows(filteredRows) {
                const start = (currentPage - 1) * rowsPerPage;
                const end = start + rowsPerPage;
                rows.forEach(row => row.style.display = 'none');
                filteredRows.slice(start, end).forEach(row => row.style.display = '');
            }

            function updatePagination(filteredRows) {
                const totalPages = Math.ceil(filteredRows.length / rowsPerPage);
                const pagination = document.getElementById('pagination');
                pagination.innerHTML = '';

                const prevPageItem = document.createElement('li');
                prevPageItem.className = 'page-item';
                if (currentPage === 1) prevPageItem.classList.add('disabled');
                const prevPageLink = document.createElement('a');
                prevPageLink.className = 'page-link';
                prevPageLink.href = '#';
                prevPageLink.textContent = 'Anterior';
                prevPageLink.addEventListener('click', function(event) {
                    event.preventDefault();
                    if (currentPage > 1) {
                        currentPage--;
                        displayRows(filteredRows);
                        updatePagination(filteredRows);
                    }
                });
                prevPageItem.appendChild(prevPageLink);
                pagination.appendChild(prevPageItem);

                for (let i = 1; i <= totalPages; i++) {
                    const pageItem = document.createElement('li');
                    pageItem.className = 'page-item';
                    if (currentPage === i) pageItem.classList.add('active');
                    const pageLink = document.createElement('a');
                    pageLink.className = 'page-link';
                    pageLink.href = '#';
                    pageLink.textContent = i;
                    pageLink.addEventListener('click', function(event) {
                        event.preventDefault();
                        currentPage = i;
                        displayRows(filteredRows);
                        updatePagination(filteredRows);
                    });
                    pageItem.appendChild(pageLink);
                    pagination.appendChild(pageItem);
                }

                const nextPageItem = document.createElement('li');
                nextPageItem.className = 'page-item';
                if (currentPage === totalPages) nextPageItem.classList.add('disabled');
                const nextPageLink = document.createElement('a');
                nextPageLink.className = 'page-link';
                nextPageLink.href = '#';
                nextPageLink.textContent = 'Siguiente';
                nextPageLink.addEventListener('click', function(event) {
                    event.preventDefault();
                    if (currentPage < totalPages) {
                        currentPage++;
                        displayRows(filteredRows);
                        updatePagination(filteredRows);
                    }
                });
                nextPageItem.appendChild(nextPageLink);
                pagination.appendChild(nextPageItem);
            }

            document.getElementById('searchInput').addEventListener('keyup', function() {
                const value = this.value.toLowerCase();
                const filteredRows = rows.filter(row => row.textContent.toLowerCase().includes(value));
                currentPage = 1;
                displayRows(filteredRows);
                updatePagination(filteredRows);
            });

            displayRows(rows);
            updatePagination(rows);
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>