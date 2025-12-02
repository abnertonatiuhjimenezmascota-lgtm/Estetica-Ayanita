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
	$ID_Material = $_POST['ID_Material'];	
	$Nombre_material = $_POST['Nombre_material'];
	$Costo_material = $_POST['Costo_material'];
	$Lugar_compra = $_POST['Lugar_compra'];
	$Inventario = $_POST['Inventario'];


$sql = "UPDATE materiales SET Nombre_material = '$Nombre_material', Costo_material = '$Costo_material', Lugar_compra = '$Lugar_compra', 
Inventario = '$Inventario' WHERE ID_Material = $ID_Material";
//Ejecutar e imformar
	if($conn->query($sql)){
	echo "Factura actualizada correctamente";
	} else {
	echo "Error: " . $sql->error;
}
}

//Consulta
$sql = "SELECT * FROM materiales";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title> Materiales estetica </title>
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

		<h2>Registro de Materiales</h2>

		<a href="Actualizar datos.html" class="btn">Regresar</a>

		<form method="POST">

			<label>ID_Material:</label>
			<input type="number" name="ID_Material">

			<label>Nombre del Material:</label>
			<input type="text" name="Nombre_material">

			<label>Costo del Material:</label>
			<input type="text" name="Costo_material">

			<label>Lugar de Compra:</label>
			<input type="text" name="Lugar_compra">

			<label>Inventario:</label>
			<input type="text" name="Inventario">

			<input type="submit" value="Registrar Material">

		</form>

		<h2>Lista de Materiales</h2>

		<table>
			<tr>
				<th>ID</th>
				<th>Nombre</th>
				<th>Costo</th>
				<th>Lugar de Compra</th>
				<th>Inventario</th>
			</tr>

			<?php
			if ($result->num_rows > 0) {
				while ($row = $result->fetch_assoc()) {
					echo "<tr>
					<td>".$row["ID_Material"]."</td>
					<td>".$row["Nombre_material"]."</td>
					<td>".$row["Costo_material"]."</td>
					<td>".$row["Lugar_compra"]."</td>
					<td>".$row["Inventario"]."</td>
					</tr>";
				}
			} else {
				echo "<tr><td colspan='5'>No hay materiales disponibles</td></tr>";
			}

			$conn->close();
			?>
		</table>

	</div>



</body>
</html>