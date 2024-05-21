<?php
  require_once "./funciones.php";


      if(isset($_GET['find'])) {

        $radMun = strClean($_POST['radMun']);

        if($radMun == "") {
          echo "<script>new swal('¡Error!', 'Debes seleccionar una opción', 'error');</script>";
          exit();
        }

        echo '<script> window.location.href = "http://localhost/sistema-transformadores/ubicaciones?municipio=' . $radMun .'"; </script>';

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
          echo "<script>new swal('¡Error!', 'Debes llenar todos los campos', 'error');</script>";
          exit();
        }

	$consultaNombre = ejecutar_consulta_simple("SELECT * FROM municipios WHERE M_Ubicacion = '$ubicacion' AND M_Nombre = '$nombre'");
	
	if($consultaNombre->rowCount() >= 1) {
	  echo "<script>new swal('¡Error!', 'La localidad " . $nombre . " ya existe en la Parroquia " . $ubicacion . "', 'error');</script>";
	  exit();
	}
        

        $consulta4= ejecutar_consulta_simple("SELECT id FROM municipios");
        $numero = ($consulta4->rowCount())+1;
        $codigo = generar_codigo_aleatorio("L", 7, $numero);

        if($stmt->execute()){
          echo "<script>new swal('¡Éxito!', 'Localidad Creada Correctamente', 'success');</script>";
          echo '<script> location.reload(); </script>';
        } else{
          echo "<script>new swal('Ocurrió un error', 'Por favor intente de nuevo', 'error');</script>";
        }

      } else if(isset($_GET['getMun'])) {
        $mun = $_GET['getMun'];
        if($mun != "Central de Servicios") {
        echo '<div class="form-group">
                    <label for="HParroquiaAdd" class="text-dark">Parroquia</label>
                    <select id="HParroquiaAdd" class="form-control input-default" name="HParroquiaAdd">
                    <option disabled selected="selected">Seleccione una opción</option>
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
          <label for="LocalidadFind" class="text-dark mr-2">Localidad</label>
          <select id="LocalidadFind" class="form-control input-default" name="LocalidadFind">
            <option value="Todas" selected="selected">Todas</option>
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

        if($parroquia == "Todas" && $localidad == "Todas") {
          echo '<script> location.reload(); </script>';
        } else if($parroquia != "Todas" && $localidad == "Todas") {
          echo'
            <div id="resultsList" class="d-flex flex-wrap add-list">

              <h4 class="mx-auto w-100 text-center mt-5 justify-content-around"><strong>Parroquia: </strong>' . $parroquia . ' <br><br><strong>Localidad: </strong>' . $localidad . '</h4>
              <div class="col-2 p-0 m-2">
                <div class="card-body d-flex flex-column align-items-center">
                  <h5 class="card-title text-center">Transformadores Instalados</h5>
                  <span class="badge badge-success badge-pill font-tiny text-white">' . getTData('Instalado', $municipio, $parroquia, false) . '</span>
                </div>
              </div>

              <div class="col-2 p-0 m-2">
                <div class="card-body d-flex flex-column align-items-center">
                  <h5 class="card-title text-center">Transformadores Dañados</h5>
                  <span class="badge badge-danger badge-pill font-tiny text-white">' . getTData('Dañado', $municipio, $parroquia, false) . '</span>
                </div>
              </div>

              <div class="col-2 p-0 m-2">
                <div class="card-body d-flex flex-column align-items-center">
                  <h5 class="card-title text-center">Transformadores Totales</h5>
                  <span class="badge badge-primary badge-pill font-tiny text-white">' . getTData(false, $municipio, $parroquia, false) . '</span>
                </div>
              </div>

              <div class="col-2 p-0 m-2">
                <div class="card-body d-flex flex-column align-items-center">
                  <h5 class="card-title text-center">Capacidad Instalada</h5>
                  <span class="badge badge-warning badge-pill font-tiny text-white">' . getParLocCapacidad($municipio, $parroquia, false) . '</span>
                </div>
              </div>
            </div>

            <div class="table-responsive mt-3">
              <table class="table table-striped table-hover" id="table1">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Serial</th>
                    <th>Estado</th>
                    <th>Capacidad</th>
                    <th>Localidad</th>
                    <th>Dirección</th>
                    <th>Tipo</th>
                    <th>Banco Transformador</th>
                  </tr>
                </thead>
                <tbody>
                  ';
                    $result = connect()->query("SELECT * FROM transformadores WHERE T_Municipio = '$municipio' AND T_Parroquia = '$parroquia'");

                    $num = 1;

                    while ($rows = $result->fetch()) {
                      echo"<tr>
                            <th> <strong>" . $num++ . "</strong></th>
                            <td><a class='text-info' href='transformador?serial=" . $rows['T_Codigo'] . "'>" . $rows['T_Codigo'] . "</a></td>
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
        }  else if($parroquia != "Todas" && $localidad != "Todas") {
          echo'
            <div id="resultsList" class="d-flex flex-wrap add-list">

              <h4 class="mx-auto w-100 text-center mt-5 justify-content-around"><strong>Parroquia: </strong>' . $parroquia . ' <strong>Localidad: </strong>' . $localidad . '</h4>
              <div class="col-2 p-0 m-2">
                <div class="card-body d-flex flex-column align-items-center">
                  <h5 class="card-title text-center">Transformadores Instalados</h5>
                  <span class="badge badge-success badge-pill font-tiny text-white">' . getTData('Instalado', $municipio, $parroquia, $localidad) . '</span>
                </div>
              </div>

              <div class="col-2 p-0 m-2">
                <div class="card-body d-flex flex-column align-items-center">
                  <h5 class="card-title text-center">Transformadores Dañados</h5>
                  <span class="badge badge-danger badge-pill font-tiny text-white">' . getTData('Dañado', $municipio, $parroquia, $localidad) . '</span>
                </div>
              </div>

              <div class="col-2 p-0 m-2">
                <div class="card-body d-flex flex-column align-items-center">
                  <h5 class="card-title text-center">Transformadores Totales</h5>
                  <span class="badge badge-primary badge-pill font-tiny text-white">' . getTData(false, $municipio, $parroquia, $localidad) . '</span>
                </div>
              </div>

              <div class="col-2 p-0 m-2">
                <div class="card-body d-flex flex-column align-items-center">
                  <h5 class="card-title text-center">Capacidad Instalada</h5>
                  <span class="badge badge-warning badge-pill font-tiny text-white">' . getParLocCapacidad($municipio, $parroquia, $localidad) . '</span>
                </div>
              </div>
            </div>

            <div class="table-responsive mt-3">
              <table class="table table-striped table-hover" id="table1">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Serial</th>
                    <th>Estado</th>
                    <th>Capacidad</th>
                    <th>Dirección</th>
                    <th>Tipo</th>
                    <th>Banco Transformador</th>
                  </tr>
                </thead>
                <tbody>
                  ';
                    $result = connect()->query("SELECT * FROM transformadores WHERE T_Municipio = '$municipio' AND T_Parroquia = '$parroquia' AND T_Localidad = '$localidad'");

                    $num = 1;

                    while ($rows = $result->fetch()) {
                      echo"<tr>
                            <th> <strong>" . $num++ . "</strong></th>
                            <td><a class='text-info' href='transformador?serial=" . $rows['T_Codigo'] . "'>" . $rows['T_Codigo'] . "</a></td>
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
          echo "<script>new swal('¡Error!', 'Debes llenar todos los campos', 'error');</script>";
          exit();
        }
        
        $consultaNombre = ejecutar_consulta_simple("SELECT * FROM municipios WHERE M_Ubicacion = '$ubicacion' AND M_Nombre = '$nombre' AND M_Codigo != '$codigo'");
	
	if($consultaNombre->rowCount() >= 1) {
	  echo "<script>new swal('¡Error!', 'La localidad " . $nombre . " ya existe en la Parroquia " . $ubicacion . "', 'error');</script>";
	  exit();
	}

        if($sqlEdit->execute()){
          echo "<script>new swal('¡Éxito!', 'Ubicación editada correctamente', 'success');</script>";
          echo '<script> window.location.href = "http://localhost/sistema-transformadores/ubicaciones"; </script>';
        } else{
          echo "<script>new swal('Ocurrió un error', 'Por favor intente de nuevo', 'error');</script>";
        }

      } else if(isset($_GET['UDel'])) {
        $codigo = strClean($_POST["delU"]);

        $queryDel = "DELETE FROM municipios WHERE M_Codigo = '$codigo'";

        if(connect()->query($queryDel)) {
          echo "<script>new swal('¡Éxito!', 'Ubicación eliminada correctamente', 'success');</script>";
          echo '<script> window.location.href = "http://localhost/sistema-transformadores/ubicaciones"; </script>';
        } else {
          echo "<script>new swal('Ocurrió un error', 'Por favor intente de nuevo', 'error');</script>";
        }

      }


       if(isset($_GET['getPar'])) {
        $par = $_GET['getPar'];
        echo '<div class="form-group">
                    <label for="HLocalidadAdd" class="text-dark">Localidad</label>
                    <select id="HLocalidadAdd" class="form-control input-default" name="HLocalidadAdd">
                    <option disabled selected="selected">Seleccione una opción</option>
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
