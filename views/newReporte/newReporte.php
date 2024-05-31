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
    header('Location: http://localhost/transformers-under-control/login');
  }
  include "./conexiones/funciones.php";

  $informe = strClean($_GET['informe']);
  $tipoData = strClean($_GET['tipoData']);

  if(!isset($informe) || !isset($tipoData)) {
    header('Location: http://localhost/transformers-under-control/reportes');
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <?php include "./modulos/links.php"; ?>
  <title>New Record | <?php echo NOMBRE; ?></title>
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
      <input type="button" onclick="printDiv('contenido')" value="Print Record" id="valueBtn" class="btn btn-primary">
    </form>

    <p class="sm-hidden mt-3">Turn your phone sideways</p>

    <h4 class="mt-4">Features:</h4>
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
          echo '<span class="py-2"><strong>Record:  </strong> General</span>';
        } else {
          if ($informe == "transformers") {
            echo '
              <span class="py-2 border-bottom-1"><strong>Record of:  </strong> Transformers</span>
              <span class="py-2 border-bottom-1"><strong>State:  </strong> ' . $estado . '</span>
              <span class="py-2 border-bottom-1"><strong>Capacity:  </strong> ';
              if ($capacidad == "None"){
                echo 'None';
              } else if($capacidad != "All" && $capacidad != "None") {
                echo $capacidad . ' kW' ;
              } else {
                echo 'All';
              }
              echo '</span>
              <span class="py-2 border-bottom-1"><strong>Brand:  </strong> ' . $marca . '</span>
              <span class="py-2 border-bottom-1"><strong>Model:  </strong> ' . $modelo . '</span>
              <span class="py-2 border-bottom-1"><strong>Years of Warranty:  </strong> ' . $anos . '</span>
              <span class="py-2 border-bottom-1"><strong>Type:  </strong> ' . $tipo . '</span>
              <span class="py-2"><strong>Transformer Bank:  </strong> ' . $banco . '</span>
            ';
          } elseif ($informe == "operations") {
            echo '
              <span class="py-2 border-bottom-1"><strong>Record of:  </strong> Operations</span>
              <span class="py-2 border-bottom-1"><strong>Process:  </strong> ' . $procedimiento . '</span>
            ';

            if($fecha == "All" || $fecha == "None") {
              echo '<span class="py-2 border-bottom-1"><strong>Date:  </strong> ' . $fecha . '</span>';
            } else {
              echo '<span class="py-2 border-bottom-1"><strong>Begin:  </strong> ' . $fechaInicio . '</span>';
              echo '<span class="py-2 border-bottom-1"><strong>End:  </strong> ' . $fechaFin . '</span>';
            }

            echo '
              <span class="py-2 border-bottom-1"><strong>Transformer`s Serial Number:  </strong> ' . $serial . '</span>
            ';
          }
          echo '
            <span class="py-2 border-bottom-1"><strong>Location:  </strong> ';
            if($mun == "All") {
              echo "All";
            } else if($mun == "None") {
              echo "None";
            }else {
              echo munChoose($mun);
            }

          echo'</span>
            <span class="py-2 border-bottom-1"><strong>Parish:  </strong> ' . $par . '</span>
            <span class="py-2 border-bottom-1"><strong>Location:  </strong> ' . $loc . '</span>
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

    .logo-img {
      width: 2rem !important;
      height: auto !important;
    }
    
  </style>

  <div class="p-4 mr-3" style="overflow-x: scroll; width: max-content;">
    <div class="shadow bg-white p-4 d-flex flex-column align-items-center" id="contenido" style="width: 340mm; height: fit-content;">

    <div class="w-75 d-flex flex-row justify-content-center mb-3">
      <img class="logo-img mr-3" src="<?php echo media; ?>img/logo.png" alt="logo">
      <p class="text-center my-auto font-x-small fw-500"><?php echo NOMBRE; ?></p>
    </div>

      <?php
        if($informe == "General") {
          $query = connect()->query("SELECT * FROM municipios WHERE M_Tipo = 'Municipio'");

          echo '<div class="text-center font-weight-bold my-3">General Record<br> Transformers Installed in the Area</div>';

          while ($rows = $query->fetch()) {
            $mun = $rows['M_Nombre'];
            $num = 1;

            echo '
              <div class="w-100 my-3 mx-auto" id="table">
                <table class="w-100">
                  <tr><th class="p-1">' . munChoose($mun) . '</th></tr>
                  <tr><td class="p-1">Total Transformers: ' . getMunCount(false, $mun) . '</td></tr>
                </table>
                <table class="w-100">
                  <tr>';

                    if(munChoose($mun) == "Service Central") {
                      echo '<td class="p-1">Transformers In Stock: ' . getMunCount('Stock', $mun) . '</td>';
                    } else {
                      echo '<td class="p-1">Installed Transformers: ' . getMunCount('Installed', $mun) . '</td>';
                    }
                    echo '
                    <td class="p-1">Damaged Transformers: ' . getMunCount('Damaged', $mun) . '</td>
                    <td class="p-1">Installed Capacity: ' . getMunCapacidad($mun) . '</td>
                  </tr>
                </table>
                <table class="w-100">
                  <tr>
                    <th class="p-1">Transformers Info</th>
                  </tr>
                </table>
                <table class="w-100">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Serial Number</th>
                      <th>State</th>
                      <th>Capacity</th>
                      <th>Brand</th>
                      <th>Model</th>
                      <th>Years of<br>Warranty</th>
                      <th>Type</th>
                      <th>Transformer<br>Bank</th>
                      <th>Parish</th>
                      <th>Location</th>
                      <th>Address</th>
                    </tr>
                  </thead>
                  <tbody>

                  ';

                    $munTrans = connect()->query("SELECT * FROM transformadores WHERE T_Municipio = '$mun'");

                    if($munTrans->rowCount() <= 0) {
                      echo '</tbody></table><table class="w-100 p-1"><tr><td class="text-center">None</td></tr></table>';
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
                    <th class="p-1">Operations</th>
                  </tr>
                </table>
                ';

                $munOp = connect()->query("SELECT * FROM operaciones WHERE O_Municipio = '$mun'");
                $num2 = 1;

                if($munOp->rowCount() <= 0) {
                  echo '<table class="w-100 p-1 last"><tr><td class="text-center">None</td></tr></table>';
                } else {
                  echo '
                <table class="w-100 last">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Process</th>
                      <th>Date</th>
                      <th>Transformer`s Serial Number</th>
                      <th>Final State</th>
                      <th>Parish</th>
                      <th>Location</th>
                      <th>Address</th>
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
          if ($informe == "transformers") {
            echo "
              <div class='text-center font-weight-bold mt-3'>Transformer's Record</div>
            ";

            if($tipoData == "All") {
              $TAllQuery = connect()->query("SELECT * FROM transformadores");
              $num = 1;

              echo '
                <div class="w-100 mt-3 mx-auto">
                  <table class="w-100">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Serial Number</th>
                        <th>State</th>
                        <th>Capacity</th>
                        <th>Brand</th>
                        <th>Model</th>
                        <th>Years of<br>Warranty</th>
                        <th>Type</th>
                        <th>Transformer<br>Bank</th>
                        <th>Municipality</th>
                        <th>Parish</th>
                        <th>Location</th>
                        <th>Address</th>
                      </tr>
                    </thead>
                    <tbody>
                  ';

                  if($TAllQuery->rowCount() <= 0) {
                    echo '</tbody></table><table class="w-100 p-1"><tbody><tr><td class="text-center">None</td></tr>';
                  } else {
                    while ($filas = $TAllQuery->fetch()) {
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

            } else if($tipoData == "Personalized") {

              $title = "";

              if($estado == "All") {
                $estadoQ = "";
              } else if($estado != "All" && $estado != "None") {
                $estadoQ = " AND T_Estado = '$estado'";
                $title = $title . "State: " . $estado . ". ";
              }

              if($capacidad == "All") {
                $capacidadQ = "";
              } else if($capacidad != "All" && $capacidad != "None") {
                $capacidadQ = " AND T_Capacidad = '$capacidad'";
                $title = $title . "Capacity: " . $capacidad . " kW. ";
              }

              if($marca == "All") {
                $marcaQ = "";
              } else if($marca != "All" && $marca != "None") {
                $marcaQ = " AND T_Marca = '$marca'";
                $title = $title . "Brand: " . $marca . ". ";
              }

              if($modelo == "All") {
                $modeloQ = "";
              } else if($modelo != "All" && $modelo != "None") {
                $modeloQ = " AND T_Modelo = '$modelo'";
                $title = $title . "Model: " . $modelo . ". ";
              }

              if($anos == "All") {
                $anosQ = "";
              } else if($anos != "All" && $anos != "None") {
                $anosQ = " AND T_Garantia = '$anos'";
                $title = $title . "Years of Warranty: " . $anos . ". ";
              }

              if($mun == "All") {
                $munQ = "";
              } else{
                $munQ = " AND T_Municipio = '$mun'";
                $title = $title . "Municipality: " . munChoose($mun) . ". ";
              }

              if($par == "All") {
                $parQ = "";
              } else {
                $parQ = " AND T_Parroquia = '$par'";
                $title = $title . "Parish: " . $par . ". ";
              }

              if($loc == "All") {
                $locQ = "";
              } else {
                $locQ = " AND T_Localidad = '$loc'";
                $title = $title . "Location: " . $loc . ". ";
              }

              if($tipo == "All") {
                $tipoQ = "";
              } else if($tipo != "All" && $tipo != "None") {
                $tipoQ = " AND T_Tipo = '$tipo'";
                $title = $title . "Type: " . $tipo . ". ";
              }

              if($banco == "All") {
                $bancoQ = "";
              } else if($banco != "All" && $banco != "None") {
                $bancoQ = " AND T_Banco = '$banco'";
                $title = $title . "Transformer Bank: " . $banco . ". ";
              }

              $resultQuery = "SELECT * FROM transformadores WHERE id != 0" . $estadoQ . $capacidadQ . $marcaQ . $modeloQ . $anosQ . $munQ . $parQ . $locQ . $tipoQ . $bancoQ;
              $TPerQuery = connect()->query($resultQuery);
              $num = 1;

              if(strlen($title) > 1) {
                echo '
                  <div class="text-center font-weight-bold mb-3">Transformers with ' . $title . '</div>';
              }

              echo '
                <div class="w-100 mt-3 mx-auto">
                  <table class="w-100">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Serial</th>';

                          if($estado == "All") {
                            echo '<th>State</th>';
                          }

                          if($capacidad == "All") {
                            echo '<th>Capacity</th>';
                          }

                          if($marca == "All") {
                            echo '<th>Brand</th>';
                          }

                          if($modelo == "All") {
                            echo '<th>Model</th>';
                          }

                          if($anos == "All") {
                            echo '<th>Years of<br>Warranty</th>';
                          }

                          if($tipo == "All") {
                            echo '<th>Type</th>';
                          }

                          if($banco == "All") {
                            echo '<th>Transformer<br>Bank</th>';
                          }

                            if($mun == "All") {
                              echo '<th>Municipality</th>';
                            }

                            if($par == "All") {
                              echo '<th>Parish</th>';
                            }

                            if($loc == "All") {
                              echo '<th>Locality</th>';
                            }

                            echo '
                          <th>Address</th>
                      <tr>
                    </thead>
                    <tbody>
              ';

              if($TPerQuery->rowCount() <= 0) {
                echo '</tbody></table><table class="w-100 p-1"><tbody><tr><td class="text-center">None</td></tr>';
              } else {
                while ($filas = $TPerQuery->fetch()) {
                  $municipio = $filas['T_Municipio'];

                  echo '
                  <tr>
                    <td>' . $num++ . '</td>
                    <td>' . $filas['T_Codigo'] . '</td>';

                      if($estado == "All") {
                        echo '<td>' . $filas['T_Estado'] . '</td>';
                      }

                      if($capacidad == "All") {
                        echo '<td>' . $filas['T_Capacidad'] . ' kW</td>';
                      }

                      if($marca == "All") {
                        echo '<td>' . $filas['T_Marca'] . '</td>';
                      }

                      if($modelo == "All") {
                        echo '<td>' . $filas['T_Modelo'] . '</td>';
                      }

                      if($anos == "All") {
                        echo '<td>' . $filas['T_Garantia'] . '</td>';
                      }


                      if($tipo == "All") {
                        echo '<td>' . $filas['T_Tipo'] . '</td>';
                      }

                      if($banco == "All") {
                        echo '<td>' . $filas['T_Banco'] . '</td>';
                      }

                      if($mun == "All") {
                        echo '<td>' . munChoose($municipio) . '</td>';
                      }

                      if($par == "All") {
                        echo '<td>' . $filas['T_Parroquia'] . '</td>';
                      }

                      if($loc == "All") {
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

          } elseif ($informe == "operations") {
            echo "
              <div class='text-center font-weight-bold mt-3'>Operation's Record</div>
            ";

            if($tipoData == "All") {
              $OAllQuery = connect()->query("SELECT * FROM operaciones");
              $num = 1;

              echo '
                <div class="w-100 mt-3 mx-auto">
                  <table class="w-100">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Process</th>
                        <th>Date</th>
                        <th>Transformer Serial Number</th>
                        <th>Final State</th>
                        <th>Municipality</th>
                        <th>Parish</th>
                        <th>Location</th>
                        <th>Address</th>
                      </tr>
                    </thead>
                    <tbody>
                  ';

                  if($OAllQuery->rowCount() <= 0) {
                    echo '</tbody></table><table class="w-100 p-1"><tbody><tr><td class="text-center">None</td></tr>';
                  } else {
                    while ($filas = $OAllQuery->fetch()) {
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

            } else if($tipoData == "Personalized") {
              $titulo = "";

              if($procedimiento == "All") {
                $procedimientoQ = "";
              } else if($procedimiento != "All" && $procedimiento != "None") {
                $procedimientoQ = " AND O_Procedimiento = '$procedimiento'";
                $titulo = $titulo . "Process: " . $procedimiento . ". ";
              }

              if($fecha == "All") {
                $fechaQ = "";
              } else if($fecha != "All" && $fecha != "None") {
                $fechaQ = " AND O_Fecha < '$fechaFin' AND O_Fecha > '$fechaInicio'";
                $titulo = $titulo . "Begin: " . $fechaInicio . " - End: " . $fechaFin . ". ";
              }

              if($serial == "All") {
                $serialQ = "";
              } else if($serial != "All" && $serial != "None") {
                $serialQ = " AND O_Equipo = '$serial'";
                $titulo = $titulo . "Serial Number: " . $serial . ". ";
              }

              if($mun == "All") {
                $munQ = "";
              } else if($mun != "All" && $mun != "None") {
                $munQ = " AND O_Municipio = '$mun'";
                $titulo = $titulo . "Municipality: " . munChoose($mun) . ". ";
              }

              if($par == "All") {
                $parQ = "";
              } else if($par != "All" && $par != "None") {
                $parQ = " AND O_Parroquia = '$par'";
                $titulo = $titulo . "Parish: " . $par . ". ";
              }

              if($loc == "All") {
                $locQ = "";
              } else if($loc != "All" && $loc != "None") {
                $locQ = " AND O_Localidad = '$loc'";
                $titulo = $titulo . "Location: " . $loc . ". ";
              }

              $opResultQuery = "SELECT * FROM operaciones WHERE id != 0" . $procedimientoQ . $fechaQ . $serialQ . $munQ . $parQ . $locQ;
              $opPerQuery = connect()->query($opResultQuery);
              $num = 1;

              if(strlen($titulo) > 1) {
                echo '
                  <div class="text-center font-weight-bold mb-3">Operations with ' . $titulo . '</div>
                ';
              }

              echo '

                <div class="w-100 mt-3 mx-auto">
                  <table class="w-100">
                    <thead>
                      <tr>
                        <th>#</th>';

                        if($procedimiento == "All") {
                          echo '<th>Process/th>';
                        }

                        if($fecha == "All") {
                          echo '<th>Date</th>';
                        }

                        if($serial == "All") {
                          echo '<th>Serial Number</th>';
                        }

                        echo '<th>Final State</th>';

                        if($mun == "All") {
                          echo '<th>Municipality</th>';
                        }

                        if($par == "All") {
                          echo '<th>Parish</th>';
                        }

                        if($loc == "All") {
                          echo '<th>Location</th>';
                        }

                        echo '
                          <th>Address</th>
                        </tr>
                    </thead>
                    <tbody>';

                    if($opPerQuery->rowCount() <= 0) {
                      echo '</tbody></table><table class="w-100 p-1"><tbody><tr><td class="text-center">None</td></tr>';
                    } else {
                      while ($fila = $opPerQuery->fetch()) {
                        $municipio = $fila['O_Municipio'];

                        echo '
                          <tr>
                            <td>' . $num++ . '</td>';

                            if($procedimiento == "All") {
                              echo '<td>' . $fila['O_Procedimiento'] . '</td>';
                            }

                            if($fecha == "All") {
                              echo '<td>' . $fila['O_Fecha'] . '</td>';
                            }

                            if($serial == "All") {
                              echo '<td>' . $fila['O_Equipo'] . '</td>';
                            }

                            echo '<td>' . $fila['O_EstadoActual'] . '</td>';

                            if($mun == "All") {
                              echo '<td>' . munChoose($municipio) . '</td>';
                            }

                            if($par == "All") {
                              echo '<td>' . $fila['O_Parroquia'] . '</td>';
                            }

                            if($loc == "All") {
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
    w.document.title = "Record " + date;
    setTimeout(function() {w.print(); w.close();}, 2000);

  }


</script>
</body>

</html>
