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
    
  session_destroy();

  echo '<script> window.location.href = "http://localhost/sistema-transformadores/login"; </script>';
