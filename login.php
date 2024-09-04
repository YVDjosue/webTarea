<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include('conexion.php');
    $username = $_POST['usuario'];
    $password = $_POST['contrasenia'];
    $sql = "SELECT * FROM usuarios WHERE usuario = ? AND estado = 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    echo $username." ".$password;
    if ($result->num_rows === 1) {
        echo "primer if";
        $row = $result->fetch_assoc();
        echo $row['contrasenia'];
        if (password_verify($password, $row['contrasenia'])) {
            // Inicio de sesión exitoso
            echo "segundo if";
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['usuario'];
            header("Location: index.php"); // Redireccionar a la página index
            exit();
        } else {
            $error = "Contraseña incorrecta.";
        }
    } else {
        $error = "Usuario no encontrado.";
    }

    // Cerrar la conexión
    $stmt->close();
    $conn->close();

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
</head>

<body class="bg-light d-flex justify-content-center align-items-center vh-100">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
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
                <br>
                <!-- <i class="bi bi-people-fill" style="font-size: 2rem; color: cornflowerblue;"></i>  \-->
                <!-- <h2 class="text-center mb-4">Login</h2> -->
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php endif; ?>
                <form method="POST" action="login.php">
                    <div class="form-group">
                        <label for="usuario"><b>Usuario</b></label>
                        <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Ingrese su usuario" required>
                    </div>
                    <div class="form-group">
                        <label for="contrasenia"><b>Contraseña</b></label>
                        <input type="password" class="form-control" id="contrasenia" name="contrasenia" placeholder="Ingrese su contraseña" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Iniciar Sesión</button>
                    <div class="text-center">
                        <a href="registro.php" class="text-decoration-none">¿No tienes cuenta? <span class="text-primary">Crea una aquí</span></a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>