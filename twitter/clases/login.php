<?php  
	include 'conexion.php';
	$con = new conexion();

	$usuario = $_POST['usuario'];
	$clave = $_POST['clave'];

	$st = $con->consultar($con->conectar(), "select codigo_usuario, usuario from usuarios where usuario = '$usuario' and contrasenia = '$clave'");

	while($id = oci_fetch_array($st, OCI_BOTH)){ $CUsuario = $id['CODIGO_USUARIO']; } 

	$rsCod = oci_num_rows($st);

	if($rsCod > 0){
		session_start();
		$_SESSION['sesion'] = 1;
		$_SESSION['CUsuario'] = $CUsuario;
		$_SESSION['usuario'] = $usuario;
		header('Location: ../inicio');
	}
	else{
		session_start();
		$_SESSION['sesion'] = 0;
		header('Location: ../login');
	}
?>