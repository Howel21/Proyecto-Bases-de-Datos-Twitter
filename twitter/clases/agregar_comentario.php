<?php  
	include 'conexion.php';
	$con = new conexion();

	$codigo_usuario= $_POST['codusu'];
	$comentario = $_POST['comtweet'];
	$codigo_tweet = $_POST['codtweet'];

	$query = "insert into comentarios(codigo_publicacion, comentario, fecha_comentario) values('$codigo_tweet', '$comentario', '')";

	$con->guardar($con->conectar(), $query);

	echo "Registrado";
?>