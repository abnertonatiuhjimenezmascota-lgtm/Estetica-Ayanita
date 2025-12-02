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


$sql = "UPDATE clientes SET Nombre_cliente = '$Nombre_cliente', Telefono = '$Telefono', Edad = '$Edad', 
Direccion = '$Direccion' WHERE ID_Cliente = $ID_Cliente";
//Ejecutar e imformar
	if($conn->query($sql)){
	echo "Factura actualizada correctamente";
	} else {
	echo "Error: " . $sql->error;
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
			background-image: url("Fondo3.jpg");
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
			width: 600px;
			animation: fadeIn 0.6s ease;
		}

		@keyframes fadeIn {
			from { opacity: 0; transform: translateY(15px); }
			to   { opacity: 1; transform: translateY(0); }
		}

		h2 {
			color: #c75b9b;
			text-align: center;
			margin-bottom: 20px;
			font-size: 26px;
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

		form label {
			font-weight: bold;
			color: #9b4f7c;
		}

		input[type="text"], input[type="number"] {
			width: 100%;
			padding: 10px;
			border: 2px solid #f1cce3;
			border-radius: 10px;
			margin-top: 5px;
			margin-bottom: 15px;
		}

		input[type="submit"] {
			background: #c75b9b;
			color: white;
			padding: 12px 20px;
			border: none;
			border-radius: 10px;
			width: 100%;
			font-size: 16px;
			cursor: pointer;
			margin-top: 10px;
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

		tr:last-child td {
			border-bottom: none;
		}

		.alert {
			padding: 10px;
			border-radius: 10px;
			text-align: center;
			font-weight: bold;
			width: 400px;
			margin: 10px auto;
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

		<h2>Registro de Clientes</h2>

		<a href="Actualizar datos.html" class="btn">Regresar</a>

		<form method="POST">

			<label>ID_Cliente:</label>
			<input type="number" name="ID_Cliente">

			<label>Nombre del Cliente:</label>
			<input type="text" name="Nombre_cliente">

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
				<th>ID</th>
				<th>Nombre</th>
				<th>Teléfono</th>
				<th>Edad</th>
				<th>Dirección</th>
			</tr>

			<?php
			if ($result->num_rows > 0) {
				while ($row = $result->fetch_assoc()) {
					echo "<tr>
					<td>".$row["ID_Cliente"]."</td>
					<td>".$row["Nombre_cliente"]."</td>
					<td>".$row["Telefono"]."</td>
					<td>".$row["Edad"]."</td>
					<td>".$row["Direccion"]."</td>
					</tr>";
				}
			} else {
				echo "<tr><td colspan='5'>No hay clientes registrados</td></tr>";
			}

			$conn->close();
			?>
		</table>

	</div>


</body>
</html>