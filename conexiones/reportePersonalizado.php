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

        if($informe == "transformers") {

          if($EstadoCheck == "" && $CapacidadCheck == "" && $MarcaCheck == "" && $ModeloCheck == "" && $AnosCheck == "" && $TipoCheck == "" && $BancoCheck == "" && $UbicacionCheck == "") {
            echo "<script>new swal('¡Error!', 'You must choose an option', 'error');</script>";
            exit();
          } else {

            if($EstadoCheck == "") {
              $EstadoInput = "None";
            }

            if($CapacidadCheck == "") {
              $CapacidadInput = "None";
            }

            if($MarcaCheck == "") {
              $MarcaInput = "None";
            }

            if($ModeloCheck == "") {
              $ModeloInput = "None";
            }

            if($AnosCheck == "") {
              $AnosInput = "None";
            }

            if($TipoCheck == "") {
              $TipoInput = "None";
            }

            if($BancoCheck == "") {
              $BancoInput = "None";
            }


            if($MarcaInput == "") {
              $MarcaInput == "All";
            }

            if($ModeloInput == "") {
              $ModeloInput == "All";
            }

            if($AnosInput == "") {
              $AnosInput == "All";
            }

            if($HParroquiaAdd == "") {
              $HParroquiaAdd = "All";
            }

            if($HLocalidadAdd == "") {
              $HLocalidadAdd = "All";
            }

            if($HParroquiaAdd != "" && $UbicacionInput == "") {
              echo "<script>new swal('¡Error!', 'You must choose a Municipality', 'error');</script>";
              exit();
            }

            if($HLocalidadAdd != "" && $HParroquiaAdd == "") {
              echo "<script>new swal('¡Error!', 'You must choose a Parish', 'error');</script>";
              exit();
            }

            if($EstadoInput == "All" && $CapacidadInput == "All" && $MarcaInput == "All" && $ModeloInput == "All" && $AnosInput == "All" && $TipoInput == "All" && $BancoInput == "All" && $UbicacionInput == "All") {
              $tipoData = "All";
            } else {
              $tipoData = "Personalized";
            }

            echo '<script> window.open("http://localhost/transformers-under-control/newReporte?informe=' . $informe . '&tipoData=' . $tipoData . '&estado=' . $EstadoInput . '&capacidad=' . $CapacidadInput . '&marca=' . $MarcaInput . '&modelo=' . $ModeloInput . '&anos=' . $AnosInput . '&mun=' . $UbicacionInput . '&par=' . $HParroquiaAdd . '&loc=' . $HLocalidadAdd . '&tipo=' . $TipoInput . '&banco=' . $BancoInput . '", "_blank"); </script>';
          }

        } else if($informe == "operations") {

          if($ProcedimientoCheck == "" && $FechaCheck == "" && $SerialCheck == "" && $UbicacionCheck == "") {
            echo "<script>new swal('¡Error!', 'You must choose an option', 'error');</script>";
            exit();
          } else {

            if($ProcedimientoCheck == "") {
              $ProcedimientoInput = "None";
            }

            if($FechaCheck == "") {
              $fecha = "None";
            }

            if($SerialCheck == "") {
              $SerialInput = "None";
            }

            if($SerialInput == "") {
              $SerialInput == "All";
            }

            if($FechaCheck != "" && $FechaInicio == "") {
              echo "<script>new swal('¡Error!', 'You must choose a Begin date', 'error');</script>";
              exit();
            } else if($FechaCheck != "" && $FechaFin == "") {
              echo "<script>new swal('¡Error!', 'You must choose a End date', 'error');</script>";
              exit();
            }

            if($FechaCheck != "" && $fechaInicio == "" && $fechaFin == "") {
              $fecha = "All";
            }

            if($HParroquiaAdd != "" && $UbicacionInput == "") {
              echo "<script>new swal('¡Error!', 'You must choose a Municipality', 'error');</script>";
              exit();
            }

            if($HLocalidadAdd != "" && $HParroquiaAdd == "") {
              echo "<script>new swal('¡Error!', 'You must choose a Parish', 'error');</script>";
              exit();
            }

            if($HParroquiaAdd == "") {
              $HParroquiaAdd = "All";
            }

            if($HLocalidadAdd == "") {
              $HLocalidadAdd = "All";
            }

            if($ProcedimientoInput == "All" && $fecha == "All" && $SerialInput == "All" && $UbicacionInput == "All") {
              $tipoData = "All";
            } else {
              $tipoData = "Personalized";
            }

            echo '<script> window.open("http://localhost/transformers-under-control/newReporte?informe=' . $informe . '&tipoData=' . $tipoData . '&procedimiento=' . $ProcedimientoInput . '&fecha=' . $fecha . '&fechaInicio=' . $fechaInicio . '&fechaFin=' . $fechaFin . '&serial=' . $SerialInput . '&mun=' . $UbicacionInput . '&par=' . $HParroquiaAdd . '&loc=' . $HLocalidadAdd . '", "_blank"); </script>';
          }
        }

      } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
      }
    }
?>
