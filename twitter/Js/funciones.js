$(function(){
    $("#formulario").on("submit", function(e){
    var parametro = new FormData($("#formulario")[0]);

    document.getElementById("tweet").value = "";

    var url = "../clases/mostrar_tweet.php";
    e.preventDefault(); // Evita que el navegador se refresque
    $.ajax({
        url: url,
        type: "post",
        contentType: false,
        processData: false, 
        data: parametro,  
        success: function (datos) {
            $("#coment").html(datos);
        }
    });
    });
});

$(function(){
    $("#formperfil").on("submit", function(e){
    var parametro = new FormData($("#formperfil")[0]);

    var url = "../clases/datos_perfil.php";
    e.preventDefault(); // Evita que el navegador se refresque
    $.ajax({
        url: url,
        type: "post",
        contentType: false,
        processData: false, 
        data: parametro,  
        success: function (codigo_usuario) {
            location.href = "../perfil/?cus="+codigo_usuario;
        }
    });
    });
});

mostrar = function(msg, cod){
    document.getElementById("cod_tweet").value=cod; 
    document.getElementById("com").innerHTML = msg; 

};

var loadFile = function(event) {
    var output = document.getElementById('foto');
    output.src = URL.createObjectURL(event.target.files[0]);
}

$(document).ready(function() {
    $('#tweet').click(function() {
        $('#ctweet').css('display','block');
    })
});

function MostrarPublicacion(tweet, codigo_publicacion){
    $(document).ready(function(){
        $.ajax({
            url: "../clases/mostrar_publicacion.php",
            type: "post",
            data: {codigo_publicacion: codigo_publicacion}, 
            success: function (modal) {
                $("#valorprueba").html(modal);           
            }
        });
    });   
}

function agregarComentario(){
    var codigo_usuario = document.getElementById("cod_usu").value;
    var comentario_tweet = document.getElementById("comentario_tweet").value;
    var codigo_tweet = document.getElementById("cod_tweet").value;

    var url = "../clases/agregar_comentario.php";

    $.ajax({
        url: url,
        type: "post",
        data: {codusu: codigo_usuario, comtweet: comentario_tweet, codtweet: codigo_tweet},  
        success: function (datos) {
            $("#ModalComentario").modal("hide");
        }
    });
}

function seguir(codigo_usuario, usuario){
    var url = "../clases/seguir_usuario.php";

    $.ajax({
        url: url,
        type: "post",
        data: {usu_seg: usuario, usu_a_seg: codigo_usuario},  
        success: function (datos) {
            $("#secaseguir").html(datos);
        }
    });
}