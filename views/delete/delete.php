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

  if($_SESSION['tipo'] == "Normal") {
    header('Location: http://localhost/sistema-transformadores/dashboard');
  }

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <?php include "./modulos/links.php"; ?>
  <title>Eliminar | <?php echo NOMBRE; ?></title>
</head>

<body style="width: 100vw;">
  <?php
    include "./modulos/menu.php";
    include "./conexiones/funciones.php";
  ?>

  <style media="screen">
    @media (max-width: 768px) {
      .col-9 {
        max-width: 90%;
      }

      .container-p-y {
        margin-left: 0.5rem;
      }

      .back-btn {
        margin-left: 0.5rem;
      }
    }

    @media (min-width: 992px) {
      .container-p-y {
        margin-left: 3rem;
      }

      .back-btn {
        margin-left: 3rem;
      }
    }
  </style>

    <div class="d-flex flex-row justify-content-between mb-0">
      <?php
          if(isset($_GET['transformador'])) {
            echo '<a class="btn btn-outline-primaty py-2 text-primary back-btn nav-icon" href="inventario">';
          } else if(isset($_GET['operacion'])) {
            echo '<a class="btn btn-outline-primaty py-2 text-primary back-btn nav-icon" href="historial">';
          } else if(isset($_GET['cuenta'])) {
            echo '<a class="btn btn-outline-primaty py-2 text-primary back-btn nav-icon" href="configuraciones">';
          } else if(isset($_GET['ubicacion'])) {
            echo '<a class="btn btn-outline-primaty py-2 text-primary back-btn nav-icon" href="ubicaciones">';
          }
        ?>
        <i class="bx bx-arrow-back text-primary"></i> Volver
      </a>
    </div>

  <div class="container-fluid mt-0 flex-grow-1 container-p-y mt-3">
    <h4 class="fw-bold mb-0">Eliminar <?php if(isset($_GET['transformador'])) {echo "Transformador";} else if(isset($_GET['operacion'])) {echo "Operación";} else if(isset($_GET['cuenta'])) {echo "Cuenta";} else if(isset($_GET['ubicacion'])) {echo "Ubicación";} ?></h4>
  </div>

    <?php
    if(isset($_GET['transformador'])) {

      $delete = strClean($_GET['transformador']);
      $sql = connect()->prepare("SELECT * FROM transformadores WHERE T_Codigo = '$delete'");

    } else if(isset($_GET['operacion'])) {

      $delete = strClean($_GET['operacion']);
      $sql = connect()->prepare("SELECT * FROM operaciones WHERE O_Codigo = '$delete'");

    } else if(isset($_GET['ubicacion'])) {

      $delete = strClean($_GET['ubicacion']);
      $sql = connect()->prepare("SELECT * FROM municipios WHERE M_Codigo = '$delete'");

    } else if(isset($_GET['cuenta'])) {

      $delete = strClean($_GET['cuenta']);
      $sql = connect()->prepare("SELECT * FROM usuarios WHERE userCodigo = '$delete'");
    }

    if(!isset($delete)) {
      header('Location: http://localhost/sistema-transformadores/dashboard');
    }

    $sql->execute();
    $data = $sql->fetch(PDO::FETCH_OBJ);

    ?>

  <div class="container-fluid p-2">

    <div class="col-lg-11 mx-auto mt-4 card">
      <div class="card-body">
        <div class="card-title">
        <?php
          if(isset($_GET['transformador'])) {
            echo'<h4>Datos del transformador</h4>
              </div>
              <ul class="list-group col-9 mx-auto mt-3">
                <li class="list-group-item"><strong>Serial:  </strong> ' . $data->T_Codigo . '</li>
                <li class="list-group-item"><strong>Marca:  </strong> ' . $data->T_Marca . '</li>
                <li class="list-group-item"><strong>Modelo:  </strong> ' . $data->T_Modelo . '</li>
                <li class="list-group-item"><strong>Capacidad:  </strong> ' . $data->T_Capacidad . '</li>
                <li class="list-group-item"><strong>Tipo:  </strong> ' . $data->T_Tipo . '</li>
                <li class="list-group-item"><strong>Banco Transformador:  </strong> ' . $data->T_Banco . '</li>
                <li class="list-group-item"><strong>Municipio:  </strong> ' . $data->T_Municipio . '</li>
                <li class="list-group-item"><strong>Parroquia:  </strong> ' . $data->T_Parroquia . '</li>
                <li class="list-group-item"><strong>Localidad:  </strong> ' . $data->T_Localidad . '</li>
                <li class="list-group-item"><strong>Dirección:  </strong> ' . $data->T_Direccion . '</li>
                <li class="list-group-item"><strong>Estado Actual:  </strong> ' . $data->T_Estado . '</li>
                <li class="list-group-item"><strong>Años de Garantia:  </strong> ' . $data->T_Garantia . '</li>
              </ul>

              <form action="' . SERVERURL . 'conexiones/inventario.php?deleteT" autocomplete="off" enctype="multipart/form-data" method="POST" data-form="delete" class="FormularioAjax p-3 d-flex flex-column align-items-center">
                <input type="hidden" name="delT" value="' . $data->T_Codigo . '">
                <div class="RespuestaAjax mt-3"></div>

                <button type="submit" class="btn btn-danger mx-auto">Eliminar</button>
              </form>
              ';
          } else if(isset($_GET['operacion'])) {
            echo'<h4>Datos de la operación</h4>
              </div>
              <ul class="list-group col-9 mx-auto mt-3">
                <li class="list-group-item"><strong>Procedimiento:  </strong> ' . $data->O_Procedimiento . '</li>
                <li class="list-group-item"><strong>Fecha:  </strong> ' . $data->O_Fecha . '</li>
                <li class="list-group-item"><strong>N° Serial del Transformador:  </strong> ' . $data->O_Equipo . '</li>
                <li class="list-group-item"><strong>Estado del Transformador:  </strong> ' . $data->O_EstadoActual . '</li>
                <li class="list-group-item"><strong>Municipio:  </strong> ' . $data->O_Municipio . '</li>
                <li class="list-group-item"><strong>Parroquia:  </strong> ' . $data->O_Parroquia . '</li>
                <li class="list-group-item"><strong>Localidad:  </strong> ' . $data->O_Localidad . '</li>
                <li class="list-group-item"><strong>Dirección:  </strong> ' . $data->O_Direccion . '</li>
              </ul>

              <form action="' . SERVERURL . 'conexiones/historial.php?deleteO" autocomplete="off" enctype="multipart/form-data" method="POST" data-form="delete" class="FormularioAjax p-3 d-flex flex-column align-items-center">
                <input type="hidden" name="delO" value="' . $data->O_Codigo . '">
                <div class="RespuestaAjax mt-3"></div>

                <button type="submit" class="btn btn-danger mx-auto">Eliminar</button>
              </form>
              ';
          } else if(isset($_GET['cuenta'])) {
            echo'<h4>Datos de la cuenta</h4>
              </div>
              <ul class="list-group col-9 mx-auto mt-3">
                <li class="list-group-item"><strong>Nombre de Usuario:  </strong> ' . $data->userUsername . '</li>
                <li class="list-group-item"><strong>Tipo de Cuenta:  </strong> ' . $data->userType . '</li>
                <li class="list-group-item"><strong>Nombre:  </strong> ' . $data->userName . '</li>
                <li class="list-group-item"><strong>Apellido:  </strong> ' . $data->userLastname . '</li>
                <li class="list-group-item"><strong>Cargo:  </strong> ' . $data->userCargo . '</li>
                <li class="list-group-item"><strong>Correo:  </strong> ' . $data->userEmail . '</li>
              </ul>

              <form action="' . SERVERURL . 'conexiones/create.php?deleteC" autocomplete="off" enctype="multipart/form-data" method="POST" data-form="delete" class="FormularioAjax p-3 d-flex flex-column align-items-center">
                <input type="hidden" name="delC" value="' . $data->userCodigo . '">
                <div class="RespuestaAjax mt-3"></div>

                <button type="submit" class="btn btn-danger mx-auto">Eliminar</button>
              </form>
            ';
          } else if(isset($_GET['ubicacion'])) {
            $datUbic = $data->M_Ubicacion;

            $getMunicipio = connect()->prepare("SELECT * FROM municipios WHERE M_Nombre = '$datUbic'");
            $getMunicipio->execute();
            $total = $getMunicipio->fetch(PDO::FETCH_OBJ);

            echo'<h4>Datos de la ubicación</h4>
              </div>
              <ul class="list-group col-9 mx-auto mt-3">
                <li class="list-group-item"><strong>Nombre de la localidad:  </strong> ' . $data->M_Nombre . '</li>
                <li class="list-group-item"><strong>Municipio:  </strong> ' . $total->M_Ubicacion . '</li>
                <li class="list-group-item"><strong>Parroquia:  </strong> ' . $data->M_Ubicacion . '</li>
              </ul>

              <form action="' . SERVERURL . 'conexiones/ubicaciones.php?UDel" autocomplete="off" enctype="multipart/form-data" method="POST" data-form="delete" class="FormularioAjax p-3 d-flex flex-column align-items-center">
                <input type="hidden" name="delU" value="' . $data->M_Codigo . '">
                <div class="RespuestaAjax mt-3"></div>

                <button type="submit" class="btn btn-danger mx-auto">Eliminar</button>
              </form>
              ';
          }
        ?>
      </div>
    </div>
  </div>

  <?php include "./modulos/scripts.php"; ?>
  <script src="<?php echo media; ?>js/ajax/principal.js"></script>

</body>

</html>
