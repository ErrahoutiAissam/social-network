<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
  <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
    <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
      <i class="bx bx-menu bx-sm"></i>
    </a>
  </div>

  <div class="navbar-nav-right d-flex align-items-center" style="z-index: 50;" id="navbar-collapse">
    <div>
      <a href="<?= BASE_URL ?>" class="navbar-brand">Yuai</a>
    </div>

    <ul class="navbar-nav flex-row align-items-center ms-auto">
      <?php if (!isset($_SESSION['auth-client'])) : ?>
        <li class="nav-item" title="Se connecter">
          <a class="nav-link" href="<?= BASE_URL . '/login' ?>">
            <i class="menu-icon tf-icons bx bx-user"></i>
            Se connecter
          </a>
        </li>
        <li class="nav-item" title="Se connecter">
          <a class="nav-link" href="<?= BASE_URL . '/signup' ?>">
            <i class="menu-icon tf-icons bx bx-user"></i>
            S'inscrire
          </a>
        </li>
      <?php endif; ?>
      <!-- User Profil -->
      <?php if (isset($_SESSION['auth-client'])) : ?>
        <li class="nav-item navbar-dropdown dropdown-user dropdown">
          <a class="nav-link dropdown-toggle hide-arrow" href="" data-bs-toggle="dropdown">
            <i class="bx bx-user me-2"></i>
          </a>
          <ul class="dropdown-menu dropdown-menu-end">
            <li>
              <a class="dropdown-item" href="<?= BASE_URL . '/profil' ?>">
                <i class="bx bx-user me-2"></i>
                <span class="align-middle">Mon Profil</span>
              </a>
            </li>
            <li>
              <div class="dropdown-divider"></div>
            </li>
            <li>
              <a class="dropdown-item" href="<?= BASE_URL . '/logout' ?>">
                <i class="bx bx-power-off me-2"></i>
                <span class="align-middle">Se déconnecter</span>
              </a>
            </li>
          </ul>
        </li>
      <?php endif; ?>
      <!--/ User -->
    </ul>
  </div>
</nav>