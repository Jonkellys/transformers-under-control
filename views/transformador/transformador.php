<?php
  date_default_timezone_set("America/Caracas");

  session_start(['name' => 'Sistema']);

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

<?php
  include "./conexiones/funciones.php";
  $codigo = strClean($_GET['serial']);
  $sql = connect()->prepare("SELECT * FROM transformadores WHERE T_Codigo = '$codigo'");
  $sql->execute();
  $data = $sql->fetch(PDO::FETCH_OBJ);
?>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <?php include "./modulos/links.php"; ?>
  <title>Transformador <?php echo $codigo; ?> | <?php echo NOMBRE; ?></title>
</head>

<body style="width: 100vw;">
  <?php include "./modulos/menu.php"; ?>

  <div class="d-flex flex-row justify-content-between mb-4 ms-3">
    <a class="btn btn-outline-primaty py-2 text-primary ml-4 nav-icon" href="inventario">
      <i class="bx bx-arrow-back text-primary"></i> Volver
    </a>
  </div>

  <style media="screen">
    @media (max-width: 768px) {
      .extra-thing {
        width: 100%;
      }

      .accordion .d-flex {
        margin-left: 0.7rem !important;
      }

      .col-9 {
        max-width: 90%;
      }

      .extra-item {
        flex-direction: column;
        align-items: flex-start;
      }
      
      .btn-op {
        flex-direction: column;
        align-items: flex-start;
        width: 60%;
      }
      
    }

    @media (min-width: 992px) {
      .accordion .d-flex {
        margin-left: 3rem !important;
      }

      .extra-item {
        flex-direction: row;
        align-items: flex-start;
      }

      .extra-thing:first-of-type {
        margin-right: 2rem;
      }

      .btn-op {
        margin-left: 2rem;
        flex-direction: row;
        justify-content: flex-start;
      }
    }
  </style>

  <div id="accordion-one" class="accordion">
      <div class="d-flex btn-op mb-4">
        <button class="btn btn-primary m-1" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><i class="bx bx-plus-circle text-white"></i> Añadir Operación</button>
        <?php
          if($_SESSION['tipo'] == "Administrador") {
            echo "
            <a class='btn btn-info m-1' href='editar?transformador=" . $data->T_Codigo . "'>
              <span class='tf-icons bx bx-edit text-white'></span> Editar Transformador
            </a>

            <a class='btn btn-danger m-1' href='delete?transformador=" . $data->T_Codigo . "'>
              <span class='tf-icons bx bx-trash text-white'></span>Eliminar Transformador
            </a>";
          }
        ?>
      </div>

      <div id="collapseOne" class="collapse card mt-3 col-9 mb-4 rounded mx-auto" data-parent="#accordion-one">
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
              <input id="HEquipoAdd" readonly value="<?php echo $codigo; ?>" type="text" class="form-control input-default" name="HEquipoAdd" placeholder="Ingrese el número serial del transformador">
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

    <div class="card col-9 p-4 mx-auto">
      <h4 class="fw-bold mb-0">Transformador <?php echo $codigo; ?></h4>

      <ul class="list-group mt-3 mb-3">
        <li class="list-group-item"><strong>Serial:  </strong><?php echo $data->T_Codigo; ?></li>
        <li class="list-group-item"><strong>Marca:  </strong><?php echo $data->T_Marca; ?></li>
        <li class="list-group-item"><strong>Modelo:  </strong><?php echo $data->T_Modelo; ?></li>
        <li class="list-group-item"><strong>Capacidad:  </strong><?php echo $data->T_Capacidad; ?> kW</li>
        <li class="list-group-item"><strong>Tipo:  </strong><?php echo $data->T_Tipo; ?></li>
        <li class="list-group-item"><strong>Banco Transformador:  </strong><?php echo $data->T_Banco; ?></li>
        <li class="list-group-item"><strong>Municipio:  </strong><?php echo $data->T_Municipio; ?></li>
        <li class="list-group-item"><strong>Parroquia:  </strong><?php echo $data->T_Parroquia; ?></li>
        <li class="list-group-item"><strong>Localidad:  </strong><?php echo $data->T_Localidad; ?></li>
        <li class="list-group-item"><strong>Dirección:  </strong><?php echo $data->T_Direccion; ?></li>
        <li class="list-group-item"><strong>Estado Actual:  </strong><?php echo $data->T_Estado; ?></li>
        <li class="list-group-item"><strong>Años de Garantia:  </strong><?php echo $data->T_Garantia; ?></li>
      </ul>

      <?php
          $direccion = $data->T_Direccion;
          $localidad = $data->T_Localidad;
          $code = $data->T_Codigo;
          $capacidad = $data->T_Capacidad;

       if($data->T_Tipo == "Trifásico" && $data->T_Municipio != 'Central de Servicios') {
        $stmt = connect()->query("SELECT * FROM transformadores WHERE T_Direccion = '$direccion' AND T_Localidad = '$localidad' AND T_Tipo = 'Trifásico' AND T_Codigo != '$code' AND T_Municipio != 'Central de Servicios'");
        echo '<h4 class="fw-bold mb-3 mt-4">Banco Transformador junto con</h4>
            <ul class="mb-3">
        ';

        while ($rows = $stmt->fetch()) {
          echo '
            <li class="list-group-item d-flex p-2 extra-item mb-2"><p class="extra-thing mb-0"><strong>N° Serial:  </strong><a class="text-primary" href="transformador?serial=' . $rows['T_Codigo'] . '">' . $rows['T_Codigo'] . '</a></p> <p class="extra-thing mb-0"><strong>Capacidad: </strong>' . $rows['T_Capacidad'] . ' kW</p></li>';
          $capacidad += $rows['T_Capacidad'];
        }

          echo '</ul>
          <p class="ml-2"><strong>Capacidad Total: </strong>' . $capacidad . ' kW</p>';
        }

        $operacionesQuery = connect()->query("SELECT * FROM operaciones WHERE O_Equipo = '$code'");
        if($operacionesQuery->rowCount() >= 1) {
          echo '<h4 class="fw-bold mb-3 mt-4">Operaciones realizadas en este transformador</h4>
            <ul class="mb-3">
          ';

          while ($row = $operacionesQuery->fetch()) {
            echo '
              <li class="list-group-item d-flex mb-2 p-2 extra-item"><p class="extra-thing mb-0"><strong>Procedimiento:  </strong>' . $row['O_Procedimiento'] . '</p><p class="extra-thing mb-0"><strong>Fecha:  </strong>' . $row['O_Fecha'] . '</p></li>
            </a>';
          }

          echo '</ul>';
        }

        echo '</div>';

      ?>

  <?php include "./modulos/scripts.php"; ?>
  <script src="<?php echo media; ?>js/ajax/principal.js"></script>
  <script src="<?php echo media; ?>js/locations.js"></script>
</body>

</html>
