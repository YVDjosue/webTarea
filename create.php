<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit();
}
include('conexion.php');

// Comprobación de errores en la URL
$error = '';
if (isset($_GET['error'])) {
    $error = $_GET['error'];
}
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
        <form id="createTaskForm" action="store.php" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="codigo">Código</label>
                    <input type="text" class="form-control" id="codigo" name="codigo" required>
                    <div class="invalid-feedback">
                        Por favor, ingrese un código válido.
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                    <div class="invalid-feedback">
                        Por favor, ingrese un nombre válido.
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea class="form-control" id="descripcion" name="descripcion" required></textarea>
                <div class="invalid-feedback">
                    Por favor, ingrese una descripción válida.
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="fecha_de_registro">Fecha de Registro</label>
                    <input type="date" class="form-control" id="fecha_de_registro" name="fecha_de_registro" value="<?php echo date('Y-m-d'); ?>" readonly>
                    <div class="invalid-feedback">
                        Por favor, ingrese una fecha de registro válida.
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <label for="fecha_culminacion">Fecha de Culminación</label>
                    <input type="date" class="form-control" id="fecha_culminacion" name="fecha_culminacion" required>
                    <div class="invalid-feedback">
                        Por favor, ingrese una fecha de culminación válida.
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <label for="fecha_finalizacion">Fecha de Finalización</label>
                    <input type="date" class="form-control" id="fecha_finalizacion" name="fecha_finalizacion" required>
                    <div class="invalid-feedback">
                        Por favor, ingrese una fecha de finalización válida.
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="responsable">Responsable</label>
                <select class="form-control" id="responsable" name="responsable" aria-label="Default select example" required>
                    <option value="">Seleccione un responsable</option>
                    <?php
                    // Consulta para obtener los colaboradores
                    $sql = "SELECT id, nombres, apellidos FROM colaborador";
                    $result = mysqli_query($conn, $sql);

                    // Verificar si hay resultados
                    if (mysqli_num_rows($result) > 0) {
                        // Recorrer los resultados y agregar opciones al select
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<option value='" . $row['id'] . "'>" . $row['nombres'] . " " . $row['apellidos'] . "</option>";
                        }
                    } else {
                        echo "<option value=''>No hay colaboradores registrados</option>";
                    }
                    ?>
                </select>
                <div class="invalid-feedback">
                    Por favor, seleccione un responsable.
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="estado">Estado</label>
                    <select class="form-control" id="estado" name="estado" required>
                        <option value="Nuevo">Nuevo</option>
                        <option value="En Curso">En Curso</option>
                        <option value="Culminado">Culminado</option>
                        <option value="Revisado">Revisado</option>
                    </select>
                    <div class="invalid-feedback">
                        Por favor, seleccione un estado.
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label for="eliminado">Eliminado</label>
                    <select class="form-control" id="eliminado" name="eliminado" required>
                        <option value="0">No</option>
                        <option value="1">Sí</option>
                    </select>
                    <div class="invalid-feedback">
                        Por favor, seleccione una opción.
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="adjunto">Subir Archivo</label>
                <div class="custom-file">
                    <input type="file" class="form-control-file" id="adjunto" name="adjunto" accept=".jpg,.jpeg,.png,.pdf">
                    <label class="custom-file-label" for="adjunto">Adjuntar</label>
                </div>
            </div>

            <div class="row">
                <button type="submit" class="btn btn-success mr-2">Guardar</button>
                <button type="button" onclick="cancelAction()" class="btn btn-danger">
                    Cancelar
                </button>
            </div>
        </form>
        <br>
    </div>

    <script>
        function showErrorModal(message) {
            document.getElementById('errorMessage').innerText = message;
            $('#errorModal').modal('show');
        }
    </script>

    <?php if ($error): ?>
        <script>
            swal({
                title: "Error",
                text: "<?php echo htmlspecialchars($error); ?>",
                icon: "warning",
            }).then((willContinue) => {
                if (willContinue) {
                    window.history.back();
                }
            });
        </script>
    <?php endif; ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        function cancelAction() {
            window.location.href = 'index.php';
        }

        function validateAdjunto() {
            swal({
                title: "Cuidado!",
                text: "El archivo es demasiado grande.",
                icon: "warning",
            });
        }

        function validateForm() {
            swal({
                title: "Cuidado!",
                text: "La fecha de finalización debe ser mayor o igual a la fecha de culminación!",
                icon: "warning",
            });
        }

        (function() {
            'use strict';
            window.addEventListener('load', function() {
                var forms = document.getElementsByClassName('needs-validation');
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();

        document.getElementById('createTaskForm').addEventListener('submit', function(event) {
            var responsable = document.getElementById('responsable').value;
            //verificar que el responsable no este vacío
            if (responsable === '') {
                swal({
                    title: "Error",
                    text: "Cuidado! Debe seleccionar un responsable.",
                    icon: "warning",
                }).then((willContinue) => {
                    if (willContinue) {
                        event.preventDefault();
                    }
                });
                event.preventDefault();
            }

            var fechaRegistro = new Date(document.getElementById('fecha_de_registro').value);
            var fechaCulminacion = new Date(document.getElementById('fecha_culminacion').value);
            var fechaFinalizacion = new Date(document.getElementById('fecha_finalizacion').value);

            if (fechaCulminacion < fechaRegistro) {
                validateForm();
                event.preventDefault();
            } else if (fechaFinalizacion < fechaCulminacion) {
                validateForm();
                event.preventDefault();
            }
        });

        document.getElementById('adjunto').addEventListener('change', function() {
            var fileName = this.files[0].name;
            this.nextElementSibling.innerHTML = fileName;
        });
    </script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</body>

</html>