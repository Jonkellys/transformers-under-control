<div class="row">

  <div class="mb-3 mx-2 ">
      <div class="input-group-text mb-3">
        <input type="checkbox" class="mr-2" name="UbicacionCheck" value="on"> Ubicación
      </div>
    <label for="HMunicipioAdd" class="text-dark">Municipio</label>

    <select id="HMunicipioAdd" class="form-control input-default" name="UbicacionInput">
      <option value="Todos" selected="selected">Todos</option>
      <?php

        $sqlMun = "SELECT * FROM municipios WHERE M_Tipo = 'Municipio'";
        $resultMun = connect()->query($sqlMun);

        while ($rowsMun = $resultMun->fetch()) {
          echo'<option value="' . $rowsMun['M_Nombre'] . '">' . $rowsMun['M_Nombre'] . '</option>';
        };
      ?>
    </select>
  </div>
  <div id="locate1" class="loc-m">
    <div class="form-group">
      <label for="HParroquiaAdd" class="text-dark">Parroquia</label>
      <select id="HParroquiaAdd" class="form-control input-default" name="HParroquiaAdd">
        <option disabled selected="selected"></option>
        <?php
        $sql = "SELECT * FROM municipios WHERE M_Tipo = 'Parroquia' AND M_Ubicacion = '$mun'";
        $result = connect()->query($sql);

        while ($rows = $result->fetch()) {
          echo'<option value="' . $rows['M_Nombre'] . '">' . $rows['M_Nombre'] . '</option>';
        };
        ?>
      </select>
      <p>Deje en blanco para seleccionar <strong>Todos</strong></p>
    </div>
  </div>
  <div id="locate2" class="loc-m">
    <div class="form-group">
      <label for="HLocalidadAdd" class="text-dark">Localidad</label>
      <select id="HLocalidadAdd" class="form-control input-default" name="HLocalidadAdd">
        <option disabled selected="selected"></option>
        <?php
        $sql = "SELECT * FROM municipios WHERE M_Tipo = 'Localidad' AND M_Ubicacion = '$par'";
        $result = connect()->query($sql);

        while ($rows = $result->fetch()) {
          echo'<option value="' . $rows['M_Nombre'] . '">' . $rows['M_Nombre'] . '</option>';
        };
        ?>
      </select>
    </div>
  </div>
</div>

<div class="RespuestaAjax mt-3"></div>
<button type="submit" class="btn btn-primary">Generar Reporte</button>

<script type="text/javascript">
$(document).ready(function(){

    $('#HMunicipioAdd').change(function(e) {
        e.preventDefault();

        var formu = $(this);
        let valor = document.getElementById('HMunicipioAdd').value;

        var respuesta = document.getElementById('locate1');


                $.ajax({
                    url: "http://localhost/sistema-transformadores/conexiones/ubicaciones.php?getMun=" + valor,
                    type: 'GET',
                    data: $(this).val(),
                    dataType: 'html',
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        respuesta.innerHTML = data;
                        console.log(data);
                    },
                    error: function(error) {
                        respuesta.html("Error: " + error);
                        // console.log("Error: " + error);
                    }
                });

    });


    $('#locate1').change(function(e) {
        e.preventDefault();

        var formu = $(this);
        let valeur = document.getElementById('HParroquiaAdd').value;

        var repond = document.getElementById('locate2');

                $.ajax({
                    url: 'http://localhost/sistema-transformadores/conexiones/ubicaciones.php?getPar=' + valeur,
                    type: 'GET',
                    data: $(this).val(),
                    dataType: 'html',
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        repond.innerHTML = data;
                        console.log(data);
                    },
                    error: function(error) {
                        respuesta.html('Error: ' + error);
                        // console.log("Error: " + error);
                    }
                });

    });

});

</script>
