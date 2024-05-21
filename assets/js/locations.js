$(document).ready(function(){

    $('#HMunicipioAdd').change(function(e) {
        e.preventDefault();

        var formu = $(this);
        let valor = document.getElementById('HMunicipioAdd').value;

        var respuesta = document.getElementById('locate1');
        
        var msjError = "<script>new swal('Ocurrió un error inesperado', 'Por favor actualice la página', 'error');</script>";
                     

                $.ajax({
                    url: "http://localhost/sistema-transformadores/conexiones/ubicaciones.php?getMun=" + valor,
                    type: 'GET',
                    data: $(this).val(),
                    dataType: 'html',
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        respuesta.innerHTML = data;
                        // console.log(valor);
                    },
                    error: function(error) {
                        respuesta.html("Error: " + error);
                        // console.log("Error: " + error);
                    }
                });
        
    });
    
    
    $('#locate1').change(function(e) {
        e.preventDefault();

        var formu = $(this);
        let valeur = document.getElementById('HParroquiaAdd').value;

        var repond = document.getElementById('locate2');
        
        var msjError = "<script>new swal('Ocurrió un error inesperado', 'Por favor actualice la página', 'error');</script>";

                $.ajax({
                    url: 'http://localhost/sistema-transformadores/conexiones/ubicaciones.php?getPar=' + valeur,
                    type: 'GET',
                    data: $(this).val(),
                    dataType: 'html',
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        repond.innerHTML = data;
                        // console.log(valeur);
                    },
                    error: function(error) {
                        respuesta.html('Error: ' + error);
                        // console.log("Error: " + error);
                    }
                });
        
    });
    
});
