<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit();
}
include('conexion.php');

$id = $_GET['id'];
$sql = "SELECT * FROM tareas WHERE id = $id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Tarea</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include('navbar.php'); ?>
<div class="container mt-5">
    <h2 class="mb-4">Editar Tarea</h2>
    <form id="editTaskForm" action="update.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <div class="form-group">
            <label for="codigo">Código</label>
            <input type="text" class="form-control" id="codigo" name="codigo" value="<?php echo $row['codigo']; ?>" required>
        </div>
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $row['nombre']; ?>" required>
        </div>
        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion" required><?php echo $row['descripcion']; ?></textarea>
        </div>
        <div class="form-group">
            <label for="fecha_de_registro">Fecha de Registro</label>
            <input type="date" class="form-control" id="fecha_de_registro" name="fecha_de_registro" value="<?php echo $row['fecha_de_registro']; ?>" required>
        </div>
        <div class="form-group">
            <label for="fecha_culminacion">Fecha de Culminación</label>
            <input type="date" class="form-control" id="fecha_culminacion" name="fecha_culminacion" value="<?php echo $row['fecha_culminacion']; ?>" required>
        </div>
        <div class="form-group">
            <label for="fecha_finalizacion">Fecha de Finalización</label>
            <input type="date" class="form-control" id="fecha_finalizacion" name="fecha_finalizacion" value="<?php echo $row['fecha_finalizacion']; ?>" required>
        </div>
        <div class="form-group">
            <label for="responsable">Responsable</label>
            <input type="text" class="form-control" id="responsable" name="responsable" value="<?php echo $row['responsable']; ?>" required>
        </div>
        <div class="form-group">
            <label for="estado">Estado</label>
            <select class="form-control" id="estado" name="estado" required>
                <option value="Nuevo" <?php if ($row['estado'] == 'Nuevo') echo 'selected'; ?>>Nuevo</option>
                <option value="En Curso" <?php if ($row['estado'] == 'En Curso') echo 'selected'; ?>>En Curso</option>
                <option value="Culminado" <?php if ($row['estado'] == 'Culminado') echo 'selected'; ?>>Culminado</option>
                <option value="Revisado" <?php if ($row['estado'] == 'Revisado') echo 'selected'; ?>>Revisado</option>
            </select>
        </div>
        <div class="form-group">
            <label for="eliminado">Eliminado</label>
            <select class="form-control" id="eliminado" name="eliminado" required>
                <option value="0" <?php if ($row['eliminado'] == 0) echo 'selected'; ?>>No</option>
                <option value="1" <?php if ($row['eliminado'] == 1) echo 'selected'; ?>>Sí</option>
            </select>
        </div>
        <div class="form-group">
            <label for="adjunto">Adjunto</label>
            <input type="file" class="form-control" id="adjunto" name="adjunto" accept=".jpg,.jpeg,.png,.pdf">
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
document.getElementById('editTaskForm').addEventListener('submit', function(event) {
    var fechaRegistro = new Date(document.getElementById('fecha_de_registro').value);
    var fechaCulminacion = new Date(document.getElementById('fecha_culminacion').value);
    var fechaFinalizacion = new Date(document.getElementById('fecha_finalizacion').value);

    if (fechaCulminacion < fechaRegistro) {
        alert('La fecha de culminación debe ser mayor o igual a la fecha de registro.');
        event.preventDefault();
    } else if (fechaFinalizacion < fechaCulminacion) {
        alert('La fecha de finalización debe ser mayor o igual a la fecha de culminación.');
        event.preventDefault();
    }
});
</script>
</body>
</html>
