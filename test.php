<?php
require("security.php");
require("conexion.php");
$query = mysqli_query($conn, "SELECT * FROM tareas");

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Control de Tareas</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Barra de navegación -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Nombre de la Empresa</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <span class="nav-link">Hola, Usuario</span>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Cerrar Sesión</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-4">
        <!-- Botón para crear nueva tarea -->
        <div class="d-flex justify-content-between mb-3">
            <h2>Listado de Tareas</h2>
            <button class="btn btn-primary" data-toggle="modal" data-target="#createTaskModal">Crear Nueva Tarea</button>
        </div>

        <!-- Buscador -->
        <input class="form-control mb-3" id="searchInput" type="text" placeholder="Buscar tareas...">

        <!-- Tabla de tareas -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NOMBRE DE TAREA</th>
                    <th>CODIGO</th>
                    <th>RESPONSABLE</th>
                    <th>ESTADO</th>
                    <th>ACCIONES</th>
                </tr>
            </thead>
            <tbody id="taskTableBody">
                <?php

                while($row = mysqli_fetch_array($query)){
                    echo "<tr>
                             <td>{$row['id']}</td>
                             <td>{$row['nombre']}</td>
                             <td>{$row['codigo']}</td>
                             <td>{$row['responsable']}</td>
                             <td>{$row['estado']}</td>
                             <td>botoncitos</td>
                         </tr>";
                }
                ?>
            </tbody>
        </table>

        <!-- Paginación -->
        <nav>
            <ul class="pagination justify-content-center" id="pagination">
                <!-- Aquí se generarán los botones de paginación -->
            </ul>
        </nav>
    </div>

    <!-- Modal para crear tarea -->
    <div class="modal fade" id="createTaskModal" tabindex="-1" role="dialog" aria-labelledby="createTaskModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createTaskModalLabel">Crear Nueva Tarea</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="createTaskForm">
                        <div class="form-group">
                            <label for="taskCode">Código</label>
                            <input type="text" class="form-control" id="taskCode" required>
                        </div>
                        <div class="form-group">
                            <label for="taskName">Nombre</label>
                            <input type="text" class="form-control" id="taskName" required>
                        </div>
                        <div class="form-group">
                            <label for="taskDescription">Descripción</label>
                            <textarea class="form-control" id="taskDescription" rows="3" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="taskStartDate">Fecha de Registro</label>
                            <input type="date" class="form-control" id="taskStartDate" required>
                        </div>
                        <div class="form-group">
                            <label for="taskEndDate">Fecha de Culminación</label>
                            <input type="date" class="form-control" id="taskEndDate" required>
                        </div>
                        <div class="form-group">
                            <label for="taskCompletionDate">Fecha de Finalización</label>
                            <input type="date" class="form-control" id="taskCompletionDate" required>
                        </div>
                        <div class="form-group">
                            <label for="taskResponsible">Responsable</label>
                            <input type="text" class="form-control" id="taskResponsible" required>
                        </div>
                        <div class="form-group">
                            <label for="taskStatus">Estado</label>
                            <input type="text" class="form-control" id="taskStatus" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para editar tarea -->
    <div class="modal fade" id="editTaskModal" tabindex="-1" role="dialog" aria-labelledby="editTaskModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editTaskModalLabel">Editar Tarea</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editTaskForm">
                        <div class="form-group">
                            <label for="editTaskCode">Código</label>
                            <input type="text" class="form-control" id="editTaskCode" required>
                        </div>
                        <div class="form-group">
                            <label for="editTaskName">Nombre</label>
                            <input type="text" class="form-control" id="editTaskName" required>
                        </div>
                        <div class="form-group">
                            <label for="editTaskDescription">Descripción</label>
                            <textarea class="form-control" id="editTaskDescription" rows="3" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="editTaskStartDate">Fecha de Registro</label>
                            <input type="date" class="form-control" id="editTaskStartDate" required>
                        </div>
                        <div class="form-group">
                            <label for="editTaskEndDate">Fecha de Culminación</label>
                            <input type="date" class="form-control" id="editTaskEndDate" required>
                        </div>
                        <div class="form-group">
                            <label for="editTaskCompletionDate">Fecha de Finalización</label>
                            <input type="date" class="form-control" id="editTaskCompletionDate" required>
                        </div>
                        <div class="form-group">
                            <label for="editTaskResponsible">Responsable</label>
                            <input type="text" class="form-control" id="editTaskResponsible" required>
                        </div>
                        <div class="form-group">
                            <label for="editTaskStatus">Estado</label>
                            <input type="text" class="form-control" id="editTaskStatus" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // Aquí iría el código JavaScript para manejar la paginación, búsqueda en tiempo real y CRUD de tareas
    </script>
</body>
</html>
