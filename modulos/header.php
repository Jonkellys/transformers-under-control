<style media="screen">
  @media (max-width: 768px) {
    .logo-img {
      width: 30% !important;
      height: auto !important;
      margin-left: 1.5rem !important;
    }

    .btn-help {
      font-size: 10px;
      padding: 0.25rem 0.5rem;
    }
  }

  @media (min-width: 992px) {
    .logo-img {
      width: 20% !important;
      height: auto !important;
      margin-left: 3rem !important;
    }
  }
</style>

<header class="card rounded-0 w-100 mb-0 p-2 d-flex flex-row justify-content-between">
  <img class="my-auto logo-img" src="<?php echo media; ?>img/name.png" alt="" />
  <a class="btn btn-outline-info my-auto mr-5 btn-help" href="ayuda<?php echo "#" . $page; ?>">Ayuda</a>
</header>
