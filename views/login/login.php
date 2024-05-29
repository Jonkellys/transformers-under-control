<?php
  $page = "login";

  session_start(['name' => 'Sistema']);

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
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <?php include "./modulos/links.php"; ?>
  <title>Log in | <?php echo NOMBRE; ?></title>
</head>

<body class="d-flex flex-column align-items-start bg-body" style="width: 100vw;">

  <style media="screen">
    @media (max-width: 768px) {
      .main-img {
        width: 100% !important;
        height: 25% !important;

      }

      .main-box {
        flex-direction: column;
        margin-top: 4%;
      }

      .login-form {
        display: flex;
        flex-direction: column;
        align-items: center;
      }

      .col-8 {
        max-width: 100%;
      }
    }

    @media (min-width: 992px) {
      .main-img {
        width: 50% !important;
        height: auto !important;
      }

      .main-box {
        flex-direction: row;
      }

      .second-box {
        margin-top: 2rem !important;
        width: 50% !important;
      }

      .link {
        margin-left: 6rem
      }
    }
  </style>

<?php include "./modulos/header.php"; ?>

  <div class="d-flex mt-2 flex-row justify-content-between mb-0 ms-3">
    <a class="btn btn-outline-primaty py-2 text-primary ml-4 nav-icon" href="./">
      <i class="bx bx-arrow-back text-primary"></i> Return
    </a>
  </div>

    <div class="card mb-4 col-9 d-flex p-0 mx-auto mt-1 main-box">
      <img class="rounded-left main-img" src="<?php echo media; ?>img/image-login.jpg" alt="Login-img">
      <div class="d-flex flex-row justify-content-center align-items-center my-5 second-box">
        <div class="d-flex flex-column align-items-center justify-content-center w-100">
          <h2 class="mb-3 text-primary">Log in</h2>
          <form action="<?php echo SERVERURL; ?>conexiones/login.php" id="login-form" autocomplete="off" enctype="multipart/form-data" method="POST" data-form="save" class="FormularioAjax p-3 login-form w-100">
            <div class="form-group col-8 mx-auto">
              <label for="usuarioLog" class="form-label">Username</label>
              <input type="text" name="usuario" onkeypress="return letras(event)" id="usuarioLog" class="form-control input-default " placeholder="Enter your username" />
            </div>

            <div class="form-group mt-4 col-8 mx-auto">
              <label for="claveLog" class="form-label">Password</label>
              <input type="password" name="clave"  id="claveLog" class="form-control input-default" placeholder="Enter your password" />
            </div>
            <a href="recover" class="link mt-4 text-primary">Forgot your password?</a>

            <br>
            <div id="respuesta" class="RespuestaAjax mt-3"></div>
            <div class="d-flex flex-column align-items-center justify-content-center">
              <button class="btn btn-primary mx-auto mt-2" value="submit" name="submit" id="btn" type="submit">Log in</button>
            </div>

          </form>
        </div>
      </div>
    </div>
    
  <?php include "./modulos/scripts.php"; ?>
  <script src="<?php echo media; ?>js/ajax/login.js"></script>
</body>

</html>
