<?php
//ini_set( 'display_errors', 0 );

header("Content-Type: text/javascript");
$data = json_decode(file_get_contents('php://input'), true);

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$db = "messages";

$conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Conexion fallida: %s\n". $conn -> error);

$sql = "SELECT * FROM users WHERE username='" . $data["username"] . "'";

$result = $conn->query($sql);
//si existe lo update
if ($result->num_rows > 0) {
	$sql = "UPDATE users SET ";
	$sql .= "nombres='" . $data["nombres"] . "',";
	$sql .= "apellidos='" . $data["apellidos"] . "',";
	$sql .= "fecha_nacimiento='" . $data["fecha_nacimiento"] . "',";
	$sql .= "email='" . $data["enail"] . "',";
	$sql .= "username='" . $data["username"] . "',";
	$sql .= "password='" . $data["password"] . "'";
	$sql .= "WHERE username='" . $data["username"] . "'";
}
else {//de lo contrario add
	$sql = "INSERT INTO users ( nombres, apellidos, fecha_nacimiento, email, username, password) ";
	$sql .= " VALUES ('" . $data["nombres"] . "', '" . $data["apellidos"] . "', '" . $data["fecha_nacimiento"] . "', '";
	$sql .=  $data["email"] . "', '" . $data["username"] . "', MD5('" . $data["password"] . "'))";
}

$result = $conn->query($sql);

if ($result === TRUE) {
	echo '{"username": "' . $data["username"] . '"}';
}
else {
	echo '{"error": "No se pudo guardar el alumno"}';
}
$conn->close();
?>