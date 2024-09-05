<?php
include 'conexion.php'; // Incluir el archivo de configuración

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Recibir los datos del formulario
  $colaborador_id = $_POST['colaborador_id'];
  $usuario = $_POST['usuario'];
  $contrasenia = $_POST['contrasenia'];
  $estado = 1; // Asumiendo que el estado inicial es 'activo'

  // Hashear la contraseña para mayor seguridad
  $hashed_contrasenia = password_hash($contrasenia, PASSWORD_DEFAULT);;
  // echo "Contraseña original: $contrasenia<br>";
  // echo "Contraseña hasheada: $hashed_contrasenia<br>";


  // Preparar la consulta SQL para insertar el nuevo usuario
  $sql = "INSERT INTO usuarios (colaborador_id, usuario, contrasenia, estado) VALUES (?, ?, ?, ?)";

  // Preparar y ejecutar la consulta
  if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("issi", $colaborador_id, $usuario, $hashed_contrasenia, $estado);

    if ($stmt->execute()) {
      echo "Registro exitoso";
      header('Location: login.php'); // Redirigir a la página de inicio de sesión
    } else {
      echo "Error: " . $stmt->error;
    }

    $stmt->close();
  } else {
    echo "Error en la preparación de la consulta: " . $conn->error;
  }

  // Cerrar la conexión
  $conn->close();
}
