<?php
  require_once "./funciones.php";

  if(isset($_GET['informe'])) {
    $tipo = strClean($_GET['informe']);

    if($tipo == "transformers") {
      echo '
      <input type="hidden" value="transformers" name="informe">

      <div class="row">

      <div class="input-group mb-3 mx-2">
        <div class="input-group-prepend">
          <div class="input-group-text">
            <input type="checkbox" class="mr-2" name="EstadoCheck" value="on"> State
          </div>
        </div>
        <select class="form-control input-default" name="EstadoInput">
          <option selected="selected" value="All">All</option>
          <option value="Installed">Installed</option>
          <option value="Damaged">Damaged</option>
          <option value="Stock">In Stock</option>
        </select>
      </div>

      <div class="input-group mb-3 mx-2">
        <div class="input-group-prepend">
          <div class="input-group-text">
            <input type="checkbox" class="mr-2" name="CapacidadCheck" value="on"> Capacity
          </div>
        </div>
        <select class="form-control input-default" name="CapacidadInput">
          <option selected="selected" value="All">All</option>
          <option value="5">5 kW</option>
          <option value="10">10 kW</option>
          <option value="15">15 kW</option>
          <option value="25">25 kW</option>
          <option value="37.5">37,5 kW</option>
          <option value="50">50 kW</option>
          <option value="75">75 kW</option>
          <option value="100">100 kW</option>
          <option value="165">165 kW</option>
        </select>
      </div>

      <div class="input-group mb-3 mx-2">
        <div class="input-group-prepend">
          <div class="input-group-text">
            <input type="checkbox" class="mr-2" name="MarcaCheck" value="on"> Brand
          </div>
        </div>
        <input type="text" name="MarcaInput" class="form-control input-default" value="All">
      </div>

      <div class="input-group mb-3 mx-2">
        <div class="input-group-prepend">
          <div class="input-group-text">
            <input type="checkbox" class="mr-2" name="ModeloCheck" value="on"> Model
          </div>
        </div>
        <input type="text" name="ModeloInput" class="form-control input-default" value="All">
      </div>
      </div>

        <div class="row">
        <div class="input-group mb-3 mx-2">
          <div class="input-group-prepend">
            <div class="input-group-text">
              <input type="checkbox" class="mr-2" name="AnosCheck" value="on"> Years of Warranty
            </div>
          </div>
          <input type="text" name="AnosInput" onkeypress="return numeros(event)" class="form-control input-default" value="All">
        </div>

        <div class="input-group mb-3 mx-2">
          <div class="input-group-prepend">
            <div class="input-group-text">
              <input type="checkbox" class="mr-2" name="TipoCheck" value="on"> Type
            </div>
          </div>
          <select class="form-control input-default" name="TipoInput">
            <option selected="selected" value="All">All</option>
            <option value="Monophase">Monophase</option>
            <option value="Triphase">Triphase</option>
          </select>
        </div>

        <div class="input-group mb-3 mx-2">
          <div class="input-group-prepend">
            <div class="input-group-text">
              <input type="checkbox" class="mr-2" name="BancoCheck" value="on"> Transformer Bank
            </div>
          </div>
          <select class="form-control input-default" name="BancoInput">
            <option selected="selected" value="All">All</option>
            <option value="Residential">Residential</option>
            <option value="Commercial">Commercial</option>
            <option value="Industrial">Industrial</option>
          </select>
        </div>
      </div>

      ';
    } else if($tipo == "operations") {
      echo '
      <input type="hidden" value="operations" name="informe">

      <div class="row">

      <div class="input-group mb-3 mx-2">
        <div class="input-group-prepend">
          <div class="input-group-text">
            <input type="checkbox" class="mr-2" name="ProcedimientoCheck" value="on"> Process
          </div>
        </div>
        <select class="form-control input-default" name="ProcedimientoInput">
          <option selected="selected" value="All">All</option>
          <option value="Repair">Repair</option>
          <option value="Installation">Installation</option>
          <option value="Removal">Removal</option>
        </select>
      </div>

      <div class="sm-hidden mb-0 position-absolute row" style="top: 24%; left: 40%;">
        <p class="mr-5">Since: </p>
        <p class="ml-5">Until:</p>
      </div>

      <div class="mb-3 ml-2 mr-4 row">
          <div class="input-group-text mr-2">
            <input type="checkbox" class="mr-2" name="FechaCheck" value="on"> Date
          </div>
        <div class="row fecha-row">

        <p class="big-hidden mb-0 mt-1">Since:</p>
        <input type="date" name="FechaInicio" placeholder="Since:" class="fechaInput form-control">
        <p class="big-hidden mb-0 mt-1">Until:</p>
        <input type="date" name="FechaFin" placeholder="Until:" class="fechaInput form-control">
      </div>
      </div>

      <div class="input-group mb-3 mx-2">
        <div class="input-group-prepend">
          <div class="input-group-text">
            <input type="checkbox" class="mr-2" name="SerialCheck" value="on"> Serial Number
          </div>
        </div>
        <input type="text" name="SerialInput" class="form-control input-default" value="All">
      </div>
      </div>

      ';
    }

  }
?>
