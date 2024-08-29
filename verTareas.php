<?php
require("security.php");
require("conexion.php");
$query = mysqli_query($conn, "SELECT * FROM tareas");

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Mostrar tareas</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="bg-light">
	<div class="container mt-5">
        <h2 class="text-center mb-4">Listado de Elementos</h2>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>NOMBRE DE TAREA</th>
                        <th>CODIGO</th>
                        <th>RESPONSABLE</th>
                        <th>ESTADO</th>
                    </tr>
                </thead>
                <tbody>

		        <?php

		        while($row = mysqli_fetch_array($query)){
		        	echo "<tr>
		                     <td>{$row['id']}</td>
		                     <td>{$row['nombre']}</td>
		                     <td>{$row['codigo']}</td>
		                     <td>{$row['responsable']}</td>
		                     <td>{$row['estado']}</td>
		                 </tr>";
		        }
        		?>
    			</tbody>
            </table>
        </div>
    </div>

<a href="logout.php">Salir</a>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>