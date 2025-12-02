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
	$ID_Cliente = $_POST['ID_Cliente'];	
	$Nombre_cliente = $_POST['Nombre_cliente'];
	$Telefono = $_POST['Telefono'];
	$Edad = $_POST['Edad'];
	$Direccion = $_POST['Direccion'];


//Preparar secuencia MySQL
	$sql = "INSERT INTO clientes (ID_Cliente, Nombre_cliente, Telefono, Edad, Direccion) 
    VALUES ('$ID_Cliente', '$Nombre_cliente', '$Telefono', '$Edad', '$Direccion')";

//Ejecutar e imformar
    if ($conn->query($sql) === TRUE){
        echo "<p> Cliente agregado correctamente. </p>";
    } else {
        echo "<p> Error: " . $conn->error . "</p>";
    }
}


//Consulta
$sql = "SELECT * FROM clientes";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title> Clientes estetica </title>
<style>
		body {
			margin: 0;
			font-family: "Segoe UI", sans-serif;
			background-image: url("Fondo4.jpg");
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
			color: #d36ca7;
			margin-bottom: 20px;
		}

		.btn {
			display: inline-block;
			background: #d36ca7;
			color: white;
			padding: 10px 20px;
			border-radius: 10px;
			text-decoration: none;
			margin-bottom: 20px;
			transition: 0.3s;
		}

		.btn:hover {
			background: #b35487;
		}

		label {
			font-weight: bold;
			color: #b35487;
			display: block;
			margin-top: 10px;
		}

		input {
			width: 100%;
			padding: 10px;
			border: 2px solid #f4c2d2;
			border-radius: 10px;
			margin-bottom: 10px;
		}

		input[type="submit"] {
			background: #d36ca7;
			color: white;
			margin-top: 15px;
			font-size: 16px;
			cursor: pointer;
		}

		input[type="submit"]:hover {
			background: #b35487;
		}

		table {
			width: 100%;
			border-collapse: collapse;
			margin-top: 25px;
		}

		th {
			background: #d36ca7;
			color: white;
			padding: 10px;
		}

		td {
			background: #ffe0f0;
			padding: 10px;
			border-bottom: 2px solid #f4c2d2;
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
			background: #f8dce3;
			color: #a8335a;
		}

		.error {
			background: #ffd1d1;
			color: #a10000;
		}
	</style>
</head>
<body>

<div class="card">

	<h2>Registro de Clientes</h2>

	<a href="Ingresar datos.html" class="btn">Regresar</a>

	<form method="POST">
		<label>ID_Cliente:</label>
		<input type="number" name="ID_Cliente" required>

		<label>Nombre del cliente:</label>
		<input type="text" name="Nombre_cliente" required>

		<label>Teléfono:</label>
		<input type="text" name="Telefono">

		<label>Edad:</label>
		<input type="text" name="Edad">

		<label>Dirección:</label>
		<input type="text" name="Direccion">

		<input type="submit" value="Registrar Cliente">
	</form>

	<h2>Lista de Clientes</h2>

	<table>
		<tr>
			<th>ID_Cliente</th>
			<th>Nombre</th>
			<th>Teléfono</th>
			<th>Edad</th>
			<th>Dirección</th>
		</tr>

		<?php
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				echo "<tr>
					<td>{$row['ID_Cliente']}</td>
					<td>{$row['Nombre_cliente']}</td>
					<td>{$row['Telefono']}</td>
					<td>{$row['Edad']}</td>
					<td>{$row['Direccion']}</td>
				</tr>";
			}
		} else {
			echo "<tr><td colspan='5'>No hay clientes disponibles</td></tr>";
		}

		$conn->close();
		?>
	</table>

</div>

</body>
</html>