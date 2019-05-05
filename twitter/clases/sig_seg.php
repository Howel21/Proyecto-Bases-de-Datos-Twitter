<?php  
	error_reporting(0);

	include 'conexion.php';
	$con = new conexion();

	$codigo_usuario = $_POST['codigo_usuario'];	
	$usuario = $_POST['usuario'];	

	$accion = $_GET['accion'];

	function siguiendo($con, $codigo_usuario){
	$si = $con->consultar($con->conectar(), "select s.CODIGO_USUARIO_SEGUIDO, u.USUARIO, u.FOTO_PERFIL, u.FOTO_PORTADA
										    from seguidores s
											inner join USUARIOS u
											on s.CODIGO_USUARIO_SEGUIDO = u.CODIGO_USUARIO
											where s.CODIGO_USUARIO_SEGUIDOR = '$codigo_usuario'");

	while($siguiendo = oci_fetch_array($si, OCI_BOTH)){
		echo '<div style="margin-top: 10px; margin-right: 20px; width: 250px; height: 230px; background: #fff; float: left;">
					<div style="background-color: #4996FF; height: 80px;">
						<img src="../'.$siguiendo['FOTO_PERFIL'].'" width="70" height="70" style="background-color: #fff; padding: 0px; border-radius: 40px; margin-top: 40px; margin-left: 10px;">
						<a href="#"><p style="margin-left: 10px; color: #000;"><b>'.$siguiendo['USUARIO'].'</b></p></a>
						<input style="background: #fff; border-radius: 20px; border: 1px solid #01A7F4; font-size: 12px; padding: 5px 30px; color: #01A7F4; position: absolute; margin-top: -65px; margin-right: 150px; margin-left: 120px;" type="button" value="Siguiendo" onclick="seguir('.$siguiendo['CODIGO_USUARIO_SEGUIDO'].', '.$codigo_usuario.')">
					</div>
				</div>';
		}
	}

	function seguidores($con, $codigo_usuario){
	$si = $con->consultar($con->conectar(), "select s.CODIGO_USUARIO_SEGUIDOR, u.USUARIO
										    from seguidores s
											inner join USUARIOS u
											on s.CODIGO_USUARIO_SEGUIDOR = u.CODIGO_USUARIO
											where s.CODIGO_USUARIO_SEGUIDO = '$codigo_usuario'");

	while($siguiendo = oci_fetch_array($si, OCI_BOTH)){
		echo '<div style="margin-top: 10px; margin-right: 20px; width: 250px; height: 230px; background: #fff; float: left;">
					<div style="background-color: #4996FF; height: 80px;">
						<img src="../'.$siguiendo['FOTO_PERFIL'].'" width="70" height="70" style="background-color: #fff; padding: 0px; border-radius: 40px; margin-top: 40px; margin-left: 10px;">
						<a href="#"><p style="margin-left: 10px; color: #000;"><b>'.$siguiendo['USUARIO'].'</b></p></a>
						<input style="background: #fff; border-radius: 20px; border: 1px solid #01A7F4; font-size: 12px; padding: 5px 30px; color: #01A7F4; position: absolute; margin-top: -65px; margin-right: 150px; margin-left: 120px;" type="button" value="Seguir" onclick="seguir('.$siguiendo['CODIGO_USUARIO_SEGUIDOR'].', '.$codigo_usuario.')">
					</div>
				</div>';
		}
	}

	if($accion==1)
		siguiendo($con, $codigo_usuario);
	else
		seguidores($con, $codigo_usuario);
?>