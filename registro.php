<?php
session_start();
include('conexion.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $usuario = $_POST['usuario'];
  $contrasenia = $_POST['contrasenia'];

  $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND estado = 1";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if ($contrasenia == $row['contrasenia']) {
      $_SESSION['usuario'] = $usuario;
      header('Location: index.php');
    } else {
      $error = "Contraseña incorrecta.";
    }
  } else {
    $error = "Usuario no encontrado o inactivo.";
  }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <style>
    .register-container {
      width: 100%;
      max-width: 400px;
      padding: 2rem;
      background-color: #fff;
      border-radius: 0.5rem;
      box-shadow: none;
      /* Elimina la sombra */
      border: 1px solid #dee2e6;
      /* Agrega un borde sutil */
    }

    .register-container .form-label {
      font-weight: 500;
    }

    .btn-primary {
      background-color: #007bff;
      /* Color azul clásico de Bootstrap */
      border-color: #007bff;
      /* Borde del botón */
    }

    .btn-primary:hover {
      background-color: #0056b3;
      /* Color azul más oscuro en hover */
      border-color: #0056b3;
      /* Borde del botón en hover */
    }

    .text-primary {
      color: #007bff;
      /* Color del enlace */
    }
  </style>
</head>

<body class="bg-light d-flex justify-content-center align-items-center vh-100">

  <div class="register-container">
    <div class="row justify-content-center">
      <svg
        xmlns="http://www.w3.org/2000/svg"
        width="100"
        height="100"
        viewBox="0 0 24 24"
        fill="none"
        stroke="currentColor"
        stroke-width="2"
        stroke-linecap="round"
        stroke-linejoin="round"
        class="h-12 w-12 text-primary">
        <path d="m8 3 4 8 5-5 5 15H2L8 3z"></path>
      </svg>
    </div>
    <h2 class="text-center mb-4">Crear Cuenta</h2>
    <form>
      <div class="mb-3">
        <label for="username" class="form-label">Nombre de Usuario</label>
        <input type="text" class="form-control" id="username" placeholder="Nombre de Usuario" required>
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Correo Electrónico</label>
        <input type="email" class="form-control" id="email" placeholder="Correo Electrónico" required>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Contraseña</label>
        <input type="password" class="form-control" id="password" placeholder="Contraseña" required>
      </div>
      <div class="mb-3">
        <label for="confirmPassword" class="form-label">Confirmar Contraseña</label>
        <input type="password" class="form-control" id="confirmPassword" placeholder="Confirmar Contraseña" required>
      </div>
      <button type="submit" class="btn btn-primary w-100 mb-2">Registrarse</button>
      <div class="text-center">
        <a href="/login.php" class="text-decoration-none">¿Ya tienes cuenta? <span class="text-primary">Inicia sesión aquí</span></a>
      </div>
    </form>
  </div>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>