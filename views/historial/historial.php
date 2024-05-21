<?php
  date_default_timezone_set("America/Caracas");

  session_start(['name' => 'Sistema']);

  $page = "historial";

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
    header('Location: http://transformadores-corpoelec.infinityfreeapp.com/login');
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <?php include "./modulos/links.php"; ?>
  <title>Historial | <?php echo NOMBRE; ?></title>
</head>

<body style="width: 100vw;">
  <?php
    include "./modulos/menu.php";
    include "./conexiones/funciones.php";
  ?>

  <div class="container-fluid mt-0 flex-grow-1 container-p-y ml-5 w-50">
    <h4 class="fw-bold mb-0 w-50">Historial</h4>
  </div>

  <style media="screen">
    @media (max-width: 768px) {
      .add-btn {
        margin-left: 0.7rem !important;
      }

      .collapse {
        max-width: 95%;
        padding: 0rem !important;
      }

      .col-9 {
        max-width: 90%;
        padding: 0rem !important;
      }
    }

    @media (min-width: 992px) {
      .add-btn {
        margin-left: 3rem !important;
      }

      .collapse {
        position: relative;
        width: 100%;
        min-height: 1px;
        padding-right: 15px;
        padding-left: 15px;
        flex: 0 0 75%;
        max-width: 75%;
      }
    }
  </style>

  <div class="container-fluid p-4">

    <div class="d-flex flex-row justify-content-space add-btn">
      <button class="mb-0 btn btn-primary mx-1" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><i class="bx bx-plus-circle text-white"></i> Añadir Operación</button>
    </div>

    <div id="accordion-one" class="accordion">
      <div id="collapseOne" class="collapse card mt-3 col-9 rounded mx-auto" data-parent="#accordion-one">
        <div class="card-body">
          <h4 class="card-title">Añadir datos de la operación</h4>
          <form action="<?php echo SERVERURL; ?>conexiones/historial.php?HAdd" name="HAdd" id="HAdd" autocomplete="off" enctype="multipart/form-data" method="POST" data-form="save" class="FormularioAjax p-3">
            <div class="form-group">
              <label for="HProcAdd" class="text-dark">Procedimiento</label>
              <select id="HProcAdd" class="form-control input-default" name="HProcAdd">
                <option disabled selected="selected">Seleccione el procedimiento realizado</option>
                <option value="Reparación">Reparación</option>
                <option value="Instalación">Instalación</option>
                <option value="Retiro">Retiro</option>
              </select>
            </div>

            <input type="hidden" name="HAddInput">

            <div class="form-group">
              <label for="HFechaAdd" class="text-dark">Fecha</label>
              <p>Indique en que fecha se realizó el procedimiento</p>
              <input id="HFechaAdd" type="date" class="form-control input-default" name="HFechaAdd">
            </div>

            <div class="form-group">
              <label for="HEquipoAdd" class="text-dark">Número Serial</label>
              <input id="HEquipoAdd" onkeypress="return letras(event)" type="text" class="form-control input-default" name="HEquipoAdd" placeholder="Ingrese el número serial del transformador">
            </div>

            <div class="">
              <label class="text-dark">Ubicación</label>
              <p>Indique la ubicación del transformador donde se realizó el procedimiento</p>
              
              <div class="d-flex flex-row flex-start flex-wrap">
                <p>Usar dirección de "Central de Servicios"</p>
                <label class="radio-inline mr-3 ml-4"><input type="checkbox" name="TCentralDir" value="Si"> Sí</label>
              </div>
              <div class="d-flex flex-row flex-start flex-wrap">
                <div class="form-group">
                  <label for="HMunicipioAdd" class="text-dark">Municipio</label>
                  <select id="HMunicipioAdd" class="form-control input-default" name="HMunicipioAdd">
                    <option disabled selected="selected">Seleccione una opción</option>
                    <?php

                      $sqlMun = "SELECT * FROM municipios WHERE M_Tipo = 'Municipio' AND M_Nombre != 'Central de Servicios'";
                      $resultMun = connect()->query($sqlMun);

                      while ($rowsMun = $resultMun->fetch()) {
                        echo'<option value="' . $rowsMun['M_Nombre'] . '">' . $rowsMun['M_Nombre'] . '</option>';
                      };
                    ?>
                  </select>
                </div>
                 <div id="locate1" class="ml-5"></div>
                 <div id="locate2" class="ml-5"></div>
               </div>
              </div>

            <div class="form-group">
              <label for="HDireccionAdd" class="text-dark">Dirección</label>
              <textarea id="HDireccionAdd" class="form-control input-default h-150px" name="HDireccionAdd" rows="6" id="comment"></textarea>
            </div>

            <div class="RespuestaAjax mt-3"></div>
            <button type="submit" class="btn btn-primary">Añadir datos</button>
          </form>
        </div>
      </div>

    </div>


    <div class="col-11 mx-auto mt-4 card">
      <div class="card-body">
        <div class="card-title">
          <h4>Historial de Operaciones</h4>
        </div>
        <div class="table-responsive">
          <table class="table table-striped table-hover" id="table">
            <thead>
              <tr>
                <th>#</th>
                <th>Procedimiento</th>
                <th>Fecha</th>
                <th>Serial del Transformador</th>
                <th>Estado</th>
                <th>Municipio</th>
                <th>Parroquia</th>
                <th>Localidad</th>
                <th>Dirección</th>
                <?php
                  if($_SESSION['tipo'] == "Administrador") {
                    echo '<th>Acciones</th>';
                  }
                ?>
              </tr>
            </thead>
            <tbody>
              <?php

                $result = connect()->query("SELECT * FROM operaciones");
                $num = 1;

                while ($rows = $result->fetch()) {
                  echo"<tr>
                        <th> <strong>" . $num++ . "</strong></th>
                        <td>" . $rows['O_Procedimiento'] . "</td>
                        <td>" . $rows['O_Fecha'] . "</td>
                        <td><a class='text-info' href='transformador?serial=" . $rows['O_Equipo'] . "'>" . $rows['O_Equipo'] . "</a></td>
                        <td>" . $rows['O_EstadoActual'] . "</td>
                        <td>" . $rows['O_Municipio'] . "</td>
                        <td>" . $rows['O_Parroquia'] . "</td>
                        <td>" . $rows['O_Localidad'] . "</td>
                        <td>" . $rows['O_Direccion'] . "</td>
                        ";

                        if($_SESSION['tipo'] == "Administrador") {
                        echo "<td class='mt-0 d-flex flex-row justify-content-around'>
                          <a class='btn btn-sm btn-info' href='editar?operacion=" . $rows['O_Codigo'] . "'>
                            <span class='tf-icons bx bx-edit text-white'></span>
                          </a>

                          <a class='btn btn-sm btn-danger' href='delete?operacion=" . $rows['O_Codigo'] . "'>
                            <span class='tf-icons bx bx-trash text-white'></span>
                          </a>
                        </td>";
                        }
                      echo "</tr>";
                };
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

  </div>

  <?php include "./modulos/scripts.php"; ?>
  <script src="<?php echo media; ?>js/ajax/principal.js"></script>
  <script src="<?php echo media; ?>js/locations.js"></script>
  <script src="<?php echo media; ?>extras/datatables/config.js"></script>
  <script>
    function letras(e) {
        tecla = (document.all) ? e.keyCode : e.which;


        if (tecla == 32) {
          return true;
        }

        patron = /[a-zA-Z0-9]/gi;
        tecla_final = String.fromCharCode(tecla);
        return patron.test(tecla_final);
      }
  </script>
</body>

</html>
