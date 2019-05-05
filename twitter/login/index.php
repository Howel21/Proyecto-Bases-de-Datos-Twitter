<!DOCTYPE html>
<html>
<head>
	<title>Iniciar sesión en twitter</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum‐scale=1.0, user‐scalable=no">
	<link rel="icon" type="image/png" href="../imagenes/logo.png" />
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/estilos.css">
	<style type="text/css">
		body{
			background: #DFE7F3;
		}
	</style>
</head>
<body>
	<div id="contenedor" class="container-fluid">
		<div id="barlogin" class="col-md-12">
			<a href=""><img src="../imagenes/logo.png" width="20" height="20"> Inicio</a>
			<a href="">Sobre nosotros</a>
		</div>
	</div>
	<div class="container-fluid">
		<center>
			<div class="col-md-9">
				<form id="formLogin" action="../clases/login.php" method="POST">
					<br><br>
					<p style="font-size: 25px;"><b>Iniciar sesión en Twitter</b></p>
					<input type="text" name="usuario" placeholder="Telefono, correo o usuario"><br>
					<input type="password" name="clave" placeholder="Contraseña">
					<br>
					<button class="btn btn-primary" type="submit">Iniciar sesión</button>
				</form>
			</div>
		</center>
	</div>
</body>
</html>