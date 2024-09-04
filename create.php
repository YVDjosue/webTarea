<?php
session_start();
include('security.php');
include('conexion.php');
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Tarea</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body>
    <?php include('navbar.php'); ?>
    <div class="container mt-5">
        <h2 class="mb-4">Crear Nueva Tarea</h2>
        <form id="createTaskForm" action="store.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="codigo">Código</label>
                <input type="text" class="form-control" id="codigo" name="codigo" required>
            </div>
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea class="form-control" id="descripcion" name="descripcion" required></textarea>
            </div>
            <div class="form-group">
                <label for="fecha_de_registro">Fecha de Registro</label>
                <input type="date" class="form-control" id="fecha_de_registro" name="fecha_de_registro" required>
            </div>
            <div class="form-group">
                <label for="fecha_culminacion">Fecha de Culminación</label>
                <input type="date" class="form-control" id="fecha_culminacion" name="fecha_culminacion" required>
            </div>
            <div class="form-group">
                <label for="fecha_finalizacion">Fecha de Finalización</label>
                <input type="date" class="form-control" id="fecha_finalizacion" name="fecha_finalizacion" required>
            </div>
            <div class="form-group">
                <label for="responsable">Responsable</label>
                <input type="text" class="form-control" id="responsable" name="responsable" required>
            </div>
            <div class="form-group">
                <label for="estado">Estado</label>
                <select class="form-control" id="estado" name="estado" required>
                    <option value="Nuevo">Nuevo</option>
                    <option value="En Curso">En Curso</option>
                    <option value="Culminado">Culminado</option>
                    <option value="Revisado">Revisado</option>
                </select>
            </div>
            <div class="form-group">
                <label for="eliminado">Eliminado</label>
                <select class="form-control" id="eliminado" name="eliminado" required>
                    <option value="0">No</option>
                    <option value="1">Sí</option>
                </select>
            </div>
            <div class="form-group">
                <label for="adjunto">Adjunto</label>
                <input type="file" class="form-control" id="adjunto" name="adjunto" accept=".jpg,.jpeg,.png,.pdf">
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>

            <button onclick="window.location.href='/index.php'" class="btn btn-warning">
                Cancelar
            </button>
        </form>


    </div>
</body>

</html>
</form>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    function validateForm() {
        swal({
            title: "Cuidado!",
            text: "La fecha de finalización debe ser mayor o igual a la fecha de culminación!",
            icon: "warning",
        });
    }
</script>
<script>
    document.getElementById('createTaskForm').addEventListener('submit', function(event) {
        var fechaRegistro = new Date(document.getElementById('fecha_de_registro').value);
        var fechaCulminacion = new Date(document.getElementById('fecha_culminacion').value);
        var fechaFinalizacion = new Date(document.getElementById('fecha_finalizacion').value);

        if (fechaCulminacion < fechaRegistro) {

            validateForm();
            event.preventDefault();
        } else if (fechaFinalizacion < fechaCulminacion) {
            validateForm();
            // alert('La fecha de finalización debe ser mayor o igual a la fecha de culminación.');
            event.preventDefault();
        }
    });
</script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</body>

</html>