<?php
include 'conexion.php';
$sql = "INSERT INTO tareas (codigo, nombre, descripcion, fecha_de_registro, fecha_culminacion, fecha_finalizacion, responsable, estado, eliminado, adjunto) VALUES ";

$values = [];
for ($i = 1; $i <= 50; $i++) {
    $codigo = 'COD' . str_pad($i, 3, '0', STR_PAD_LEFT);
    $nombre = 'Tarea ' . $i;
    $descripcion = 'Descripción de la tarea ' . $i;
    $fecha_de_registro = date('Y-m-d', strtotime('-' . rand(0, 365) . ' days'));
    $fecha_culminacion = date('Y-m-d', strtotime($fecha_de_registro . ' + ' . rand(1, 30) . ' days'));
    $fecha_finalizacion = date('Y-m-d', strtotime($fecha_culminacion . ' + ' . rand(1, 30) . ' days'));
    $responsable = 'Responsable ' . $i;
    $estado = array('Nuevo', 'En Curso', 'Culminado', 'Revisado')[array_rand(array('Nuevo', 'En Curso', 'Culminado', 'Revisado'))];
    $eliminado = rand(0, 1);
    $adjunto = 'adjunto' . $i . '.pdf';

    $values[] = "('$codigo', '$nombre', '$descripcion', '$fecha_de_registro', '$fecha_culminacion', '$fecha_finalizacion', '$responsable', '$estado', '$eliminado', '$adjunto')";
}

$sql .= implode(", ", $values);

if ($conn->query($sql) === TRUE) {
    echo "Datos insertados correctamente";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
