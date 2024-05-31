<?php

  require_once "./funciones.php";
  date_default_timezone_set("America/Caracas");

  if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $usuarioLogin = strClean($_POST['usuario']);
    $passwordLogin = strClean($_POST['clave']);
    $passwordHash = password_hash($passwordLogin, PASSWORD_DEFAULT);
    $claveLogin = password_verify($passwordLogin, $passwordHash);

    if($usuarioLogin == "" || $passwordLogin == "") {
      echo "<script>new swal('¡Error!', 'You must complete all fields', 'error');</script>";
      exit(); 
    }

    $iniciar = iniciarSesion($usuarioLogin);


    if($iniciar->rowCount()==1) {
      $row = $iniciar->fetch(PDO::FETCH_ASSOC);
        
      if($row['userUsername'] == $usuarioLogin && password_verify($passwordLogin, $row['userPassword'])) {
          echo "<script>new swal({
                  title: '¡Success!',
                  text: 'Loging in...',
                  icon: 'success',
                  showConfirmButton: false
                })</script>";
          

          session_start(['name' => 'Sistema']);

          $_SESSION['id'] = $row['id'];
          $_SESSION['codigo'] = $row['userCodigo'];
          $_SESSION['usuario'] = $row['userUsername'];
          $_SESSION['clave'] = $row['userPassword'];
          $_SESSION['tipo'] = $row['userType'];
          $_SESSION['nombre'] = $row['userName'];
          $_SESSION['apellido'] = $row['userLastname'];
          $_SESSION['correo'] = $row['userEmail'];
          $_SESSION['cargo'] = $row['userCargo'];
          $_SESSION['token'] = md5(uniqid(mt_rand(), true));
          $_SESSION["acceso"]= time(); 

          echo '<script> window.location.href = "http://localhost/transformers-under-control/dashboard"; </script>';
        
      } else {
          echo "<script>new swal('¡Error!', 'The password is incorrect', 'error');</script>";
          exit();
      }
        
  } else {
      echo "<script>new swal('¡Error!', 'The user doesn`t exists', 'error');</script>";
    exit();
  }
                    
}    

?>
