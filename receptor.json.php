<?php
header("Content-Type: text/javascript");
//json_decode[crea una matriz asociativa no objt]
//php:// [Acceso a distintos flujos de E/S]
//'php://input' [flujo de solo reading]
$data = json_decode(file_get_contents('php://input'), true);
//$data = json_decode('php://input', true);
//$data=file_get_contents('php://input');

session_start();

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$db = "messages";

$conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Conexion fallida: %s\n". $conn -> error);
echo('mmm '.$data["destino"]);
$user = $conn->real_escape_string($_POST['nickname']);
echo('llll'.$user);
$sql = "SELECT id FROM users WHERE username ='".$data["destino"]."'";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()
) {
    $id = $row["id"];
	echo ('lala'.$id);
	$sql="SELECT * FROM messages WHERE remitente='$id'";
	$result = $conn->query($sql);
	$mensajitos = array();

	while($row = $result->fetch_assoc()) {
		$id = $row["id"];
		$item = '{"id": "' . $id . '", "h_d": "' . $row["h_d"]; //h_d[hora-dia]
		$item .= '", "remitente": "' . $row["remitente"];

		$item .= '", "destinatario": "' . $row["destinatario"];
		$item .= '", "mensaje": "' . $row["mensaje"]. '"}';
		array_push($mensajitos, $item);
	}
	echo "[" . implode(", ", $mensajitos) . "]";
    
}

$conn->close();
?>