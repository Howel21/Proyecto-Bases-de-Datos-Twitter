<?php  
	error_reporting(0);

	include 'conexion.php';
	$con = new conexion();

	$codigo_usuario = $_POST['codigo_usuario'];	
	$usuario = $_POST['usuario'];
	$tweet = $_POST['tweet'];

	session_start();
	$foto_perfil = $_SESSION['foto_perfil'];

	$nombimg= $_FILES['img']['name'];
	$temp = $_FILES['img']['tmp_name'];
	
		if($temp!=""){
			$ruta = "../imagenes/".$nombimg;
			copy($temp, $ruta);

			$query = "insert into publicaciones(codigo_usuario, texto_publicacion, fecha_publicacion, enlace_publicacion) values('$codigo_usuario', '$tweet', '', '$ruta')";
			$con->guardar($con->conectar(), $query);
		}
		else{
			if($tweet!=""){
				$query = "insert into publicaciones(codigo_usuario, texto_publicacion, fecha_publicacion, enlace_publicacion) values('$codigo_usuario', '$tweet', '', '')";
				$con->guardar($con->conectar(), $query);
			}
		}		

	function mostrarTwits($con, $codigo_usuario, $usuario, $foto_perfil){
		$st = $con->consultar($con->conectar(), "select p.codigo_publicacion, p.TEXTO_PUBLICACION, p.ENLACE_PUBLICACION, count(c.CODIGO_COMENTARIO)
			from publicaciones p
			left outer join comentarios c
			on c.codigo_publicacion = p.codigo_publicacion
			where p.codigo_usuario = '$codigo_usuario'
			group by p.CODIGO_PUBLICACION, p.TEXTO_PUBLICACION, p.ENLACE_PUBLICACION
			order by p.CODIGO_PUBLICACION desc");

		while($tweets = oci_fetch_array($st, OCI_BOTH)){
			if($tweets['ENLACE_PUBLICACION']!=""){
			echo '
			    <div id="mc" onclick="MostrarPublicacion('."'".''.$tweets['TEXTO_PUBLICACION'].''."'".','.$tweets['CODIGO_PUBLICACION'].')" data-toggle="modal" data-target="#MPublicacion">
					<div id="comentario" style="margin-top: 10px; background-color: #fff; padding-bottom: 10px;">
					<input type="hidden" id="codigo_tweet" value="'.$tweets['CODIGO_PUBLICACION'].'">
					<img src="'.$foto_perfil.'" width="40" height="40" style="background-color: #fff; padding: 0px; border-radius: 40px; margin-top: 20px; margin-left: 10px; margin-right: 10px;">
					<p style="margin-left: 60px; margin-top: -35px;"><b><a style="color: #000;	" href="">'.$usuario.'</a></b></p>
					<p style="margin-left: 10px;">'.$tweets['TEXTO_PUBLICACION'].'</p>
					<center>
						<img src="'.$tweets['ENLACE_PUBLICACION'].'" width="550" height="400" style="margin-bottom: 10px; border-radius: 20px;"> 
					</center>
					</div>
				</div>	
				<div style="background-color: #fff; padding-bottom: 10px;">
				<a onclick="mostrar('."'".''.$tweets['TEXTO_PUBLICACION'].''."'".','.$tweets['CODIGO_PUBLICACION'].')" id="vt"><img src="../imagenes/com.png" width="20" data-toggle="modal" data-target="#ModalComentario">'.$tweets['COUNT(C.CODIGO_COMENTARIO)'].'</a>
				<a href="#" onclick="mostrar()" href="" id="vt"><img src="../imagenes/like.png" width="20"> 0</a>
				</div>';
			}
			else{
				echo '
				<div id="mc" onclick="MostrarPublicacion('."'".''.$tweets['TEXTO_PUBLICACION'].''."'".','.$tweets['CODIGO_PUBLICACION'].')" data-toggle="modal" data-target="#MPublicacion">
					<div id="comentario" style="margin-top: 10px; background-color: #fff; padding-bottom: 10px;">
					<input type="hidden" id="codigo_tweet" value="'.$tweets['CODIGO_PUBLICACION'].'">
					<img src="'.$foto_perfil.'" width="40" height="40" style="background-color: #fff; padding: 0px; border-radius: 40px; margin-top: 20px; margin-left: 10px; margin-right: 10px;">
					<p style="margin-left: 60px; margin-top: -35px;"><b><a style="color: #000;	" href="">'.$usuario.'</a></b></p>
					<p style="margin-left: 10px;">'.$tweets['TEXTO_PUBLICACION'].'</p>
					</div>
				</div>
				<div style="background-color: #fff; padding-bottom: 10px;">
					<a onclick="mostrar('."'".''.$tweets['TEXTO_PUBLICACION'].''."'".','.$tweets['CODIGO_PUBLICACION'].')" id="vt"><img src="../imagenes/com.png" width="20" data-toggle="modal" data-target="#ModalComentario">'.$tweets['COUNT(C.CODIGO_COMENTARIO)'].'</a>
					<a href="#" onclick="mostrar()" id="vt"><img src="../imagenes/like.png" width="20"> 0</a>
					</div>
				</div>';
			}
		}
	}

	mostrarTwits($con, $codigo_usuario, $usuario, $foto_perfil);

?>
