function registrar(){
    var accion = document.getElementById("opcion1").value;
    var url = "ajax/ajax-tablas.php";

    //llamada al fichero PHP con AJAX
    $.ajax({
        type: "POST",
        url:  url,
        data:  {accion: accion}, // Valor que se recibira por POST

        beforeSend: function () {
            //mostramos gif "cargando"
            $('#loading_spinner').show();
            $("#resultado").hide();
        },
        
        success: function () {
            //escondemos gif
            $("#resultado").html(datos);
        }
    });
}
