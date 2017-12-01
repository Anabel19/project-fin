<?php
include("seguridad.php");

echo ('Usuario'.$_SESSION["userA"]) ;
header("Content-Type: text/javascript");
$data = json_decode(file_get_contents('php://input'), true);

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$db = "messages";

$conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Conexion fallida: %s\n". $conn -> error);

//$sql = "SELECT * FROM message WHERE remitente='" . $_SESSION["userA"] . "'";
echo('lll'.$data["destinatario"]);
if($_SESSION["loggedID"]!= $data["destinatario"] ){
	$sql = "SELECT * FROM message";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		$sql = "INSERT INTO message ( remitente, destinatario, mensaje) ";
		$sql .= " VALUES ( '" . $_SESSION["loggedID"] . "','" . $data["destinatario"] . "', '" . $data["newmensaje"] . "')";
	}
}
$result = $conn->query($sql);

if ($result === TRUE) {
	echo '{"remitente": "' . $data["remitente"] . '"}';
}
else {
	echo '{"error": "No se pudo guardar el mensaje"}';
}
$conn->close();
?>

