<!DOCTYPE html>
<html lang="fr" class="light-style layout-menu-fixed">
  <?php require(ROOT . 'views/templates/admin/head.php'); ?>
  <body>
    <?php if(isset($success)): if ($success): ?>
      <div
        class="alert alert-info alert-dismissible position-absolute"
        style="right: 25px; top: 85px;"
        role="alert"
      >
        La modification a réussi
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="alert"
          aria-label="Close"
        ></button>
      </div>
    <?php endif; endif; if(isset($errors['state'])): ?>
      <div
        class="alert alert-danger alert-dismissible position-absolute"
        style="right: 25px; top: 85px;"
        role="alert"
      >
        La modification a echoué
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="alert"
          aria-label="Close"
        ></button>
      </div>
    <?php endif; ?>
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <?php require(ROOT . 'views/templates/admin/aside.php'); ?>

        <div class="layout-page">
          <?php require(ROOT . 'views/templates/admin/navbar.php'); ?>
          <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">
                <div class="col-md-12">
                  <ul class="nav nav-pills flex-column flex-md-row mb-3">
                    <li class="nav-item">
                      <a class="nav-link active" href="javascript:void(0);">
                        <i class="bx bx-user me-1"></i>
                        Compte
                      </a>
                    </li>
                  </ul>
                  <div class="card mb-4">
                    <h5 class="card-header">Informations personnelles</h5>
                    <hr class="my-0" />
                    <div class="card-body">
                      <form action="<?= BASE_URL_ADMIN ?>/user/<?= $user['id'] ?>/edit" method="POST">
                        <div class="row">
                          <div class="mb-3 col-md-6">
                            <label for="firstName" class="form-label">Prénom</label>
                            <input
                              class="form-control"
                              type="text"
                              id="firstName"
                              name="firstname"
                              value="<?= $user['firstname'] ?>"
                            />
                          </div>
                          <?php if (isset($errors['firstname'])): ?>
                            <ul>
                              <?php foreach ($errors['firstname'] as $value): ?>
                                <li class="form-text text-danger"><?= $value ?></li>
                              <?php endforeach; ?>
                            </ul>
                          <?php endif; ?>
                          <div class="mb-3 col-md-6">
                            <label for="lastName" class="form-label">Nom</label>
                            <input
                              class="form-control"
                              type="text"
                              name="lastname"
                              id="lastName"
                              value="<?= $user['lastname'] ?>"
                            />
                          </div>
                          <?php if (isset($errors['lastname'])): ?>
                            <ul>
                              <?php foreach ($errors['lastname'] as $value): ?>
                                <li class="form-text text-danger"><?= $value ?></li>
                              <?php endforeach; ?>
                            </ul>
                          <?php endif; ?>
                          <div class="mb-3 col-md-6">
                            <label for="email" class="form-label">E-mail</label>
                            <input
                              class="form-control"
                              type="text"
                              id="email"
                              name="email"
                              value="<?= $user['email'] ?>"
                            />
                          </div>
                          <?php if (isset($errors['email'])): ?>
                            <ul>
                              <?php foreach ($errors['email'] as $value): ?>
                                <li class="form-text text-danger"><?= $value ?></li>
                              <?php endforeach; ?>
                            </ul>
                          <?php endif; ?>
                        </div>
                        <div class="mt-2">
                          <button type="submit" class="btn btn-primary me-2">
                            Enregistrer
                          </button>
                        </div>
                      </form>
                    </div>
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
