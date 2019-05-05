<!DOCTYPE html>
<html>
<head>
	<title>Twitter</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum‐scale=1.0, user‐scalable=no">
	<link rel="icon" type="image/png" href="../../imagenes/logo.png" />
	<link rel="stylesheet" type="text/css" href="../../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../../css/estilos.css">
	<script type="text/javascript" src="../../js/jquery.js"></script> 
	<script type="text/javascript" src="../../js/funciones.js"></script>
    <script type="text/javascript" src="../../js/bootstrap.min.js"></script>
	<style type="text/css">
		body{
			background: #DFE7F3;
		}
	</style>
</head> 	
<body>
	<?php
		error_reporting(0); 

		include '../../clases/conexion.php';
		$con = new conexion();

		$codigo_usuario = $_GET['cu'];

		$tw = $con->consultar($con->conectar(), "select count(*) from publicaciones where codigo_usuario = '$codigo_usuario'");
		$si = $con->consultar($con->conectar(), "select count(*) from seguidores where CODIGO_USUARIO_SEGUIDOR = '$codigo_usuario'");
		$seg = $con->consultar($con->conectar(), "select count(*) from seguidores where 
			CODIGO_USUARIO_SEGUIDO = '$codigo_usuario'");
		
		$usu = $con->consultar($con->conectar(), "select usuario, foto_perfil, foto_portada from usuarios where 
			codigo_usuario = '$codigo_usuario'");
	
		while($us = oci_fetch_array($usu, OCI_BOTH)){ 
			$usuario = $us['USUARIO']; 
			$foto_perfil = $us['FOTO_PERFIL'];
			$foto_portada = $us['FOTO_PORTADA'];
		}

		while($t = oci_fetch_array($tw, OCI_BOTH)) $tweets = $t['COUNT(*)'];
		while($s = oci_fetch_array($si, OCI_BOTH)) $siguiendo = $s['COUNT(*)'];
		while($use = oci_fetch_array($seg, OCI_BOTH)) $seguidores = $use['COUNT(*)'];
	?>
	<div id="contenedor" class="container-fluid">
		<div id="barlogin" class="col-md-12" style="margin-top: -25px;">
			<br>
			<a href="../../inicio"><img src="../../imagenes/inicio.png" width="20" style="margin-left: 0px;"> Inicio</a>
			<a href=""><img src="../../imagenes/notificaciones.png" width="20" style="margin-left: -20px;"> Notificaciones</a>
			<a href=""><img src="../../imagenes/mensaje.png" width="20" style="margin-left: -20px;"> Mensajes</a>
			<a href="../clases/cerrar_sesion.php" style="float: right; margin-top: -5px; border-radius: 20px; border: 1px solid gray; padding: 5px 30px;">Cerrar Sesion</a>
		</div>
		<center>
			<img src="../../imagenes/logo.png" width="22" style="margin-top: -40px; z-index: 2; position: absolute;">
		</center>
	</div>
	<div style="width: 100%; height: 212px; background: #fff;">
		<div style="background: #4996FF; height: 150px; width: 100%;">
			<img src="<?php echo "../".$foto_perfil; ?>" width="200" height="200" style="background-color: #fff; padding: 5px; border-radius: 200px; margin-top: 50px; margin-left: 100px;">
			<div style="margin-left: 350px; margin-top: -155px;">
				<div id="link">
					<div style="margin-left: 10px; width: 400px;">
					<div class="row" style="margin-top: 60px;">
					<div class="col-md-3" style="padding: 2px;"><a href="#">Tweets</a><br><b style="margin-left: -10px;"><a href="../?cu=<?php echo $codigo_usuario; ?>" id="v" href="" style="padding: 5px 30px;"><?php echo $tweets; ?></a></b></div>
					<div class="col-md-3" style="padding: 2px;"><a href="#">Siguiendo</a><br><b style="margin-left: 0px;"><a id="v" style="padding: 5px 30px;" href=""><?php echo $siguiendo; ?></a></b></div>
					<div class="col-md-3" style="padding: 2px;"><a href="#">Seguidores</a><br><b style="margin-left: 0px;"><a id="v" href="../seguidores/?cu=<?php echo $codigo_usuario; ?>" style="padding: 5px 30px;"><?php echo $seguidores; ?></a></b></div>
					</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid" style="padding: 0px 90px;">
	<section class="row" style="margin: 0; width: 100%;">
		<aside class="col-md-3" style="padding: 7px;">
			<p style="margin-top: 50px; margin-left: 10px;"><b><?php echo $usuario; ?></b></p>
			<div style="margin-top: 10px; margin-left: 10px;"><p style="margin-left: -50px;">© 2019 Twitter Sobre nosotros<br> Centro de Ayuda Condiciones Política de <br> privacidad Cookies Información sobre anuncios</p></div>
		</aside>
		<aside class="col-md-9" style="margin-top: -10px; padding: 7px; ">
			<div id="secsegui" style="margin-top: 10px;"></div>
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
		    var codigo_usuario = "<?php echo $codigo_usuario;?>";
		    var usuario = "<?php echo $usuario; ?>";

		    if(codigo_usuario.length!=0){
			    $.ajax({
			        url: "../../clases/sig_seg.php?accion=1",
			        type: "post",
			        data: {codigo_usuario: codigo_usuario, usuario: usuario}, 
			        success: function (datos) {
			        	$("#secsegui").html(datos);
			        }
			    });
		    }
		    else{
	    		location.href = "../";
		    }
		});
	</script>
</body>
</html>