<?php
header("Content-Type: text/javascript");
//session_start();
$data = json_decode(file_get_contents('php://input'), true);

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$db = "messages";
 
$conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Conexion fallida: %s\n". $conn -> error);

$sql = "SELECT username,id FROM users WHERE username='" .  $data["username"] . "' AND password=md5('" .  $data["password"] . "')";
$result = $conn->query($sql);

$usuarios = array();

if($row = $result->fetch_assoc()) {
	session_start();
		$_SESSION["loggedIN"]="SIP"; //estoy ingresando
		$_SESSION["userA"]=$row["username"];
		$_SESSION["loggedID"]=$row["id"];
		//header("Location: conexion.php");
		echo('<font color="blue"> Cargando</font>');
		echo ('<a href=i.html>Bienvenido(a)!</a>'.$_SESSION['userA']);

} else {
	echo('<font color="red"> Revise username or password</font>');
	echo "<br><a href='users.html'>Volver a Intentarlo</a>";

}

$conn->close();
?>
