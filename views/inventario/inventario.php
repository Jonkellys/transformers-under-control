<?php
  date_default_timezone_set("America/Caracas");

  session_start(['name' => 'Sistema']);

  $page = "inventario";

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
  <title>Inventario | <?php echo NOMBRE; ?></title>
</head>

<body style="width: 100vw;">
  <?php include "./modulos/menu.php"; ?>
  <?php include "./conexiones/funciones.php"; ?>

  <div class="container-fluid mt-0 flex-grow-1 container-p-y ml-5 w-50">
    <h4 class="fw-bold mb-0 w-50">Inventario</h4>
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
      <button class="mb-0 btn btn-primary mx-1" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><i class="bx bx-plus-circle text-white"></i> Añadir Transformador</button>
    </div>

    <div id="accordion-one" class="accordion">
      <div id="collapseOne" class="collapse col-9 card mt-3 rounded mx-auto" data-parent="#accordion-one">
        <div class="card-body">
          <h4 class="card-title">Añadir datos del transformador</h4>
          <form action="<?php echo SERVERURL; ?>conexiones/inventario.php?addT" name="TAdd" id="TAdd" autocomplete="off" enctype="multipart/form-data" method="POST" data-form="save" class="FormularioAjax p-3">
            <input type="hidden" name="TAddInput">
            <div class="form-group">
              <label for="TCodigoAdd" class="text-dark">N° Serial</label>
              <input id="TCodigoAdd" onkeypress="return letras(event)" type="text" name="TCodigoAdd" class="form-control input-default" placeholder="Ingrese el número serial del transformador">
            </div>

            <div class="form-group">
              <label for="TCapacidadAdd" class="text-dark">Capacidad</label>
              <select id="TCapacidadAdd" class="form-control input-default" name="TCapacidadAdd">
                <option disabled selected="selected">¿Cuánta capacidad genera el transformador?</option>
                <option value="5">5 kW</option>
                <option value="10">10 kW</option>
                <option value="15">15 kW</option>
                <option value="25">25 kW</option>
                <option value="37,5">37,5 kW</option>
                <option value="50">50 kW</option>
                <option value="75">75 kW</option>
                <option value="100">100 kW</option>
                <option value="165">165 kW</option>
              </select>
            </div>

            <div class="form-group">
              <label for="TMarcaAdd" class="text-dark">Marca</label>
              <input id="TMarcaAdd" type="text" onkeypress="return letras(event)" name="TMarcaAdd" class="form-control input-default" placeholder="Ingrese la marca del transformador">
            </div>

            <div class="form-group">
              <label for="TModeloAdd" class="text-dark">Modelo</label>
              <input id="TModeloAdd" type="text" name="TModeloAdd" class="form-control input-default" placeholder="Ingrese el modelo del transformador">
            </div>

            <div class="form-group">
              <label for="TGarantiaAdd" class="text-dark">Años de Garantía</label>
              <input id="TGarantiaAdd" type="text" onkeypress="return numeros(event)" name="TGarantiaAdd" class="form-control input-default" placeholder="Ingrese cuantos años de garantía tiene el transformador">
            </div>

            <div class="form-group">
              <label for="TTipoAdd" class="text-dark">Tipo</label>
              <select id="TTipoAdd" class="form-control input-default" name="TTipoAdd">
                <option disabled selected="selected">Seleccione el tipo de transformador</option>
                <option value="Monofásico">Monofásico</option>
                <option value="Trifásico">Trifásico</option>
              </select>
            </div>

            <div class="form-group">
              <label for="TBancoAdd" class="text-dark">Banco Transformador</label>
              <select id="TBancoAdd" class="form-control input-default" name="TBancoAdd">
                <option disabled selected="selected">Seleccione el tipo de transformador</option>
                <option value="Residencial">Residencial</option>
                <option value="Comercial">Comercial</option>
                <option value="Industrial">Industrial</option>
              </select>
            </div>

            <div class="form-group">
              <label for="TEstadoAdd" class="text-dark">Estado Actual</label>
              <select id="TEstadoAdd" class="form-control input-default" name="TEstadoAdd">
                <option disabled selected="selected">¿Cúal es el estado actual del transformador?</option>
                <option value="Instalado">Instalado</option>
                <option value="Dañado">Dañado</option>
                <option value="Almacenado">Almacenado</option>
              </select>
            </div>

            <label class="w-100 text-dark">Ubicación</label>
            <div class="d-flex flex-row flex-start flex-wrap">
              <p>Usar dirección de "Central de Servicios"</p>
              <label class="radio-inline mr-3 ml-4"><input type="checkbox" name="TCentralDir" value="Si"> Sí</label>
            </div>

            <div class="d-flex flex-row flex-start flex-wrap">
              <div class="form-group">
                <label for="TMunicipioAdd" class="text-dark">Municipio</label>
                <select id="HMunicipioAdd" class="form-control input-default" name="TMunicipioAdd">
                <option disabled selected="selected">Seleccione una opción</option>
                <?php

                  $sql = "SELECT * FROM municipios WHERE M_Tipo = 'Municipio'";
                  $result = connect()->query($sql);

                  while ($rows = $result->fetch()) {
                    echo'<option value="' . $rows['M_Nombre'] . '">' . $rows['M_Nombre'] . '</option>';
                  };
                ?>
              </select>
             </div>
             <div id="locate1" class="ml-5"></div>
             <div id="locate2" class="ml-5"></div>
            </div>

            <div class="form-group">
              <label for="TDireccionAdd" class="text-dark">Dirección</label>
              <textarea id="TDireccionAdd" class="form-control input-default h-150px" name="TDireccionAdd" rows="6" id="comment"></textarea>
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
          <h4>Lista de Transformadores</h4>
        </div>
        <div class="table-responsive">
          <table class="table table-striped table-hover" id="table">
            <thead>
              <tr>
                <th>#</th>
                <th>Serial</th>
                <th>Estado</th>
                <th>Capacidad Instalada</th>
                <th>Municipio</th>
                <th>Tipo</th>
                <th>Banco Transformador</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $result = connect()->query("SELECT * FROM transformadores");
                $num = 1;
                $dir = array();

                while ($rows = $result->fetch()) {

                if($rows['T_Municipio'] == "Central de Servicios") {
                  $direccion = "CORPOELEC";
                } else if($rows['T_Municipio'] != "Central de Servicios") {
                  $direccion = "estado sucre " . $rows['T_Localidad'] . " " . $rows['T_Direccion'];
                }


                  echo"<tr>
                        <th> <strong>" . $num++ . "</strong></th>
                        <td><a class='text-info' href='transformador?serial=" . $rows['T_Codigo'] . "'>" . $rows['T_Codigo'] . "</a></td>
                        <td>" . $rows['T_Estado'] . "</td>
                        <td>" . $rows['T_Capacidad'] . " kW</td>
                        <td>" . $rows['T_Municipio'] . "</td>
                        <td>" . $rows['T_Tipo'] . "</td>
                        <td>" . $rows['T_Banco'] . "</td>";
                        if($_SESSION['tipo'] == "Administrador") {
                        echo "<td class='mt-0 d-flex flex-row'>
                          <a class='btn btn-sm btn-info mr-1' href='editar?transformador=" . $rows['T_Codigo'] . "'>
                            <span class='tf-icons bx bx-edit text-white'></span>
                          </a>

                          <a class='btn btn-sm btn-danger mr-1' href='delete?transformador=" . $rows['T_Codigo'] . "'>
                            <span class='tf-icons bx bx-trash text-white'></span>
                          </a>
                          <a class='btn btn-sm btn-warning' target='_blank' href='" . SERVERURL ."conexiones/send.php?dir=" . $direccion . "'>
                            <span class='tf-icons bx bx-map-pin text-white'></span>
                          </a>
                        </td>";
                        } else {
                        echo "<td class='mt-0 d-flex flex-row'>
                            <a class='btn btn-sm btn-warning' target='_blank' href='" . SERVERURL ."conexiones/send.php?dir=" . $direccion . "'>
                              <span class='tf-icons bx bx-map-pin text-white'></span>
                            </a>
                          </td>
                        ";
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

      function numeros(e) {
          tecla = (document.all) ? e.keyCode : e.which;


          if (tecla == 32) {
            return true;
          }

          patron = /[0-9]/gi;
          tecla_final = String.fromCharCode(tecla);
          return patron.test(tecla_final);
        }
  </script>
  <script src="<?php echo media; ?>extras/datatables/config.js"></script>

</body>

</html>
