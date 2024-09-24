<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit();
}

include('conexion.php');

$id = $_GET['id'];

// Consulta para obtener los detalles de la tarea y el responsable actual
$sql = "SELECT tareas.*, colaborador.id AS responsable_id, CONCAT(colaborador.nombres, ' ', colaborador.apellidos) AS responsable
        FROM tareas
        LEFT JOIN colaborador ON tareas.responsable = colaborador.id
        WHERE tareas.id = $id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

// Consulta para obtener todos los colaboradores
$colaboradores = $conn->query("SELECT id, CONCAT(nombres, ' ', apellidos) AS nombre_completo FROM colaborador WHERE estado = 1");
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Tarea</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body>
    <?php include('navbar.php'); ?>
    <div class="container mt-5">
        <h2 class="mb-4">Editar Tarea</h2>
        <form id="editTaskForm" action="update.php" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="codigo">Código</label>
                    <input type="text" class="form-control" id="codigo" name="codigo" value="<?php echo $row['codigo']; ?>" required>
                    <div class="invalid-feedback">
                        Por favor, ingrese un código válido.
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $row['nombre']; ?>" required>
                    <div class="invalid-feedback">
                        Por favor, ingrese un nombre válido.
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea class="form-control" id="descripcion" name="descripcion" required><?php echo $row['descripcion']; ?></textarea>
                <div class="invalid-feedback">
                    Por favor, ingrese una descripción válida.
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="fecha_de_registro">Fecha de Registro</label>
                    <input type="date" class="form-control" id="fecha_de_registro" name="fecha_de_registro" value="<?php echo $row['fecha_de_registro']; ?>" disabled required>
                    <div class="invalid-feedback">
                        Por favor, ingrese una fecha de registro válida.
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <label for="fecha_culminacion">Fecha de Culminación</label>
                    <input type="date" class="form-control" id="fecha_culminacion" name="fecha_culminacion" value="<?php echo $row['fecha_culminacion']; ?>" required>
                    <div class="invalid-feedback">
                        Por favor, ingrese una fecha de culminación válida.
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <label for="fecha_finalizacion">Fecha de Finalización</label>
                    <input type="date" class="form-control" id="fecha_finalizacion" name="fecha_finalizacion" value="<?php echo $row['fecha_finalizacion']; ?>" required>
                    <div class="invalid-feedback">
                        Por favor, ingrese una fecha de finalización válida.
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="responsable">Responsable</label>
                <select class="form-control" id="responsable" name="responsable" required>
                    <option value="">Seleccione un responsable</option>
                    <?php
                    // Recorrer todos los colaboradores y establecer el responsable actual como preseleccionado
                    while ($colaborador = $colaboradores->fetch_assoc()) {
                        $selected = ($colaborador['id'] == $row['responsable_id']) ? 'selected' : '';
                        echo "<option value='{$colaborador['id']}' $selected>{$colaborador['nombre_completo']}</option>";
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
                        <option value="Nuevo" <?php if ($row['estado'] == 'Nuevo') echo 'selected'; ?>>Nuevo</option>
                        <option value="En Curso" <?php if ($row['estado'] == 'En Curso') echo 'selected'; ?>>En Curso</option>
                        <option value="Culminado" <?php if ($row['estado'] == 'Culminado') echo 'selected'; ?>>Culminado</option>
                        <option value="Revisado" <?php if ($row['estado'] == 'Revisado') echo 'selected'; ?>>Revisado</option>
                    </select>
                    <div class="invalid-feedback">
                        Por favor, seleccione un estado.
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label for="eliminado">Eliminado</label>
                    <select class="form-control" id="eliminado" name="eliminado" required>
                        <option value="0" <?php if ($row['eliminado'] == 0) echo 'selected'; ?>>No</option>
                        <option value="1" <?php if ($row['eliminado'] == 1) echo 'selected'; ?>>Sí</option>
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
            <button type="submit" class="btn btn-success mr-2">Actualizar</button>
            <button type="button" onclick="window.location.href='/index.php'" class="btn btn-danger mr-2">
                Cancelar
            </button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        // Validación del formulario
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

        document.getElementById('editTaskForm').addEventListener('submit', function(event) {
            var fechaRegistro = new Date(document.getElementById('fecha_de_registro').value);
            var fechaCulminacion = new Date(document.getElementById('fecha_culminacion').value);
            var fechaFinalizacion = new Date(document.getElementById('fecha_finalizacion').value);

            if (fechaCulminacion < fechaRegistro) {
                swal('Error', 'La fecha de culminación debe ser mayor o igual a la fecha de registro.', 'error');
                event.preventDefault();
            } else if (fechaFinalizacion < fechaCulminacion) {
                swal('Error', 'La fecha de finalización debe ser mayor o igual a la fecha de culminación.', 'error');
                event.preventDefault();
            }
        });

        document.getElementById('adjunto').addEventListener('change', function() {
            var fileName = this.files[0].name;
            this.nextElementSibling.innerHTML = fileName;
        });
    </script>
</body>

</html>