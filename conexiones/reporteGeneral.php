<?php
    date_default_timezone_set("America/Caracas");

    session_start(['name' => 'Sistema']);

    if(!isset($_SESSION['token']) || !isset($_SESSION['usuario'])) {
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
        header('Location: http://localhost/sistema-transformadores/login');

    }  else if(!isset($_GET['tipo'])) {
        header('Location: http://localhost/sistema-transformadores/reportes');
    }
        require_once "./funciones.php";
        require "../assets/extras/fpdf/fpdf.php";

        if($_GET['tipo'] == "general") {
            $query = connect()->query("SELECT * FROM municipios WHERE M_Tipo = 'Municipio'");

            $pdf = new FPDF("L", "mm", "Legal");
            $pdf->AddPage();
            $pdf->SetTitle("Reporte de Transformadores");
            $pdf->Image("../assets/img/name.png", 10, 10, 65);
            $pdf->Image("../assets/img/rif.png", 300, 12, 35);
            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(0, 10, mb_convert_encoding('República Bolivariana de Venezuela', 'ISO-8859-1', 'UTF-8'), 0, 0, 'C');

            $pdf->Ln(6);
            $pdf->Cell(0, 10, 'Estado Sucre', 0, 0, 'C');
            $pdf->Ln(6);
            $pdf->Cell(0, 10, mb_convert_encoding('Corporación Nacional Eléctrica', 'ISO-8859-1', 'UTF-8'), 0, 0, 'C');
            $pdf->Ln(6);
            $pdf->Cell(0, 10, mb_convert_encoding('Central de Servicios Carúpano', 'ISO-8859-1', 'UTF-8'), 0, 0, 'C');
            $pdf->Ln(20);

            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(0, 10, 'Reporte General', 0, 0, 'C');
            $pdf->Ln(6);
            $pdf->Cell(0, 10, mb_convert_encoding('Transformadores instalados en la zona Carúpano-Paría', 'ISO-8859-1', 'UTF-8'), 0, 2, 'C');
            $pdf->Ln(10);

            while ($rows = $query->fetch()) {
                $mun = $rows['M_Nombre'];
                $pdf->AliasNbPages();

                if($pdf->PageNo() != 1) {
                    $pdf->Cell(0, 10, mb_convert_encoding('Página ' . $pdf->PageNo() . ' de {nb} - ' . munChoose($mun), 'ISO-8859-1', 'UTF-8'), 0, 2, 'C');
                    $pdf->Ln(5);
                }

                $pdf->SetFont('Arial', 'B', 10);
                $pdf->Cell(0, 9, mb_convert_encoding(munChoose($mun), 'ISO-8859-1', 'UTF-8'), 1, 1, 'C');
                $pdf->SetFont('Arial', '', 9);
                $pdf->Cell(0, 9, 'Transformadores Totales: ' . getMunCount(false, $mun), 1, 1, 'C');

                if(munChoose($mun) == "Central de Servicios") {
                  $pdf->Cell(112, 9, 'Transformadores Almacenados: ' . getMunCount('Almacenado', $mun), 1, 0, 'C');
                } else {
                  $pdf->Cell(112, 9, 'Transformadores Instalados: ' . getMunCount('Instalado', $mun), 1, 0, 'C');
                }

                $pdf->Cell(112, 9, mb_convert_encoding('Transformadores Dañados: ' . getMunCount('Dañado', $mun), 'ISO-8859-1', 'UTF-8'), 1, 0, 'C');
                $pdf->Cell(111.5, 9, 'Capacidad Instalada: ' . getMunCapacidad($mun), 1, 1, 'C');

                $pdf->SetFont('Arial', 'B', 9);
                $pdf->Cell(0, 9, mb_convert_encoding('Información de los transformadores', 'ISO-8859-1', 'UTF-8'), 1, 1, 'C');
                $pdf->SetFont('Arial', '', 9);

                $current_y = $pdf->GetY();

                $pdf->Cell(10, 9, '#', 1, 0, 'C');
                $pdf->Cell(30, 9, mb_convert_encoding('N° Serial', 'ISO-8859-1', 'UTF-8'), 1, 0, 'C');
                $pdf->Cell(20, 9, 'Estado', 1, 0, 'C');
                $pdf->Cell(23, 9, 'Capacidad', 1, 0, 'C');
                $pdf->Cell(31, 9, 'Marca', 1, 0, 'C');
                $pdf->Cell(31, 9, 'Modelo', 1, 0, 'C');
                $current_x = $pdf->GetX();
                $pdf->MultiCell(20, 4.5, mb_convert_encoding('Años de Garantía', 'ISO-8859-1', 'UTF-8'), 1, 'C');
                $pdf->SetXY($current_x + 20, $current_y);
                $pdf->Cell(42, 9, 'Parroquia', 1, 0, 'C');
                $pdf->Cell(42, 9, 'Localidad', 1, 0, 'C');
                $pdf->Cell(42, 9, mb_convert_encoding('Dirección', 'ISO-8859-1', 'UTF-8'), 1, 0, 'C');
                $pdf->Cell(20, 9, 'Tipo', 1, 0, 'C');
                $pdf->MultiCell(24.5, 4.5, 'Banco Transformador', 1, 'C');

                $num = 1;
                $munTrans = connect()->query("SELECT * FROM transformadores WHERE T_Municipio = '$mun'");

                if($munTrans->rowCount() <= 0) {
                    $pdf->Cell(335.5, 9, 'Ninguno', 1, 1, 'C');
                } else {

                    while ($row = $munTrans->fetch()) {
                        $new_y = $pdf->GetY();
                        $pdf->SetTextColor(255);
                        $pdf->MultiCell(43, 9, mb_convert_encoding($row['T_Direccion'], 'ISO-8859-1', 'UTF-8'), 0, 'C');
                        $pdf->SetTextColor(0);
                        $r_y = $pdf->GetY();

                        $div = intval(($r_y - $new_y ) / 9);
                        $current_x = $pdf->GetX();
                        $pdf->SetXY($current_x, $new_y);
                        $pdf->MultiCell(10, 9 * $div, iconv('UTF-8', 'ISO-8859-1', $num++), 1, 'C');
                        $end_y = ($pdf->GetY() > $end_y)?$pdf->GetY() : $end_y;

                        $current_x = $current_x + 10;
                        $pdf->SetXY($current_x, $new_y);
                        $pdf->MultiCell(30, 9 * $div, mb_convert_encoding($row['T_Codigo'], 'ISO-8859-1', 'UTF-8'), 1, 'C');
                        $end_y = ($pdf->GetY() > $end_y)?$pdf->GetY() : $end_y;

                        $current_x = $current_x + 30;
                        $pdf->SetXY($current_x, $new_y);
                        $pdf->MultiCell(20, 9 * $div, mb_convert_encoding($row['T_Estado'], 'ISO-8859-1', 'UTF-8'), 1, 'C');
                        $end_y = ($pdf->GetY() > $end_y)?$pdf->GetY() : $end_y;

                        $current_x = $current_x + 20;
                        $pdf->SetXY($current_x, $new_y);
                        $pdf->MultiCell(23, 9 * $div, $row['T_Capacidad'] . " kW", 1, 'C');
                        $end_y = ($pdf->GetY() > $end_y)?$pdf->GetY() : $end_y;

                        $current_x = $current_x + 23;
                        $pdf->SetXY($current_x, $new_y);
                        $pdf->MultiCell(31, 9 * $div, mb_convert_encoding($row['T_Marca'], 'ISO-8859-1', 'UTF-8'), 1, 'C');
                        $end_y = ($pdf->GetY() > $end_y)?$pdf->GetY() : $end_y;

                        $current_x = $current_x + 31;
                        $pdf->SetXY($current_x, $new_y);
                        $pdf->MultiCell(31, 9 * $div, mb_convert_encoding($row['T_Modelo'], 'ISO-8859-1', 'UTF-8'), 1, 'C');
                        $end_y = ($pdf->GetY() > $end_y)?$pdf->GetY() : $end_y;

                        $current_x = $current_x + 31;
                        $pdf->SetXY($current_x, $new_y);
                        $pdf->MultiCell(20, 9 * $div, $row['T_Garantia'], 1, 'C');
                        $end_y = ($pdf->GetY() > $end_y)?$pdf->GetY() : $end_y;

                        $current_x = $current_x + 20;
                        $pdf->SetXY($current_x, $new_y);
                        $pdf->MultiCell(42, 9, mb_convert_encoding($row['T_Parroquia'], 'ISO-8859-1', 'UTF-8'), 1, 'C');
                        $end_y = ($pdf->GetY() > $end_y)?$pdf->GetY() : $end_y;

                        $current_x = $current_x + 42;
                        $pdf->SetXY($current_x, $new_y);
                        $pdf->MultiCell(42, 9, mb_convert_encoding($row['T_Localidad'], 'ISO-8859-1', 'UTF-8'), 1, 'C');
                        $end_y = ($pdf->GetY() > $end_y)?$pdf->GetY() : $end_y;

                        $current_x = $current_x + 42;
                        $pdf->SetXY($current_x, $new_y);
                        $pdf->MultiCell(42, 9, mb_convert_encoding($row['T_Direccion'], 'ISO-8859-1', 'UTF-8'), 1, 'C');
                        $end_y = ($pdf->GetY() > $end_y)?$pdf->GetY() : $end_y;

                        $current_x = $current_x + 42;
                        $pdf->SetXY($current_x, $new_y);
                        $pdf->MultiCell(20, 9 * $div, mb_convert_encoding($row['T_Tipo'], 'ISO-8859-1', 'UTF-8'), 1, 'C');
                        $end_y = ($pdf->GetY() > $end_y)?$pdf->GetY() : $end_y;

                        $current_x = $current_x + 20;
                        $pdf->SetXY($current_x, $new_y);
                        $pdf->MultiCell(24.5, 9 * $div, mb_convert_encoding($row['T_Banco'], 'ISO-8859-1', 'UTF-8'), 1, 'C');
                        $end_y = ($pdf->GetY() > $end_y)?$pdf->GetY() : $end_y;

                        $resta = intval($end_y - $new_y);
                        $div = intval($resta / 9);
                    }
                }

                $pdf->SetFont('Arial', 'B', 9);
                $pdf->Cell(0, 9, 'Operaciones realizadas', 1, 1, 'C');
                $pdf->SetFont('Arial', '', 9);

                $munOp = connect()->query("SELECT * FROM operaciones WHERE O_Municipio = '$mun'");
                $num2 = 1;

                $pdf->Cell(10, 9, mb_convert_encoding('#', 'ISO-8859-1', 'UTF-8'), 1, 0, 'C');
                $pdf->Cell(33, 9, 'Procedimiento', 1, 0, 'C');
                $pdf->Cell(28, 9, 'Fecha', 1, 0, 'C');
                $pdf->Cell(43, 9, mb_convert_encoding('N° Serial del Transformador', 'ISO-8859-1', 'UTF-8'), 1, 0, 'C');
                $pdf->Cell(60, 9, 'Parroquia', 1, 0, 'C');
                $pdf->Cell(60, 9, 'Localidad', 1, 0, 'C');
                $pdf->Cell(60, 9, mb_convert_encoding('Dirección', 'ISO-8859-1', 'UTF-8'), 1, 0, 'C');
                $pdf->Cell(41.5, 9, 'Estado del Transformador', 1, 1, 'C');

                if($munOp->rowCount() <= 0) {
                    $pdf->Cell(335.5, 9, 'Ninguno', 1, 1, 'C');
                } else {

                    while ($rows = $munOp->fetch()) {
                        $pdf->Cell(10, 9, $num2++, 1, 0, 'C');
                        $pdf->Cell(33, 9, mb_convert_encoding($rows['O_Procedimiento'], 'ISO-8859-1', 'UTF-8'), 1, 0, 'C');
                        $pdf->Cell(28, 9, $rows['O_Fecha'], 1, 0, 'C');
                        $pdf->Cell(43, 9, mb_convert_encoding($rows['O_Equipo'], 'ISO-8859-1', 'UTF-8'), 1, 0, 'C');
                        $pdf->Cell(60, 9, mb_convert_encoding($rows['O_Parroquia'], 'ISO-8859-1', 'UTF-8'), 1, 0, 'C');
                        $pdf->Cell(60, 9, mb_convert_encoding($rows['O_Localidad'], 'ISO-8859-1', 'UTF-8'), 1, 0, 'C');
                        $pdf->Cell(60, 9, mb_convert_encoding($rows['O_Direccion'], 'ISO-8859-1', 'UTF-8'), 1, 0, 'C');
                        $pdf->Cell(41.5, 9, mb_convert_encoding($rows['O_EstadoActual'], 'ISO-8859-1', 'UTF-8'), 1, 1, 'C');
                    }
                }

                $pdf->AddPage();

            }

            $pdf->Output();

        } else if($_GET['tipo'] == "personalizado") {
            if ($_SERVER["REQUEST_METHOD"] == "POST"){
                try {

                    $EstadoInput = strClean($_POST["EstadoInput"]);
                    $CapacidadInput = strClean($_POST["CapacidadInput"]);
                    $MarcaInput = strClean($_POST["MarcaInput"]);
                    $ModeloInput = strClean($_POST["ModeloInput"]);
                    $AnosInput = strClean($_POST["AnosInput"]);
                    $HMunicipioAdd = strClean($_POST["HMunicipioAdd"]);
                    $HParroquiaAdd = strClean($_POST["HParroquiaAdd"]);
                    $HLocalidadAdd = strClean($_POST["HLocalidadAdd"]);
                    $TipoInput = strClean($_POST["TipoInput"]);
                    $BancoInput = strClean($_POST["BancoInput"]);
                    $transSubmit = strClean($_POST["transSubmit"]);

                    $ProcedimientoInput = strClean($_POST["ProcedimientoInput"]);
                    $fechaCheck = strClean($_POST["fechaCheck"]);
                    $FechaInicio = strClean($_POST["FechaInicio"]);
                    $FechaFin = strClean($_POST["FechaFin"]);
                    $SerialInput = strClean($_POST["SerialInput"]);
                    $opSubmit = strClean($_POST["opSubmit"]);

                    if($HLocalidadAdd == "") {
                        $localidad = "Todos";
                    } else {
                        $localidad = $HLocalidadAdd;
                    }

                    if($HMunicipioAdd == "") {
                        $municipio = "Todos";
                    } else {
                        $municipio = $HMunicipioAdd;
                    }

                    if($HParroquiaAdd == "") {
                        $parroquia = "Todos";
                    } else {
                        $parroquia = $HLocalidadAdd;
                    }

                    if($transSubmit == "transformadores") {
                        $titulo = "Reporte de Transformadores";
                        if($EstadoInput == "Todos" && $CapacidadInput == "Todos" && $MarcaInput == "Todos" && $ModeloInput == "Todos" && $AnosInput == "Todos" && $HMunicipioAdd == "Todos" && $parroquia == "Todos" && $localidad == "Todos" && $TipoInput == "Todos" && $BancoInput == "Todos") {
                            $informe = "Todos";
                        } else {
                          $informe = "No Todos";
                        }

                        echo '<script> window.open("http://localhost/sistema-transformadores/conexiones/reportePersonalizado.php?informe=' . $informe . '&titulo=' . $titulo . '&estado=' . $EstadoInput . '&capacidad=' . $CapacidadInput . '&marca=' . $MarcaInput . '&modelo=' . $ModeloInput . '&anos=' . $AnosInput . '&mun=' . $HMunicipioAdd . '&par=' . $parroquia . '&loc=' . $localidad . '&tipo=' . $TipoInput . '&banco=' . $BancoInput . '", "_blank"); </script>';

                    } else if($opSubmit == "operaciones") {
                        $titulo = "Reporte de Operaciones";
                        if ($ProcedimientoInput == "Todos" && $HMunicipioAdd == "Todos" && $parroquia == "Todos" && $localidad == "Todos" && $fechaCheck == "Todos" && $SerialInput == "Todos") {
                            $informe = "Todos";
                        } else {
                            $informe = "No Todos";
                        }

                        echo '<script> window.open("http://localhost/sistema-transformadores/conexiones/reportePersonalizado.php?informe=' . $informe . '&titulo=' . $titulo . '&proc=' . $ProcedimientoInput . '&fechaT=' . $fechaCheck . '&inicio=' . $FechaInicio . '&fin=' . $FechaFin . '&serial=' . $SerialInput . '&mun=' . $HMunicipioAdd . '&par=' . $parroquia . '&loc=' . $localidad . '", "_blank"); </script>';
                    }

                } catch(PDOException $e) {
                    echo "Error: " . $e->getMessage();
                }
            }


        }



?>
