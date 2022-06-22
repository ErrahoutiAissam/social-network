<!DOCTYPE html>
<html lang="fr" class="light-style layout-menu-fixed">
<?php require(ROOT . 'views/templates/admin/head.php'); ?>

<body>
  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
      <?php require(ROOT . 'views/templates/admin/aside.php'); ?>
      <div class="layout-page">
        <?php require(ROOT . 'views/templates/admin/navbar.php'); ?>
        <div class="content-wrapper">
          <div class="container-xxl d-flex justify-content-center align-items-center container-p-y">
            <div class="card text-center">
              <h5 class="card-header">Suppression d'abonnement</h5>
              <div class="card-body">
                Êtes-vous sûr de désabonner ?
                <div class="mt-3 d-flex justify-content-around align-items-center">
                  <form method="post" class="mb-0">
                    <button type="submit" class="btn btn-danger">Supprimer</button>
                  </form>
                  <a href="<?= BASE_URL_ADMIN ?>/follows/<?= $id ?>" class="btn btn-primary">Annuler</a>
                </div>
              </div>
            </div>
          </div>
          <div class="content-backdrop fade"></div>
        </div>
      </div>
    </div>

    <div class="layout-overlay layout-menu-toggle"></div>
  </div>
  <?php require(ROOT . 'views/templates/admin/scripts.php'); ?>
</body>

</html>