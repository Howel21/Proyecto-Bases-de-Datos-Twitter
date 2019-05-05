<!DOCTYPE html>
<html>
<head>
	<title>Registrate en Twitter</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum‐scale=1.0, user‐scalable=no">
	<link rel="icon" type="image/png" href="../imagenes/logo.png" />
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/estilos.css">
  <script type="text/javascript" src="../js/jquery.js"></script> 
  <script type="text/javascript" src="../js/bootstrap.min.js"></script>
  <script type="text/javascript" src="../js/Login.js"></script>
  <script type="text/javascript" src="../js/popper.min.js"></script>
</head>
<body>
<!-- Modal Paso 1-->
<div class="modal fade" id="Paso1" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
      <div class="modal-content" style="height: 500px;"> 

      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel"><b>Paso 1 de 3</b></h4>
        <input type="button" class="btn btn-primary" value="Siguiente" data-toggle="modal" data-target="#Paso2" id="p1" style="border-radius: 20px;">
      </div>

          <center><img src="../imagenes/logo.png" width="25" height="25" style="margin-top: 20px;"></center>  
          <h4 class="modal-title" id="myModalLabel" style="margin-left: 20px;"><b>Crea tu cuenta</b></h4>
            <!-- Modal Body -->
            <div class="modal-body">
                <p class="statusMsg"></p>
                <form role="form" method="POST">
                    <div class="form-group">
                      <label>Nombre</label>
                      <input type="text" class="form-control" id="usuario" style=" border: none; border-bottom: 1px solid gray;"/>
                    </div>
                    <div class="form-group">
                      <label>Telefono o correo</label>
                      <input type="text" class="form-control" id="metodo" style=" border: none; border-bottom: 1px solid gray;"/>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Paso 2-->
<div class="modal fade" id="Paso2" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
      <div class="modal-content" style="height: 500px;"> 

      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel"><b>Paso 2 de 3</b></h4>
        <input type="button" class="btn btn-primary" value="Siguiente" data-toggle="modal" data-target="#Paso3" id="p2" style="border-radius: 20px;">
      </div>

          <center><img src="../imagenes/logo.png" width="25" height="25" style="margin-top: 20px;"></center>  
          <h4 class="modal-title" id="myModalLabel" style="margin-left: 20px;"><b>Necesitaras una contraseña</b></h4>
            <!-- Modal Body -->
            <div class="modal-body">
                <p class="statusMsg"></p>
                <form role="form" method="POST">
                    <div class="form-group">
                      <label>Ingresa una contraseña</label>
                      <input type="password" class="form-control" id="c" style=" border: none; border-bottom: 1px solid gray;"/>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Paso 3-->
<div class="modal fade" id="Paso3" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
      <div class="modal-content"> 

      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel"><b>Paso 3 de 3</b></h4>
        <input type="button" class="btn btn-success" value="Registrarse" onclick="registrar()" style="border-radius: 20px;">
      </div>
          <center><img src="../imagenes/logo.png" width="25" height="25" style="margin-top: 20px;"></center>  
          <h4 class="modal-title" id="myModalLabel" style="margin-left: 20px;"><b>Estamos a un paso de completar tu registro</b></h4>
            <!-- Modal Body -->
            <div class="modal-body">
                <p class="statusMsg"></p>
                <form role="form" method="POST">
                    <div class="form-group">
                      <label>Nombre</label>
                      <input type="text" class="form-control" id="u" style=" border: none; border-bottom: 1px solid gray;"/>
                    </div>
                    <div class="form-group">
                      <label>Telefono o correo</label>
                      <input type="text" class="form-control" id="m" style=" border: none; border-bottom: 1px solid gray;"/>
                    </div>
                </form>
                <br>
                <div style="margin-left: -100px;">
                  <p>Si te registras, significa que aceptas los <span style="color: #55A0F5;"><a href="#">Términos del servicio</a></span> y la <span style="color: #55A0F5;"><a href="#">Política de privacidad</a></span>, incluido el <span style="color: #55A0F5;"><a href="#">Uso de cookies</a></span>. Otros usuarios podrán encontrarte por tu correo electrónico o tu número de teléfono si los proporcionas · <span style="color: #55A0F5;"><a href="#">Opciones de privacidad</a></span></p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Confirmacion-->
<div class="modal fade" id="Confirmacion" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
      <div class="modal-content" style="height: 400px;"> 
        <center><img src="../imagenes/logo.png" width="50" height="50" style="margin-top: 20px;"></center>
          <h4 class="modal-title" id="myModalLabel" style="margin-left: 20px; margin-top: 20px;"><b>Felicidades hemos registrado tu cuenta</b></h4>
          <br>
          <center>
            <img style="margin-top: 20px;" src="../imagenes/check.png" width="120" height="120"> 
          </center>
          <br><br>
            <!-- Modal Body -->
            <div class="modal-body">
                <p class="statusMsg"></p>
                <form role="form" method="POST">
                    <div class="form-group">
                      <input type="button" class="btn btn-primary" value="Continuar" style="width: 100%;" style="border-radius: 20px;"/>
                    </div>
                </form>
                <br>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function(){
  $("#Paso1").modal("show");
  $("#p1").on("click",function(){
    $("#Paso1").modal("hide");
  });
  $("#p2").on("click",function(){
    $("#Paso2").modal("hide");
    var usuario = document.getElementById("usuario").value;
    var metodo = document.getElementById("metodo").value;
    
    document.getElementById("u").value = usuario;
    document.getElementById("m").value = metodo;
  });
});

function registrar(){
  var nombre = document.getElementById("u").value;
  var metodo = document.getElementById("m").value;
  var contrasenia = document.getElementById("c").value;

  var url = "../clases/registrar_usuario.php";

  $.ajax({
      type: "POST",
      url:  url,
      data:  {usuario: nombre, metodo : metodo, contrasenia : contrasenia},

      success: function (datos) {
          if(datos == 0){
            alert("El usuario ya existe");
          }
          else{
            $("#Paso3").modal("hide");
            $("#Confirmacion").modal("show");
             location.href = "../inicio";
          }
      }
  });
}
</script>
</body>
</html>