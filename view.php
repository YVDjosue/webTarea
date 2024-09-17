<?php
session_start();
include('security.php');
include('conexion.php');

$id = $_GET['id'];
$sql = "SELECT tareas.*, CONCAT(colaborador.nombres, ' ', colaborador.apellidos) AS responsable FROM tareas LEFT JOIN colaborador ON tareas.responsable = colaborador.id WHERE tareas.id = $id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ver Tarea</title>
  <link href="https://bootswatch.com/5/litera/bootstrap.css" rel="stylesheet">
</head>

<body>
  <?php include('navbar.php'); ?>
  <div class="container mt-5">
    <h2 class="mb-4">Ver Tarea</h2>
    <div class="card">
      <div class="card-header">
        Detalles de la Tarea
      </div>
      <div class="card-body">
        <dl class="row">
          <dt class="col-sm-3">ID</dt>
          <dd class="col-sm-9"><?php echo $row['id']; ?></dd>

          <dt class="col-sm-3">Nombre</dt>
          <dd class="col-sm-9"><?php echo $row['nombre']; ?></dd>

          <dt class="col-sm-3">Código</dt>
          <dd class="col-sm-9"><?php echo $row['codigo']; ?></dd>

          <dt class="col-sm-3">Responsable</dt>
          <dd class="col-sm-9"><?php echo $row['responsable']; ?></dd>

          <dt class="col-sm-3">Estado</dt>
          <dd class="col-sm-9"><?php echo $row['estado']; ?></dd>

          <dt class="col-sm-3">Descripción</dt>
          <dd class="col-sm-9"><?php echo $row['descripcion']; ?></dd>

          <dt class="col-sm-3">Fecha de Registro</dt>
          <dd class="col-sm-9"><?php echo $row['fecha_de_registro']; ?></dd>

          <dt class="col-sm-3">Fecha de Culminación</dt>
          <dd class="col-sm-9"><?php echo $row['fecha_culminacion']; ?></dd>

          <dt class="col-sm-3">Fecha de Finalización</dt>
          <dd class="col-sm-9"><?php echo $row['fecha_finalizacion']; ?></dd>

          <dt class="col-sm-3">Eliminado</dt>
          <dd class="col-sm-9"><?php echo ($row['eliminado'] ? 'Si' : 'No'); ?></dd>

          <dt class="col-sm-3">Adjunto</dt>
          <dd class="col-sm-9">
            <?php if ($row['adjunto']) { ?>
              <a href="files/<?php echo $row['adjunto']; ?>" target="_blank">Ver Adjunto</a>
            <?php } else { ?>
              No hay adjunto
            <?php } ?>
          </dd>
        </dl>
      </div>
      <div class="card-footer">
        <a href="index.php" class="btn btn-primary mb-3">Volver</a>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>