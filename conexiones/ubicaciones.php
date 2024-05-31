<?php
  require_once "./funciones.php";


      if(isset($_GET['find'])) {

        $radMun = strClean($_POST['radMun']);

        if($radMun == "") {
          echo "<script>new swal('¡Error!', 'You must choose an option', 'error');</script>";
          exit();
        }

        echo '<script> window.location.href = "http://localhost/transformers-under-control/locations?municipio=' . $radMun .'"; </script>';

      } else if(isset($_GET['UAdd'])) {
        $stmt = connect()->prepare("INSERT INTO municipios(M_Codigo, M_Nombre, M_Tipo, M_Ubicacion)
        VALUES(:codigo, :nombre, :tipo, :ubicacion)");

        $stmt->bindParam(':codigo', $codigo);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':tipo', $tipo);
        $stmt->bindParam(':ubicacion', $ubicacion);

        $nombre = strClean($_POST["LAdd"]);
        $ubicacion = strClean($_POST["HParroquiaAdd"]);
        $municipio = strClean($_POST["LMunicipioAdd"]);
        $tipo = "Localidad";

        if($nombre == "" || $ubicacion == "" || $municipio == "") {
          echo "<script>new swal('¡Error!', 'You must complete all fields', 'error');</script>";
          exit();
        }

	$consultaNombre = ejecutar_consulta_simple("SELECT * FROM municipios WHERE M_Ubicacion = '$ubicacion' AND M_Nombre = '$nombre'");
	
	if($consultaNombre->rowCount() >= 1) {
	  echo "<script>new swal('¡Error!', 'The Location " . $nombre . " already exists in the Parish " . $ubicacion . "', 'error');</script>";
	  exit();
	}
        

        $consulta4= ejecutar_consulta_simple("SELECT id FROM municipios");
        $numero = ($consulta4->rowCount())+1;
        $codigo = generar_codigo_aleatorio("L", 7, $numero);

        if($stmt->execute()){
          echo "<script>new swal('¡Success!', 'Location Created Correctly', 'success');</script>";
          echo '<script> location.reload(); </script>';
        } 

      } else if(isset($_GET['getMun'])) {
        $mun = $_GET['getMun'];
        if($mun != "Service Central") {
        echo '<div class="form-group">
                    <label for="HParroquiaAdd" class="text-dark">Parish</label>
                    <select id="HParroquiaAdd" class="form-control input-default" name="HParroquiaAdd">
                    <option disabled selected="selected">Choose an option</option>
                    ';
                      $sql = "SELECT * FROM municipios WHERE M_Tipo = 'Parroquia' AND M_Ubicacion = '$mun'";
                      $result = connect()->query($sql);

                      while ($rows = $result->fetch()) {
                        echo'<option value="' . $rows['M_Nombre'] . '">' . $rows['M_Nombre'] . '</option>';
                      };
                    echo '
                  </select>
                 </div>';
          }

      } else if(isset($_GET['getParroquia'])) {
        $par = strClean($_GET['getParroquia']);

        echo '<div class="form-group">
          <label for="LocalidadFind" class="text-dark mr-2">Location</label>
          <select id="LocalidadFind" class="form-control input-default" name="LocalidadFind">
            <option value="All" selected="selected">All</option>
            ';
              $sql3 = "SELECT * FROM municipios WHERE M_Tipo = 'Localidad' AND M_Ubicacion = '$par'";
              $result3 = connect()->query($sql3);

              while ($rows3 = $result3->fetch()) {
                echo'<option value="' . $rows3['M_Nombre'] . '">' . $rows3['M_Nombre'] . '</option>';
              };
              echo '
          </select>
       </div>';

      } else if(isset($_GET['municipio']) && isset($_GET['parroquia']) && isset($_GET['localidad'])) {
        $municipio = $_GET['municipio'];
        $parroquia = $_GET['parroquia'];
        $localidad = $_GET['localidad'];

        if($parroquia == "All" && $localidad == "All") {
          echo '<script> location.reload(); </script>';
        } else if($parroquia != "All" && $localidad == "All") {
          echo'
            <div id="resultsList" class="d-flex flex-wrap add-list">

              <h4 class="mx-auto w-100 text-center mt-5 justify-content-around"><strong>Parish: </strong>' . $parroquia . ' <br><br><strong>Location: </strong>' . $localidad . '</h4>
              <div class="col-2 p-0 m-2">
                <div class="card-body d-flex flex-column align-items-center">
                  <h5 class="card-title text-center">Installed Transformers</h5>
                  <span class="badge badge-success badge-pill font-tiny text-white">' . getTData('Installed', $municipio, $parroquia, false) . '</span>
                </div>
              </div>

              <div class="col-2 p-0 m-2">
                <div class="card-body d-flex flex-column align-items-center">
                  <h5 class="card-title text-center">Damaged Transformers</h5>
                  <span class="badge badge-danger badge-pill font-tiny text-white">' . getTData('Damaged', $municipio, $parroquia, false) . '</span>
                </div>
              </div>

              <div class="col-2 p-0 m-2">
                <div class="card-body d-flex flex-column align-items-center">
                  <h5 class="card-title text-center">Total Transformers</h5>
                  <span class="badge badge-primary badge-pill font-tiny text-white">' . getTData(false, $municipio, $parroquia, false) . '</span>
                </div>
              </div>

              <div class="col-2 p-0 m-2">
                <div class="card-body d-flex flex-column align-items-center">
                  <h5 class="card-title text-center">Installed Capacity</h5>
                  <span class="badge badge-warning badge-pill font-tiny text-white">' . getParLocCapacidad($municipio, $parroquia, false) . '</span>
                </div>
              </div>
            </div>

            <div class="table-responsive mt-3">
              <table class="table table-striped table-hover" id="table1">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Serial Number</th>
                    <th>State</th>
                    <th>Capacity</th>
                    <th>Location</th>
                    <th>Address</th>
                    <th>Type</th>
                    <th>Transformer Bank</th>
                  </tr>
                </thead>
                <tbody>
                  ';
                    $result = connect()->query("SELECT * FROM transformadores WHERE T_Municipio = '$municipio' AND T_Parroquia = '$parroquia'");

                    $num = 1;

                    while ($rows = $result->fetch()) {
                      echo"<tr>
                            <th> <strong>" . $num++ . "</strong></th>
                            <td><a class='text-info' href='transformer?serial=" . $rows['T_Codigo'] . "'>" . $rows['T_Codigo'] . "</a></td>
                            <td>" . $rows['T_Estado'] . "</td>
                            <td>" . $rows['T_Capacidad'] . " kW</td>
                            <td>" . $rows['T_Localidad'] . "</td>
                            <td>" . $rows['T_Direccion'] . "</td>
                            <td>" . $rows['T_Tipo'] . "</td>
                            <td>" . $rows['T_Banco'] . "</td>
                          </tr>";
                    };

                  echo '
                </tbody>
              </table>
            </div>
          </div>';
        }  else if($parroquia != "All" && $localidad != "All") {
          echo'
            <div id="resultsList" class="d-flex flex-wrap add-list">

              <h4 class="mx-auto w-100 text-center mt-5 justify-content-around"><strong>Parish: </strong>' . $parroquia . ' <strong>Location: </strong>' . $localidad . '</h4>
              <div class="col-2 p-0 m-2">
                <div class="card-body d-flex flex-column align-items-center">
                  <h5 class="card-title text-center">Installed Transformers</h5>
                  <span class="badge badge-success badge-pill font-tiny text-white">' . getTData('Installed', $municipio, $parroquia, $localidad) . '</span>
                </div>
              </div>

              <div class="col-2 p-0 m-2">
                <div class="card-body d-flex flex-column align-items-center">
                  <h5 class="card-title text-center">Damaged Transformers</h5>
                  <span class="badge badge-danger badge-pill font-tiny text-white">' . getTData('Damaged', $municipio, $parroquia, $localidad) . '</span>
                </div>
              </div>

              <div class="col-2 p-0 m-2">
                <div class="card-body d-flex flex-column align-items-center">
                  <h5 class="card-title text-center">Total Transformers</h5>
                  <span class="badge badge-primary badge-pill font-tiny text-white">' . getTData(false, $municipio, $parroquia, $localidad) . '</span>
                </div>
              </div>

              <div class="col-2 p-0 m-2">
                <div class="card-body d-flex flex-column align-items-center">
                  <h5 class="card-title text-center">Installed Capacity</h5>
                  <span class="badge badge-warning badge-pill font-tiny text-white">' . getParLocCapacidad($municipio, $parroquia, $localidad) . '</span>
                </div>
              </div>
            </div>

            <div class="table-responsive mt-3">
              <table class="table table-striped table-hover" id="table1">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Serial Number</th>
                    <th>State</th>
                    <th>Capacity</th>
                    <th>Address</th>
                    <th>Type</th>
                    <th>Transformer Bank</th>
                  </tr>
                </thead>
                <tbody>
                  ';
                    $result = connect()->query("SELECT * FROM transformadores WHERE T_Municipio = '$municipio' AND T_Parroquia = '$parroquia' AND T_Localidad = '$localidad'");

                    $num = 1;

                    while ($rows = $result->fetch()) {
                      echo"<tr>
                            <th> <strong>" . $num++ . "</strong></th>
                            <td><a class='text-info' href='transformer?serial=" . $rows['T_Codigo'] . "'>" . $rows['T_Codigo'] . "</a></td>
                            <td>" . $rows['T_Estado'] . "</td>
                            <td>" . $rows['T_Capacidad'] . " kW</td>
                            <td>" . $rows['T_Direccion'] . "</td>
                            <td>" . $rows['T_Tipo'] . "</td>
                            <td>" . $rows['T_Banco'] . "</td>
                          </tr>";
                    };

                  echo '
                </tbody>
              </table>
            </div>
          </div>';
        }

     } else if(isset($_GET['UUpdate'])) {
        $sqlEdit = connect()->prepare("UPDATE municipios SET M_Codigo = :codigo, M_Nombre = :nombre, M_Tipo = :tipo, M_Ubicacion = :ubicacion WHERE M_Codigo = :codigo");

        $sqlEdit->bindParam(":codigo", $codigo);
        $sqlEdit->bindParam(":nombre", $nombre);
        $sqlEdit->bindParam(":tipo", $tipo);
        $sqlEdit->bindParam(":ubicacion", $ubicacion);

        $codigo = strClean($_POST["UCodigo"]);
        $nombre = strClean($_POST["UdireccionUpdate"]);
        $tipo = strClean($_POST["UTipo"]);
        $ubicacion = strClean($_POST["HParroquiaAdd"]);
        $municipio = strClean($_POST["HMunicipioAdd"]);

        if($nombre == "" || $ubicacion == "" || $municipio == "") {
          echo "<script>new swal('¡Error!', 'You must complete all fields', 'error');</script>";
          exit();
        }
        
        $consultaNombre = ejecutar_consulta_simple("SELECT * FROM municipios WHERE M_Ubicacion = '$ubicacion' AND M_Nombre = '$nombre' AND M_Codigo != '$codigo'");
	
	if($consultaNombre->rowCount() >= 1) {
	  echo "<script>new swal('¡Error!', 'The Location " . $nombre . " already exists in the Parish " . $ubicacion . "', 'error');</script>";
	  exit();
	}

        if($sqlEdit->execute()){
          echo "<script>new swal('¡Success!', 'Location Updated Correctly', 'success');</script>";
          echo '<script> window.location.href = "http://localhost/transformers-under-control/locations"; </script>';
        }

      } else if(isset($_GET['UDel'])) {
        $codigo = strClean($_POST["delU"]);

        $queryDel = "DELETE FROM municipios WHERE M_Codigo = '$codigo'";

        if(connect()->query($queryDel)) {
          echo "<script>new swal('¡Success!', 'Location Deleted Correctly', 'success');</script>";
          echo '<script> window.location.href = "http://localhost/transformers-under-control/locations"; </script>';
        }

      }


       if(isset($_GET['getPar'])) {
        $par = $_GET['getPar'];
        echo '<div class="form-group">
                    <label for="HLocalidadAdd" class="text-dark">Location</label>
                    <select id="HLocalidadAdd" class="form-control input-default" name="HLocalidadAdd">
                    <option disabled selected="selected">Choose an option</option>
                    ';
                      $sql = "SELECT * FROM municipios WHERE M_Tipo = 'Localidad' AND M_Ubicacion = '$par'";
                      $result = connect()->query($sql);

                      while ($rows = $result->fetch()) {
                        echo'<option value="' . $rows['M_Nombre'] . '">' . $rows['M_Nombre'] . '</option>';
                      };
                    echo '
                  </select>
                 </div>';
      }

?>
