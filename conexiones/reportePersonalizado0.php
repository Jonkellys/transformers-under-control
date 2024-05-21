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

    }

    require_once "./funciones.php";


    $informe = strClean($_POST['informe']);
    $titulo = strClean($_POST['titulo']);
    $estado = strClean($_POST['estado']);
    $capacidad = strClean($_POST['capacidad']);
    $marca = strClean($_POST['marca']);
    $modelo = strClean($_POST['modelo']);
    $anos = strClean($_POST['anos']);
    $mun = strClean($_POST['mun']);
    $par = strClean($_POST['par']);
    $loc = strClean($_POST['loc']);
    $tipo = strClean($_POST['tipo']);
    $banco = strClean($_POST['banco']);

    $procedimiento = strClean($_POST['proc']);
    $fechaT = strClean($_POST['fechaT']);
    $inicio = strClean($_POST['inicio']);
    $fin = strClean($_POST['fin']);
    $serial = strClean($_POST['serial']);

    $pdf = new FPDF("L", "mm", "Legal");
    $pdf->AddPage();
    $pdf->SetTitle(mb_convert_encoding($titulo, 'ISO-8859-1', 'UTF-8'));
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
    $pdf->Cell(0, 10, $titulo, 0, 0, 'C');
    $pdf->Ln(20);

    if($titulo == "Reporte de Transformadores") {
      if($informe == "Todos") {

        $pdf->SetFont('Arial', 'B', 9);

        $num = 1;

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
        $pdf->Cell(32, 9, 'Municipio', 1, 0, 'C');
        $pdf->Cell(32, 9, 'Parroquia', 1, 0, 'C');
        $pdf->Cell(32, 9, 'Localidad', 1, 0, 'C');
        $pdf->Cell(32, 9, mb_convert_encoding('Dirección', 'ISO-8859-1', 'UTF-8'), 1, 0, 'C');
        $pdf->Cell(20, 9, 'Tipo', 1, 0, 'C');
        $pdf->MultiCell(25, 4.5, 'Banco Transformador', 1, 'C');

        $munTrans = connect()->query("SELECT * FROM transformadores");
        $pdf->SetFont('Arial', '', 9);

        if($munTrans->rowCount() <= 0) {
          $pdf->Cell(335.5, 9, 'Ninguno', 1, 1, 'C');
        } else {

          while ($row = $munTrans->fetch()) {
            $new_y = $pdf->GetY();
            $pdf->MultiCell(32, 9, mb_convert_encoding($row['T_Direccion'], 'ISO-8859-1', 'UTF-8'), 0, 'C');
            $pdf->SetTextColor(255);
            $r_y = $pdf->GetY();
            $pdf->setAutoPageBreak(true, 2);

            $div = intval(($end_y - $new_y ));
            $resta = intval($div / 9);

            $current_x = $pdf->GetX();
            $pdf->SetXY($current_x, $new_y);
            $pdf->MultiCell(10, $div, iconv('UTF-8', 'ISO-8859-1', $num++), 1, 'C');
            $end_y = ($pdf->GetY() > $end_y)?$pdf->GetY() : $end_y;

            $current_x = $current_x + 10;
            $pdf->SetXY($current_x, $new_y);
            $pdf->MultiCell(30, $div, mb_convert_encoding($row['T_Codigo'], 'ISO-8859-1', 'UTF-8'), 1, 'C');
            $end_y = ($pdf->GetY() > $end_y)?$pdf->GetY() : $end_y;

            $current_x = $current_x + 30;
            $pdf->SetXY($current_x, $new_y);
            $pdf->MultiCell(20, $div, mb_convert_encoding($row['T_Estado'], 'ISO-8859-1', 'UTF-8'), 1, 'C');
            $end_y = ($pdf->GetY() > $end_y)?$pdf->GetY() : $end_y;

            $current_x = $current_x + 20;
            $pdf->SetXY($current_x, $new_y);
            $pdf->MultiCell(23, $div, $row['T_Capacidad'] . " kW", 1, 'C');
            $end_y = ($pdf->GetY() > $end_y)?$pdf->GetY() : $end_y;

            $current_x = $current_x + 23;
            $pdf->SetXY($current_x, $new_y);
            $pdf->MultiCell(31, $div, mb_convert_encoding($row['T_Marca'], 'ISO-8859-1', 'UTF-8'), 1, 'C');
            $end_y = ($pdf->GetY() > $end_y)?$pdf->GetY() : $end_y;

            $current_x = $current_x + 31;
            $pdf->SetXY($current_x, $new_y);
            $pdf->MultiCell(31, $div, mb_convert_encoding($row['T_Modelo'], 'ISO-8859-1', 'UTF-8'), 1, 'C');
            $end_y = ($pdf->GetY() > $end_y)?$pdf->GetY() : $end_y;

            $current_x = $current_x + 31;
            $pdf->SetXY($current_x, $new_y);
            $pdf->MultiCell(20, $div, $row['T_Garantia'], 1, 'C');
            $end_y = ($pdf->GetY() > $end_y)?$pdf->GetY() : $end_y;

            $current_x = $current_x + 20;
            $pdf->SetXY($current_x, $new_y);
            $pdf->MultiCell(32, 9, mb_convert_encoding($row['T_Municipio'], 'ISO-8859-1', 'UTF-8'), 'T, L, R', 'C');
            $end_y = ($pdf->GetY() > $end_y)?$pdf->GetY() : $end_y;

            $current_x = $current_x + 32;
            $pdf->SetXY($current_x, $new_y);
            $pdf->MultiCell(32, 9, mb_convert_encoding($row['T_Parroquia'], 'ISO-8859-1', 'UTF-8'), 'T, L, R', 'C');
            $end_y = ($pdf->GetY() > $end_y)?$pdf->GetY() : $end_y;

            $current_x = $current_x + 32;
            $pdf->SetXY($current_x, $new_y);
            $pdf->MultiCell(32, 9, mb_convert_encoding($row['T_Localidad'], 'ISO-8859-1', 'UTF-8'), 'T, L, R', 'C');
            $end_y = ($pdf->GetY() > $end_y)?$pdf->GetY() : $end_y;

            $current_x = $current_x + 32;
            $pdf->SetXY($current_x, $new_y);
            $pdf->MultiCell(32, 9, mb_convert_encoding($row['T_Direccion'], 'ISO-8859-1', 'UTF-8'), 'T, L, R', 'C');
            $end_y = ($pdf->GetY() > $end_y)?$pdf->GetY() : $end_y;

            $current_x = $current_x + 32;
            $pdf->SetXY($current_x, $new_y);
            $pdf->MultiCell(20, $div, mb_convert_encoding($row['T_Tipo'], 'ISO-8859-1', 'UTF-8'), 1, 'C');
            $end_y = ($pdf->GetY() > $end_y)?$pdf->GetY() : $end_y;

            $current_x = $current_x + 20;
            $pdf->SetXY($current_x, $new_y);
            $pdf->MultiCell(25, $div, mb_convert_encoding($row['T_Banco'], 'ISO-8859-1', 'UTF-8'), 1, 'C');
            $last_y = $pdf->GetY();

            if($last_y >= 185) {
              $pdf->AddPage();
              $pdf->SetY(10);
            } else {
              $end_y = ($pdf->GetY() > $end_y)?$pdf->SetY(0): $end_y;
            }

            $resta = intval($end_y - $new_y);
            // $div = intval($resta / 9);

          }
        }

      } else {
        $title = "";

        if($estado == "Todos") {
          $estadoQ = "";
        } else if($estado != "Todos" && $estado != "Ninguno") {
          $estadoQ = " AND T_Estado = '$estado'";
          $title = $title .  "Estado: " . $estado . ". ";
        }

        if($capacidad == "Todos") {
          $capacidadQ = "";
        } else if($capacidad != "Todos" && $capacidad != "Ninguno") {
          $capacidadQ = " AND T_Capacidad = '$capacidad'";
          $title = $title .  "Capacidad: " . $capacidad . " kW. ";
        }

        if($marca == "Todos") {
          $marcaQ = "";
        } else if($marca != "Todos" && $marca != "Ninguno") {
          $marcaQ = " AND T_Marca = '$marca'";
          $title = $title .  "Marca: " . $marca . ". ";
        }

        if($modelo == "Todos") {
          $modeloQ = "";
        } else if($modelo != "Todos" && $modelo != "Ninguno") {
          $modeloQ = " AND T_Modelo = '$modelo'";
          $title = $title . "Modelo: " . $modelo .  ".";
        }

        if($anos== "Todos") {
          $anosQ = "";
        } else if($anos!= "Todos" && $anos!= "Ninguno") {
          $anosQ = " AND T_Garantia = '$anos'";
          $title = $title . "Años de Garantía: " . $anos . ". ";
        }

        if($mun == "Todos") {
          $munQ = "";
        } else if($mun != "Todos" && $mun != "Ninguno") {
          $munQ = " AND T_Municipio = '$mun'";
          $title = $title . "Municipio: " . $mun . ". ";
        }

        if($par == "Todos") {
          $parQ = "";
        } else if($par != "Todos" && $par != "Ninguno") {
          $parQ = " AND T_Parroquia = '$par'";
          $title = $title . "Parroquia: " . $par . ". ";
        }

        if($loc == "Todos") {
          $locQ = "";
        } else if($loc != "Todos" && $loc != "Ninguno") {
          $locQ = " AND T_Localidad = '$loc'";
          $title = $title . "Localidad: " . $loc . ". ";
        }

        if($tipo == "Todos") {
          $tipoQ = "";
        } else if($tipo != "Todos" && $tipo != "Ninguno") {
          $tipoQ = " AND T_Tipo = '$tipo'";
          $title = $title . "Tipo: " . $tipoQ . ". ";
        }

        if($banco == "Todos") {
          $bancoQ = "";
        } else if($banco != "Todos" && $banco != "Ninguno") {
          $bancoQ = " AND T_Banco = '$banco'";
          $title = $title . "Banco Transformador: " . $banco . ". ";
        }

        $select1 = "SELECT * FROM transformadores WHERE id != 0" . $estadoQ . $capacidadQ . $marcaQ . $modeloQ . $anosQ . $munQ . $parQ . $locQ . $tipoQ . $bancoQ;

        $pdf = new FPDF("L", "mm", "Legal");
        $pdf->AddPage();
        $pdf->SetTitle(mb_convert_encoding($titulo, 'ISO-8859-1', 'UTF-8'));
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
        $pdf->Cell(0, 10, $titulo, 0, 0, 'C');
        $pdf->Ln(10);

        $pdf->MultiCell(0, 10, mb_convert_encoding($title, 'ISO-8859-1', 'UTF-8'), 0, 'C');
        $pdf->Ln(10);

        $pdf->SetFont('Arial', 'B', 9);

        $num = 1;

        $current_y = $pdf->GetY();

        $pdf->Cell(10, 9, '#', 1, 0, 'C');
        $pdf->Cell(30, 9, mb_convert_encoding('N° Serial', 'ISO-8859-1', 'UTF-8'), 1, 0, 'C');

        if($estado != "Ninguno") {
          $pdf->Cell(20, 9, 'Estado', 1, 0, 'C');
          // $pdf->Cell(23, 9, 'Capacidad', 1, 0, 'C');
          // $pdf->Cell(31, 9, 'Marca', 1, 0, 'C');
          // $pdf->Cell(31, 9, 'Modelo', 1, 0, 'C');
          // $current_x = $pdf->GetX();
          // $pdf->MultiCell(20, 4.5, mb_convert_encoding('Años de Garantía', 'ISO-8859-1', 'UTF-8'), 1, 'C');
          // $pdf->SetXY($current_x + 20, $current_y);
          // $pdf->Cell(42, 9, 'Parroquia', 1, 0, 'C');
          // $pdf->Cell(42, 9, 'Localidad', 1, 0, 'C');
          // $pdf->Cell(42, 9, mb_convert_encoding('Dirección', 'ISO-8859-1', 'UTF-8'), 1, 0, 'C');
          // $pdf->Cell(20, 9, 'Tipo', 1, 0, 'C');
          // $pdf->MultiCell(25, 4.5, 'Banco Transformador', 1, 'C');
        }

        if($capacidad != "Ninguno") {
          $pdf->Cell(23, 9, 'Capacidad', 1, 0, 'C');
        }

        if($marca != "Ninguno") {
          $pdf->Cell(31, 9, 'Marca', 1, 0, 'C');
        }

        if($modelo != "Ninguno") {
          $pdf->Cell(31, 9, 'Modelo', 1, 0, 'C');
        }

        if($anos != "Ninguno") {
          $current_x = $pdf->GetX();
          $pdf->MultiCell(20, 4.5, mb_convert_encoding('Años de Garantía', 'ISO-8859-1', 'UTF-8'), 1, 'C');
          $pdf->SetXY($current_x + 20, $current_y);
        }

        $pdf->Cell(32, 9, 'Municipio', 1, 0, 'C');

        if($parroquia != "Ninguno") {
          $pdf->Cell(32, 9, 'Parroquia', 1, 0, 'C');
        }

        if($localidad != "Ninguno") {
          $pdf->Cell(32, 9, 'Localidad', 1, 0, 'C');
        }

        if($dir)
          $pdf->Cell(32, 9, mb_convert_encoding('Dirección', 'ISO-8859-1', 'UTF-8'), 1, 0, 'C');
          $pdf->Cell(20, 9, 'Tipo', 1, 0, 'C');
          $pdf->MultiCell(25, 4.5, 'Banco Transformador', 1, 'C');
        }

        $pdf->Output();
      }


    if($titulo == "Reporte de Operaciones") {

      if($informe == "Todos") {

        $pdf->SetFont('Arial', 'B', 9);
        $num1 = 1;
        $current_y = $pdf->GetY();

        $pdf->Cell(10, 9, '#', 1, 0, 'C');
        $pdf->Cell(30, 9, 'Procedimiento', 1, 0, 'C');
        $pdf->Cell(30, 9, 'Fecha', 1, 0, 'C');
        $pdf->Cell(33, 9, mb_convert_encoding('Serial del Equipo', 'ISO-8859-1', 'UTF-8'), 1, 0, 'C');
        $pdf->Cell(58, 9, 'Municipio', 1, 0, 'C');
        $pdf->Cell(58, 9, 'Parroquia', 1, 0, 'C');
        $pdf->Cell(58, 9, 'Localidad', 1, 0, 'C');
        $pdf->Cell(58, 9, mb_convert_encoding('Dirección', 'ISO-8859-1', 'UTF-8'), 1, 1, 'C');

        $munOp = connect()->query("SELECT * FROM operaciones");
        $pdf->SetFont('Arial', '', 9);

        if($munOp->rowCount() <= 0) {
          $pdf->Cell(335.5, 9, 'Ninguno', 1, 1, 'C');
        } else {

          while ($row = $munOp->fetch()) {
            $new_y = $pdf->GetY();
            $pdf->SetTextColor(255);
            $pdf->MultiCell(43, 9, mb_convert_encoding($row['O_Direccion'], 'ISO-8859-1', 'UTF-8'), 0, 'C');
            $pdf->SetTextColor(0);
            $pdf->setAutoPageBreak(true, 2);
            $r_y = $pdf->GetY();


            $div = intval(($r_y - $new_y ) / 9);

            $current_x = $pdf->GetX();
            $pdf->SetXY($current_x, $new_y);
            $pdf->MultiCell(10, 9 * $div, mb_convert_encoding($num1++, 'ISO-8859-1', 'UTF-8'), 1, 'C');
            $end_y = ($pdf->GetY() > $end_y)?$pdf->GetY() : $end_y;

            $current_x = $current_x + 10;
            $pdf->SetXY($current_x, $new_y);
            $pdf->MultiCell(30, 9 * $div, mb_convert_encoding($row['O_Procedimiento'], 'ISO-8859-1', 'UTF-8'), 1, 'C');
            $end_y = ($pdf->GetY() > $end_y)?$pdf->GetY() : $end_y;

            $current_x = $current_x + 30;
            $pdf->SetXY($current_x, $new_y);
            $pdf->MultiCell(30, 9 * $div, $row['O_Fecha'], 1, 'C');
            $end_y = ($pdf->GetY() > $end_y)?$pdf->GetY() : $end_y;

            $current_x = $current_x + 30;
            $pdf->SetXY($current_x, $new_y);
            $pdf->MultiCell(33, 9 * $div, mb_convert_encoding($row['O_Equipo'], 'ISO-8859-1', 'UTF-8'), 1, 'C');
            $end_y = ($pdf->GetY() > $end_y)?$pdf->GetY() : $end_y;

            $current_x = $current_x + 33;
            $pdf->SetXY($current_x, $new_y);
            $pdf->MultiCell(58, 9 * $div, mb_convert_encoding($row['O_Municipio'], 'ISO-8859-1', 'UTF-8'), 1, 'C');
            $end_y = ($pdf->GetY() > $end_y)?$pdf->GetY() : $end_y;

            $current_x = $current_x + 58;
            $pdf->SetXY($current_x, $new_y);
            $pdf->MultiCell(58, 9 * $div, mb_convert_encoding($row['O_Parroquia'], 'ISO-8859-1', 'UTF-8'), 1, 'C');
            $end_y = ($pdf->GetY() > $end_y)?$pdf->GetY() : $end_y;

            $current_x = $current_x + 58;
            $pdf->SetXY($current_x, $new_y);
            $pdf->MultiCell(58, 9 * $div, mb_convert_encoding($row['O_Localidad'], 'ISO-8859-1', 'UTF-8'), 1, 'C');
            $end_y = ($pdf->GetY() > $end_y)?$pdf->GetY() : $end_y;

            $current_x = $current_x + 58;
            $pdf->SetXY($current_x, $new_y);
            $pdf->MultiCell(58, 9 * $div, mb_convert_encoding($row['O_Direccion'], 'ISO-8859-1', 'UTF-8'), 1, 'C');
            $last_y = $pdf->GetY();

            if($last_y >= 185) {
              $pdf->AddPage();
              $pdf->SetY(10);
            } else {
              $end_y = ($pdf->GetY() > $end_y)?$pdf->SetY(0): $end_y;
            }

            $resta = intval($end_y - $new_y);
            $div = intval($resta / 9);

          }
        }

      }

    }

    $pdf->Output();
?>
