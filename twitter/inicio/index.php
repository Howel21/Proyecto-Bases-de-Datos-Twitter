<!DOCTYPE html>
<html>
<head>
	<title>Twitter</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum‐scale=1.0, user‐scalable=no">
	<link rel="icon" type="image/png" href="../imagenes/logo.png" />
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/estilos.css">
	<script type="text/javascript" src="../js/jquery.js"></script> 
	<script type="text/javascript" src="../js/funciones.js"></script>
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>
	<style type="text/css">
		body{
			background: #DFE7F3;
		}
	</style>
</head> 	
<body>
	<?php 
		error_reporting(0); 

		include '../clases/conexion.php';
		$con = new conexion();

		session_start();
		$codigo_sesion = $_SESSION['CUsuario'];
		$usuario = $_SESSION['usuario'];

		$tw = $con->consultar($con->conectar(), "select count(*) from publicaciones where codigo_usuario = '$codigo_sesion'");
		$si = $con->consultar($con->conectar(), "select count(*) from seguidores where CODIGO_USUARIO_SEGUIDOR = '$codigo_sesion'");
		$se = $con->consultar($con->conectar(), "select count(*) from seguidores where CODIGO_USUARIO_SEGUIDO = '$codigo_sesion'");
	
		$usu = $con->consultar($con->conectar(), "select usuario, foto_perfil, foto_portada from usuarios where 
			codigo_usuario = '$codigo_sesion'");
	
		while($us = oci_fetch_array($usu, OCI_BOTH)){ 
			$usuario = $us['USUARIO']; 
			$foto_perfil = $us['FOTO_PERFIL'];
			$foto_portada = $us['FOTO_PORTADA'];
		}

		$_SESSION['foto_perfil'] = $foto_perfil;

		while($t = oci_fetch_array($tw, OCI_BOTH)) $tweets = $t['COUNT(*)'];
		while($s = oci_fetch_array($si, OCI_BOTH)) $siguiendo = $s['COUNT(*)'];
		while($useg = oci_fetch_array($se, OCI_BOTH)) $siguidores = $useg['COUNT(*)'];
	?>
	<div id="contenedor" class="container-fluid">
		<div id="barlogin" class="col-md-12" style="margin-top: -25px;">
			<br>
			<a href=""><img src="../imagenes/inicio.png" width="20" style="margin-left: 0px;"> Inicio</a>
			<a href=""><img src="../imagenes/notificaciones.png" width="20" style="margin-left: -20px;"> Notificaciones</a>
			<a href=""><img src="../imagenes/mensaje.png" width="20" style="margin-left: -20px;"> Mensajes</a>
			<a href="../clases/cerrar_sesion.php" style="float: right; margin-top: -5px; border-radius: 20px; border: 1px solid gray; padding: 5px 30px;">Cerrar Sesion</a>
		</div>
		<center>
			<img src="../imagenes/logo.png" width="22" style="margin-top: -40px; z-index: 2; position: absolute;">
		</center>
	</div>

	<div class="container-fluid" style="padding: 0px 90px;">
	<section class="row" style="margin-top: 10px;">
		<article class="col-md-3" style="padding: 7px;">
			<div id="secusuario">
				<div style="background-color: #4996FF; height: 95px;">
					<img src="<?php echo $foto_perfil ?>" width="70" height="70" style="background-color: #fff; padding: 2px; border-radius: 40px; margin-top: 60px; margin-left: 10px;">
					<a href="../perfil/?cus=<?php echo $codigo_sesion; ?>"><p style="margin-top: -25px; margin-left: 90px; color: #000;"><b><?php echo $usuario; ?></b></p></a>
				</div>
				<div class="container-fluid" style="margin-left: 10px;">
					<div class="row" style="margin-top: 60px;">
					<div class="col-md-3" style="padding: 2px;"><a href="#">Tweets</a><br><b style="margin-left: 0px;"><?php echo $tweets; ?></b></div>
					<div class="col-md-4" style="padding: 2px;"><a href="../perfil/siguiendo/?cu=<?php echo $codigo_sesion; ?>">Siguiendo</a><br><b style="margin-left: 0px;"><?php echo $siguiendo; ?></b></div>
					<div class="col-md-3" style="padding: 2px;"><a href="../perfil/seguidores/?cu=<?php echo $codigo_sesion; ?>">Seguidores</a><br><b style="margin-left: 0px;"><?php echo $siguidores; ?></b></div>
					</div>
				</div>
			</div>
			<div style="background: #fff; height: 400px; margin-top: 10px;">
				<p style="padding-top: 20px;"><b>Tendencias</b></p>
				<a href="" style="color: #008FEA; margin-left: 60px;">#Fuera JOH</a><br><hr>	
				<a href="" style="color: #008FEA; margin-left: 60px;">#VivaLaChampions</a><br><hr>
				<a href="" style="color: #008FEA; margin-left: 60px;">#PorUNAHondurasMejor</a><br><hr>
				<a href="" style="color: #008FEA; margin-left: 60px;">#ComidasTradicionales</a><br><hr>
				<a href="" style="color: #008FEA; margin-left: 60px;">#Tendencias</a><br><hr>
				<a href="" style="color: #008FEA; margin-left: 60px;">#Twitter</a><br><hr>
			</div>
		</article>
		<aside class="col-md-6" style="padding: 7px;">
			<div id="secanuncios">		
				<form enctype="multipart/form-data" id="formulario" method="post">
					<div style="float: left; width: 100%; background-color: #D7E7FF; padding: 15px;">
						<input type="hidden" name="codigo_usuario" value="<?php echo $codigo_sesion; ?>">
						<input type="hidden" name="usuario" value="<?php echo $usuario; ?>">
						<img src="<?php echo $foto_perfil; ?>" width="35" height="35" style="background-color: #fff; padding: 0px; border-radius: 40px; margin-left: 10px; float: left; margin-right: 10px;">
						<textarea id="tweet" name="tweet" placeholder="¿Que estas pensando"></textarea>
					</div>
					<div id="ctweet">
						<img src="../imagenes/cimg.png" id="foto" width="30" style="margin-left: 55px; margin-top: -35px;">
						<br>
						<input type="file" onchange="loadFile(event)" name="img" id="fimg">
						<input type="submit" class="btn btn-primary" style="float: right; margin-top: -40px; margin-right: 35px; border-radius: 20px; padding: 5px 15px;" value="Twittear" />
					</div>
				</form>
			</div>
			<br><br><br>
			<div id="coment"></div>
		</aside>
		<aside class="col-md-3" style="padding: 7px;">
			<div id="secaseguir"></div>
		</aside>
	</section>

	<!-- Modal Confirmacion-->
	<div class="modal fade" id="ModalComentario" role="dialog">
	    <div class="modal-dialog">
	      <div class="modal-content"> 
	         <h5 class="modal-title" id="myModalLabel" style="margin-left: 20px; margin-top: 20px;"><b>Respuesta a <?php echo $usuario; ?></b></h5>
	          <br>
	          <center>
	            <p id="codP"></p>
	          </center>
	          <br><br>
	            <!-- Modal Body -->
	            <div class="modal-body">
	                <p class="statusMsg"></p>
	                <form role="form" method="POST">
	                    <div class="form-group">
	                    	<p style="float: left; margin-left: 0px;" id="com"></p>
							<div style="float: left; width: 100%; background-color: #D7E7FF; padding: 15px;">
							<input type="hidden" id="cod_usu" value="<?php echo $codigo_sesion; ?>">
							<input type="hidden" id="cod_tweet" value="">
							<textarea id="comentario_tweet" style="width: 100%; height: 100px;" placeholder="Twittea tu respuesta"></textarea>
							<br><br><br><br><br>
							<input type="button" class="btn btn-primary" value="Responder" style=" float: right; width: 120px; padding: 0px; border-radius: 20px;" onclick="agregarComentario()" />
							</div>
	                    </div>
	                </form>
	                <br>
	            </div>
	        </div>
	    </div>
	</div>

	<!-- Modal Publicaciones-->
	<div class="modal fade" id="MPublicacion" role="dialog">
	    <div class="modal-dialog">
	      <div class="modal-content"> 
	         <h5 class="modal-title" id="myModalLabel" style="margin-left: 20px; margin-top: 20px;"><b>
	         	<?php echo $usuario; ?></b></h5>
	          <br>
	          <center>
	            <p id="codP"></p>
	          </center>
	          <br><br>
	            <!-- Modal Body -->
	            <div class="modal-body">
	                <p style="margin-left: 0;" id="valorprueba"></p>
	            </div>
	        </div>
	    </div>
	</div>

	<script type="text/javascript">
		$(document).ready(function(){
		    var codigo_usuario = "<?php echo $codigo_sesion;?>";
		    var usuario = "<?php echo $usuario; ?>";
		    var foto_perfil = "<?php echo $foto_perfil; ?>";

		    if(codigo_usuario.length!=0){
			    $.ajax({
			        url: "../clases/mostrar_tweet.php",
			        type: "post",
			        data: {codigo_usuario: codigo_usuario, usuario: usuario, foto_perfil: foto_perfil}, 
			        success: function (datos) {
			            $("#coment").html(datos);
			        }
			    });
		    }
		    else{
	    		location.href = "../";
		    }
		});

		$(document).ready(function(){
			var codigo_usuario = "<?php echo $codigo_sesion;?>";

		    $.ajax({
		        url: "../clases/usuarios_a_seguir.php",
		        type: "post",
		        data: {codigo_usuario: codigo_usuario},
		        success: function (datos) {
		            $("#secaseguir").html(datos);
		        }
		    });
		});
	</script>
</body>
</html>