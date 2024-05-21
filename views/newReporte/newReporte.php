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
  include "./conexiones/funciones.php";

  $informe = strClean($_GET['informe']);
  $tipoData = strClean($_GET['tipoData']);

  if(!isset($informe) || !isset($tipoData)) {
    header('Location: http://localhost/sistema-transformadores/reportes');
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <?php include "./modulos/links.php"; ?>
  <title>Nuevo Reporte | <?php echo NOMBRE; ?></title>
</head>

<style media="screen">
  #contenido {
    font-family: "Arial";
  }

  @media (max-width: 768px) {
    body {
      flex-direction: column;
    }

    .charList {
      width: 100%;
    }

    .sm-hidden {
      display: block;
    }

    #hideBtn {
      display: none;
    }
  }

  @media (min-width: 992px) {
    body {
      flex-direction: row;
    }

    .charList {
      width: 25%;
    }

    .sm-hidden {
      display: none;
    }
  }
</style>

<body style="width: 100vw; height: 100vh;" class="d-flex">

  <div class="bg-light shadow p-3 charList" style="overflow-y: scroll;" id="charBox">

    <form class=" ">
      <input type="button" onclick="printDiv('contenido')" value="Imprimir Reporte" id="valueBtn" class="btn btn-primary">
    </form>

    <p class="sm-hidden mt-3">Para mejor visualización coloque su teléfono de forma horizontal</p>

    <h4 class="mt-4">Características:</h4>
    <?php

      $estado = strClean($_GET['estado']);
      $capacidad = strClean($_GET['capacidad']);
      $marca = strClean($_GET['marca']);
      $modelo = strClean($_GET['modelo']);
      $anos = strClean($_GET['anos']);
      $tipo = strClean($_GET['tipo']);
      $banco = strClean($_GET['banco']);

      $procedimiento = strClean($_GET['procedimiento']);
      $fecha = strClean($_GET['fecha']);
      $fechaInicio = strClean($_GET['fechaInicio']);
      $fechaFin = strClean($_GET['fechaFin']);
      $serial = strClean($_GET['serial']);

      $mun = strClean($_GET['mun']);
      $par = strClean($_GET['par']);
      $loc = strClean($_GET['loc']);

    ?>

    <ul class="list-group mx-auto mt-3 border-white mb-4">
      <?php
        if($informe == "General") {
          echo '<span class="py-2"><strong>Reporte:  </strong> General</span>';
        } else {
          if ($informe == "transformadores") {
            echo '
              <span class="py-2 border-bottom-1"><strong>Reporte de:  </strong> Transformadores</span>
              <span class="py-2 border-bottom-1"><strong>Estado:  </strong> ' . $estado . '</span>
              <span class="py-2 border-bottom-1"><strong>Capacidad:  </strong> ';
              if ($capacidad == "Ninguno"){
                echo 'Ninguno';
              } else if($capacidad != "Todos" && $capacidad != "Ninguno") {
                echo $capacidad . ' kW' ;
              } else {
                echo 'Todas';
              }
              echo '</span>
              <span class="py-2 border-bottom-1"><strong>Marca:  </strong> ' . $marca . '</span>
              <span class="py-2 border-bottom-1"><strong>Modelo:  </strong> ' . $modelo . '</span>
              <span class="py-2 border-bottom-1"><strong>Años de Garantía:  </strong> ' . $anos . '</span>
              <span class="py-2 border-bottom-1"><strong>Tipo:  </strong> ' . $tipo . '</span>
              <span class="py-2"><strong>Banco Transformador:  </strong> ' . $banco . '</span>
            ';
          } elseif ($informe == "operaciones") {
            echo '
              <span class="py-2 border-bottom-1"><strong>Reporte de:  </strong> Operaciones</span>
              <span class="py-2 border-bottom-1"><strong>Procedimiento:  </strong> ' . $procedimiento . '</span>
            ';

            if($fecha == "Todos" || $fecha == "Ninguno") {
              echo '<span class="py-2 border-bottom-1"><strong>Fecha:  </strong> ' . $fecha . '</span>';
            } else {
              echo '<span class="py-2 border-bottom-1"><strong>Fecha de Inicio:  </strong> ' . $fechaInicio . '</span>';
              echo '<span class="py-2 border-bottom-1"><strong>Fecha de Fin:  </strong> ' . $fechaFin . '</span>';
            }

            echo '
              <span class="py-2 border-bottom-1"><strong>Serial del Transformador:  </strong> ' . $serial . '</span>
            ';
          }
          echo '
            <span class="py-2 border-bottom-1"><strong>Ubicación:  </strong> ';
            if($mun == "Todos") {
              echo "Todos";
            } else if($mun == "Ninguno") {
              echo "Ninguno";
            }else {
              echo munChoose($mun);
            }

          echo'</span>
            <span class="py-2 border-bottom-1"><strong>Parroquia:  </strong> ' . $par . '</span>
            <span class="py-2 border-bottom-1"><strong>Localidad:  </strong> ' . $loc . '</span>
          ';
        }
      ?>
    </ul>

  </div>

  <button id="hideBtn" class="btn btn-sm btn-light position-fixed" style="top: 50%; left: 17%;"><i class="bx bx-chevron-left"></i></button>

  <style>
    table * {
      border: 1px solid black !important;
      text-align: center !important;
    }
  </style>

  <div class="p-4 mr-3" style="overflow-x: scroll; width: max-content;">
    <div class="shadow bg-white p-4 d-flex flex-column align-items-center" id="contenido" style="width: 340mm; height: fit-content;">

    <div class="w-100 d-flex flex-row justify-content-between">
      <img style="width: 17%; height: 33%;" src="<?php echo media; ?>img/name.png" alt="logo">
      <p class="text-center px-5 mr-5">República Bolivariana de Venezuela <br> Estado Sucre <br> Corporación Nacional Eléctrica <br> Central de Servicios Carúpano</p>
      <p class="ml-5" style="font-size: 14px; font-weight: bold;">RIF: J-200100141</p>
    </div>

      <?php
        if($informe == "General") {
          $query = connect()->query("SELECT * FROM municipios WHERE M_Tipo = 'Municipio'");

          echo '<div class="text-center font-weight-bold my-3">Reporte General <br> Transformadores instalados en la zona Carúpano-Paría</div>';

          while ($rows = $query->fetch()) {
            $mun = $rows['M_Nombre'];
            $num = 1;

            echo '
              <div class="w-100 my-3 mx-auto" id="table">
                <table class="w-100">
                  <tr><th class="p-1">' . munChoose($mun) . '</th></tr>
                  <tr><td class="p-1">Transformadores Totales: ' . getMunCount(false, $mun) . '</td></tr>
                </table>
                <table class="w-100">
                  <tr>';

                    if(munChoose($mun) == "Central de Servicios") {
                      echo '<td class="p-1">Transformadores Almacenados: ' . getMunCount('Almacenado', $mun) . '</td>';
                    } else {
                      echo '<td class="p-1">Transformadores Instalados: ' . getMunCount('Instalado', $mun) . '</td>';
                    }
                    echo '
                    <td class="p-1">Transformadores Dañados: ' . getMunCount('Dañado', $mun) . '</td>
                    <td class="p-1">Capacidad Instalada: ' . getMunCapacidad($mun) . '</td>
                  </tr>
                </table>
                <table class="w-100">
                  <tr>
                    <th class="p-1">Información de los Transformadores</th>
                  </tr>
                </table>
                <table class="w-100">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Serial</th>
                      <th>Estado</th>
                      <th>Capacidad</th>
                      <th>Marca</th>
                      <th>Modelo</th>
                      <th>Años de<br>Garantía</th>
                      <th>Tipo</th>
                      <th>Banco<br>Transformador</th>
                      <th>Parroquia</th>
                      <th>Localidad</th>
                      <th>Dirección</th>
                    </tr>
                  </thead>
                  <tbody>

                  ';

                    $munTrans = connect()->query("SELECT * FROM transformadores WHERE T_Municipio = '$mun'");

                    if($munTrans->rowCount() <= 0) {
                      echo '</tbody></table><table class="w-100 p-1"><tr><td class="text-center">Ninguno</td></tr></table>';
                    } else {
                      while ($row = $munTrans->fetch()) {
                        echo '

                          <tr>
                            <td>' . $num++ . '</td>
                            <td>' . $row['T_Codigo'] . '</td>
                            <td>' . $row['T_Estado'] . '</td>
                            <td>' . $row['T_Capacidad'] . ' kW</td>
                            <td>' . $row['T_Marca'] . '</td>
                            <td>' . $row['T_Modelo'] . '</td>
                            <td>' . $row['T_Garantia'] . '</td>
                            <td>' . $row['T_Tipo'] . '</td>
                            <td>' . $row['T_Banco'] . '</td>
                            <td>' . $row['T_Parroquia'] . '</td>
                            <td>' . $row['T_Localidad'] . '</td>
                            <td>' . $row['T_Direccion'] . '</td>
                          </tr>
                        ';
                      }
                    }
                  echo '
                  </tbody>
                  </table>
                <table class="w-100">
                  <tr>
                    <th class="p-1">Operaciones Realizadas</th>
                  </tr>
                </table>
                ';

                $munOp = connect()->query("SELECT * FROM operaciones WHERE O_Municipio = '$mun'");
                $num2 = 1;

                if($munOp->rowCount() <= 0) {
                  echo '<table class="w-100 p-1 last"><tr><td class="text-center">Ninguno</td></tr></table>';
                } else {
                  echo '
                <table class="w-100 last">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Procedimiento</th>
                      <th>Fecha</th>
                      <th>Serial del Transformador</th>
                      <th>Estado Final</th>
                      <th>Parroquia</th>
                      <th>Localidad</th>
                      <th>Dirección</th>
                    </tr>
                  </thead>
                  <tbody>';
                      while ($fila = $munOp->fetch()) {
                        echo '
                          <tr>
                            <td>' . $num2++ . '</td>
                            <td>' . $fila['O_Procedimiento'] . '</td>
                            <td>' . $fila['O_Fecha'] . '</td>
                            <td>' . $fila['O_Equipo'] . '</td>
                            <td>' . $fila['O_EstadoActual'] . '</td>
                            <td>' . $fila['O_Parroquia'] . '</td>
                            <td>' . $fila['O_Localidad'] . '</td>
                            <td>' . $fila['O_Direccion'] . '</td>
                          </tr>
                        ';
                      }
                    }

                    echo '
                  </tbody>
                </table>
              </div>
            ';
          }
        } else {
          if ($informe == "transformadores") {
            echo '
              <div class="text-center font-weight-bold mt-3">Reporte de Transformadores</div>
            ';

            if($tipoData == "Todos") {
              $TTodosQuery = connect()->query("SELECT * FROM transformadores");
              $num = 1;

              echo '
                <div class="w-100 mt-3 mx-auto">
                  <table class="w-100">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Serial</th>
                        <th>Estado</th>
                        <th>Capacidad</th>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Años de<br>Garantía</th>
                        <th>Tipo</th>
                        <th>Banco<br>Transformador</th>
                        <th>Ubicación</th>
                        <th>Parroquia</th>
                        <th>Localidad</th>
                        <th>Dirección</th>
                      </tr>
                    </thead>
                    <tbody>
                  ';

                  if($TTodosQuery->rowCount() <= 0) {
                    echo '</tbody></table><table class="w-100 p-1"><tbody><tr><td class="text-center">Ninguno</td></tr>';
                  } else {
                    while ($filas = $TTodosQuery->fetch()) {
                      $municipio = $filas['T_Municipio'];
                      echo '
                        <tr>
                          <td>' . $num++ . '</td>
                          <td>' . $filas['T_Codigo'] . '</td>
                          <td>' . $filas['T_Estado'] . '</td>
                          <td>' . $filas['T_Capacidad'] . ' kW</td>
                          <td>' . $filas['T_Marca'] . '</td>
                          <td>' . $filas['T_Modelo'] . '</td>
                          <td>' . $filas['T_Garantia'] . '</td>
                          <td>' . $filas['T_Tipo'] . '</td>
                          <td>' . $filas['T_Banco'] . '</td>
                          <td>' . munChoose($municipio) . '</td>
                          <td>' . $filas['T_Parroquia'] . '</td>
                          <td>' . $filas['T_Localidad'] . '</td>
                          <td>' . $filas['T_Direccion'] . '</td>
                        </tr>
                      ';
                    }
                  }

                echo '
                </tbody>
                </table>
                </div>
              ';

            } else if($tipoData == "Personalizado") {

              $title = "";

              if($estado == "Todos") {
                $estadoQ = "";
              } else if($estado != "Todos" && $estado != "Ninguno") {
                $estadoQ = " AND T_Estado = '$estado'";
                $title = $title . "Estado: " . $estado . ". ";
              }

              if($capacidad == "Todos") {
                $capacidadQ = "";
              } else if($capacidad != "Todos" && $capacidad != "Ninguno") {
                $capacidadQ = " AND T_Capacidad = '$capacidad'";
                $title = $title . "Capacidad: " . $capacidad . " kW. ";
              }

              if($marca == "Todos") {
                $marcaQ = "";
              } else if($marca != "Todos" && $marca != "Ninguno") {
                $marcaQ = " AND T_Marca = '$marca'";
                $title = $title . "Marca: " . $marca . ". ";
              }

              if($modelo == "Todos") {
                $modeloQ = "";
              } else if($modelo != "Todos" && $modelo != "Ninguno") {
                $modeloQ = " AND T_Modelo = '$modelo'";
                $title = $title . "Modelo: " . $modelo . ". ";
              }

              if($anos == "Todos") {
                $anosQ = "";
              } else if($anos != "Todos" && $anos != "Ninguno") {
                $anosQ = " AND T_Garantia = '$anos'";
                $title = $title . "Años de Garantía: " . $anos . ". ";
              }

              if($mun == "Todos") {
                $munQ = "";
              } else{
                $munQ = " AND T_Municipio = '$mun'";
                $title = $title . "Ubicación: " . munChoose($mun) . ". ";
              }

              if($par == "Todos") {
                $parQ = "";
              } else {
                $parQ = " AND T_Parroquia = '$par'";
                $title = $title . "Parroquia: " . $par . ". ";
              }

              if($loc == "Todos") {
                $locQ = "";
              } else {
                $locQ = " AND T_Localidad = '$loc'";
                $title = $title . "Localidad: " . $loc . ". ";
              }

              if($tipo == "Todos") {
                $tipoQ = "";
              } else if($tipo != "Todos" && $tipo != "Ninguno") {
                $tipoQ = " AND T_Tipo = '$tipo'";
                $title = $title . "Tipo: " . $tipo . ". ";
              }

              if($banco == "Todos") {
                $bancoQ = "";
              } else if($banco != "Todos" && $banco != "Ninguno") {
                $bancoQ = " AND T_Banco = '$banco'";
                $title = $title . "Banco Transformador: " . $banco . ". ";
              }

              $resultQuery = "SELECT * FROM transformadores WHERE id != 0" . $estadoQ . $capacidadQ . $marcaQ . $modeloQ . $anosQ . $munQ . $parQ . $locQ . $tipoQ . $bancoQ;
              $TPerQuery = connect()->query($resultQuery);
              $num = 1;

              if(strlen($title) > 1) {
                echo '
                  <div class="text-center font-weight-bold mb-3">Transformadores con ' . $title . '</div>';
              }

              echo '
                <div class="w-100 mt-3 mx-auto">
                  <table class="w-100">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Serial</th>';

                          if($estado == "Todos") {
                            echo '<th>Estado</th>';
                          }

                          if($capacidad == "Todos") {
                            echo '<th>Capacidad</th>';
                          }

                          if($marca == "Todos") {
                            echo '<th>Marca</th>';
                          }

                          if($modelo == "Todos") {
                            echo '<th>Modelo</th>';
                          }

                          if($anos == "Todos") {
                            echo '<th>Años de<br>Garantía</th>';
                          }

                          if($tipo == "Todos") {
                            echo '<th>Tipo</th>';
                          }

                          if($banco == "Todos") {
                            echo '<th>Banco<br>Transformador</th>';
                          }

                            if($mun == "Todos") {
                              echo '<th>Ubicación</th>';
                            }

                            if($par == "Todos") {
                              echo '<th>Parroquia</th>';
                            }

                            if($loc == "Todos") {
                              echo '<th>Localidad</th>';
                            }

                            echo '
                          <th>Dirección</th>
                      <tr>
                    </thead>
                    <tbody>
              ';

              if($TPerQuery->rowCount() <= 0) {
                echo '</tbody></table><table class="w-100 p-1"><tbody><tr><td class="text-center">Ninguno</td></tr>';
              } else {
                while ($filas = $TPerQuery->fetch()) {
                  $municipio = $filas['T_Municipio'];

                  echo '
                  <tr>
                    <td>' . $num++ . '</td>
                    <td>' . $filas['T_Codigo'] . '</td>';

                      if($estado == "Todos") {
                        echo '<td>' . $filas['T_Estado'] . '</td>';
                      }

                      if($capacidad == "Todos") {
                        echo '<td>' . $filas['T_Capacidad'] . ' kW</td>';
                      }

                      if($marca == "Todos") {
                        echo '<td>' . $filas['T_Marca'] . '</td>';
                      }

                      if($modelo == "Todos") {
                        echo '<td>' . $filas['T_Modelo'] . '</td>';
                      }

                      if($anos == "Todos") {
                        echo '<td>' . $filas['T_Garantia'] . '</td>';
                      }


                      if($tipo == "Todos") {
                        echo '<td>' . $filas['T_Tipo'] . '</td>';
                      }

                      if($banco == "Todos") {
                        echo '<td>' . $filas['T_Banco'] . '</td>';
                      }

                      if($mun == "Todos") {
                        echo '<td>' . munChoose($municipio) . '</td>';
                      }

                      if($par == "Todos") {
                        echo '<td>' . $filas['T_Parroquia'] . '</td>';
                      }

                      if($loc == "Todos") {
                        echo '<td>' . $filas['T_Localidad'] . '</td>';
                      }

                    echo '
                    <td>' . $filas['T_Direccion'] . '</td>
                  <tr>
                  ';
                }
              }

              echo '
              <tbody>
              </table>
                </div>
              ';
            }

          } elseif ($informe == "operaciones") {
            echo '
              <div class="text-center font-weight-bold mt-3">Reporte de Operaciones</div>
            ';

            if($tipoData == "Todos") {
              $OTodosQuery = connect()->query("SELECT * FROM operaciones");
              $num = 1;

              echo '
                <div class="w-100 mt-3 mx-auto">
                  <table class="w-100">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Procedimiento</th>
                        <th>Fecha</th>
                        <th>Serial del Transformador</th>
                        <th>Estado Final</th>
                        <th>Ubicación</th>
                        <th>Parroquia</th>
                        <th>Localidad</th>
                        <th>Dirección</th>
                      </tr>
                    </thead>
                    <tbody>
                  ';

                  if($OTodosQuery->rowCount() <= 0) {
                    echo '</tbody></table><table class="w-100 p-1"><tbody><tr><td class="text-center">Ninguno</td></tr>';
                  } else {
                    while ($filas = $OTodosQuery->fetch()) {
                      $municipio = $filas['O_Municipio'];

                      echo '
                        <tr>
                        <td>' . $num++ . '</td>
                        <td>' . $filas['O_Procedimiento'] . '</td>
                        <td>' . $filas['O_Fecha'] . '</td>
                        <td>' . $filas['O_Equipo'] . '</td>
                        <td>' . $filas['O_EstadoActual'] . '</td>
                        <td>' . munChoose($municipio) . '</td>
                        <td>' . $filas['O_Parroquia'] . '</td>
                        <td>' . $filas['O_Localidad'] . '</td>
                        <td>' . $filas['O_Direccion'] . '</td>
                        </tr>
                      ';
                    }
                  }

                echo '
                </tbody>
                </table>
                </div>
              ';

            } else if($tipoData == "Personalizado") {
              $titulo = "";

              if($procedimiento == "Todos") {
                $procedimientoQ = "";
              } else if($procedimiento != "Todos" && $procedimiento != "Ninguno") {
                $procedimientoQ = " AND O_Procedimiento = '$procedimiento'";
                $titulo = $titulo . "Procedimiento: " . $procedimiento . ". ";
              }

              if($fecha == "Todos") {
                $fechaQ = "";
              } else if($fecha != "Todos" && $fecha != "Ninguno") {
                $fechaQ = " AND O_Fecha < '$fechaFin' AND O_Fecha > '$fechaInicio'";
                $titulo = $titulo . "Fecha desde: " . $fechaInicio . " - hasta: " . $fechaFin . ". ";
              }

              if($serial == "Todos") {
                $serialQ = "";
              } else if($serial != "Todos" && $serial != "Ninguno") {
                $serialQ = " AND O_Equipo = '$serial'";
                $titulo = $titulo . "Serial: " . $serial . ". ";
              }

              if($mun == "Todos") {
                $munQ = "";
              } else if($mun != "Todos" && $mun != "Ninguno") {
                $munQ = " AND O_Municipio = '$mun'";
                $titulo = $titulo . "Ubicación: " . munChoose($mun) . ". ";
              }

              if($par == "Todos") {
                $parQ = "";
              } else if($par != "Todos" && $par != "Ninguno") {
                $parQ = " AND O_Parroquia = '$par'";
                $titulo = $titulo . "Parroquia: " . $par . ". ";
              }

              if($loc == "Todos") {
                $locQ = "";
              } else if($loc != "Todos" && $loc != "Ninguno") {
                $locQ = " AND O_Localidad = '$loc'";
                $titulo = $titulo . "Localidad: " . $loc . ". ";
              }

              $opResultQuery = "SELECT * FROM operaciones WHERE id != 0" . $procedimientoQ . $fechaQ . $serialQ . $munQ . $parQ . $locQ;
              $opPerQuery = connect()->query($opResultQuery);
              $num = 1;

              if(strlen($titulo) > 1) {
                echo '
                  <div class="text-center font-weight-bold mb-3">Operaciones con ' . $titulo . '</div>
                ';
              }

              echo '

                <div class="w-100 mt-3 mx-auto">
                  <table class="w-100">
                    <thead>
                      <tr>
                        <th>#</th>';

                        if($procedimiento == "Todos") {
                          echo '<th>Procedimiento</th>';
                        }

                        if($fecha == "Todos") {
                          echo '<th>Fecha</th>';
                        }

                        if($serial == "Todos") {
                          echo '<th>Serial del Equipo</th>';
                        }

                        echo '<th>Estado Final</th>';

                        if($mun == "Todos") {
                          echo '<th>Ubicación</th>';
                        }

                        if($par == "Todos") {
                          echo '<th>Parroquia</th>';
                        }

                        if($loc == "Todos") {
                          echo '<th>Localidad</th>';
                        }

                        echo '
                          <th>Dirección</th>
                        </tr>
                    </thead>
                    <tbody>';

                    if($opPerQuery->rowCount() <= 0) {
                      echo '</tbody></table><table class="w-100 p-1"><tbody><tr><td class="text-center">Ninguno</td></tr>';
                    } else {
                      while ($fila = $opPerQuery->fetch()) {
                        $municipio = $fila['O_Municipio'];

                        echo '
                          <tr>
                            <td>' . $num++ . '</td>';

                            if($procedimiento == "Todos") {
                              echo '<td>' . $fila['O_Procedimiento'] . '</td>';
                            }

                            if($fecha == "Todos") {
                              echo '<td>' . $fila['O_Fecha'] . '</td>';
                            }

                            if($serial == "Todos") {
                              echo '<td>' . $fila['O_Equipo'] . '</td>';
                            }

                            echo '<td>' . $fila['O_EstadoActual'] . '</td>';

                            if($mun == "Todos") {
                              echo '<td>' . munChoose($municipio) . '</td>';
                            }

                            if($par == "Todos") {
                              echo '<td>' . $fila['O_Parroquia'] . '</td>';
                            }

                            if($loc == "Todos") {
                              echo '<td>' . $fila['O_Localidad'] . '</td>';
                            }

                            echo '
                              <td>' . $fila['O_Direccion'] . '</td>
                          </tr>
                        ';
                      }
                    }
                    echo '
                    </tbody>
                  </table>
                </div>
              ';
            }

          }
        }
      ?>

  </div>
  </div>

  <?php include "./modulos/scripts.php"; ?>
  <script type="text/javascript">
    $(document).ready(function() {
      $('#hideBtn').click(function () {
        if ($('#charBox').is(':hidden')) {
          $('#charBox').show();
          $('#hideBtn').css('left', '17%');
        } else {
          $('#charBox').hide();
          $('#hideBtn').css('left', '0');
        }
      });
    });

  function printDiv(divName) {
    var printContents = document.getElementById(divName).innerHTML;
    var fecha = new Date();
    var dia =fecha.getDate();
    var meses = fecha.getMonth();
    var mes = meses + 1;
    var ano = fecha.getFullYear();
    var hora = fecha.getHours();
    if(hora > 12) {
      hora -= 12;
      var huso = "pm";
    } else {
      var huso = "am";
    }
    var min = fecha.getMinutes();

    var date = ano + "-" + mes + "-" + dia + " " + hora + "." + min + huso;

    w = window.open();
    w.document.write('<!DOCTYPE html><html><head>');
    w.document.write('<link rel="stylesheet" href="<?= media; ?>css/estilos.css" /><link rel="stylesheet" href="<?= media; ?>css/style.css" />');
    w.document.write('</head><body>');
    w.document.write('<style>@media print { @page { size: Legal landscape; font-family: "Arial";} body {font-family: "Arial";} .last { page-break-after: always; } th { font-weight: bolder; } table, th, td { border: 1px solid black !important; text-align: center !important; } } th { font-weight: bold; } table, th, td { border: 1px solid black !important; text-align: center !important; }</style>');
    w.document.write(printContents);
    w.document.write('</body></html>');
    w.document.title = "Reporte " + date;
    setTimeout(function() {w.print(); w.close();}, 2000);

  }


</script>
</body>

</html>
