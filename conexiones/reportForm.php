<?php
  require_once "./funciones.php";

  if(isset($_GET['informe'])) {
    $tipo = strClean($_GET['informe']);

    if($tipo == "transformadores") {
      echo '
      <input type="hidden" value="transformadores" name="informe">

      <div class="row">

      <div class="input-group mb-3 mx-2">
        <div class="input-group-prepend">
          <div class="input-group-text">
            <input type="checkbox" class="mr-2" name="EstadoCheck" value="on"> Estado
          </div>
        </div>
        <select class="form-control input-default" name="EstadoInput">
          <option selected="selected" value="Todos">Todos</option>
          <option value="Instalado">Instalado</option>
          <option value="Dañado">Dañado</option>
          <option value="Almacenado">Almacenado</option>
        </select>
      </div>

      <div class="input-group mb-3 mx-2">
        <div class="input-group-prepend">
          <div class="input-group-text">
            <input type="checkbox" class="mr-2" name="CapacidadCheck" value="on"> Capacidad
          </div>
        </div>
        <select class="form-control input-default" name="CapacidadInput">
          <option selected="selected" value="Todos">Todos</option>
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
            <input type="checkbox" class="mr-2" name="MarcaCheck" value="on"> Marca
          </div>
        </div>
        <input type="text" name="MarcaInput" class="form-control input-default" value="Todos">
      </div>

      <div class="input-group mb-3 mx-2">
        <div class="input-group-prepend">
          <div class="input-group-text">
            <input type="checkbox" class="mr-2" name="ModeloCheck" value="on"> Modelo
          </div>
        </div>
        <input type="text" name="ModeloInput" class="form-control input-default" value="Todos">
      </div>
      </div>

        <div class="row">
        <div class="input-group mb-3 mx-2">
          <div class="input-group-prepend">
            <div class="input-group-text">
              <input type="checkbox" class="mr-2" name="AnosCheck" value="on"> Años de Garantía
            </div>
          </div>
          <input type="text" name="AnosInput" onkeypress="return numeros(event)" class="form-control input-default" value="Todos">
        </div>

        <div class="input-group mb-3 mx-2">
          <div class="input-group-prepend">
            <div class="input-group-text">
              <input type="checkbox" class="mr-2" name="TipoCheck" value="on"> Tipo
            </div>
          </div>
          <select class="form-control input-default" name="TipoInput">
            <option selected="selected" value="Todos">Todos</option>
            <option value="Monofásico">Monofásico</option>
            <option value="Trifásico">Trifásico</option>
          </select>
        </div>

        <div class="input-group mb-3 mx-2">
          <div class="input-group-prepend">
            <div class="input-group-text">
              <input type="checkbox" class="mr-2" name="BancoCheck" value="on"> Banco
            </div>
          </div>
          <select class="form-control input-default" name="BancoInput">
            <option selected="selected" value="Todos">Todos</option>
            <option value="Residencial">Residencial</option>
            <option value="Comercial">Comercial</option>
            <option value="Industrial">Industrial</option>
          </select>
        </div>
      </div>

      ';
    } else if($tipo == "operaciones") {
      echo '
      <input type="hidden" value="operaciones" name="informe">

      <div class="row">

      <div class="input-group mb-3 mx-2">
        <div class="input-group-prepend">
          <div class="input-group-text">
            <input type="checkbox" class="mr-2" name="ProcedimientoCheck" value="on"> Procedimiento
          </div>
        </div>
        <select class="form-control input-default" name="ProcedimientoInput">
          <option selected="selected" value="Todos">Todos</option>
          <option value="Reparación">Reparación</option>
          <option value="Instalación">Instalación</option>
          <option value="Retiro">Retiro</option>
        </select>
      </div>

      <div class="sm-hidden mb-0 position-absolute row" style="top: 24%; left: 40%;">
        <p class="mr-5">Desde: </p>
        <p class="ml-5">Hasta:</p>
      </div>

      <div class="mb-3 ml-2 mr-4 row">
          <div class="input-group-text mr-2">
            <input type="checkbox" class="mr-2" name="FechaCheck" value="on"> Fecha
          </div>
        <div class="row fecha-row">

        <p class="big-hidden mb-0 mt-1">Desde:</p>
        <input type="date" name="FechaInicio" placeholder="Desde:" class="fechaInput form-control">
        <p class="big-hidden mb-0 mt-1">Hasta:</p>
        <input type="date" name="FechaFin" placeholder="Hasta:" class="fechaInput form-control">
      </div>
      </div>

      <div class="input-group mb-3 mx-2">
        <div class="input-group-prepend">
          <div class="input-group-text">
            <input type="checkbox" class="mr-2" name="SerialCheck" value="on"> Serial
          </div>
        </div>
        <input type="text" name="SerialInput" class="form-control input-default" value="Todos">
      </div>
      </div>

      ';
    }

  }
?>
