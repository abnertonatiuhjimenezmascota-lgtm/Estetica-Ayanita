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
	$ID_Factura = $_POST['ID_Factura'];	
	$ID_Cliente = $_POST['ID_Cliente'];
	$ID_Servicios = $_POST['ID_Servicios'];
	$Fecha_factura = $_POST['Fecha_factura'];
	$Cantidad_servicio = $_POST['Cantidad_servicio'];
	$Costo_servicio = $_POST['Costo_servicio'];
    $Total_ingreso = $_POST['Total_ingreso'];


//Preparar secuencia MySQL
	$sql = "INSERT INTO facturas (ID_Factura, ID_Cliente, ID_Servicios, Fecha_factura, Cantidad_servicio, Costo_servicio, Total_ingreso) 
    VALUES ('$ID_Factura', '$ID_Cliente', '$ID_Servicios', '$Fecha_factura', '$Cantidad_servicio', '$Costo_servicio', '$Total_ingreso')";

//Ejecutar e imformar
    if ($conn->query($sql) === TRUE){
        echo "<p> Factura agregada correctamente. </p>";
    } else {
        echo "<p> Error: " . $conn->error . "</p>";
    }
}


//consultar datos
$sql = "SELECT ID_Cliente, Nombre_cliente FROM clientes";
	$resultCliente = $conn->query($sql);
$sql = "SELECT ID_Servicios, Nombre_servicio, Precio_servicio FROM servicios";
$resultServicios = $conn->query($sql);

//Consulta
$sql = "SELECT * FROM facturas";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title> Formulario de registro </title>
</head>
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
			width: 750px;
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

		input, select {
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

	<h2>Registro de Facturas</h2>

	<a href="Ingresar datos.html" class="btn">Regresar</a>

	<form method="POST">

		<label>ID_Factura:</label>
		<input type="number" name="ID_Factura" required>

		<label>ID_Cliente:</label>
		<select name="ID_Cliente" required>
			<option value="">-- Selecciona un cliente --</option>
			<?php
			if ($resultCliente->num_rows > 0) {
				while ($row = $resultCliente->fetch_assoc()) {
					echo "<option value='{$row['ID_Cliente']}'>{$row['ID_Cliente']} - {$row['Nombre_cliente']}</option>";
				}
			}
			?>
		</select>

		<label>ID_Servicios:</label>
		<select name="ID_Servicios" required>
			<option value="">-- Selecciona un servicio --</option>
			<?php
			if ($resultServicios->num_rows > 0) {
				while ($row = $resultServicios->fetch_assoc()) {
					echo "<option value='{$row['ID_Servicios']}'>{$row['ID_Servicios']} - {$row['Nombre_servicio']} - $ {$row['Precio_servicio']}</option>";
				}
			}
			?>
		</select>

		<label>Fecha de factura:</label>
		<input type="date" name="Fecha_factura">

		<label>Cantidad del servicio:</label>
		<input type="text" name="Cantidad_servicio">

		<label>Costo del servicio:</label>
		<input type="text" name="Costo_servicio">

		<label>Total ingreso:</label>
		<input type="text" name="Total_ingreso">

		<input type="submit" value="Registrar factura">

	</form>

	<h2>Lista de Facturas</h2>

	<table>
		<tr>
			<th>ID_Factura</th>
			<th>ID_Cliente</th>
			<th>ID_Servicios</th>
			<th>Fecha</th>
			<th>Cantidad</th>
			<th>Costo</th>
			<th>Total</th>
		</tr>

		<?php
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				echo "<tr>
					<td>{$row['ID_Factura']}</td>
					<td>{$row['ID_Cliente']}</td>
					<td>{$row['ID_Servicios']}</td>
					<td>{$row['Fecha_factura']}</td>
					<td>{$row['Cantidad_servicio']}</td>
					<td>{$row['Costo_servicio']}</td>
					<td>{$row['Total_ingreso']}</td>
				</tr>";
			}
		} else {
			echo "<tr><td colspan='7'>No hay facturas disponibles</td></tr>";
		}

		$conn->close();
		?>
	</table>

</div>



</body>
</html>