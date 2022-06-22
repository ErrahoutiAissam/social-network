<!DOCTYPE html>
<html lang="fr" class="light-style layout-menu-fixed">
<?php require(ROOT . 'views/templates/admin/head.php'); ?>

<body>
  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-content-navbar layout-without-menu">
    <div class="layout-container">
      <!-- Layout container -->
      <div class="layout-page">
        <?php require(ROOT . 'views/templates/navbar.php'); ?>
        <div class="content-wrapper">
          <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Profil /</span></h4>
            <div class="row">
              <div class="col-md-12">
                <div class="card mb-4">
                  <h5 class="card-header">Informations</h5>
                  <div class="card-body">
                    <div class="d-flex align-items-start align-items-sm-center gap-4 justify-content-between">
                      <div class="d-flex flex-column align-items-center">
                        <img class="rounded-circle" src="<?= BASE_URL ?>/assets/images/users/default.jpg" alt="avtar" width="100" height="100" />
                        <p class="mt-3"><?= ucfirst($user['firstname']) . ' ' . strtoupper($user['lastname']) ?></p>
                      </div>
                      <div class="button-wrapper">
                        <?php if ($user['id'] != $_SESSION['auth-client']) : ?>
                          <?php if (!$amIFollowing) : ?>
                            <a href="<?= BASE_URL ?>/follow/<?= $user['id'] ?>" class="btn btn-outline-primary mb-4">
                              <i class="bx bx-reset d-block d-sm-none"></i>
                              <span class="d-none d-sm-block">S'abonner</span>
                            </a>
                          <?php endif; ?>
                          <?php if ($amIFollowing) : ?>
                            <a href="<?= BASE_URL ?>/unfollow/<?= $user['id'] ?>" class="btn btn-outline-secondary mb-4">
                              <i class="bx bx-reset d-block d-sm-none"></i>
                              <span class="d-none d-sm-block">Se désabonner</span>
                            </a>
                          <?php endif; ?>
                        <?php endif; ?>
                      </div>
                    </div>
                  </div>
                  <hr class="my-0" />
                  <div class="card-body">
                    <?php if ($user['id'] == $_SESSION['auth-client']) : ?>
                      <form id="formAccountSettings" action="<?= BASE_URL ?>/profil/edit" method="POST">
                        <div class="row">
                          <div class="mb-3 col-md-4">
                            <label for="firstName" class="form-label">Prénom</label>
                            <input class="form-control" type="text" id="firstName" name="firstname" value="<?= $user['firstname'] ?>" />
                          </div>
                          <div class="mb-3 col-md-4">
                            <label for="lastName" class="form-label">Nom</label>
                            <input class="form-control" type="text" name="lastname" id="lastName" value="<?= $user['lastname'] ?>" />
                          </div>
                          <div class="mb-3 col-md-4">
                            <label for="email" class="form-label">E-mail</label>
                            <input class="form-control" type="text" id="email" name="email" value="<?= $user['email'] ?>" />
                          </div>
                        </div>
                        <div class="mt-2">
                          <button type="submit" class="btn btn-primary me-2">Enregistrer</button>
                          <button type="reset" class="btn btn-outline-secondary">Annule</button>
                        </div>
                      </form>
                    <?php endif; ?>
                    <?php if ($user['id'] != $_SESSION['auth-client']) : ?>
                      <div class="row">
                        <div class="mb-3 col-md-4">
                          <label class="form-label">Prénom</label>
                          <p class="form-control"><?= $user['firstname'] ?></p>
                        </div>
                        <div class="mb-3 col-md-4">
                          <label class="form-label">Nom</label>
                          <p class="form-control"><?= $user['lastname'] ?></p>
                        </div>
                        <div class="mb-3 col-md-4">
                          <label class="form-label">E-mail</label>
                          <p class="form-control"><?= $user['email'] ?></p>
                        </div>
                      </div>
                    <?php endif; ?>
                  </div>
                </div>
                <div class="card mb-4">
                  <h5 class="card-header"><?= count($posts) ?> Posts</h5>
                  <div class="card-body">
                    <?php foreach ($posts as $post) : ?>
                      <div class="row mb-5">
                        <div class="col-1">
                          <img class="rounded-circle" src="<?= BASE_URL ?>/assets/images/users/default.jpg" alt="avtar" width="100%" />
                        </div>
                        <div class="col-11">
                          <h5>
                            <a href="<?= BASE_URL ?>/user/<?= $user['id'] ?>">
                              <?= ucfirst($user['firstname']) . ' ' . strtoupper($user['lastname']) ?>
                              @<?= $user['username'] ?>
                            </a>
                            <small><?= (new DateTime($post['create_at']))->format('h:i d-m-Y') ?></small>
                          </h5>
                          <p><?= $post['content'] ?></p>
                        </div>
                      </div>
                    <?php endforeach; ?>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="content-backdrop fade"></div>
        </div>
        <!-- Content wrapper -->
      </div>
      <!-- / Layout page -->
    </div>

    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
  </div>
  <?php require(ROOT . 'views/templates/admin/scripts.php'); ?>
</body>

</html>