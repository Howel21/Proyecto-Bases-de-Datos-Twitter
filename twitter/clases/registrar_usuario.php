<?php
	include 'conexion.php';
	$con = new conexion();

	$nombre = $_POST['usuario'];
	$metodo = $_POST['metodo'];
	$contrasenia = $_POST['contrasenia'];

	$st = $con->consultar($con->conectar(), "select count(*) from usuarios where usuario = '$nombre'");
	while ($c = oci_fetch_array($st)) $validar = $c['COUNT(*)'];

	if($validar > 0){
		echo 0;
	}else{
		$con->guardar($con->conectar(), "insert into usuarios(usuario, contrasenia) values('$nombre', '$contrasenia')");

		$rs = $con->consultar($con->conectar(), "select codigo_usuario from usuarios where usuario = '$nombre'");
		while ($v = oci_fetch_array($rs)) {
			$codigo_usuario = $v['CODIGO_USUARIO'];
		}

		session_start();
		$_SESSION['CUsuario'] = $codigo_usuario;
		$_SESSION['usuario'] = $nombre;

		echo $codigo_usuario;
	}
?>