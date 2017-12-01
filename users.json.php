<?php
header("Content-Type: text/javascript");
session_start();
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$db = "messages";
 
$conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Conexion fallida: %s\n". $conn -> error);

$sql = "SELECT * FROM users WHERE id!='".$_SESSION["loggedID"]."'";
$result = $conn->query($sql);
$alumnos = array();

while($row = $result->fetch_assoc()) {
    $id = $row["id"];
    $item = '{"id": "' . $id . '", "username": "' . $row["username"];
    $item .= '", "nombres": "' . $row["nombres"];
	$item .= '", "apellidos": "' . $row["apellidos"];
	$item .= '", "fecha_nacimiento": "' . $row["fecha_nacimiento"];
    $item .= '", "email": "' . $row["email"];
    $item .= '", "password": "' . $row["password"]. '"}';
    array_push($alumnos, $item);
}
echo "[" . implode(", ", $alumnos) . "]";

$conn->close();
?>