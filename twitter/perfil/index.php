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

		$codigo_usuario = $_GET['cu'];
		$codigo_usuario_sesion = $_GET['cus'];

		$tw = $con->consultar($con->conectar(), "select count(*) from publicaciones where codigo_usuario = '$codigo_usuario' or codigo_usuario = '$codigo_usuario_sesion'");
		$si = $con->consultar($con->conectar(), "select count(*) from seguidores where CODIGO_USUARIO_SEGUIDOR = '$codigo_usuario' or CODIGO_USUARIO_SEGUIDOR = '$codigo_usuario_sesion'");
		$seg = $con->consultar($con->conectar(), "select count(*) from seguidores where 
			CODIGO_USUARIO_SEGUIDO = '$codigo_usuario' or CODIGO_USUARIO_SEGUIDO = '$codigo_usuario_sesion'");

		$usu = $con->consultar($con->conectar(), "select usuario, foto_perfil, foto_portada from usuarios where 
			codigo_usuario = '$codigo_usuario' or codigo_usuario = '$codigo_usuario_sesion'");
	
		while($us = oci_fetch_array($usu, OCI_BOTH)){ 
			$usuario = $us['USUARIO']; 
			$foto_perfil = $us['FOTO_PERFIL'];
			$foto_portada = $us['FOTO_PORTADA'];
		}

		session_start();
		$_SESSION['foto_perfil'] = $foto_perfil;

		while($t = oci_fetch_array($tw, OCI_BOTH)) $tweets = $t['COUNT(*)'];
		while($s = oci_fetch_array($si, OCI_BOTH)) $siguiendo = $s['COUNT(*)'];
		while($use = oci_fetch_array($seg, OCI_BOTH)) $seguidores = $use['COUNT(*)'];
	?>
	<div id="contenedor" class="container-fluid">
		<div id="barlogin" class="col-md-12" style="margin-top: -25px;">
			<br>
			<a href="../inicio"><img src="../imagenes/inicio.png" width="20" style="margin-left: 0px;"> Inicio</a>
			<a href=""><img src="../imagenes/notificaciones.png" width="20" style="margin-left: -20px;"> Notificaciones</a>
			<a href=""><img src="../imagenes/mensaje.png" width="20" style="margin-left: -20px;"> Mensajes</a>
			<a href="../clases/cerrar_sesion.php" style="float: right; margin-top: -5px; border-radius: 20px; border: 1px solid gray; padding: 5px 30px;">Cerrar Sesion</a>
		</div>
		<center>
			<img src="../imagenes/logo.png" width="22" style="margin-top: -40px; z-index: 2; position: absolute;">
		</center>
	</div>
	<div style="width: 100%; height: 212px; background: #fff;">
		<div style="background: #4996FF; height: 150px; width: 100%;">
			<img src="<?php echo $foto_perfil; ?>" width="200" height="200" style="background-color: #fff; padding: 5px; border-radius: 200px; margin-top: 50px; margin-left: 100px;">
			<div style="margin-left: 350px; margin-top: -155px;">
				<div id="link">
					<div style="margin-left: 10px; width: 400px;">
					<div class="row" style="margin-top: 60px;">
					<div class="col-md-3" style="padding: 2px;"><a href="?cu=<?php 
					if($codigo_usuario!="")
						echo $codigo_usuario; 
					else
						echo $codigo_usuario_sesion;
					?>">Tweets</a><br><b style="margin-left: -10px;"><a id="v" href="" style="padding: 5px 30px;"><?php echo $tweets; ?></a></b></div>
					<div class="col-md-3" style="padding: 2px;"><a href="#">Siguiendo</a><br><b style="margin-left: 0px;"><a id="v" style="padding: 5px 30px;" href="siguiendo/?cu=<?php 
					if($codigo_usuario!="")
						echo $codigo_usuario; 
					else
						echo $codigo_usuario_sesion;
					?>"><?php echo $siguiendo; ?></a></b></div>
					<div class="col-md-3" style="padding: 2px;"><a href="#">Seguidores</a><br><b style="margin-left: 0px;"><a id="v" href="seguidores/?cu=<?php 
					if($codigo_usuario!="")
						echo $codigo_usuario; 
					else
						echo $codigo_usuario_sesion; ?>" style="padding: 5px 30px;"><?php echo $seguidores; ?></a></b></div>
					</div>
						<input style="background: #fff; border: 1px solid #C3C2C2; border-radius: 35px; padding: 5px 10px; right: 100px; color: #676767; top: 215px; position: absolute; display: none;" type="button" id="editar" value="Editar perfil" data-toggle="modal" data-target="#MPerfil">
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid" style="padding: 0px 90px;">
	<section class="row" style="margin: 0; width: 100%;">
		<aside class="col-md-3" style="padding: 7px;">
			<p style="margin-top: 50px; margin-left: 10px;"><b><?php echo $usuario ?></b></p>
			<div style="margin-top: 10px; margin-left: 10px;"><p style="margin-left: -50px;">© 2019 Twitter Sobre nosotros<br> Centro de Ayuda Condiciones Política de <br> privacidad Cookies Información sobre anuncios</p></div>
		</aside>
		<aside class="col-md-6" style="margin-top: -10px; padding: 7px;">
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

	<!-- Modal Perfil-->
	<div class="modal fade" id="MPerfil" role="dialog">
	    <div class="modal-dialog">
	      <div class="modal-content"> 
	         <h5 class="modal-title" id="myModalLabel" style="color: #5DADDB; margin-left: 20px; margin-top: 20px;"><b>TU PERFIL DE TWITTER</b></h5>
	          <br>
	          <center>
	            <p id="codP"></p>
	          </center>
	          <br><br>
	            <!-- Modal Body -->
	            <div class="modal-body">
	                <form enctype="multipart/form-data" id="formperfil" method="post">
	                	<input type="text" class="form-control"  name="actusu" placeholder="Tu usuario" value="<?php echo $usuario; ?>"><br>
		                <input type="text" class="form-control" name="bio" placeholder="Biografia"><br>
		                <input type="text" class="form-control" name="web" placeholder="Sitio web"><br>
		                <label>Foto de perfil</label>
		                <label style="margin-left: 100px;">Foto de portada</label>
	                	<input type="hidden" name="codigo_usuario" value="<?php echo $codigo_usuario_sesion; ?>">
						<img src="../imagenes/cimg.png" width="40" style="margin-left: 110px; margin-top: -65px;">
						<img src="../imagenes/cimg.png" width="40" style="margin-left: 170px; margin-top: -65px;">
						<br>
						<input type="file" onchange="loadFile(event)" name="imgpe" id="fimg" style="margin-top: -55px; margin-left: 110px; width: 30px; height: 25px;">
						<input type="file" onchange="loadFile(event)" name="imgpo" id="fimg" style="margin-top: -55px; margin-left: 328px; width: 30px; height: 25px;">
						<input type="submit" class="btn btn-primary" style="float: right; margin-right: 35px; border-radius: 20px; padding: 5px 15px; background: #fff; color: #3183CF;" value="Guardar Cambios" />
					</form>
	            </div>
	        </div>
	    </div>
	</div>

	<script type="text/javascript">
		$(document).ready(function(){
			var codigo_usuario_sesion = "<?php echo $codigo_usuario_sesion;?>";
		    var codigo_usuario = "<?php echo $codigo_usuario;?>";
		    var foto_perfil = "<?php echo $foto_perfil; ?>";

		    var usuario = "<?php echo $usuario; ?>";
		    if(codigo_usuario_sesion.length!=0){
			    $.ajax({
			        url: "../clases/mostrar_tweet.php",
			        type: "post",
			        data: {codigo_usuario: codigo_usuario_sesion, usuario: usuario, foto_perfil: foto_perfil}, 
			        success: function (datos) {
			            $("#coment").html(datos);
			            document.getElementById("editar").style.display = 'block';
			        }
			    });
			}
		    else{
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
			    else { location.href = "../"; }
		    }
		});


		$(document).ready(function(){
			var codigo_usuario = "<?php echo $codigo_usuario;?>";

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