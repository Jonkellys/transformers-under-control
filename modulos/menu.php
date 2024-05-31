<?php 

  function menuDash($name) {
    if($name == "dashboard") {
      echo 'class="btn disabled p-2 mr-1"';
    } 
    else {
      echo 'href="dashboard"  class="btn btn-primary p-2 mr-1"';
    }
  }

  function menuInv($name) {
    if($name == "inventory") {
      echo 'class="btn disabled p-2 mr-1"';
    } 
    else {
      echo 'href="inventory"  class="btn btn-primary p-2 mr-1"';
    }
  }

  function menuHis($name) {
    if($name == "operations") {
      echo 'class="btn disabled p-2 mr-1"';
    } 
    else {
      echo 'href="operations"  class="btn btn-primary p-2 mr-1"';
    }
  }

  function menuUbic($name) {
    if($name == "locations") {
      echo 'class="btn disabled p-2 mr-1"';
    } 
    else {
      echo 'href="locations"  class="btn btn-primary p-2 mr-1"';
    }
  }
  
  function menuFile($name) {
    if($name == "records") {
      echo 'class="btn disabled p-2 mr-1"';
    } 
    else {
      echo 'href="records"  class="btn btn-primary p-2 mr-1"';
    }
  }

  function menuConf($name) {
    if($name == "configurations") {
      echo 'class="btn disabled p-2 mr-1"';
    } 
    else {
      echo 'href="configurations"  class="btn btn-primary p-2 mr-1"';
    }
  }
?>

<div class="app-header card rounded-0 bg-primary">    
  <div class="d-flex flex-row justify-content-between">  
    <div class="header-left">
      <div class="btn-group mt-2 mb-2 btn-group-lg">
        <a <?php menuDash($page) ?> data-toggle="tooltip" data-placement="bottom" title="Dashboard"><i class="bx bx-home text-white font-medium"></i></a>
        <a <?php menuInv($page) ?> data-toggle="tooltip" data-placement="bottom" title="Inventory"><i class="bx bx-list-ul text-white font-medium"></i></a>
        <a <?php menuHis($page) ?> data-toggle="tooltip" data-placement="bottom" title="History"><i class="bx bx-time text-white font-medium"></i></a>
        <a <?php menuUbic($page) ?> data-toggle="tooltip" data-placement="bottom" title="Locations"><i class="bx bx-map text-white font-medium"></i></a>
        <a <?php menuFile($page) ?> data-toggle="tooltip" data-placement="bottom" title="Records"><i class="bx bx-file text-white font-medium"></i></a>
        <a <?php menuConf($page) ?> data-toggle="tooltip" data-placement="bottom" title="Configurations"><i class="bx bx-cog text-white font-medium"></i></a>
      </div>
    </div>

    <div class="header-right mr-4 m-out">
      <span data-toggle="tooltip" class="nav-icon col-1 rounded p-2 logoutBtn" data-placement="bottom" title="Log out" data-original-title="Cerrar Sesión"><i class="bx bx-log-out text-white font-medium answer"></i></span>
    </div>
  </div>
</div>
