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
          <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
              <div class="col-md-3"></div>
              <div class="col-md-6">
                <h4 class="fw-bold py-3 mb-4">
                  <span class="text-muted fw-light">Follow/</span> Ajouter
                </h4>
                <div class="card mb-4">
                  <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Ajouter follow</h5>
                  </div>
                  <div class="card-body">
                    <form action="<?= BASE_URL_ADMIN ?>/follows/add" method="POST">
                      <div class="mb-3">
                        <label class="form-label" for="followers-list">Utilisateur qui abonne</label>
                        <select name="follower" id="followers-list" class="form-select">
                          <option value="-1">Tous</option>
                          <?php foreach ($users as $user) : ?>
                            <option value="<?= $user['id'] ?>">
                              <?= $user['firstname'] . ' ' . $user['lastname'] ?>
                            </option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                      <?php if (isset($errors['exist'])) : ?>
                        <ul>
                          <li class="form-text text-danger"><?= $errors['exist'] ?></li>
                        </ul>
                      <?php endif; ?>
                      <div class="mb-3">
                        <label class="form-label" for="following-list">Utilisateur abonné</label>
                        <select name="following" id="following-list" class="form-select">
                          <option value="-1">Tous</option>
                          <?php foreach ($users as $user) : ?>
                            <option value="<?= $user['id'] ?>">
                              <?= $user['firstname'] . ' ' . $user['lastname'] ?>
                            </option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                      <?php if (isset($errors['equals'])) : ?>
                        <ul>
                          <li class="form-text text-danger"><?= $errors['equals'] ?></li>
                        </ul>
                      <?php endif; ?>
                      <button type="submit" class="btn btn-primary mt-3">
                        Ajouter
                      </button>
                    </form>
                  </div>
                </div>
              </div>
              <div class="col-md-3"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="layout-overlay layout-menu-toggle"></div>
  </div>
  <?php require(ROOT . 'views/templates/admin/scripts.php'); ?>
</body>

</html>