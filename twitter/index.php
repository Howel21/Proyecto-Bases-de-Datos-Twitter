<!DOCTYPE html>
<html>
<head>
	<title>Twitter</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum‐scale=1.0, user‐scalable=no">
	<link rel="icon" type="image/png" href="imagenes/logo.png" />
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/estilos.css">

	<style type="text/css">
		td{
			background: #3F709E;
		}
	</style>
</head>
<body>
	<?php  
		include 'clases/conexion.php';
		$con = new conexion();
	?>
<div id="contenedor" class="container-fluid">
<section class="row">
	<article id="art1" class="col-md-7">
		<img id="banner" src="imagenes/banner.jpeg">
	</article>
	<article class="col-md-5">
		<center>
			<img style="margin-top: 50px; padding: 0; margin-left: -400px;" src="imagenes/logo.png" width="60" height="60">
			<p style="font-size: 30px; text-align: left; margin-top: 50px; margin-left: 30px;"><b>Descubre lo que está pasando en el mundo en este momento</b></p>
			<p style="font-size: 20px; text-align: left; margin-top: 50px; margin-left: 30px;"><b>Únete hoy Twitter.</b></p><br><br>
			<a style="text-decoration: none; 	padding: 10px 200px; background: #2786FC; color: #fff; border-radius: 20px;" href="registrate">Registrarse</a><br><br>
			<a style="text-decoration: none; padding: 10px 194px; background: #fff; color: #2786FC; border: 1px solid #2786FC; border-radius: 20px;" href="login">Iniciar sesion</a>
		</center>
	</article>
</section>
<footer class="col-md-12">
	<a href="">Sobre nosotros</a>
	<a href="">Centro de ayuda</a>
	<a href="">Blog</a>
	<a href="">Estado</a>
	<a href="">Empleos</a>
	<a href="">Condiciones</a>
	<a href="">Politica de Privacidad</a>
	<a href="">Cookies</a>
	<a href="">Informacion sobre anuncios</a>
	<a href="">Marca</a>
	<a href="">Aplicaciones</a>
</footer>
</div>	
</body>
</html>