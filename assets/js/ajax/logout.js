$(document).ready(function(){

    $('.logoutBtn').click(function(e) {
        e.preventDefault();

        var formu = $(this);
        var respuesta = formu.children('.answer');

        new swal({
            title: "Do you want to close the session?",
            icon: "question",
            showCancelButton: true,
            confirmButtonText: "Yes",
            cancelButtonText: "No"
        }).then((result) => {
            if(result.isConfirmed) {
                $.ajax({
                    url: 'conexiones/logout.php',
                    type: "POST",
                    data: "",
                    processData: false,
                    contentType: false,
                    beforeSend: function(){},
                    success: function(data) {
                        respuesta.html(data);
                    },
                    error: function() {
                        respuesta.html(msjError);
                    }
                });
            } else if(result.isDenied) {
            }
        });
    });
});
