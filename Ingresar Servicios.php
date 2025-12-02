<?php
$servername = "localhost";
$username = "root";
$password = "Root";
$database = "estetica";

// Crear conexion
$conn = mysqli_connect($servername, $username, $password, $database);

//Checar conexion
if (!$conn) {
	die("conexion failed: " . mysqli_connect_error());
}
echo "connected successfully";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$ID_Servicios = $_POST['ID_Servicios'];	
	$Nombre_servicio = $_POST['Nombre_servicio'];
	$Precio_servicio = $_POST['Precio_servicio'];
	$Logitud_cabello = $_POST['Logitud_cabello'];
	$Tiempo_realizacion = $_POST['Tiempo_realizacion'];


//Preparar secuencia MySQL
	$sql = "INSERT INTO servicios (ID_Servicios, Nombre_servicio, Precio_servicio, Logitud_cabello, Tiempo_realizacion) 
    VALUES ('$ID_Servicios', '$Nombre_servicio', '$Precio_servicio', '$Logitud_cabello', '$Tiempo_realizacion')";

//Ejecutar e imformar
    if ($conn->query($sql) === TRUE){
        echo "<p> Servicio agregada correctamente. </p>";
    } else {
        echo "<p> Error: " . $conn->error . "</p>";
    }
}


//Consulta
$sql = "SELECT * FROM servicios";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title> Servicios estetica </title>
<style>
		body {
			margin: 0;
			font-family: "Segoe UI", sans-serif;
			background-image: url("Fondo5.jpg");
		    background-size: cover;
    		background-position: center ;
			padding: 40px;
		}

		.card {
			background: white;
			padding: 30px;
			border-radius: 18px;
			box-shadow: 0 8px 20px rgba(0,0,0,0.15);
			margin: auto;
			width: 700px;
			animation: fadeIn 0.6s ease;
		}

		@keyframes fadeIn {
			from { opacity: 0; transform: translateY(15px); }
			to   { opacity: 1; transform: translateY(0); }
		}

		h2 {
			text-align: center;
			color: #c75b9b;
			margin-bottom: 20px;
		}

		.btn {
			display: inline-block;
			background: #c75b9b;
			color: white;
			padding: 10px 20px;
			border-radius: 10px;
			text-decoration: none;
			margin-bottom: 20px;
			transition: 0.3s;
		}

		.btn:hover {
			background: #a74682;
		}

		label {
			font-weight: bold;
			color: #9b4f7c;
			display: block;
			margin-top: 10px;
		}

		input {
			width: 100%;
			padding: 10px;
			border: 2px solid #f1cce3;
			border-radius: 10px;
			margin-bottom: 10px;
		}

		input[type="submit"] {
			background: #c75b9b;
			color: white;
			margin-top: 15px;
			font-size: 16px;
			cursor: pointer;
		}

		input[type="submit"]:hover {
			background: #a74682;
		}

		table {
			width: 100%;
			border-collapse: collapse;
			margin-top: 25px;
		}

		th {
			background: #c75b9b;
			color: white;
			padding: 10px;
		}

		td {
			background: #ffeef7;
			padding: 10px;
			border-bottom: 2px solid #f7ddea;
			text-align: center;
		}

		.alert {
			padding: 10px;
			border-radius: 10px;
			text-align: center;
			font-weight: bold;
			margin-bottom: 20px;
		}

		.success {
			background: #c0f8d1;
			color: #1e7a34;
		}

		.error {
			background: #ffd1d1;
			color: #a10000;
		}
	</style>
</head>
<body>

<div class="card">

	<h2>Registro de Servicios</h2>

	<a href="Ingresar datos.html" class="btn">Regresar</a>


	<form method="POST">
		<label>ID_Servicios:</label>
		<input type="number" name="ID_Servicios" required>

		<label>Nombre del servicio:</label>
		<input type="text" name="Nombre_servicio" required>

		<label>Precio del servicio:</label>
		<input type="text" name="Precio_servicio" required>

		<label>Longitud del cabello:</label>
		<input type="text" name="Logitud_cabello">

		<label>Tiempo de realización:</label>
		<input type="text" name="Tiempo_realizacion">

		<input type="submit" value="Registrar Servicio">
	</form>

	<h2>Lista de Servicios</h2>

	<table>
		<tr>
			<th>ID_Servicios</th>
			<th>Nombre</th>
			<th>Precio</th>
			<th>Longitud cabello</th>
			<th>Tiempo realización</th>
		</tr>

		<?php
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				echo "<tr>
					<td>{$row['ID_Servicios']}</td>
					<td>{$row['Nombre_servicio']}</td>
					<td>{$row['Precio_servicio']}</td>
					<td>{$row['Logitud_cabello']}</td>
					<td>{$row['Tiempo_realizacion']}</td>
				</tr>";
			}
		} else {
			echo "<tr><td colspan='5'>No hay servicios disponibles</td></tr>";
		}

		$conn->close();
		?>
	</table>

</div>

</body>
</html>