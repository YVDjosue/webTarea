<?php

session_start();
$msg = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  include('conexion.php');
  $username = $_POST['username'];
  $password = $_POST['password'];
  $estado = 1;

  // Hash de la contraseña
  $hashed_password = password_hash($password, PASSWORD_DEFAULT);

  // Preparar y ejecutar la consulta SQL
  $sql = "INSERT INTO usuarios (usuario, contrasenia, estado) VALUES (?, ?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ssi", $username, $hashed_password, $estado);

  if ($stmt->execute()) {
    $msg = '<script>
            $(document).ready(function() {
                $("#successModal").modal("show");
            });
          </script>';
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Cerrar la conexión
$stmt->close();
$conn->close();
//exit(); // Asegúrate de que no se siga ejecutando el código PHP después de enviar el script JavaScript
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registro de nuevo usuario</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script>
        function validateForm(event) {
            var password = document.getElementById("password").value;
            var confirmPassword = document.getElementById("confirmPassword").value;
            if (password !== confirmPassword) {
                var modal = new bootstrap.Modal(document.getElementById('errorModal'));
                modal.show();
                event.preventDefault(); // Impide el envío del formulario
            }
        }
  </script>
  <?php echo $msg;?>
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
    <form method="POST" action="registro.php" onsubmit="validateForm(event)">
      <div class="mb-3">
        <label for="username" class="form-label">Nombre de Usuario</label>
        <input type="text" class="form-control" id="username" name="username" placeholder="Nombre de Usuario" required>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Contraseña</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" required>
      </div>
      <div class="mb-3">
        <label for="confirmPassword" class="form-label">Confirmar Contraseña</label>
        <input type="password" class="form-control" id="confirmPassword" placeholder="Confirmar Contraseña" required>
      </div>
      <button type="submit" class="btn btn-primary w-100 mb-2">Registrarse</button>
      <div class="text-center">
        <a href="login.php" class="text-decoration-none">¿Ya tienes cuenta? <span class="text-primary">Inicia sesión aquí</span></a>
      </div>
    </form>
  </div>

<!-- Modal de Bootstrap -->
    <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="errorModalLabel">Error</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Las contraseñas no coinciden.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Confirmación -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">Éxito</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Usuario registrado exitosamente.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>