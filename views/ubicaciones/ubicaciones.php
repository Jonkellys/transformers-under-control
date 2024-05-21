<?php
  date_default_timezone_set("America/Caracas");

  session_start(['name' => 'Sistema']);

  $page = "ubicaciones";

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
    header('Location: http://localhost/sistema-transformadores/login');
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <?php include "./modulos/links.php"; ?>
  <title>Ubicaciones | <?php echo NOMBRE; ?></title>
</head>

<body style="width: 100vw;">
  <?php
  include "./modulos/menu.php";
  include "./conexiones/funciones.php";
  ?>

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
        align-items: center;
        width: 100%;
        padding: 0px;
      }

      .mun-flex {
        justify-content: flex-start;
        flex-wrap: wrap;
      }

      .findParLoc {
        align-self: center;
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
        flex: 0 0 100%;
        max-width: 100%;
        flex-direction: row;
        justify-content: center;
      }

      .mun-flex {
        justify-content: space-around;
      }


    }
  </style>

  <div class="container-fluid mt-0 flex-grow-1 container-p-y ml-5 2-50">
    <h4 class="fw-bold mb-0">Ubicaciones</h4>
  </div>

  <div class="container-fluid p-4">

    <div id="accordion-one" class="accordion">
      <div class="d-flex flex-row justify-content-space add-btn">
        <button class="mb-4 btn btn-info mx-1" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><i class="bx bx-map-alt text-white"></i> Localidades</button>
      </div>

      <div id="collapseOne" class="collapse card mt-3 col-11 mb-4 rounded mx-auto" data-parent="#accordion-one">
        <div class="card-body">

          <div id="accordion-two" class="accordion">
            <div class="d-flex flex-row justify-content-space">
              <button class="mb-4 btn btn-primary mx-1" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo"><i class="bx bx-plus-circle text-white"></i> Añadir Localidad</button>
            </div>

            <div id="collapseTwo" class="collapse mt-3 mb-4 mx-auto add-list" data-parent="#accordion-two">
              <div class="card-body p-0">
                <h4 class="card-title">Añadir datos de la localidad</h4>
                <form action="<?php echo SERVERURL; ?>conexiones/ubicaciones.php?UAdd" name="UAdd" id="UAdd" autocomplete="off" enctype="multipart/form-data" method="POST" data-form="save" class="FormularioAjax p-3">
                  <div class="d-flex flex-row mun-flex">
                    <div class="form-group">
                      <label for="HMunicipioAdd" class="text-dark">Municipio</label>
                      <select id="HMunicipioAdd" class="form-control input-default" name="LMunicipioAdd">
                        <option disabled selected="selected">Seleccione una opción</option>
                        <?php

                          $selMun = "SELECT * FROM municipios WHERE M_Tipo = 'Municipio' AND M_Nombre != 'Central de Servicios'";
                          $munResult = connect()->query($selMun);

                          while ($fila = $munResult->fetch()) {
                            echo'<option value="' . $fila['M_Nombre'] . '">' . $fila['M_Nombre'] . '</option>';
                          }
                        ?>
                      </select>
                    </div>
                    <div id="locate1"></div>
                    <div class="form-group">
                      <label for="LAdd" class="text-dark">Nombre de la Localidad</label>
                      <input id="LAdd" onkeypress="return letras(event)" type="text" class="form-control input-default" name="LAdd">
                    </div>
                  </div>
                  <div class="RespuestaAjax mt-3"></div>
                  <button type="submit" class="btn btn-primary">Añadir datos</button>
                </form>
              </div>
            </div>

          </div>


          <div class="table-responsive mt-3">
            <table class="table table-striped table-hover" id="table">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nombre de la Localidad</th>
                  <th>Municipio</th>
                  <th>Parroquia</th>
                  <?php
                    if($_SESSION['tipo'] == "Administrador") {
                      echo '<th>Acciones</th>';
                    }
                  ?>
                </tr>
              </thead>
              <tbody>
                <?php
                  $result1 = connect()->query("SELECT * FROM municipios WHERE M_Tipo = 'Localidad'");

                  $num1 = 1;

                  while ($rows1 = $result1->fetch()) {
                    $ubic = $rows1['M_Ubicacion'];
                    $sql1 = connect()->prepare("SELECT * FROM municipios WHERE M_Nombre = '$ubic'");
                    $sql1->execute();
                    $data1 = $sql1->fetch(PDO::FETCH_OBJ);

                    echo"<tr>
                          <th> <strong>" . $num1++ . "</strong></th>
                          <td>" . $rows1['M_Nombre'] . "</td>
                          <td>" . $data1->M_Ubicacion . "</td>
                          <td>" . $rows1['M_Ubicacion'] . "</td>";

                          if($_SESSION['tipo'] == "Administrador") {
                          echo "<td class='mt-0'>
                            <a class='btn btn-sm btn-info' href='editar?ubicacion=" . $rows1['M_Codigo'] . "'>
                              <span class='tf-icons bx bx-edit text-white'></span>
                            </a>

                            <a class='btn btn-sm btn-danger' href='delete?ubicacion=" . $rows1['M_Codigo'] . "'>
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

    <div class="col-11 mx-auto">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Seleccione una ubicación</h4>
          <div class="basic-form mx-auto">
            <form action="<?php echo SERVERURL; ?>conexiones/ubicaciones.php?find" autocomplete="off" enctype="multipart/form-data" method="POST" data-form="save" class="SearchAjax p-3">
              <div class="form-group">
                <h5 class="text-dark">Municipios</h5>
                <label class="radio-inline mr-3">
                <input type="radio" name="radMun" value="Andrés Mata"> Andrés Mata</label>
                <label class="radio-inline mr-3">
                <input type="radio" name="radMun" value="Arismendi"> Arismendi</label>
                <label class="radio-inline mr-3">
                <input type="radio" name="radMun" value="Benítez"> Benítez</label>
                <label class="radio-inline mr-3">
                <input type="radio" name="radMun" value="Bermúdez"> Bermúdez</label>
                <label class="radio-inline mr-3">
                <input type="radio" name="radMun" value="Cajigal"> Cajigal</label>
                <label class="radio-inline mr-3">
                <input type="radio" name="radMun" value="Libertador"> Libertador</label>
                <label class="radio-inline mr-3">
                <input type="radio" name="radMun" value="Mariño"> Mariño</label>
                <label class="radio-inline">
                <input type="radio" name="radMun" value="Valdez"> Valdez</label>
                <br>
                <br>
                <h5 class="text-dark">Otros</h5>
                <label class="radio-inline">
                <input type="radio" name="radMun" value="Central de Servicios"> Central de Servicios</label>
              </div>
              <div id="respuesta" class="RespuestaAjax mt-1"></div>
              <div class="d-flex flex-column align-items-center justify-content-center">
                <button class="btn btn-primary mx-auto" value="submit" name="submit" id="btn" type="submit">Buscar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <?php
        $mun = $_GET['municipio'];

    if(isset($mun)) {
      if($mun == "Central de Servicios") {
        echo '
        <div class="col-11 mx-auto">
        <div class="card">
          <div id="resultsList" class="d-flex flex-wrap card-body">
            <h5 class="card-title mb-3 w-100">Central de Servicios</h5>
            <div class="basic-list-group d-flex justify-content-center add-list">

              <div class="col-2 p-0 m-2">
                <div class="card-body d-flex flex-column align-items-center">
                  <h5 class="card-title text-center">Transformadores Dañados</h5>
                  <span class="badge badge-danger badge-pill font-tiny text-white">' . getMunCount('Dañado', $mun) . '</span>
                </div>
              </div>

              <div class="col-2 p-0 m-2">
                <div class="card-body d-flex flex-column align-items-center">
                  <h5 class="card-title text-center">Transformadores en Stock</h5>
                  <span class="badge badge-info badge-pill font-tiny text-white">' . getMunCount('Almacenado', $mun) . '</span>
                </div>
              </div>

              <div class="col-2 p-0 m-2">
                <div class="card-body d-flex flex-column align-items-center">
                  <h5 class="card-title text-center">Transformadores Totales</h5>
                  <span class="badge badge-primary badge-pill font-tiny text-white">' . getMunCount(false, $mun) . '</span>
                </div>
              </div>

            </div>

            <div class="table-responsive mt-3">
              <table class="table table-striped table-hover" id="table1">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Serial</th>
                    <th>Estado</th>
                    <th>Capacidad</th>
                    <th>Parroquia</th>
                    <th>Localidad</th>
                    <th>Dirección</th>
                    <th>Tipo</th>
                    <th>Banco Transformador</th>
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
          </div>
        </div>
        </div>';
      } else {
      echo '<div class="col-11 mx-auto">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title mb-3">Municipio ' . $mun . '</h5>
            ';

            echo '
            <div class="col-12 findParLoc">
              <h5>Buscar Por</h5>
              <div class="form-inline">
                <div id="locateFind1" class="mr-4">
                  <div class="form-group">
                    <label for="ParroquiaFind" class="text-dark mr-2">Parroquia:</label>
                    <select id="ParroquiaFind" class="form-control input-default" name="ParroquiaFind">
                      <option value="Todas" selected="selected">Todas</option>
                      ';
                        $sql2 = "SELECT * FROM municipios WHERE M_Tipo = 'Parroquia' AND M_Ubicacion = '$mun' ORDER BY M_Nombre ASC";
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
                    <label for="LocalidadFind" class="text-dark mr-2">Localidad:</label>
                    <select id="LocalidadFind" class="form-control input-default" name="LocalidadFind">
                      <option value="Todas" selected="selected">Todas <small>(Para ver más opciones seleccione una Parroquia)</small></option>
                    </select>
                  </div>
                </div>
                <button type="submit" id="findParLoc" class="btn btn-primary mx-auto">Buscar</button>
              </div>
            ';


            echo '
              <div id="resultsList" class="d-flex flex-wrap mt-2 add-list">
                <div class="col-2 p-0 mx-2">
                  <div class="card-body d-flex flex-column align-items-center">
                    <h5 class="card-title text-center">Transformadores Instalados</h5>
                    <span class="badge badge-success badge-pill font-tiny text-white">' . getMunCount('Instalado', $mun) . '</span>
                  </div>
                </div>

                <div class="col-2 p-0 mx-2">
                  <div class="card-body d-flex flex-column align-items-center">
                    <h5 class="card-title text-center">Transformadores Dañados</h5>
                    <span class="badge badge-danger badge-pill font-tiny text-white">' . getMunCount('Dañado', $mun) . '</span>
                  </div>
                </div>

                <div class="col-2 p-0 mx-2">
                  <div class="card-body d-flex flex-column align-items-center">
                    <h5 class="card-title text-center">Transformadores Totales</h5>
                    <span class="badge badge-primary badge-pill font-tiny text-white">' . getMunCount(false, $mun) . '</span>
                  </div>
                </div>

                <div class="col-2 p-0 mx-2">
                  <div class="card-body d-flex flex-column align-items-center">
                    <h5 class="card-title text-center">Capacidad Instalada</h5>
                    <span class="badge badge-warning badge-pill font-tiny text-white">' . getMunCapacidad($mun) . '</span>
                  </div>
                </div>

                <div class="table-responsive mt-3">
                  <table class="table table-striped table-hover" id="table1">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Serial</th>
                        <th>Estado</th>
                        <th>Capacidad</th>
                        <th>Parroquia</th>
                        <th>Localidad</th>
                        <th>Dirección</th>
                        <th>Tipo</th>
                        <th>Banco Transformador</th>
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

              </div>

            </div>
            ';

          echo '
        </div>
      </div>
    </div>';
    }
}
    ?>

  </div>

  <?php include "./modulos/scripts.php"; ?>
  <!-- <script src="<?php echo media; ?>js/ajax/buscar.js"></script> -->
  <script src="<?php echo media; ?>js/locations.js"></script>
  <script src="<?php echo media; ?>js/locationFind.js"></script>
  <script src="<?php echo media; ?>js/ajax/principal.js"></script>

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
