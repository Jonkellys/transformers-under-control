<?php
  require_once "./funciones.php";
    
  $direccion = strClean($_GET['dir']);
  
  $len = strlen($direccion);
                
  for($i = 0; $i < $len; $i++) {
    if($direccion[$i] == " ") {
      $dir[] = "+";
    } else {
      $dir[] = $direccion[$i];
    }
  }
  
  $address = implode($dir);
                
  if($direccion == "CORPOELEC") {
    header('Location: https://www.google.com/maps/place/CORPOELEC/@10.5515199,-63.7200862,10z/data=!4m10!1m2!2m1!1sestado+sucre+Sector+El+Valle+Calle+La+Planta+CORPOELEC!3m6!1s0x8c33dd84668089f1:0x7129707f6e393783!8m2!3d10.663687!4d-63.2461799!15sCjZlc3RhZG8gc3VjcmUgU2VjdG9yIEVsIFZhbGxlIENhbGxlIExhIFBsYW50YSBDT1JQT0VMRUMiA4gBAZIBC2VsZWN0cmljaWFu4AEA!16s%2Fg%2F11rgll5jnv?entry=ttu');
  } else {
    header('Location: https://www.google.com/maps/search/?api=1&query=' . $address);
  }
  
?>
