<?php

    require_once "./funciones.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST"){
      try {

        $informe = strClean($_POST['informe']);
        $EstadoCheck = strClean($_POST['EstadoCheck']);
        $EstadoInput = strClean($_POST['EstadoInput']);
        $CapacidadCheck = strClean($_POST['CapacidadCheck']);
        $CapacidadInput = strClean($_POST['CapacidadInput']);
        $MarcaCheck = strClean($_POST['MarcaCheck']);
        $MarcaInput = strClean($_POST['MarcaInput']);
        $ModeloCheck = strClean($_POST['ModeloCheck']);
        $ModeloInput = strClean($_POST['ModeloInput']);
        $AnosCheck = strClean($_POST['AnosCheck']);
        $AnosInput = strClean($_POST['AnosInput']);
        $TipoCheck = strClean($_POST['TipoCheck']);
        $TipoInput = strClean($_POST['TipoInput']);
        $BancoCheck = strClean($_POST['BancoCheck']);
        $BancoInput = strClean($_POST['BancoInput']);

        $ProcedimientoCheck = strClean($_POST['ProcedimientoCheck']);
        $ProcedimientoInput = strClean($_POST['ProcedimientoInput']);
        $FechaCheck = strClean($_POST['FechaCheck']);
        $FechaInicio = strClean($_POST['FechaInicio']);
        $FechaFin = strClean($_POST['FechaFin']);
        $SerialCheck = strClean($_POST['SerialCheck']);
        $SerialInput = strClean($_POST['SerialInput']);

        $UbicacionCheck = strClean($_POST['UbicacionCheck']);
        $UbicacionInput = strClean($_POST['UbicacionInput']);
        $HParroquiaAdd = strClean($_POST['HParroquiaAdd']);
        $HLocalidadAdd = strClean($_POST['HLocalidadAdd']);

        if($informe == "transformadores") {

          if($EstadoCheck == "" && $CapacidadCheck == "" && $MarcaCheck == "" && $ModeloCheck == "" && $AnosCheck == "" && $TipoCheck == "" && $BancoCheck == "" && $UbicacionCheck == "") {
            echo "<script>new swal('¡Error!', 'Debes seleccionar una opción', 'error');</script>";
            exit();
          }

          if($EstadoCheck == "") {
            $EstadoInput = "Ninguno";
          }

          if($CapacidadCheck == "") {
            $CapacidadInput = "Ninguno";
          }

          if($MarcaCheck == "") {
            $MarcaInput = "Ninguno";
          }

          if($ModeloCheck == "") {
            $ModeloInput = "Ninguno";
          }

          if($AnosCheck == "") {
            $AnosInput = "Ninguno";
          }

          if($TipoCheck == "") {
            $TipoInput = "Ninguno";
          }

          if($BancoCheck == "") {
            $BancoInput = "Ninguno";
          }


          if($MarcaInput == "") {
            $MarcaInput == "Todos";
          }

          if($ModeloInput == "") {
            $ModeloInput == "Todos";
          }

          if($AnosInput == "") {
            $AnosInput == "Todos";
          }

          if($HParroquiaAdd == "") {
            $HParroquiaAdd = "Todos";
          }

          if($HLocalidadAdd == "") {
            $HLocalidadAdd = "Todos";
          }

          if($HParroquiaAdd != "" && $UbicacionInput == "") {
            echo "<script>new swal('¡Error!', 'Debes elegir un Municipio', 'error');</script>";
            exit();
          }

          if($HLocalidadAdd != "" && $HParroquiaAdd == "") {
            echo "<script>new swal('¡Error!', 'Debes elegir una Parroquia', 'error');</script>";
            exit();
          }

          if($EstadoInput == "Todos" && $CapacidadInput == "Todos" && $MarcaInput == "Todos" && $ModeloInput == "Todos" && $AnosInput == "Todos" && $TipoInput == "Todos" && $BancoInput == "Todos" && $UbicacionInput == "Todos") {
            $tipoData = "Todos";
          } else {
            $tipoData = "Personalizado";
          }

          echo '<script> window.open("http://localhost/sistema-transformadores/newReporte?informe=' . $informe . '&tipoData=' . $tipoData . '&estado=' . $EstadoInput . '&capacidad=' . $CapacidadInput . '&marca=' . $MarcaInput . '&modelo=' . $ModeloInput . '&anos=' . $AnosInput . '&mun=' . $UbicacionInput . '&par=' . $HParroquiaAdd . '&loc=' . $HLocalidadAdd . '&tipo=' . $TipoInput . '&banco=' . $BancoInput . '", "_blank"); </script>';

        } else if($informe == "operaciones") {

          if($ProcedimientoCheck == "" && $FechaCheck == "" && $SerialCheck == "" && $UbicacionCheck == "") {
            echo "<script>new swal('¡Error!', 'Debes seleccionar una opción', 'error');</script>";
            exit();
          }

          if($ProcedimientoCheck == "") {
            $ProcedimientoInput = "Ninguno";
          }

          if($FechaCheck == "") {
            $fecha = "Ninguno";
          }

          if($SerialCheck == "") {
            $SerialInput = "Ninguno";
          }

          if($SerialInput == "") {
            $SerialInput == "Todos";
          }

          if($FechaCheck != "" && $FechaInicio == "") {
            echo "<script>new swal('¡Error!', 'Debes seleccionar una Fecha de Inicio', 'error');</script>";
            exit();
          } else if($FechaCheck != "" && $FechaFin == "") {
            echo "<script>new swal('¡Error!', 'Debes seleccionar una Fecha de Fin', 'error');</script>";
            exit();
          }

          if($FechaCheck != "" && $fechaInicio == "" && $fechaFin == "") {
            $fecha = "Todos";
          }

          if($HParroquiaAdd != "" && $UbicacionInput == "") {
            echo "<script>new swal('¡Error!', 'Debes elegir un Municipio', 'error');</script>";
            exit();
          }

          if($HLocalidadAdd != "" && $HParroquiaAdd == "") {
            echo "<script>new swal('¡Error!', 'Debes elegir una Parroquia', 'error');</script>";
            exit();
          }

          if($HParroquiaAdd == "") {
            $HParroquiaAdd = "Todos";
          }

          if($HLocalidadAdd == "") {
            $HLocalidadAdd = "Todos";
          }

          if($ProcedimientoInput == "Todos" && $fecha == "Todos" && $SerialInput == "Todos" && $UbicacionInput == "Todos") {
            $tipoData = "Todos";
          } else {
            $tipoData = "Personalizado";
          }

          echo '<script> window.open("http://localhost/sistema-transformadores/newReporte?informe=' . $informe . '&tipoData=' . $tipoData . '&procedimiento=' . $ProcedimientoInput . '&fecha=' . $fecha . '&fechaInicio=' . $fechaInicio . '&fechaFin=' . $fechaFin . '&serial=' . $SerialInput . '&mun=' . $UbicacionInput . '&par=' . $HParroquiaAdd . '&loc=' . $HLocalidadAdd . '", "_blank"); </script>';

        }

      } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
      }
    }
?>
