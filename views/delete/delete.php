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
    header('Location: http://localhost/transformers-under-control/login');
  }

  if($_SESSION['tipo'] == "Normal") {
    header('Location: http://localhost/transformers-under-control/dashboard');
  }

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <?php include "./modulos/links.php"; ?>
  <title>Delete | <?php echo NOMBRE; ?></title>
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
          if(isset($_GET['transformer'])) {
            echo '<a class="btn btn-outline-primaty py-2 text-primary back-btn nav-icon" href="inventory">';
          } else if(isset($_GET['operation'])) {
            echo '<a class="btn btn-outline-primaty py-2 text-primary back-btn nav-icon" href="history">';
          } else if(isset($_GET['account'])) {
            echo '<a class="btn btn-outline-primaty py-2 text-primary back-btn nav-icon" href="configurations">';
          } else if(isset($_GET['location'])) {
            echo '<a class="btn btn-outline-primaty py-2 text-primary back-btn nav-icon" href="locations">';
          }
        ?>
        <i class="bx bx-arrow-back text-primary"></i> Return
      </a>
    </div>

  <div class="container-fluid mt-0 flex-grow-1 container-p-y mt-3">
    <h4 class="fw-bold mb-0">Delete <?php if(isset($_GET['transformer'])) {echo "Transformer";} else if(isset($_GET['operation'])) {echo "Operation";} else if(isset($_GET['account'])) {echo "Account";} else if(isset($_GET['location'])) {echo "Location";} ?></h4>
  </div>

    <?php
    if(isset($_GET['transformer'])) {

      $delete = strClean($_GET['transformer']);
      $sql = connect()->prepare("SELECT * FROM transformadores WHERE T_Codigo = '$delete'");

    } else if(isset($_GET['operation'])) {

      $delete = strClean($_GET['operation']);
      $sql = connect()->prepare("SELECT * FROM operaciones WHERE O_Codigo = '$delete'");

    } else if(isset($_GET['location'])) {

      $delete = strClean($_GET['location']);
      $sql = connect()->prepare("SELECT * FROM municipios WHERE M_Codigo = '$delete'");

    } else if(isset($_GET['account'])) {

      $delete = strClean($_GET['account']);
      $sql = connect()->prepare("SELECT * FROM usuarios WHERE userCodigo = '$delete'");
    }

    if(!isset($delete)) {
      header('Location: http://localhost/transformers-under-control/dashboard');
    }

    $sql->execute();
    $data = $sql->fetch(PDO::FETCH_OBJ);

    ?>

  <div class="container-fluid p-2">

    <div class="col-lg-11 mx-auto mt-4 card">
      <div class="card-body">
        <div class="card-title">
        <?php
          if(isset($_GET['transformer'])) {
            echo'<h4>Transformer Info</h4>
              </div>
              <ul class="list-group col-9 mx-auto mt-3">
                <li class="list-group-item"><strong>Serial Number:  </strong> ' . $data->T_Codigo . '</li>
                <li class="list-group-item"><strong>Brand:  </strong> ' . $data->T_Marca . '</li>
                <li class="list-group-item"><strong>Model:  </strong> ' . $data->T_Modelo . '</li>
                <li class="list-group-item"><strong>Capacity:  </strong> ' . $data->T_Capacidad . '</li>
                <li class="list-group-item"><strong>Type:  </strong> ' . $data->T_Tipo . '</li>
                <li class="list-group-item"><strong>Transformer Bank:  </strong> ' . $data->T_Banco . '</li>
                <li class="list-group-item"><strong>Municipality:  </strong> ' . $data->T_Municipio . '</li>
                <li class="list-group-item"><strong>Parish:  </strong> ' . $data->T_Parroquia . '</li>
                <li class="list-group-item"><strong>Location:  </strong> ' . $data->T_Localidad . '</li>
                <li class="list-group-item"><strong>Address:  </strong> ' . $data->T_Direccion . '</li>
                <li class="list-group-item"><strong>Actual State:  </strong> ' . $data->T_Estado . '</li>
                <li class="list-group-item"><strong>Years of Warranty:  </strong> ' . $data->T_Garantia . '</li>
              </ul>

              <form action="' . SERVERURL . 'conexiones/inventario.php?deleteT" autocomplete="off" enctype="multipart/form-data" method="POST" data-form="delete" class="FormularioAjax p-3 d-flex flex-column align-items-center">
                <input type="hidden" name="delT" value="' . $data->T_Codigo . '">
                <div class="RespuestaAjax mt-3"></div>

                <button type="submit" class="btn btn-danger mx-auto">Delete</button>
              </form>
              ';
          } else if(isset($_GET['operation'])) {
            echo'<h4>Operation Info</h4>
              </div>
              <ul class="list-group col-9 mx-auto mt-3">
                <li class="list-group-item"><strong>Process:  </strong> ' . $data->O_Procedimiento . '</li>
                <li class="list-group-item"><strong>Date:  </strong> ' . $data->O_Fecha . '</li>
                <li class="list-group-item"><strong>Transformer Serial Number:  </strong> ' . $data->O_Equipo . '</li>
                <li class="list-group-item"><strong>Transformer Status:  </strong> ' . $data->O_EstadoActual . '</li>
                <li class="list-group-item"><strong>Municipality:  </strong> ' . $data->O_Municipio . '</li>
                <li class="list-group-item"><strong>Parish:  </strong> ' . $data->O_Parroquia . '</li>
                <li class="list-group-item"><strong>Location:  </strong> ' . $data->O_Localidad . '</li>
                <li class="list-group-item"><strong>Address:  </strong> ' . $data->O_Direccion . '</li>
              </ul>

              <form action="' . SERVERURL . 'conexiones/historial.php?deleteO" autocomplete="off" enctype="multipart/form-data" method="POST" data-form="delete" class="FormularioAjax p-3 d-flex flex-column align-items-center">
                <input type="hidden" name="delO" value="' . $data->O_Codigo . '">
                <div class="RespuestaAjax mt-3"></div>

                <button type="submit" class="btn btn-danger mx-auto">Delete</button>
              </form>
              ';
          } else if(isset($_GET['account'])) {
            echo'<h4>Account Info</h4>
              </div>
              <ul class="list-group col-9 mx-auto mt-3">
                <li class="list-group-item"><strong>Username:  </strong> ' . $data->userUsername . '</li>
                <li class="list-group-item"><strong>Account Type:  </strong> ' . $data->userType . '</li>
                <li class="list-group-item"><strong>Name:  </strong> ' . $data->userName . '</li>
                <li class="list-group-item"><strong>Last name:  </strong> ' . $data->userLastname . '</li>
                <li class="list-group-item"><strong>Position:  </strong> ' . $data->userCargo . '</li>
                <li class="list-group-item"><strong>Email:  </strong> ' . $data->userEmail . '</li>
              </ul>

              <form action="' . SERVERURL . 'conexiones/create.php?deleteC" autocomplete="off" enctype="multipart/form-data" method="POST" data-form="delete" class="FormularioAjax p-3 d-flex flex-column align-items-center">
                <input type="hidden" name="delC" value="' . $data->userCodigo . '">
                <div class="RespuestaAjax mt-3"></div>

                <button type="submit" class="btn btn-danger mx-auto">Delete</button>
              </form>
            ';
          } else if(isset($_GET['location'])) {
            $datUbic = $data->M_Ubicacion;

            $getMunicipio = connect()->prepare("SELECT * FROM municipios WHERE M_Nombre = '$datUbic'");
            $getMunicipio->execute();
            $total = $getMunicipio->fetch(PDO::FETCH_OBJ);

            echo'<h4>Location Info</h4>
              </div>
              <ul class="list-group col-9 mx-auto mt-3">
                <li class="list-group-item"><strong>Location:  </strong> ' . $data->M_Nombre . '</li>
                <li class="list-group-item"><strong>Municipality:  </strong> ' . $total->M_Ubicacion . '</li>
                <li class="list-group-item"><strong>Parish:  </strong> ' . $data->M_Ubicacion . '</li>
              </ul>

              <form action="' . SERVERURL . 'conexiones/ubicaciones.php?UDel" autocomplete="off" enctype="multipart/form-data" method="POST" data-form="delete" class="FormularioAjax p-3 d-flex flex-column align-items-center">
                <input type="hidden" name="delU" value="' . $data->M_Codigo . '">
                <div class="RespuestaAjax mt-3"></div>

                <button type="submit" class="btn btn-danger mx-auto">Delete</button>
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
