<?php
  date_default_timezone_set("America/Caracas");
  include "./conexiones/funciones.php";

   session_start(['name' => 'Sistema']);
   
   $page = "configuraciones";

  if(!isset($_SESSION['token']) || !isset($_SESSION['usuario'])) {
    unset($_SESSION['id']);
    unset($_SESSION['codigo']);
    unset($_SESSION['usuario']);
    unset($_SESSION['clave']);
    unset($_SESSION['tipo']);
    unset($_SESSION['nombre']);
    unset($_SESSION['apellido']);
    unset($_SESSION['correo']);
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
  <title>Configurations | <?php echo NOMBRE; ?></title>
</head>

<body style="width: 100vw;">
  <?php
   include "./modulos/menu.php";
  ?>

  <style media="screen">
    @media (max-width: 768px) {
      .perfil-list {
        flex-direction: column;
      }

      .perfil-item {
        width: 100%;
      }
    }

    @media (min-width: 992px) {
      .perfil-list {
        flex-direction: row;
        flex-wrap: wrap;
      }

      .perfil-item {
        position: relative;
        width: 100%;
        min-height: 1px;
        padding-right: 15px;
        padding-left: 15px;
        flex: 0 0 33.33333%;
        max-width: 33.33333%;
      }
    }
  </style>

  <div class="container-fluid mt-0 flex-grow-1 container-p-y ml-5 2-50">
    <h4 class="fw-bold mb-0">Configurations</h4>
  </div>
  
  <?php
        $codigo = $_SESSION['codigo'];
        $sql = connect()->prepare("SELECT * FROM usuarios WHERE userCodigo = '$codigo'");
        $sql->execute();
        $data = $sql->fetch(PDO::FETCH_OBJ);
  ?>

  <div class="container-fluid p-4">
    <div class="card col-10 mx-auto p-4">
      <div>
        <h4>Profile</h4>
        <div class="ml-4 mt-3 d-flex perfil-list">
          <div class="form-group perfil-item">
            <label class="text-dark">Name</label>
            <input readonly="" type="text" class="form-control input-default" placeholder="<?php echo $data->userName; ?>" >
          </div>
          <div class="form-group perfil-item">
            <label class="text-dark">Last name</label>
            <input readonly="" type="text" class="form-control input-default" placeholder="<?php echo $data->userLastname; ?>" >
          </div>
          <div class="form-group perfil-item">
            <label class="text-dark">Email</label>
            <input readonly="" type="text" class="form-control input-default" placeholder="<?php echo $data->userEmail; ?>" >
          </div>
          <div class="form-group perfil-item">
            <label class="text-dark">Position</label>
            <input readonly="" type="text" class="form-control input-default" placeholder="<?php echo $data->userCargo; ?>" >
          </div>
          <div class="form-group perfil-item">
            <label class="text-dark">Username</label>
            <input readonly="" type="text" class="form-control input-default" placeholder="<?php echo $data->userUsername; ?>" >
          </div>
          <div class="form-group perfil-item">
            <label class="text-dark">User Type</label>
            <input readonly="" type="text" class="form-control input-default" placeholder="<?php echo $data->userType; ?>" >
          </div>
          <?php
            if($_SESSION['tipo'] == "Normal") {
              echo '
                <a class="text-primary" href="editar?cuenta=' . $_SESSION['codigo'] . '">Update Information</a>
              ';
            }
          ?>
        </div>
      </div>
    </div>
    <?php
        if($_SESSION['tipo'] == "Admin") {
        echo '

    <div class="card col-10 mx-auto p-4">
      <div class="">
        <h4>Accounts</h4>
        <div id="accordion-one" class="accordion">
          <div class="d-flex flex-row justify-content-space my-4">
            <button class="mb-0 btn btn-primary mx-1" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><i class="bx bx-plus-circle text-white"></i> Añadir Cuenta</button>
          </div>

          <div id="collapseOne" class="collapse mt-3 col-11 mx-auto" data-parent="#accordion-one">
            <div class="card-body m-0">
            <h4 class="mb-4 text-primary text-center">Personal Info</h4>
              <form action="' . SERVERURL . 'conexiones/create.php?CAdd" autocomplete="off" enctype="multipart/form-data" method="POST" data-form="save" class="FormularioAjax">
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="nombreAdd" class="form-label">Name</label>
                    <input type="text" autocapitalize="" name="nombre" onkeypress="return letras(event)" id="nombreAdd" class="form-control input-default " placeholder="Enter Name" />
                  </div>

                  <div class="form-group col-md-6">
                    <label for="apellidoAdd" class="form-label">Last name</label>
                    <input type="text" autocapitalize="" name="apellido" onkeypress="return letras(event)" id="apellidoAdd" class="form-control input-default" placeholder="Enter Last name" />
                  </div>
                </div>

                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="cargoAdd" class="form-label">Position</label>
                    <input type="text" name="cargo" id="cargoAdd" onkeypress="return letras(event)" class="form-control input-default" placeholder="Enter Position" />
                  </div>
                  <div class="form-group col-md-6">
                    <label for="correoAdd" class="form-label">Email</label>
                    <input type="text" name="correo" id="correoAdd" class="form-control input-default" placeholder="Enter Email" />
                  </div>
                </div>

                <br>
                <br>

                <h4 class="mb-4 text-primary text-center">Account Info</h4>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="usuarioAdd" class="form-label">Username</label>
                    <input type="text" name="usuario" id="usuarioAdd" class="form-control input-default" placeholder="Enter Username" />
                  </div>
                  <div class="form-group col-md-6">
                    <label for="tipoAdd" class="form-label">User Type</label>
                    <select name="tipo" id="tipoAdd" class="form-control input-default" >
                      <option disabled selected >Choose an option</option>
                      <option value="Normal">Normal</option>
                      <option value="Admin">Admin</option>
                    </select>
                  </div>

                </div>

                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="clave1Add" class="form-label">Password</label>
                    <input type="password" name="clave"  id="clave1Add" class="form-control input-default" placeholder="Enter Password" />
                  </div>

                  <div class="form-group col-md-6">
                    <label for="clave2Add" class="form-label">Repeat Password</label>
                    <input type="password" name="confirmar"  id="clave2Add" class="form-control input-default" placeholder="Enter Password Again" />
                  </div>
                </div>
                <br>
                <div id="respuesta" class="RespuestaAjax mt-3"></div>
                <div class="d-flex flex-column align-items-center justify-content-center">
                  <button class="btn btn-primary mx-auto" value="submit" name="submit" id="btn" type="submit">Create Account</button>
                </div>

              </form>
            </div>
          </div>
        </div>

        <div class="table-responsive">
          <table class="table table-striped table-hover" id="table">
            <thead>
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Last name</th>
                <th>Email</th>
                <th>Position</th>
                <th>Username</th>
                <th>User Type</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>';
                $result = connect()->query("SELECT * FROM usuarios");
                $num = 1;

                while ($rows = $result->fetch()) {
                  if($rows['userUsername'] == $_SESSION['usuario']) {
                    echo"<tr class='table-primary'>";
                  } else {
                    echo"<tr>";
                  };

                      echo "<th> <strong>" . $num++ . "</strong></th>
                        <td>" . $rows['userName'] . "</td>
                        <td>" . $rows['userLastname'] . "</td>
                        <td>" . $rows['userEmail'] . "</td>
                        <td>" . $rows['userCargo'] . "</td>
                        <td>" . $rows['userUsername'] . "</td>
                        <td>" . $rows['userType'] . "</td>
                        <td class='mt-0'>
                          <a class='btn btn-sm btn-info' href='editar?cuenta=" . $rows['userCodigo'] . "'>
                            <span class='tf-icons bx bx-edit text-white'></span>
                          </a>

                          <a class='btn btn-sm btn-danger' href='delete?cuenta=" . $rows['userCodigo'] . "'>
                            <span class='tf-icons bx bx-trash text-white'></span>
                          </a>


                        </td>
                  </tr>";
                };

            echo '</tbody>
          </table>
        </div>';
        }
        ?>
      </div>

    </div>
  </div>

  <?php include "./modulos/scripts.php"; ?>
  <script src="<?php echo media; ?>extras/datatables/config.js"></script>
  <script src="<?php echo media; ?>js/ajax/principal.js"></script>
  <script>
    function letras(e) {
        tecla = (document.all) ? e.keyCode : e.which;

        if (tecla == 8) {
          return true;
        }

        if (tecla == 32) {
          return true;
        }

        patron = /[A-Za-z]/;
        tecla_final = String.fromCharCode(tecla);
        return patron.test(tecla_final);
      }
  </script>
</body>

</html>
