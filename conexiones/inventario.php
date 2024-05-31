<?php

require_once "./funciones.php";

if ($_SERVER["REQUEST_METHOD"] == "POST"){
  try {
    if(isset($_GET['addT'])) {
      $stmt = connect()->prepare("INSERT INTO transformadores(T_Codigo, T_Estado, T_Capacidad, T_Municipio, T_Direccion, T_Tipo, T_Banco, T_Parroquia, T_Localidad, T_Marca, T_Modelo, T_Garantia)
            VALUES(:codigo, :estado, :capacidad, :municipio, :direccion, :tipo, :banco, :parroquia, :localidad, :marca, :modelo, :garantia)");

      $stmt->bindParam(':codigo', $codigo);
      $stmt->bindParam(':estado', $estado);
      $stmt->bindParam(':capacidad', $capacidad);
      $stmt->bindParam(':municipio', $municipio);
      $stmt->bindParam(':direccion', $direccion);
      $stmt->bindParam(':tipo', $tipo);
      $stmt->bindParam(':banco', $banco);
      $stmt->bindParam(':parroquia', $parroquia);
      $stmt->bindParam(':localidad', $localidad);
      $stmt->bindParam(':marca', $marca);
      $stmt->bindParam(':modelo', $modelo);
      $stmt->bindParam(':garantia', $garantia);

      $codigo = strClean($_POST["TCodigoAdd"]);
      $estado = strClean($_POST["TEstadoAdd"]);
      $capacidad = strClean($_POST["TCapacidadAdd"]);
      $municipio = strClean($_POST["TMunicipioAdd"]);
      $direccion = strClean($_POST["TDireccionAdd"]);
      $tipo = strClean($_POST["TTipoAdd"]);
      $banco = strClean($_POST["TBancoAdd"]);
      $parroquia = strClean($_POST["HParroquiaAdd"]);
      $localidad = strClean($_POST["HLocalidadAdd"]);
      $marca = strClean($_POST["TMarcaAdd"]);
      $modelo = strClean($_POST["TModeloAdd"]);
      $garantia = strClean($_POST["TGarantiaAdd"]);

      $centralDir = strClean($_POST["TCentralDir"]);

      if($codigo == "" || $estado == "" || $capacidad == "" || $banco == "" || $tipo == "" || $marca == "" || $modelo == "" || $garantia == "") {
        echo "<script>new swal('¡Error!', 'You must complete all fields', 'error');</script>";
        exit();
      }

      if($centralDir == "") {
        if($centralDir == "" && $municipio == "") {
          echo "<script>new swal('¡Error!', 'You must add a Municipality', 'error');</script>";
          exit();
        }

        if($municipio != "" && $parroquia == "") {
          echo "<script>new swal('¡Error!', 'You must add a Parish', 'error');</script>";
          exit();
        }

        if($parroquia != "" && $localidad == "") {
          echo "<script>new swal('¡Error!', 'You must add a Location', 'error');</script>";
          exit();
        }

        if($localidad != "" && $direccion == "") {
          echo "<script>new swal('¡Error!', 'You must add an Address', 'error');</script>";
          exit();
        }

      } else if($centralDir != "") {
        $direccion = "Calle La Planta";
        $parroquia = "Santa Catalina";
        $localidad = "Sector El Valle";
        $municipio = "Service Central";
      }

      if($estado == "Stock" && $municipio != "Service Central") {
        echo "<script>new swal('¡Error!', 'The transformers `In Stock` can only be saved in `Service Central`', 'error');</script>";
        exit();
      }

      $consulta = ejecutar_consulta_simple("SELECT T_Codigo FROM transformadores WHERE T_Codigo = '$codigo'");

      if($consulta->rowCount()>=1) {
        echo "<script>new swal('¡Error!', 'The entered serial number is already in the system', 'error');</script>";
        exit();
      }

      if($stmt->execute()){
        echo "<script>new swal('¡Success!', 'Transformer Added Correctly', 'success');</script>";
        echo '<script> location.reload(); </script>';
      }

    } else if(isset($_GET['updateT'])) {

      $sql = connect()->prepare("UPDATE transformadores SET T_Codigo = :codigo, T_Estado = :estado, T_Capacidad = :capacidad, T_Municipio = :municipio, T_Direccion = :direccion, T_Tipo = :tipo, T_Banco = :banco, T_Parroquia = :parroquia, T_Localidad = :localidad, T_Marca = :marca, T_Modelo = :modelo, T_Garantia = :garantia WHERE T_Codigo = :codigo");

      $sql->bindParam(":codigo", $codigo);
      $sql->bindParam(":estado", $estado);
      $sql->bindParam(":capacidad", $capacidad);
      $sql->bindParam(":municipio", $municipio);
      $sql->bindParam(":direccion", $direccion);
      $sql->bindParam(":tipo", $tipo);
      $sql->bindParam(":banco", $banco);
      $sql->bindParam(":parroquia", $parroquia);
      $sql->bindParam(":localidad", $localidad);
      $sql->bindParam(":marca", $marca);
      $sql->bindParam(":modelo", $modelo);
      $sql->bindParam(":garantia", $garantia);

      $codigo = strClean($_POST["TCodigoUpdate"]);
      $estado = strClean($_POST["TEstadoUpdate"]);
      $capacidad = strClean($_POST["TCapacidadUpdate"]);
      $municipio = strClean($_POST["TMunicipioUpdate"]);
      $direccion = strClean($_POST["TDireccionUpdate"]);
      $tipo = strClean($_POST["TTipoUpdate"]);
      $banco = strClean($_POST["TBancoUpdate"]);
      $parroquia = strClean($_POST["HParroquiaAdd"]);
      $localidad = strClean($_POST["HLocalidadAdd"]);
      $marca = strClean($_POST["TMarcaUpdate"]);
      $modelo = strClean($_POST["TModeloUpdate"]);
      $garantia = strClean($_POST["TGarantiaUpdate"]);

      if($estado == "" || $capacidad == "" || $municipio == "" || $direccion == "" || $tipo == "" || $banco == "" || $parroquia == "" || $localidad == "" || $marca == "" || $modelo == "" || $garantia == "") {
        echo "<script>new swal('¡Error!', 'You must complete all fields', 'error');</script>";
        exit();
      }

      if($centralDir == "" && $municipio == "") {
        echo "<script>new swal('¡Error!', 'You must add a Municipality', 'error');</script>";
        exit();
      }

      if($municipio != "" && $parroquia == "") {
        echo "<script>new swal('¡Error!', 'You must add a Parish', 'error');</script>";
        exit();
      }

      if($parroquia != "" && $localidad == "") {
        echo "<script>new swal('¡Error!', 'You must add a Location', 'error');</script>";
        exit();
      }

      if($localidad != "" && $direccion == "") {
        echo "<script>new swal('¡Error!', 'You must add an Address', 'error');</script>";
        exit();
      }

      if($estado == "Stock" && $municipio != "Service Central") {
        echo "<script>new swal('¡Error!', 'The transformers `In Stock` can only be saved in `Service Central`', 'error');</script>";
        exit();
      }

      if($sql->execute()){
        echo "<script>new swal('¡Success!', 'Info Updated Correctly', 'success');</script>";
        echo '<script> window.location.href = "http://localhost/transformers-under-control/inventory"; </script>';
      }

    } else if(isset($_GET['deleteT'])) {
      $codigo = strClean($_POST["delT"]);

      $query = "DELETE FROM transformadores WHERE T_Codigo = '$codigo'";

      if(connect()->query($query)) {
        echo "<script>new swal('Success', 'Transformer Deleted Correctly', 'success');</script>";
        echo '<script> window.location.href = "http://localhost/transformers-under-control/inventory"; </script>';
      }
    }

  }
  catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
  }
}

?>
