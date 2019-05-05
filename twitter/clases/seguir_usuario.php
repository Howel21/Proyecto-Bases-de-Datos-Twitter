<?php  
	error_reporting(0); 

	include 'conexion.php';
	$con = new conexion();

	$codigo_usuario_seguidor = $_POST['usu_seg'];
	$codigo_usuario_a_seguir = $_POST['usu_a_seg'];

	$query = "insert into seguidores(codigo_usuario_seguido, codigo_usuario_seguidor, fecha_seguido) values('$codigo_usuario_a_seguir', '$codigo_usuario_seguidor', '".date('d-M-y')."')";

	$con->guardar($con->conectar(), $query);

	function refrescar($con, $codigo_usuario_seguidor){
		$st = $con->consultar($con->conectar(), "select u.CODIGO_USUARIO, u.USUARIO, u.FOTO_PERFIL
												from seguidores s
												right outer join USUARIOS u
												on s.CODIGO_USUARIO_SEGUIDOR = u.CODIGO_USUARIO
												where s.CODIGO_USUARIO_SEGUIDO is null and s.CODIGO_USUARIO_SEGUIDOR is null and u.USUARIO is not null
												and foto_perfil is not null
												and rownum < 7
												");

			echo '<br>
					<p style="margin-left: 10px; margin-top: -15px; font-size: 20px;"><b>A quién seguir</b></p>';

		while ($usuario = oci_fetch_array($st, OCI_BOTH)) {
			echo '
				<div>
					<img src="'.$usuario['FOTO_PERFIL'].'" width="45" height="45" style="background-color: #fff; padding: 0px; border-radius: 40px; margin-left: 10px; float: left; margin-right: 10px; margin-top: 5px;"><br><a href="../perfil/?cu='.$usuario['CODIGO_USUARIO'].'" style="text-decoration: none; color: #000;"><p style="font-size: 15px; margin-left: 0px; margin-top: -20px; "><b>'.$usuario['USUARIO'].'</b></p></a>
					<br>
					<input style="background: #fff; border-radius: 20px; border: 1px solid #01A7F4; font-size: 12px; padding: 2px 20px; color: #01A7F4; position: absolute; margin-top: -40px; margin-right: 150px; margin-left: 65px;" type="button" value="Seguir" onclick="seguir('.$usuario['CODIGO_USUARIO'].', '.$codigo_usuario_seguidor.')">
					<hr style="margin-top: -5px;">
				</div>
			';
		}
	}

	refrescar($con, $codigo_usuario_seguidor);
?>