<?php
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
<html
  lang="en"
  class="light-style"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title><?php echo NOMBRE;?></title>

    <meta name="description" content="" />

    <?php include "./modulos/links.php"; ?>

  </head>

  <style media="screen">
    @media (max-width: 768px) {
      .home-img {
        width: 100% !important;
        height: 50% !important;
      }

      .home-box {
        flex-direction: column;
      }

    }

    @media (min-width: 992px) {
      .home-img {
        width: 85% !important;
        height: auto !important;
      }

      .home-box {
        flex-direction: row;
      }

      body {
        height: 100vh !important;
      }
    }
  </style>

  <body class="d-flex flex-column align-items-start" style="width: 100vw;">
    <?php include "./modulos/header.php"; ?>

    <div class="card col-9 p-0 d-flex mx-auto mt-5 home-box" >
      <img class="rounded-left home-img" src="<?php echo media; ?>img/image-home.png" alt="Bienvenido">
      <div class="d-flex flex-row justify-content-center align-items-center w-100 my-5">
        <div class="d-flex flex-column align-items-center justify-content-center mt-3">
          <h2 class="mb-3 text-dark">Bienvenido!</h2>
          <a href="login"  class="btn btn-primary btn-lg mb-2">
            <i class="menu-icon tf-icons bx bx-log-in text-white"></i>
            Iniciar Sesión
          </a>
        </div>
      </div>
    </div>


    <?php include "./modulos/scripts.php"; ?>

  </body>
</html>
