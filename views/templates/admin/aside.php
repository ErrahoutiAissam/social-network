<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
  <div class="app-brand demo">
    <a href="#" class="app-brand-link">
      <span class="app-brand-text demo menu-text fw-bolder ms-2">Yuai</span>
    </a>
    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
      <i class="bx bx-chevron-left bx-sm align-middle"></i>
    </a>
  </div>

  <div class="menu-inner-shadow"></div>

  <ul class="menu-inner py-1">
    <li class="menu-item">
      <a href="<?= BASE_URL_ADMIN ?>" class="menu-link">
        <i class="menu-icon tf-icons bx bx-home-circle"></i>
        <div data-i18n="Analytics">Dashboard</div>
      </a>
    </li>
    <li class="menu-item">
      <a href="<?= BASE_URL_ADMIN . '/profil' ?>" class="menu-link">
        <i class="menu-icon tf-icons bx bx-user"></i>
        <div data-i18n="Analytics">Profil</div>
      </a>
    </li>

    <li class="menu-header small text-uppercase">
      <span class="menu-header-text">Pages</span>
    </li>

    <li class="menu-item">
      <a href="<?= BASE_URL_ADMIN ?>/users" class="menu-link">
        <i class="menu-icon tf-icons bx bx-user"></i>
        <div data-i18n="Users">Utilisateurs</div>
      </a>
    </li>
    <li class="menu-item">
      <a href="<?= BASE_URL_ADMIN ?>/posts" class="menu-link">
        <i class="menu-icon tf-icons bx bx-package"></i>
        <div data-i18n="Users">Posts</div>
      </a>
    </li>
    <li class="menu-item">
      <a href="<?= BASE_URL_ADMIN ?>/follows" class="menu-link">
        <i class="menu-icon tf-icons bx bx-list-ol"></i>
        <div data-i18n="Users">Abonnés</div>
      </a>
    </li>
  </ul>
</aside>