<?php
  date_default_timezone_set("America/Caracas");

  session_start(['name' => 'Sistema']);

  $page = "reportes";

  if(!isset($_SESSION['token']) || !isset($_SESSION['usuario'])) {
    unset($_SESSION['id']);
    unset($_SESSION['codigo']);
    unset($_SESSION['usuario']);
    unset($_SESSION['clave']);
    unset($_SESSION['tipo']);
    unset($_SESSION['nombre']);
    unset($_SESSION['apellido']);
    unset($_SESSION['cargo']);
    unset($_SESSION['token']);
    unset($_SESSION['acceso']);

    session_regenerate_id(true);

    session_destroy();
    header('Location: http://localhost/transformers-under-control/login');
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <?php include "./modulos/links.php"; ?>
  <title>Records | <?php echo NOMBRE; ?></title>
</head>

<body style="width: 100vw;">
  <?php include "./modulos/menu.php"; ?>
  <?php include "./conexiones/funciones.php"; ?>

  <div class="container-fluid mt-0 flex-grow-1 container-p-y ml-5">
    <h4 class="fw-bold mb-0">Records</h4>
  </div>

  <style media="screen">
    @media (max-width: 768px) {
      .btn-box {
        flex-direction: column;
        align-items: center;
      }

      .btn-one {
        margin: 1rem 0px !important;
      }

      .themeChoose {
        width: 100%;
      }

      .big-hidden {
        display: block !important;
      }

      .row {
        flex-direction: column;
        width: 100%;
      }

      .input-group {
        width: 100%;
      }

      .loc-m {
        margin: 0 0 0 0.5rem;
      }

      .loc-m .form-group p {
        margin-bottom: 1rem;
      }

      .fechaBox {
        flex-direction: column !important;
      }

      .fechaInput {
        width: 100% !important;
      }

      .fecha-row {
        margin-left: 0;
      }

      .sm-hidden {
        display: none !important;
      }
    }

    @media (min-width: 992px) {
      .btn-box {
        flex-direction: row;
        justify-content: flex-start;
      }

      .themeChoose {
        width: 25%;
      }

      .big-hidden {
        display: none !important;
      }

      .sm-hidden {
        display: flex !important;
      }

      .input-group {
        width: 22%;
      }

      .loc-m {
        margin: 0rem 0 0 3rem;
      }

      .loc-m .form-group p {
        margin-bottom: 3rem;
      }

      .fechaInput {
        width: 50% !important;
      }

    }
  </style>

  <div class="container-fluid p-4">
    <div id="accordion-one" class="accordion ml-5 card mx-auto p-4 col-9">
      <h4 class="card-title">Choose an option</h4>
      <div class="d-flex btn-box">
        <a class="mb-0 btn btn-primary mx-1 btn-one" href="newReporte?informe=General&tipoData=Todos" target="_blank" rel="noopener noreferrer"><i class="bx bxs-file-pdf text-white"></i> General Record</a>

        <button class="mb-0 btn btn-primary mx-1" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><i class="bx bx-file text-white"></i> Personalized Record</button>
      </div>
      <div class="my-3">
        <h6 class="font-weight-bold">Notes:</h6>
        <ul class="list-icons">
          <li><i class="bx bx-play"></i>  The records will be generated on Legal size paper.</li>
          <li><i class="bx bx-play"></i> The option 'Location'can't be deactivated.</li>
          <li><i class="bx bx-play"></i> If the preview shows the URL address, deactivate the 'Print header and footer' option.</li>
        </ul>
      </div>
    </div>

    <div id="collapseOne" class="collapse card mt-3 col-10 rounded mx-auto" data-parent="#accordion-one">
      <div class="card-body">
        <h4 class="card-title">Choose a topic and the options to generate the record</h4>

        <div class="mb-3 mt-4 themeChoose">
          <select class="custom-select" id="themeChoose">
            <option disabled selected="selected">Choose a topic</option>
            <option value="transformadores">Transformers</option>
            <option value="operaciones">Operations</option>
          </select>
        </div>

        <form action="<?php echo SERVERURL; ?>conexiones/reportePersonalizado.php" autocomplete="off" enctype="multipart/form-data" method="POST" data-form="report" class=" FormularioAjax p-3">

          <div id="reportForm"></div>
          <div id="ubicaciones">
            <div class="row">

            <label class="w-100 ml-2">Location</label>
            <div class="mb-3 mx-2 ">
              <label for="HMunicipioAdd" class="text-dark">Municipality</label>

              <select id="HMunicipioAdd" class="form-control input-default" name="UbicacionInput">
                <option value="All" selected="selected">All</option>
                <?php

                  $sqlMun = "SELECT * FROM municipios WHERE M_Tipo = 'Municipio'";
                  $resultMun = connect()->query($sqlMun);

                  while ($rowsMun = $resultMun->fetch()) {
                    echo'<option value="' . $rowsMun['M_Nombre'] . '">' . $rowsMun['M_Nombre'] . '</option>';
                  };
                ?>
              </select>
            </div>
            <div id="locate1" class="loc-m">
              <div class="form-group">
                <label for="HParroquiaAdd" class="text-dark">Parish</label>
                <select id="HParroquiaAdd" class="form-control input-default" name="HParroquiaAdd">
                  <option disabled selected="selected"></option>
                  <?php
                  $sql = "SELECT * FROM municipios WHERE M_Tipo = 'Parroquia' AND M_Ubicacion = '$mun'";
                  $result = connect()->query($sql);

                  while ($rows = $result->fetch()) {
                    echo'<option value="' . $rows['M_Nombre'] . '">' . $rows['M_Nombre'] . '</option>';
                  };
                  ?>
                </select>
                <p>Leave blank to choose <strong>All</strong></p>
              </div>
            </div>
            <div id="locate2" class="loc-m">
              <div class="form-group">
                <label for="HLocalidadAdd" class="text-dark">Location</label>
                <select id="HLocalidadAdd" class="form-control input-default" name="HLocalidadAdd">
                  <option disabled selected="selected"></option>
                  <?php
                  $sql = "SELECT * FROM municipios WHERE M_Tipo = 'Localidad' AND M_Ubicacion = '$par'";
                  $result = connect()->query($sql);

                  while ($rows = $result->fetch()) {
                    echo'<option value="' . $rows['M_Nombre'] . '">' . $rows['M_Nombre'] . '</option>';
                  };
                  ?>
                </select>
              </div>
            </div>
          </div>

          <button type="submit" class="btn btn-primary">Generate Record</button>
        </div>
        <div class="RespuestaAjax mt-3"></div>
        </form>

      </div>
    </div>

  </div>

  <?php include "./modulos/scripts.php"; ?>

  <script src="<?php echo media; ?>js/ajax/principal.js"></script>
  <script src="<?php echo media; ?>js/locations.js"></script>
  <script>

    function numeros(e) {
      tecla = (document.all) ? e.keyCode : e.which;


      if (tecla == 32) {
        return true;
      }

      patron = /[0-9]/gi;
      tecla_final = String.fromCharCode(tecla);
      return patron.test(tecla_final);
    }


        $(document).ready(function(){
          $('#ubicaciones').hide();

          $('#themeChoose').change(function(e) {

            e.preventDefault();

            let valor = document.getElementById('themeChoose').value;

            var respuesta = document.getElementById('reportForm');


            $.ajax({
              url: "http://localhost/sistema-transformadores/conexiones/reportForm.php?informe=" + valor,
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

            if ($('#ubicaciones').is(':hidden')) {
              $('#ubicaciones').show();
            }

          });

        });

  </script>
</body>

</html>
