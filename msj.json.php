<?php
//include("seguridad.php");
header("Content-Type: text/javascript");
//$data = json_decode(file_get_contents('php://input'), true);
session_start();//sigue en sesion iniciada

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$db = "messages";
 
$conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Conexion fallida: %s\n". $conn -> error);

$sql = "SELECT * FROM message WHERE remitente='".$_SESSION["loggedID"]."'";
$result = $conn->query($sql);
$mensajitos = array();

while($row = $result->fetch_assoc()) {
	$sql_= "SELECT username FROM users WHERE destinatario!='".$_SESSION["loggedID"]."'";
	$id = $row["id"];
	$item = '{"id": "' . $id . '", "h_d": "' . $row["h_d"]; //h_d[hora-dia]
	$item .= '", "remitente": "' . $row["remitente"];

	$item .= '", "destinatario": "' . $row["destinatario"];
	$item .= '", "mensaje": "' . $row["mensaje"]. '"}';
	array_push($mensajitos, $item);
}
echo "[" . implode(", ", $mensajitos) . "]";

$conn->close();
?>