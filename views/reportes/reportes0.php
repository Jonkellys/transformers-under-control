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
  <title>Reportes | <?php echo NOMBRE; ?></title>
</head>

<body style="width: 100vw;">
  <?php include "./modulos/menu.php"; ?>
  <?php include "./conexiones/funciones.php"; ?>

  <div class="container-fluid mt-0 flex-grow-1 container-p-y ml-5">
    <h4 class="fw-bold mb-0">Reportes</h4>
  </div>

  <a target="_blank" class="btn btn-primary" href="newReporte">Reporte</a>

  <style media="screen">
    @media (max-width: 768px) {
      .btn-box {
        flex-direction: column;
        align-items: center;
      }

      .btn-one {
        margin: 1rem 0px !important;
      }

      .fechaBox {
        flex-direction: column !important;
      }

      .fechaInput {
        width: 100% !important;
      }

      .sm-hidden {
        display: none !important;
      }

      .big-hidden {
        display: block !important;
      }
    }

    @media (min-width: 992px) {
      .btn-box {
        flex-direction: row;
        justify-content: flex-start;
      }

      .sm-hidden {
        display: flex !important;
      }

      .big-hidden {
        display: none !important;
      }
    }
  </style>

  <div class="container-fluid p-4">
    <div id="accordion-one" class="accordion ml-5 card mx-auto p-4 col-9">
      <h4 class="card-title">Seleccione una Opción</h4>
      <div class="d-flex btn-box">
        <a class="mb-0 btn btn-primary mx-1 btn-one" href="newReporte?tipo=General" target="_blank" rel="noopener noreferrer"><i class="bx bxs-file-pdf text-white"></i> Reporte General</a>

        <button class="mb-0 btn btn-primary mx-1" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><i class="bx bx-file text-white"></i> Reporte Personalizado</button>
      </div>
    </div>

    <div id="collapseOne" class="collapse card mt-3 col-10 rounded mx-auto" data-parent="#accordion-one">
      <div class="card-body">
        <h4 class="card-title">Elija un tema y las opciones para generar el informe</h4>

        <form id="reportForm" action="<?php echo SERVERURL; ?>conexiones/reporteGeneral.php?tipo=personalizado" autocomplete="off" enctype="multipart/form-data" method="POST" data-form="report" class=" p-3">
          <div id="accordion-three" class="accordion">

            <div class="card">
              <div class="card-header">
                <h5 class="mb-0 collapsed" data-toggle="collapse" data-target="#collapseOne4" aria-expanded="false" aria-controls="collapseOne4"><i class="bx bx-chevron-down mr-3" aria-hidden="true"></i>Informe de Transformadores</h5>
              </div>

              <div id="collapseOne4" class="collapse" data-parent="#accordion-three">
                <div class="card-body">
                  <div class="form-group">
                    <label for="EstadoInput" class="text-dark">Estado</label>
                    <select id="EstadoInput" class="form-control input-default" name="EstadoInput">
                      <option value="Todos" selected="selected">Todos</option>
                      <option value="Instalado">Instalado</option>
                      <option value="Ninguno">Ninguno</option>
                      <option value="Dañado">Dañado</option>
                      <option value="Almacenado">Almacenado</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="CapacidadInput" class="text-dark">Capacidad</label>
                    <select id="CapacidadInput" class="form-control input-default" name="CapacidadInput">
                      <option value="Todos" selected="selected">Todas</option>
                      <option value="Ninguno">Ninguno</option>
                      <option value="5">5 kW</option>
                      <option value="10">10 kW</option>
                      <option value="15">15 kW</option>
                      <option value="25">25 kW</option>
                      <option value="37.5">37,5 kW</option>
                      <option value="50">50 kW</option>
                      <option value="75">75 kW</option>
                      <option value="100">100 kW</option>
                      <option value="165">165 kW</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="MarcaInput" class="text-dark">Marca</label>
                    <select id="MarcaSelect" class="form-control input-default chooseArea" name="MarcaInput">
                      <option selected value="Todos">Todas</option>
                      <option value="Ninguno">Ninguno</option>
                      <option value="Elegir">Elegir</option>
                    </select>
                    <?php
                    if(isset($_GET['Elegir'])) {

                      echo '<input type="text" class="form-control input-default" name="MarcaInput" id="MarcaInput">';
                    } else {
                      echo '';
                    }
                  ?>

                  </div>

                  <div class="form-group">
                    <label for="ModeloInput" class="text-dark">Modelo</label>
                    <input type="text" value="Todos" class="form-control input-default" name="ModeloInput" id="ModeloInput">
                  </div>

                  <div class="form-group">
                    <label for="AnosInput" class="text-dark">Años de Garantía</label>
                    <input type="text" value="Todos" class="form-control input-default" name="AnosInput" id="AnosInput">
                  </div>

                  <div class="d-flex flex-row flex-start flex-wrap">
                    <label class="text-dark mb-3 w-100">Ubicación</label>
                    <div class="form-group">
                      <label for="HMunicipioAdd" class="text-dark">Municipio</label>
                      <select id="HMunicipioAdd" class="form-control input-default" name="HMunicipioAdd">
                        <option value="Todos" selected>Todos</option>
                        <?php

                          $sqlMun = "SELECT * FROM municipios WHERE M_Tipo = 'Municipio'";
                          $resultMun = connect()->query($sqlMun);

                          while ($rowsMun = $resultMun->fetch()) {
                            echo'<option value="' . $rowsMun['M_Nombre'] . '">' . $rowsMun['M_Nombre'] . '</option>';
                          };
                        ?>
                      </select>
                    </div>
                    <div id="locate1" class="ml-5">
                      <div class="form-group">
                        <label for="HParroquiaAdd" class="text-dark">Parroquia</label>
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
                        <p class="mb-5">Deje en blanco para seleccionar <strong>Todos</strong></p>
                      </div>
                    </div>
                    <div id="locate2" class="ml-5">
                      <div class="form-group">
                        <label for="HLocalidadAdd" class="text-dark">Localidad</label>
                        <select id="HLocalidadAdd" class="form-control input-default" name="HLocalidadAdd">
                          <option disabled selected="selected"></option>
                          <?php
                            $sql = "SELECT * FROM municipios WHERE M_Tipo = 'Localidad' AND M_Ubicacion = '$par'";
                            $result = connect()->query($sql);

                            while ($rows = $result->fetch()) {
                              echo'<option value="' . $rows['M_Nombre'] . '">' . $rows['M_Nombre'] . '</option>';
                            };
                          ?>>
                        </select>
                      </div>
                    </div>
                  </div>


                  <div class="form-group">
                    <label for="TipoInput" class="text-dark">Tipo</label>
                    <select id="TipoInput" class="form-control input-default" name="TipoInput">
                      <option value="Todos" selected="selected">Todos</option>
                      <option value="Monofásico">Monofásico</option>
                      <option value="Trifásico">Trifásico</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="BancoInput" class="text-dark">Banco Transformador</label>
                    <select id="BancoInput" class="form-control input-default" name="BancoInput">
                      <option value="Todos" selected="selected">Todos</option>
                      <option value="Residencial">Residencial</option>
                      <option value="Comercial">Comercial</option>
                      <option value="Industrial">Industrial</option>
                    </select>
                  </div>

                  <div class="RespuestaAjax mt-3"></div>
                  <button type="submit" value="transformadores" name="transSubmit" class="btn btn-primary">Generar informe de transformadores</button>
                </form>
                </div>
              </div>
            </div>


            <div class="card">
              <div class="card-header">
                <h5 class="mb-0 collapsed" data-toggle="collapse" data-target="#collapseTwo5" aria-expanded="false" aria-controls="collapseTwo5"><i class="bx bx-chevron-down mr-3" aria-hidden="true"></i>Informe de Operaciones</h5>
              </div>

              <div id="collapseTwo5" class="collapse" data-parent="#accordion-three">

                <div class="card-body">
                  <form id="reportForm" action="<?php echo SERVERURL; ?>conexiones/reporteGeneral.php?tipo=personalizado" autocomplete="off" enctype="multipart/form-data" method="POST" data-form="report" class=" p-3">
                  <div class="form-group">
                    <label for="ProcedimientoInput" class="text-dark">Procedimiento</label>
                    <select id="ProcedimientoInput" class="form-control input-default" name="ProcedimientoInput">
                      <option value="Todos" selected="selected">Todos</option>
                      <option value="Reparación">Reparación</option>
                      <option value="Instalación">Instalación</option>
                      <option value="Instalación">Instalación</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="FechaCheck" class="text-dark">Fecha</label>
                    <div class="d-flex flex-row justify-content-around sm-hidden mt-0">
                      <p class="ml-5 mr-5">Desde:</p><p class="ml-5">Hasta:</p>
                    </div>
                    <div class="input-group fechaBox">
                      <div class="input-group-prepend">
                        <div class="input-group-text">
                          <input name="fechaCheck" checked class="mr-1" value="Todos" type="checkbox">Todas
                        </div>
                      </div>
                      <p class="big-hidden mb-0 mt-1">Desde:</p>
                      <input type="date" name="FechaInicio" placeholder="Desde:" class="fechaInput form-control">
                      <p class="big-hidden mb-0 mt-1">Hasta:</p>
                      <input type="date" name="FechaFin" placeholder="Hasta:" class="fechaInput form-control">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="SerialInput" class="text-dark">Serial del Equipo</label>
                    <input type="text" value="Todos" class="form-control input-default" name="SerialInput" id="SerialInput">
                  </div>

                  <div class="d-flex flex-row flex-start flex-wrap">
                    <label class="text-dark mb-3 w-100">Ubicación</label>
                    <div class="form-group">
                      <label for="HMunicipioAdd" class="text-dark">Municipio</label>
                      <select id="HMunicipioAdd" class="form-control input-default" name="HMunicipioAdd">
                        <option selected value="Todos">Todos</option>
                        <?php

                          $sqlMun = "SELECT * FROM municipios WHERE M_Tipo = 'Municipio'";
                          $resultMun = connect()->query($sqlMun);

                          while ($rowsMun = $resultMun->fetch()) {
                            echo'<option value="' . $rowsMun['M_Nombre'] . '">' . $rowsMun['M_Nombre'] . '</option>';
                          };
                        ?>
                      </select>
                    </div>
                    <div id="locate1" class="ml-5">
                      <div class="form-group">
                        <label for="HParroquiaAdd" class="text-dark">Parroquia</label>
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
                        <p class="mb-5">Deje en blanco para seleccionar <strong>Todos</strong></p>
                      </div>
                    </div>
                    <div id="locate2" class="ml-5">
                      <div class="form-group">
                        <label for="HLocalidadAdd" class="text-dark">Localidad</label>
                        <select id="HLocalidadAdd" class="form-control input-default" name="HLocalidadAdd">
                          <option disabled selected="selected"></option>
                          <?php
                            $sql = "SELECT * FROM municipios WHERE M_Tipo = 'Localidad' AND M_Ubicacion = '$par'";
                            $result = connect()->query($sql);

                            while ($rows = $result->fetch()) {
                              echo'<option value="' . $rows['M_Nombre'] . '">' . $rows['M_Nombre'] . '</option>';
                            };
                          ?>>
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="RespuestaAjax mt-3"></div>
                  <button type="submit" value="operaciones" name="opSubmit" class="btn btn-primary">Generar informe de operaciones</button>
                </div>
              </div>
            </div>

          </div>
        </form>

      </div>
    </div>

  </div>

  <?php include "./modulos/scripts.php"; ?>
  <script src="<?php echo media; ?>js/ajax/principal.js"></script>
  <script src="<?php echo media; ?>js/locations.js"></script>
  <script src="<?php echo media; ?>js/ajax/reporteOptions.js"></script>
  <script>
    function clearInput() {
      document.getElementById("reportForm").reset();
    }
  </script>
</body>

</html>
