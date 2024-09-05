<?php
include('conexion.php'); // Ensure this file contains the database connection code

$query = "SELECT id, nombres, apellidos FROM colaborador WHERE estado = 1";
$result = mysqli_query($conn, $query);

$colaboradores = [];
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $colaboradores[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seleccionar Colaborador</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Seleccionar Colaborador</h2>
        <input type="text" id="search" class="form-control mb-3" placeholder="Buscar colaborador...">
        <div id="colaboradoresList">
            <?php foreach ($colaboradores as $colaborador): ?>
                <p><a href="#" class="colaborador-link" data-id="<?php echo $colaborador['id']; ?>" data-nombre="<?php echo $colaborador['nombres']." ".$colaborador['apellidos']; ?>"><?php echo $colaborador['nombres']." ".$colaborador['apellidos']; ?></a></p>
            <?php endforeach; ?>
        </div>
    </div>
    <script>
        document.getElementById('search').addEventListener('keyup', function() {
            var input, filter, ul, li, a, i, txtValue;
            input = document.getElementById('search');
            filter = input.value.toUpperCase();
            div = document.getElementById('colaboradoresList');
            a = div.getElementsByTagName('a');
            for (i = 0; i < a.length; i++) {
                txtValue = a[i].textContent || a[i].innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    a[i].style.display = '';
                } else {
                    a[i].style.display = 'none';
                }
            }
        });

        document.querySelectorAll('.colaborador-link').forEach(function(link) {
            link.addEventListener('click', function(event) {
                event.preventDefault();
                var id = this.getAttribute('data-id');
                var nombre = this.getAttribute('data-nombre');
                if (window.opener && !window.opener.closed) {
                    window.opener.document.getElementById('responsable').value = nombre;
                }
                window.close();
            });
        });
    </script>
</body>
</html>
