<li class="text-divider"></li>
<li class="menu-item">
    <button id="showToastPlacement" class="menu-link btn" style="border: none; background: none;" data-bs-toggle="offcanvas" data-bs-target="#confirm" aria-controls="offcanvasTop">
      <i class="menu-icon tf-icons bx bx-log-out"></i>
        <div data-i18n="Usuarios">Log out</div>
    </button>
</li>


<div class="offcanvas offcanvas-top" tabindex="-1" id="confirm" aria-labelledby="offcanvasTopLabel" aria-hidden="true" style="visibility: hidden;">
    <div class="offcanvas-header">
        <h4 id="offcanvasTopLabel" class="offcanvas-title"><strong>Do you want to close the session?</strong></h4>
    </div>
    <div class="offcanvas-body">
        <a type="button" href="<?php echo SERVERURL; ?>conexiones/logout.php?>" class="btn btn-primary me-2">Confirm</a>
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="offcanvas">Cancel</button>
    </div>
</div>