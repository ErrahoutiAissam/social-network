<!DOCTYPE html>
<html lang="fr" class="light-style">
  <?php require(ROOT . 'views/templates/admin/head.php'); ?>
  <body>
    <div class="container-xxl container-p-y">
      <div class="misc-wrapper">
        <h2 class="mb-3 mx-2">Page non trouvé :(</h2>
        <?php if(isset($msgError)): if($msgError): ?>
          <p class="mb-4 mx-2"><?= $msgError ?></p>
        <?php endif; endif; ?>  
        <a href="index.html" class="btn btn-primary"
          >Revenir à la page d'acceuil</a
        >
        <div class="mt-3">
          <img
            src="<?= BASE_URL ?>/assets/admin/img/illustrations/page-misc-error-light.png"
            alt="page-misc-error-light"
            width="500"
            class="img-fluid"
            data-app-dark-img="illustrations/page-misc-error-dark.png"
            data-app-light-img="illustrations/page-misc-error-light.png"
          />
        </div>
      </div>
    </div>
    <?php require(ROOT . 'views/templates/admin/scripts.php'); ?>
  </body>
</html>
