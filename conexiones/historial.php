<?php

require_once "./funciones.php";

if ($_SERVER["REQUEST_METHOD"] == "POST"){
  try {
    if(isset($_GET['HAdd'])) {
      $stmt = connect()->prepare("INSERT INTO operaciones(O_Codigo, O_Procedimiento, O_Fecha, O_Equipo, O_Municipio, O_Parroquia, O_Localidad, O_Direccion, O_EstadoActual)
            VALUES(:codigo, :procedimiento, :fecha, :equipo, :municipio, :parroquia, :localidad, :direccion, :estado)");

      $stmt->bindParam(':codigo', $codigo);
      $stmt->bindParam(':procedimiento', $procedimiento);
      $stmt->bindParam(':fecha', $fecha);
      $stmt->bindParam(':equipo', $equipo);
      $stmt->bindParam(':estado', $estado);
      $stmt->bindParam(':municipio', $municipio);
      $stmt->bindParam(':parroquia', $parroquia);
      $stmt->bindParam(':localidad', $localidad);
      $stmt->bindParam(':direccion', $direccion);

      $procedimiento = strClean($_POST["HProcAdd"]);
      $fecha = strClean($_POST["HFechaAdd"]);
      $equipo = strClean($_POST["HEquipoAdd"]);
      $dir = strClean($_POST["HDirT"]);

      if($procedimiento == "" || $fecha == "" || $equipo == "") {
        echo "<script>new swal('¡Error!', 'You must complete all fields', 'error');</script>";
        exit();
      }

      if($procedimiento == "Repair") {
        $estado = "Stock";
      } else if($procedimiento == "Installation") {
        $estado = "Installed";
      } else if($procedimiento == "Removal") {
        $estado = "Damaged";
      }

      $consulta = ejecutar_consulta_simple("SELECT T_Codigo FROM transformadores WHERE T_Codigo = '$equipo'");

      if($consulta->rowCount() <= 0) {
        echo "<script>new swal('¡Error!', 'The entered serial number is already in the system', 'error');</script>";
        exit();
      } else {

        $consulta2 = connect()->query("SELECT * FROM transformadores WHERE T_Codigo = '$equipo'");

        while ($rows1 = $consulta2->fetch()) {
          $codigoT = $rows1['T_Codigo'];
          $capacidadT = $rows1['T_Capacidad'];
          $municipioT = $rows1['T_Municipio'];
          $direccionT = $rows1['T_Direccion'];
          $tipoT = $rows1['T_Tipo'];
          $bancoT = $rows1['T_Banco'];
          $estadoT = $rows1['T_Estado'];
          $parroquiaT = $rows1['T_Parroquia'];
          $localidadT = $rows1['T_Localidad'];
          $marcaT = $rows1['T_Marca'];
          $modeloT = $rows1['T_Modelo'];
          $garantiaT = $rows1['T_Garantia'];
        };

        if($estadoT == $estado) {
          echo "<script>new swal('¡Error!', 'The transformer is already in `" . $estadoT . "` state<br> Choose other option', 'error');</script>";
          exit();
        }
        
        $TCentralDir = strClean($_POST["TCentralDir"]);
                
          if($TCentralDir == "") {
            $municipio = strClean($_POST["HMunicipioAdd"]);
            $parroquia = strClean($_POST["HParroquiaAdd"]);
            $localidad = strClean($_POST["HLocalidadAdd"]);
            $direccion = strClean($_POST["HDireccionAdd"]);
          
            if($dir == "" && $municipio == "") {
              echo "<script>new swal('¡Error!', 'You must choose a Municipality', 'error');</script>";
              exit();
            }

            if($municipio != "" && $parroquia == "") {
              echo "<script>new swal('¡Error!', 'You must choose a Parish', 'error');</script>";
              exit();
            }

            if($parroquia != "" && $localidad == "") {
              echo "<script>new swal('¡Error!', 'You must choose a Location', 'error');</script>";
              exit();
            }

            if($localidad != "" && $direccion == "") {
              echo "<script>new swal('¡Error!', 'You must choose an Address', 'error');</script>";
              exit();
            }
          } else {
            $direccion = "Calle La Planta";
            $parroquia = "Santa Catalina";
            $localidad = "Sector El Valle";
            $municipio = "Service Central";
          }
        

        if($estadoT == "Stock" && $procedimiento == "Removal") {
          echo "<script>new swal('¡Error!', 'The `Stocked` transformers can`t be `Removed`', 'error');</script>";
          exit();
        }

        if($estadoT == "Damaged" && $procedimiento == "Installation") {
          echo "<script>new swal('¡Error!', 'The `Damaged` transformers can`t be `Installed`', 'error');</script>";
          exit();
        }

        if($municipio == "Service Central" && $procedimiento == "Installation") {
          echo "<script>new swal('¡Error!', 'You can`t Install on `Service Central`, choose a location', 'error');</script>";
          exit();
        }

        if($procedimiento == "Removal" || $procedimiento == "Repair") {
	       $thing = "UPDATE transformadores SET T_Codigo = '$codigoT', T_Estado = '$estado', T_Capacidad = '$capacidadT', T_Municipio = 'Central de Servicios', T_Direccion = 'Calle La Planta', T_Tipo = '$tipoT', T_Banco = '$bancoT', T_Parroquia = 'Santa Catalina', T_Localidad = 'Sector El Valle', T_Marca = '$marcaT', T_Modelo = '$modeloT', T_Garantia = '$garantiaT' WHERE T_Codigo = '$equipo'";
        } else if($procedimiento != "Removal") {
          $thing = "UPDATE transformadores SET T_Codigo = '$codigoT', T_Estado = '$estado', T_Capacidad = '$capacidadT', T_Municipio = '$municipio', T_Direccion = '$direccion', T_Tipo = '$tipoT', T_Banco = '$bancoT', T_Parroquia = '$parroquia', T_Localidad = '$localidad', T_Marca = '$marcaT', T_Modelo = '$modeloT', T_Garantia = '$garantiaT' WHERE T_Codigo = '$equipo'";
        }

	     $query = connect()->prepare($thing);

       $consulta4= ejecutar_consulta_simple("SELECT id FROM operaciones");
       $numero = ($consulta4->rowCount())+1;
       $codigo = generar_codigo_aleatorio("H", 7, $numero);

       if($stmt->execute()){
         $query->execute();
         echo "<script>new swal('¡Success!', 'Proccess Added correctly', 'success');</script>";
         echo '<script> location.reload(); </script>';
       } 

      }

    } else if(isset($_GET['updateO'])) {
      $quer = connect()->prepare("UPDATE operaciones SET O_Codigo = :codigo, O_Procedimiento = :procedimiento, O_Fecha = :fecha, O_Equipo = :equipo, O_Municipio = :municipio, O_EstadoActual = :estado, O_Parroquia = :parroquia, O_Localidad = :localidad, O_Direccion = :direccion WHERE O_Codigo = :codigo");

      $quer->bindParam(":codigo", $codigo);
      $quer->bindParam(":procedimiento", $procedimiento);
      $quer->bindParam(":fecha", $fecha);
      $quer->bindParam(":equipo", $equipo);
      $quer->bindParam(":municipio", $municipio);
      $quer->bindParam(":estado", $estado);
      $quer->bindParam(":parroquia", $parroquia);
      $quer->bindParam(":localidad", $localidad);
      $quer->bindParam(":direccion", $direccion);

      $codigo = strClean($_POST["HCodigoUpdate"]);
      $procedimiento = strClean($_POST["HProcUpdate"]);
      $fecha = strClean($_POST["HFechaUpdate"]);
      $equipo = strClean($_POST["HEquipoUpdate"]);


      if($procedimiento == "" || $fecha == "" || $equipo == "") {
        echo "<script>new swal('¡Error!', 'You must complete all fields', 'error');</script>";
        exit();
      }

      if($procedimiento != "Removal") {
        $municipio = strClean($_POST["HMunicipioAdd"]);
        $parroquia = strClean($_POST["HParroquiaAdd"]);
        $localidad = strClean($_POST["HLocalidadAdd"]);
        $direccion = strClean($_POST["HDireccionUpdate"]);

        if($municipio == "" || $parroquia == "" || $localidad == "" || $direccion == "") {
          echo "<script>new swal('¡Error!', 'You must complete all fields', 'error');</script>";
          exit();
        }
      } else {
        $municipio = 'Service Central';
        $parroquia = 'Santa Catalina';
        $localidad = 'Sector El Valle';
        $direccion = 'Calle La Planta';
      }

      if($procedimiento == "Repair" && $estado != "Stock") {
        $estado = "Stock";
      } else if($procedimiento == "Installation") {
        $estado = "Installed";
      } else if($procedimiento == "Removal") {
        $estado = "Damaged";
      }

      $consulta1 = ejecutar_consulta_simple("SELECT T_Codigo FROM transformadores WHERE T_Codigo = '$equipo'");

      if($consulta1->rowCount() <= 0) {
        echo "<script>new swal('¡Error!', 'The entered serial number is not in the system', 'error');</script>";
        exit();
      } else {
        $consulta3 = connect()->query("SELECT * FROM transformadores WHERE T_Codigo = '$equipo'");

        while ($rows1 = $consulta3->fetch()) {
          $codigoT = $rows1['T_Codigo'];
          $capacidadT = $rows1['T_Capacidad'];
          $municipioT = $rows1['T_Municipio'];
          $direccionT = $rows1['T_Direccion'];
          $tipoT = $rows1['T_Tipo'];
          $bancoT = $rows1['T_Banco'];
          $estadoT = $rows1['T_Estado'];
          $parroquiaT = $rows1['T_Parroquia'];
          $localidadT = $rows1['T_Localidad'];
          $marcaT = $rows1['T_Marca'];
          $modeloT = $rows1['T_Modelo'];
          $garantiaT = $rows1['T_Garantia'];
        };

        $thing1 = "UPDATE transformadores SET T_Codigo = '$codigoT', T_Estado = '$estado', T_Capacidad = '$capacidadT', T_Municipio = '$municipio', T_Direccion = '$direccion', T_Tipo = '$tipoT', T_Banco = '$bancoT', T_Parroquia = '$parroquia', T_Localidad = '$localidad', T_Marca = '$marcaT', T_Modelo = '$modeloT', T_Garantia = '$garantiaT' WHERE T_Codigo = '$equipo'";

        $query1 = connect()->prepare($thing1);

        if($quer->execute()){
          $query1->execute();
          echo "<script>new swal('¡Success!', 'Operation updated correctly', 'success');</script>";
          echo '<script> window.location.href = "http://localhost/transformers-under-control/historial"; </script>';
        }

      }

    } else if(isset($_GET['deleteO'])) {
      $codigo = strClean($_POST["delO"]);

      $query = "DELETE FROM operaciones WHERE O_Codigo = '$codigo'";

      if(connect()->query($query)) {
        echo "<script>new swal('¡Success!', 'Operation deleted correctly', 'success');</script>";
        echo '<script> window.location.href = "http://localhost/transformers-under-control/historial"; </script>';
      } 
    }
  }
  catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
  }
}

?>
