<?php 
	include 'conexion.php';
	$con = new conexion();

	$codigo_usuario = $_POST['codigo_usuario'];	

	$imgpe = $_FILES['imgpe']['name'];
	$temp_imgpe = $_FILES['imgpe']['tmp_name'];

	$imgpo = $_FILES['imgpo']['name'];
	$temp_imgpo = $_FILES['imgpo']['tmp_name'];
	
	if($temp_imgpe!=""){
		$rutaimgpe = "../imagenes/".$imgpe;
		copy($temp_imgpe, $rutaimgpe);

		if($temp_imgpo!=""){
			$rutaimgpo = "../imagenes/".$imgpo;
			copy($temp_imgpo, $rutaimgpo);
			$query = "update usuarios set foto_perfil='$rutaimgpe', foto_portada='$rutaimgpo' 
				  where codigo_usuario='$codigo_usuario'";
		}
		else{
			$query = "update usuarios set foto_perfil='$rutaimgpe' where codigo_usuario='$codigo_usuario'";
		}

		$con->actualizar($con->conectar(), $query);

		echo $codigo_usuario;
	}


?>