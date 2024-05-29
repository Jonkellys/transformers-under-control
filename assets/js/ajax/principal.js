$(document).ready(function(){

    $('.FormularioAjax').submit(function(e) {
        e.preventDefault();

        var form = $('form').get(0);
        var formu = $(this);

        var tipo = formu.attr('data-form');
        var accion = formu.attr('action');
        var metodo = formu.attr('method');
        var respuesta = formu.children('.RespuestaAjax');

        var msjError = "<script>new swal('Ocurrió un error inesperado', 'Por favor actualice la página', 'error');</script>";


        var textoAlerta;
        if(tipo === "save") {
            textoAlerta = "This data will be saved in the system";
        } else if(tipo === "delete") {
            textoAlerta = "This data will be eliminated from the system";
        } else if(tipo === "update") {
            textoAlerta = "This data will be updated";
        } else if(tipo === "register") {
            textoAlerta = "The report will be generated";
        } else {
            textoAlerta = "Do you want to continue this operation?";
        }

        new swal({
            title: "Are you sure?",
            text: textoAlerta,
            icon: "question",
            showCancelButton: true,
            confirmButtonText: "Accept",
            cancelButtonText: "Cancel"
        }).then((result) => {
            if(result.isConfirmed) {
                $.ajax({
                    url: accion,
                    type: metodo,
                    data: new FormData(form),
                    processData: false,
                    contentType: false,
                    beforeSend: function(){},
                    success: function(data) {
                        respuesta.html(data);
                        // console.log(data);
                    },
                    error: function(error) {
                        respuesta.html("Error: " + error);
                        // console.log("Error: " + error);
                    }
                });
            } else if(result.isDenied) {
            }
        });
    });
});
