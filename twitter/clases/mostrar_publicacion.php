<?php
	error_reporting(0);

	include 'conexion.php';
	$con = new conexion();

	$codigo_publicacion = $_POST['codigo_publicacion'];

	$st = $con->consultar($con->conectar(), "select c.codigo_comentario, u.usuario, c.comentario, p.texto_publicacion, p.enlace_publicacion
		from comentarios c
		inner join publicaciones p
		on c.CODIGO_PUBLICACION = p.CODIGO_PUBLICACION
		inner join usuarios u
		on p.CODIGO_USUARIO = u.CODIGO_USUARIO
		where c.CODIGO_PUBLICACION = ".$codigo_publicacion);

	while($publicacion = oci_fetch_array($st, OCI_BOTH)){
		if($publicacion['ENLACE_PUBLICACION']!=""){
			echo '
			    <div id="mc" onclick="MostrarPublicacion('."'".''.$publicacion['TEXTO_PUBLICACION'].''."'".','.$codigo_publicacion.')" data-toggle="modal" data-target="#MPublicacion">
					<div id="comentario" style="margin-top: 10px; background-color: #fff; padding-bottom: 10px;">
					<input type="hidden" id="codigo_tweet" value="'.$codigo_publicacion.'">
					<p style="margin-left: 10px;">'.$publicacion['TEXTO_PUBLICACION'].'</p>
					<center>
						<img src="'.$publicacion['ENLACE_PUBLICACION'].'" width="100%" height="400" style="margin-bottom: 10px; border-radius: 20px;"> 
					</center>
					</div>
				</div>	
				<div style="background-color: #fff; padding-bottom: 10px;">
				<a onclick="mostrar('."'".''.$publicacion['TEXTO_PUBLICACION'].''."'".','.$codigo_publicacion.')" id="vt"><img src="../imagenes/com.png" width="20" data-toggle="modal" data-target="#ModalComentario"> 0</a>
				<a href="#" onclick="mostrar()" href="" id="vt"><img src="../imagenes/like.png" width="20"> 0</a>
				</div>
				<br>
					<p margin-left: 0;>'.$publicacion['COMENTARIO'].'</p>';
				break;	
			}
			else{
				echo '
				<div id="mc" onclick="MostrarPublicacion('."'".''.$publicacion['TEXTO_PUBLICACION'].''."'".','.$codigo_publicacion.')" data-toggle="modal" data-target="#MPublicacion">
					<div id="comentario" style="margin-top: 10px; background-color: #fff; padding-bottom: 10px;">
					<input type="hidden" id="codigo_tweet" value="'.$codigo_publicacion.'">
					<p style="margin-left: 10px;">'.$publicacion['TEXTO_PUBLICACION'].'</p>
					</div>
				</div>
				<div style="background-color: #fff; padding-bottom: 10px;">
					<a onclick="mostrar('."'".''.$publicacion['TEXTO_PUBLICACION'].''."'".','.$codigo_publicacion.')" id="vt"><img src="../imagenes/com.png" width="20" data-toggle="modal" data-target="#ModalComentario"> 0</a>
					<a href="#" onclick="mostrar()" id="vt"><img src="../imagenes/like.png" width="20"> 0</a>
					</div>
				</div>
				<br>
					<p margin-left: 0;>'.$publicacion['COMENTARIO'].'</p>';
				break;
			}
	}

	while($publicacion = oci_fetch_array($st, OCI_BOTH)){
		echo '<div style="background-color: #fff; padding-bottom: 10px;"><p>'.$publicacion['USUARIO'].'</p><p>'.$publicacion['COMENTARIO'].'</p></div>'; 
		continue; 
	}	
?>