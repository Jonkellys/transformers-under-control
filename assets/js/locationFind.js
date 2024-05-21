$(document).ready(function(){

    $('#ParroquiaFind').change(function(e) {
        e.preventDefault();

        var formu = $(this);
        let valor = document.getElementById('ParroquiaFind').value;

        var respuesta = document.getElementById('locateFind2');

        var msjError = "<script>new swal('Ocurrió un error inesperado', 'Por favor actualice la página', 'error');</script>";

        $.ajax({
          url: "http://localhost/sistema-transformadores/conexiones/ubicaciones.php?getParroquia=" + valor,
          type: 'GET',
          data: $(this).val(),
          dataType: 'html',
          processData: false,
          contentType: false,
          success: function(data) {
            respuesta.innerHTML = data;
            console.log(data);
          },
          error: function(error) {
            console.log("Error: " + error);
          }
        });

    });


    $('#findParLoc').click(function(e) {
        e.preventDefault();

        var formu = $(this);
        let mun = document.getElementById('MunicipioFind').value;
        let par = document.getElementById('ParroquiaFind').value;
        let loc = document.getElementById('LocalidadFind').value;

        var resultado = document.getElementById('resultsList');

        var msjError = "<script>new swal('Ocurrió un error inesperado', 'Por favor actualice la página', 'error');</script>";

                $.ajax({
                    url: 'http://localhost/sistema-transformadores/conexiones/ubicaciones.php?municipio=' + mun + '&parroquia=' + par + '&localidad=' + loc,
                    type: 'GET',
                    data: $(this).val(),
                    dataType: 'html',
                    processData: false,
                    contentType: false,
                    success: function(data) {
                      resultado.replaceChildren();
                      resultado.innerHTML = data;
                        // console.log(valeur);
                    },
                    error: function(error) {
                        console.log("Error: " + error);
                    }
                });

    });

});
