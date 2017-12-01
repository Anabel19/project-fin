

header("Content-Type: text/javascript");
session_start();

$data = json_decode(file_get_contents('php://input'), true);

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$db = "messages";
 
$conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Conexion fallida: %s\n". $conn -> error);

$sql = "SELECT * FROM users WHERE username='" .  $data["username"] . "' AND password=md5('" .  $data["password"] . "')";
$result = $conn->query($sql);

$usuarios = array();

if($row = $result->fetch_assoc()) {
	$_SESSION["user"] = $row["username"];
	echo '{"response": "Inicio correcto", "user": "' . $row["username"] . '"}';
} else {
	echo '{"response": "Usuario o contraseña no valida."}';
}

$conn->close();
<?php
/*
//ALTERNATIVA JAVA
<script>
	$(document).ready(function(){
         $("#login_btn").on('click',function() {
	     	var user= $("#usernameA").val();
		    var pass= $("#passwordA").val();
		 
		    if( user =="" || pass=="")
		        alert("Revisar las entradas");	
			//var data ="user"+user + "&pass" + pass;	
			else{
				$.ajax({
					method: "post",
					url: "login.json.php",
					data: {
						login_btn: 1,
						userphp: user,
						passphp: pass
					},
					success: function(response){ //responseText[checked data q obtenemos in this variable]
					//$("#login_error").html(data);
						$("#response").html(response);
						window.location.href="i.html";
						//if(response.indexOf('success')>=0)
							//window.location.href='i.html'
					},
					dataType:'text'
				});
			}
		});	
	 });
	 //<div id="login_error"></div> 
</script>
*/


//ini_set( 'display_errors', 0 );
//ALTERNATIVA LOGIN-PHP
/*
header("Content-Type: text/javascript");
$data = json_decode(file_get_contents('php://input'), true);

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$db = "messages";
/*
session_start();
 //si ya existe la sesion
 if (isset($_SESSION['loggedIN'])){
	echo ('<a href=ready.json.php>Bienvenido(a)!</a>'.$_SESSION['user']); 
   //header("Location: conexion.php");
   //header(script: 'Location: ready.json.php');
   exit();
 }
if(isset($_POST['login_btn'])){
    $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Conexion fallida: %s\n". $conn -> error);

	$user = $conn->real_escape_string($_POST['userphp']);
	$pass = $conn->real_escape_string($_POST['passphp']);
	
	$sql = "SELECT * FROM users WHERE username='$user' and password=md5('$pass')";
	
	$result = $conn->query($sql);
	//$rows =$result->num_rows;
	if($result->num_rows >0){//todo bien..vamos a loguear
		session_start();
		$_SESSION["loggedIN"]="SIP"; //estoy ingresando
		$_SESSION["userA"]=$user;
		//header("Location: conexion.php");
		echo('<font color="blue"> Cargando</font>');
		//echo ('<a href=i.html>Bienvenido(a)!</a>'.$_SESSION['userA']);
	}
	else{
		echo('<font color="red"> Revise username or password</font>');
		echo "<br><a href='users.html'>Volver a Intentarlo</a>";
	}
	
$conn->close();

}
*/
?>