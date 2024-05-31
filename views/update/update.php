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
  if($_SESSION['tipo'] == "Normal" && !isset($_GET['account'])) {
    header('Location: http://localhost/transformers-under-control/dashboard');
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <?php include "./modulos/links.php"; ?>
  <title>Update | <?php echo NOMBRE; ?></title>
</head>

<body style="width: 100vw;">
  <?php
    include "./modulos/menu.php";
    include "./conexiones/funciones.php";
  ?>

  <style media="screen">
    @media (max-width: 768px) {
      .col-9 {
        max-width: 90%;
      }

      .container-p-y {
        margin-left: 1rem;
      }

      .back-btn {
        margin-left: 1rem;
      }
    }

    @media (min-width: 992px) {
      .container-p-y {
        margin-left: 3rem;
      }

      .back-btn {
        margin-left: 3rem;
      }
    }
  </style>

    <div class="d-flex flex-row justify-content-between mb-0 ms-3">
    <?php
          if(isset($_GET['transformer'])) {
            echo '<a class="btn btn-outline-primaty py-2 text-primary back-btn nav-icon" href="inventory">';
          } else if(isset($_GET['operation'])) {
            echo '<a class="btn btn-outline-primaty py-2 text-primary back-btn nav-icon" href="operations">';
          } else if(isset($_GET['account'])) {
            echo '<a class="btn btn-outline-primaty py-2 text-primary back-btn nav-icon" href="configurations">';
          } else if(isset($_GET['location'])) {
            echo '<a class="btn btn-outline-primaty py-2 text-primary back-btn nav-icon" href="locations">';
          }
        ?>
        <i class="bx bx-arrow-back text-primary"></i> Return
      </a>
    </div>

  <div class="container-fluid mt-0 flex-grow-1 container-p-y mt-3">
    <h4 class="fw-bold mb-0">Update <?php if(isset($_GET['transformer'])) {echo "Transformer";} else if(isset($_GET['operation'])) {echo "Operation";} else if(isset($_GET['account'])) {echo "Account";} else if(isset($_GET['location'])) {echo "Location";} ?></h4>
  </div>

    <?php
      if(isset($_GET['transformer'])) {

        $codigo = strClean($_GET['transformer']);
        $sql = connect()->prepare("SELECT * FROM transformadores WHERE T_Codigo = '$codigo'");

      } else if(isset($_GET['operation'])) {

        $codigo = strClean($_GET['operation']);
        $sql = connect()->prepare("SELECT * FROM operaciones WHERE O_Codigo = '$codigo'");

      } else if(isset($_GET['account'])) {

        $codigo = strClean($_GET['account']);

        if($_SESSION['tipo'] == "Normal" && $_SESSION['codigo'] != $codigo) {
          header('Location: http://localhost/transformers-under-control/dashboard');
        }

        $sql = connect()->prepare("SELECT * FROM usuarios WHERE userCodigo = '$codigo'");

      } else if(isset($_GET['location'])) {

        $codigo = strClean($_GET['location']);
        $sql = connect()->prepare("SELECT * FROM municipios WHERE M_Codigo = '$codigo'");

      }

      if(!isset($codigo)) {
        header('Location: http://localhost/transformers-under-control/dashboard');
      }

      $sql->execute();
      $data = $sql->fetch(PDO::FETCH_OBJ);
    ?>

  <div class="container-fluid p-2 mt-2">
    <div class="card col-9 mx-auto">
      <div class="card-body px-2 py-4">
        <h4 class="card-title">Update Info</h4>
        <?php
      if(isset($_GET['transformer'])) {
        echo '
          <form action="' . SERVERURL . 'conexiones/inventario.php?updateT" name="TUpdate" id="TUpdate" autocomplete="off" enctype="multipart/form-data" method="POST" data-form="save" class="FormularioAjax p-3">
            <div class="form-group">
              <label for="TCodigoUpdate" class="text-dark">Serial Number</label>
              <input id="TCodigoUpdate" readonly="" value="' . $data->T_Codigo . '" onkeypress="return letras(event)" type="text" name="TCodigoUpdate" class="form-control input-default">
            </div>

            <div class="form-group">
              <label for="TCapacidadUpdate" class="text-dark">Capacity</label>
              <select id="TCapacidadUpdate" class="form-control input-default" name="TCapacidadUpdate">
                <option selected="selected" value="' . $data->T_Capacidad . '">' . $data->T_Capacidad . ' kW</option>
                <option value="5">5 kW</option>
                <option value="10">10 kW</option>
                <option value="15">15 kW</option>
                <option value="25">25 kW</option>
                <option value="37,5">37,5 kW</option>
                <option value="50">50 kW</option>
                <option value="75">75 kW</option>
                <option value="100">100 kW</option>
                <option value="165">165 kW</option>
              </select>
            </div>

            <div class="form-group">
              <label for="TMarcaUpdate" class="text-dark">Brand</label>
              <input id="TMarcaUpdate" value="' . $data->T_Marca . '" type="text" onkeypress="return letras(event)" name="TMarcaUpdate" class="form-control input-default">
            </div>

            <div class="form-group">
              <label for="TModeloUpdate" class="text-dark">Model</label>
              <input id="TModeloUpdate" value="' . $data->T_Modelo . '" type="text" name="TModeloUpdate" class="form-control input-default">
            </div>

            <div class="form-group">
              <label for="TGarantiaUpdate" class="text-dark">Years of Warranty</label>
              <input id="TGarantiaUpdate" onkeypress="return numeros(event)" value="' . $data->T_Garantia . '" type="text" name="TGarantiaUpdate" class="form-control input-default">
            </div>

            <div class="form-group">
              <label for="TEstadoUpdate" class="text-dark">Actual State</label>
              <select id="TEstadoUpdate" class="form-control input-default" name="TEstadoUpdate">
                <option value="' . $data->T_Estado . '" selected="selected">' . $data->T_Estado . '</option>
                ';
                if($data->T_Estado == "Installed") {
                  echo '
                  <option value="Damaged">Damaged</option>
                  <option value="Stock">In Stocked</option>
                  ';
                } else if($data->T_Estado == "Damaged") {
                  echo '
                  <option value="Installed">Installed</option>
                  <option value="Stock">In Stocked</option>
                  ';
                } else if($data->T_Estado == "Stock") {
                  echo '
                  <option value="Installed">Instalado</option>
                  <option value="Damaged">Damaged</option>
                  ';
                }
                echo '
              </select>
            </div>

            <div class="form-group">
              <label for="TTipoUpdate" class="text-dark">Type</label>
              <select id="TTipoUpdate" class="form-control input-default" name="TTipoUpdate">
                <option value="' . $data->T_Tipo . '" selected="selected">' . $data->T_Tipo . '</option>
                ';
                  if($data->T_Tipo == "Monophase") {
                    echo '
                      <option value="Triphase">Triphase</option>
                    ';
                  } else if($data->T_Tipo == "Triphase") {
                    echo '
                      <option value="Monophase">Monophase</option>
                    ';
                  }
                  echo '
              </select>
            </div>

            <div class="form-group">
              <label for="TBancoUpdate" class="text-dark">Transformer Bank</label>
              <select id="TBancoUpdate" class="form-control input-default" name="TBancoUpdate">
                <option value="' . $data->T_Banco . '" selected="selected">' . $data->T_Banco . '</option>
              ';
                  if($data->T_Banco == "Residential") {
                    echo '
                      <option value="Commercial">Commercial</option>
                      <option value="Industrial">Industrial</option>
                    ';
                  } else if($data->T_Banco == "Commercial") {
                    echo '
                      <option value="Residential">Residential</option>
                      <option value="Industrial">Industrial</option>
                    ';
                  } else if($data->T_Banco == "Industrial") {
                    echo '
                      <option value="Residential">Residential</option>
                      <option value="Commercial">Commercial</option>
                    ';
                  }
                  echo '
                </select>
            </div>

              <div class="form-group">
                <label for="HMunicipioAdd" class="text-dark">Municipality</label>
                <select id="HMunicipioAdd" class="form-control input-default" name="TMunicipioUpdate">
                  <option value="' . $data->T_Municipio . '" selected="selected">' . $data->T_Municipio . '</option>
                  ';
                    $sql1 = "SELECT * FROM municipios WHERE M_Tipo = 'Municipio'";
                    $result1 = connect()->query($sql1);

                    while ($rows1 = $result1->fetch()) {
                      echo'<option value="' . $rows1['M_Nombre'] . '">' . $rows1['M_Nombre'] . '</option>';
                    };
                  echo '
                </select>
              </div>
              <div id="locate1">
                <div class="form-group">
                  <label for="HParroquiaAdd" class="text-dark">Parish</label>
                  <select id="HParroquiaAdd" class="form-control input-default" name="HParroquiaAdd">
                    <option value="' . $data->T_Parroquia . '" selected="selected">' . $data->T_Parroquia . '</option>
                    ';
                      $sql2 = "SELECT * FROM municipios WHERE M_Tipo = 'Parroquia' AND M_Ubicacion = '$data->T_Municipio'";
                      $result2 = connect()->query($sql2);

                      while ($rows2 = $result2->fetch()) {
                        echo'<option value="' . $rows2['M_Nombre'] . '">' . $rows2['M_Nombre'] . '</option>';
                      };
                  echo '
                  </select>
                </div>
              </div>
              <div id="locate2">
                <div class="form-group">
                  <label for="HLocalidadAdd" class="text-dark">Location</label>
                  <select id="HLocalidadAdd" class="form-control input-default" name="HLocalidadAdd">
                    <option value="' . $data->T_Localidad . '" selected="selected">' . $data->T_Localidad . '</option>
                    ';
                      $sql3 = "SELECT * FROM municipios WHERE M_Tipo = 'Localidad' AND M_Ubicacion = '$data->T_Parroquia'";
                      $result3 = connect()->query($sql3);

                      while ($rows3 = $result3->fetch()) {
                        echo'<option value="' . $rows3['M_Nombre'] . '">' . $rows3['M_Nombre'] . '</option>';
                      };
                      echo '
                  </select>
               </div>
              </div>

            <div class="form-group">
              <label for="TDireccionUpdate" class="text-dark">Address</label>
              <textarea value="' . $data->T_Direccion . '" id="TDireccionUpdate" class="form-control input-default h-150px" name="TDireccionUpdate" rows="6" id="comment">' . $data->T_Direccion . '</textarea>
            </div>

            <div class="RespuestaAjax mt-3"></div>

            <button type="submit" class="btn btn-primary">Update</button>
          </form>
          ';
          } else if(isset($_GET['operation'])) {
            echo '
              <form action="' . SERVERURL . 'conexiones/historial.php?updateO" autocomplete="off" enctype="multipart/form-data" method="POST" data-form="save" class="FormularioAjax p-3">
              <input value="' . $data->O_Codigo . '" type="hidden" name="HCodigoUpdate">
              <input value="' . $data->O_Municipio . '" type="hidden" name="HMunicipioUpdate">
              <div class="form-group">
                <label for="HProcUpdate" class="text-dark">Process</label>
                <select id="HProcUpdate" class="form-control input-default" name="HProcUpdate">
                  <option value="' . $data->O_Procedimiento . '" selected="selected">' . $data->O_Procedimiento . '</option>

                  ';
                  if($data->O_Procedimiento == "Repair") {
                    echo '
                    <option value="Installation">Installation</option>
                    <option value="Removal">Removal</option>
                    ';
                  } else if($data->O_Procedimiento == "Installation") {
                    echo '
                      <option value="Repair">Repair</option>
                      <option value="Removal">Removal</option>
                    ';
                  } else if($data->O_Procedimiento == "Removal") {
                    echo '
                      <option value="Repair">Repair</option>
                      <option value="Installation">Installation</option>
                    ';
                  }
                echo '
                </select>
              </div>

              <div class="form-group">
                <label for="HFechaUpdate" class="text-dark">Date</label>
                <input id="HFechaUpdate" value="' . $data->O_Fecha . '" type="date" class="form-control input-default" name="HFechaUpdate">
              </div>

              <div class="form-group">
                <label for="HEquipoUpdate" class="text-dark">Transformer`s Serial Number</label>
                <input id="HEquipoUpdate" value="' . $data->O_Equipo . '" readonly="" type="text" class="form-control input-default" name="HEquipoUpdate" placeholder="Ingrese el número serial del transformador">
              </div>

              <div class="form-group">
                <label for="HMunicipioAdd" class="text-dark">Municipality</label>
                <select id="HMunicipioAdd" class="form-control input-default" name="HMunicipioAdd">
                  <option value="' . $data->O_Municipio . '" selected="selected">' . $data->O_Municipio . '</option>
                  ';
                    $sql4 = "SELECT * FROM municipios WHERE M_Tipo = 'Municipio'";
                    $result4 = connect()->query($sql4);

                    while ($rows4 = $result4->fetch()) {
                      echo'<option value="' . $rows4['M_Nombre'] . '">' . $rows4['M_Nombre'] . '</option>';
                    };
                  echo '
                </select>
              </div>
              <div id="locate1">
                <div class="form-group">
                  <label for="HParroquiaAdd" class="text-dark">Parish</label>
                  <select id="HParroquiaAdd" class="form-control input-default" name="HParroquiaAdd">
                    <option value="' . $data->O_Parroquia . '" selected="selected">' . $data->O_Parroquia . '</option>
                    ';
                      $sql5 = "SELECT * FROM municipios WHERE M_Tipo = 'Parroquia' AND M_Ubicacion = '$data->O_Municipio'";
                      $result5 = connect()->query($sql5);

                      while ($rows5 = $result5->fetch()) {
                        echo'<option value="' . $rows5['M_Nombre'] . '">' . $rows5['M_Nombre'] . '</option>';
                      };
                  echo '
                  </select>
                </div>
              </div>
              <div id="locate2">
                <div class="form-group">
                  <label for="HLocalidadAdd" class="text-dark">Location</label>
                  <select id="HLocalidadAdd" class="form-control input-default" name="HLocalidadAdd">
                    <option value="' . $data->O_Localidad . '" selected="selected">' . $data->O_Localidad . '</option>
                    ';
                      $sql6 = "SELECT * FROM municipios WHERE M_Tipo = 'Localidad' AND M_Ubicacion = '$data->O_Parroquia'";
                      $result6 = connect()->query($sql6);

                      while ($rows6 = $result6->fetch()) {
                        echo'<option value="' . $rows6['M_Nombre'] . '">' . $rows6['M_Nombre'] . '</option>';
                      };
                      echo '
                  </select>
               </div>
              </div>

            <div class="form-group">
              <label for="HDireccionUpdate" class="text-dark">Address</label>
              <textarea value="' . $data->O_Direccion . '" id="TDireccionUpdate" class="form-control input-default h-150px" name="HDireccionUpdate" rows="6" id="comment">' . $data->O_Direccion . '</textarea>
            </div>

              <div class="RespuestaAjax mt-3"></div>
              <button type="submit" class="btn btn-primary">Update</button>
              </form>
              ';
            } else if(isset($_GET['account'])) {
              echo '
                <form action="' . SERVERURL . 'conexiones/create.php?updateC" autocomplete="off" enctype="multipart/form-data" method="POST" data-form="save" class="FormularioAjax p-3">
                  <div class="form-group">
                    <label for="nombreUpdate" class="text-dark">Name</label>
                    <input type="text" value="' . $data->userName . '" name="nombreUpdate" onkeypress="return letras(event)" id="nombreUpdate" class="form-control input-default" />
                  </div>

                  <input type="hidden" name="codigoUpdate" value="' . $data->userCodigo . '" />
                  <input type="hidden" name="contrasenaUpdate" value="' . $data->userPassword . '" />
                  <input type="hidden" name="correoCheck" value="' . $data->userEmail . '" />
                  <input type="hidden" name="userCheck" value="' . $data->userUsername . '" />

                  <div class="form-group">
                    <label for="apellidoUpdate" class="text-dark">Lastname</label>
                    <input type="text" value="' . $data->userLastname . '" name="apellidoUpdate" onkeypress="return letras(event)" id="apellidoUpdate" class="form-control input-default" />
                  </div>

                  <div class="form-group">
                    <label for="cargoUpdate" class="text-dark">Position</label>
                    <input type="text" value="' . $data->userCargo . '" name="cargoUpdate" id="cargoUpdate" onkeypress="return letras(event)" class="form-control input-default" />
                  </div>

                  <div class="form-group">
                    <label for="correoUpdate" class="text-dark">Email</label>
                    <input type="text" value="' . $data->userEmail . '" name="correoUpdate" id="correoUpdate" class="form-control input-default" />
                  </div>

                  <div class="form-group">
                    <label for="usuarioUpdate" class="text-dark">Username</label>
                    <input type="text" value="' . $data->userUsername . '" name="usuarioUpdate" id="usuarioUpdate" class="form-control input-default" />
                  </div>

                  <div class="form-group">
                    <label for="tipoUpdate" class="text-dark">User Type</label>
                    <select name="tipoUpdate" id="tipoUpdate" class="form-control input-default" >
                      <option value="' . $data->userType . '" selected >' . $data->userType . '</option>
                      ';
                      if($data->userType == "Normal") {
                        echo '<option value="Admin">Admin</option>';
                      } else if($data->userType == "Admin") {
                        echo '<option value="Normal">Normal</option>';
                      }
                    echo '
                    </select>
                  </div>

                  <a class="ml-3 text-primary" href="recover">Update Password</a><small class="ml-2">(The session will close)</small>

                  <div class="RespuestaAjax mt-3"></div>
                  <button type="submit" class="btn btn-primary">Update</button>
                </form>
              ';
            }  else if(isset($_GET['location'])) {
              $datUbic = $data->M_Ubicacion;

              $getMunicipio = connect()->prepare("SELECT * FROM municipios WHERE M_Nombre = '$datUbic'");
              $getMunicipio->execute();
              $total = $getMunicipio->fetch(PDO::FETCH_OBJ);

              echo '
                <form action="' . SERVERURL . 'conexiones/ubicaciones.php?UUpdate" autocomplete="off" enctype="multipart/form-data" method="POST" data-form="save" class="FormularioAjax p-3">
                  <div class="form-group">
                    <label for="HMunicipioAdd" class="text-dark">Municipality</label>
                    <select id="HMunicipioAdd" class="form-control input-default" name="HMunicipioAdd">
                      <option value="' . $total->M_Ubicacion . '" selected="selected">' . $total->M_Ubicacion . '</option>
                      ';
                        $sql7 = "SELECT * FROM municipios WHERE M_Tipo = 'Municipio' AND M_Nombre != 'Central de Servicios'";
                        $result7 = connect()->query($sql7);

                        while ($rows7 = $result7->fetch()) {
                          echo'<option value="' . $rows7['M_Nombre'] . '">' . $rows7['M_Nombre'] . '</option>';
                        };
                      echo '
                    </select>
                  </div>

                  <div id="locate1">
                    <div class="form-group">
                      <label for="HParroquiaAdd" class="text-dark">Parish</label>
                      <select id="HParroquiaAdd" class="form-control input-default" name="HParroquiaAdd">
                        <option value="' . $data->M_Ubicacion . '" selected="selected">' . $data->M_Ubicacion . '</option>
                        ';
                          $sql8 = "SELECT * FROM municipios WHERE M_Tipo = 'Parroquia' AND M_Ubicacion = '$data->M_Ubicacion'";
                          $result8 = connect()->query($sql8);

                          while ($rows8 = $result8->fetch()) {
                            echo'<option value="' . $rows8['M_Nombre'] . '">' . $rows8['M_Nombre'] . '</option>';
                          };
                      echo '
                      </select>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="UdireccionUpdate" class="text-dark">Location</label>
                    <input type="text" value="' . $data->M_Nombre . '" name="UdireccionUpdate" id="usuarioUpdate" class="form-control input-default" />
                  </div>

                  <input type="hidden" name="UCodigo" value="' . $data->M_Codigo . '" />
                  <input type="hidden" name="UTipo" value="' . $data->M_Tipo . '" />

                  <div class="RespuestaAjax mt-3"></div>
                  <button type="submit" class="btn btn-primary">Update</button>
                </form>
              ';
            }
          ?>
        </div>
    </div>
  </div>

  <?php include "./modulos/scripts.php"; ?>
  <script src="<?php echo media; ?>js/ajax/principal.js"></script>
  <script src="<?php echo media; ?>js/locations.js"></script>
  <script>
    function letras(e) {
        tecla = (document.all) ? e.keyCode : e.which;

        if (tecla == 8) {
          return true;
        }

        if (tecla == 32) {
          return true;
        }

        patron = /[A-Za-z]/;
        tecla_final = String.fromCharCode(tecla);
        return patron.test(tecla_final);
      }

      function numeros(e) {
          tecla = (document.all) ? e.keyCode : e.which;


          if (tecla == 32) {
            return true;
          }

          patron = /[0-9]/gi;
          tecla_final = String.fromCharCode(tecla);
          return patron.test(tecla_final);
        }  
  </script>
</body>

</html>
