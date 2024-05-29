<?php
  date_default_timezone_set("America/Caracas");

  session_start(['name' => 'Sistema']);

  $page = "ubicacion";

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
  <?php $mun = $_GET['municipio']; ?>
  <?php
  include "./modulos/menu.php";
  include "./conexiones/funciones.php";
  ?>
  <title><?php echo munChoose($mun) . ' | ' . NOMBRE; ?></title>
</head>

<body style="width: 100vw;">

  <style media="screen">
    @media (max-width: 768px) {
      .list-info {
        flex-direction: column;
        align-items: center;
      }

      .col-2 {
        margin: 0px;
      }

      .add-btn {
        margin-left: 0.7rem !important;
      }

      .add-list {
        display: flex;
        flex-direction: column;
        width: 100%;
        padding: 0px;
      }

      .mun-flex {
        justify-content: flex-start;
        flex-wrap: wrap;
      }

    }

    @media (min-width: 992px) {
      .list-info {
        flex-direction: row;
        justify-content: center;
      }

      .add-btn {
        margin-left: 3rem !important;
      }

      .add-list {
        position: relative;
        width: 100%;
        min-height: 1px;
        padding-right: 15px;
        padding-left: 15px;
        flex: 0 0 83.33333%;
        max-width: 83.33333%;
      }

      .mun-flex {
        justify-content: space-around;
      }

    }
  </style>

  <div class="container-fluid mt-0 flex-grow-1 container-p-y ml-5 2-50">
    <h4 class="fw-bold mb-0">Location</h4>
  </div>

  <div class="container-fluid p-4">

    <?php

    if(isset($mun)) {
      if($mun == "Service Central") {
        echo '
        <div class="col-11 mx-auto">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title mb-3">Service Central</h5>
            <div class="basic-list-group d-flex list-info">

             <div class="col-2 p-0 m-2">
                <div class="card-body d-flex flex-column align-items-center">
                  <h5 class="card-title text-center">Damaged Transformers</h5>
                  <span class="badge badge-danger badge-pill font-tiny text-white">' . getMunCount('Damaged', $mun) . '</span>
                </div>
              </div>

              <div class="col-2 p-0 m-2">
                <div class="card-body d-flex flex-column align-items-center">
                  <h5 class="card-title text-center">Transformers In Stock</h5>
                  <span class="badge badge-info badge-pill font-tiny text-white">' . getMunCount('Stock', $mun) . '</span>
                </div>
              </div>

              <div class="col-2 p-0 m-2">
                <div class="card-body d-flex flex-column align-items-center">
                  <h5 class="card-title text-center">Total Transformers</h5>
                  <span class="badge badge-primary badge-pill font-tiny text-white">' . getMunCount(false, $mun) . '</span>
                </div>
              </div>

            </div>';
      } else {
    echo '<div class="col-11 mx-auto">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title mb-3">Municipality ' . $mun . '</h5>
          ';

          echo '
          <div class="col-9">
            <h4>Search By</h4>
            <div class="d-flex flex-row justify-content-around flex-wrap">
                <div id="locateFind1">
                  <div class="form-group">
                    <label for="ParroquiaFind" class="text-dark">Parish</label>
                    <select id="ParroquiaFind" class="form-control input-default" name="ParroquiaFind">
                      <option value="All" selected="selected">All</option>
                      ';
                        $sql2 = "SELECT * FROM municipios WHERE M_Tipo = 'Parroquia' AND M_Ubicacion = '$mun'";
                        $result2 = connect()->query($sql2);

                        while ($rows2 = $result2->fetch()) {
                          echo'<option value="' . $rows2['M_Nombre'] . '">' . $rows2['M_Nombre'] . '</option>';
                        };
                    echo '
                    </select>
                  </div>
                </div>
                <input type="hidden" id="MunicipioFind" value="' . $mun . '"/>
                <div id="locateFind2">
                  <div class="form-group">
                    <label for="LocalidadFind" class="text-dark">Location</label>
                    <select id="LocalidadFind" class="form-control input-default" name="LocalidadFind">
                      <option value="All" selected="selected">All <small>(To see more options choose a Parish)</small></option>
                    </select>
                  </div>
                </div>
              </div>
              <button type="submit" id="findParLoc" class="btn btn-primary mx-auto">Search</button>
          </div>';

          echo '
          <div class="basic-list-group d-flex list-info" id="resultsList">
          ';
          if(!isset($_GET['parroquia']) && !isset($_GET['localidad'])) {
            echo'

              <div class="col-2 p-0 m-2">
                <div class="card-body d-flex flex-column align-items-center">
                  <h5 class="card-title text-center">Installed Transformers</h5>
                  <span class="badge badge-success badge-pill font-tiny text-white">' . getMunCount('Installed', $mun) . '</span>
                </div>
              </div>

              <div class="col-2 p-0 m-2">
                <div class="card-body d-flex flex-column align-items-center">
                  <h5 class="card-title text-center">Damaged Transformers</h5>
                  <span class="badge badge-danger badge-pill font-tiny text-white">' . getMunCount('Damaged', $mun) . '</span>
                </div>
              </div>

              <div class="col-2 p-0 m-2">
                <div class="card-body d-flex flex-column align-items-center">
                  <h5 class="card-title text-center">Total Transformers</h5>
                  <span class="badge badge-primary badge-pill font-tiny text-white">' . getMunCount(false, $mun) . '</span>
                </div>
              </div>

              <div class="col-2 p-0 m-2">
                <div class="card-body d-flex flex-column align-items-center">
                  <h5 class="card-title text-center">Installed Capacity</h5>
                  <span class="badge badge-warning badge-pill font-tiny text-white">' . getMunCapacidad($mun) . '</span>
                </div>
              </div>
            </div>';
          }
echo '
            <div class="table-responsive mt-3">
              <table class="table table-striped table-hover" id="table">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>SerialNumber</th>
                    <th>State</th>
                    <th>Capacity</th>
                    <th>Parish</th>
                    <th>Location</th>
                    <th>Address</th>
                    <th>Type</th>
                    <th>Transformer Bank</th>
                  </tr>
                </thead>
                <tbody>
                  ';
                    $result = connect()->query("SELECT * FROM transformadores WHERE T_Municipio = '$mun'");

                    $num = 1;

                    while ($rows = $result->fetch()) {
                      echo"<tr>
                            <th> <strong>" . $num++ . "</strong></th>
                            <td><a class='text-info' href='transformador?serial=" . $rows['T_Codigo'] . "'>" . $rows['T_Codigo'] . "</a></td>
                            <td>" . $rows['T_Estado'] . "</td>
                            <td>" . $rows['T_Capacidad'] . " kW</td>
                            <td>" . $rows['T_Parroquia'] . "</td>
                            <td>" . $rows['T_Localidad'] . "</td>
                            <td>" . $rows['T_Direccion'] . "</td>
                            <td>" . $rows['T_Tipo'] . "</td>
                            <td>" . $rows['T_Banco'] . "</td>
                          </tr>";
                    };

                  echo '
                </tbody>
              </table>
            </div>
            ';
          }

          echo '
        </div>
      </div>
    </div>';
    }

    ?>

  </div>

  <?php include "./modulos/scripts.php"; ?>
  <script src="<?php echo media; ?>js/locationFind.js"></script>

  <script src="<?php echo media; ?>extras/datatables/config.js"></script>
  <script>
    function letras(e) {
        tecla = (document.all) ? e.keyCode : e.which;


        if (tecla == 32) {
          return true;
        }

        patron = /[a-zA-Z]/gi;
        tecla_final = String.fromCharCode(tecla);
        return patron.test(tecla_final);
      }
  </script>
</body>

</html>
