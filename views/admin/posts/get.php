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
                <div class="col-md-12">
                  <ul class="nav nav-pills mb-3" role="tablist">
                    <li class="nav-item">
                      <button 
                        type="button"
                        class="nav-link active"
                        role="tab"
                        data-bs-toggle="tab"
                        data-bs-target="#post-infos"
                        aria-controls="post-infos"
                        aria-selected="true"
                      >
                        Informations
                      </button>
                    </li>
                  </ul>
                  <div class="tab-content card">
                    <div class="tab-pane fade show active" id="post-infos" role="tabpanel">
                      <div class="row">
                        <div class="mb-3 col-md-6">
                          <label class="form-label">Contenu</label>
                          <p class="form-control">
                            <?= strToTitle($post['content'], 100) ?>
                          </p>
                        </div>
                        <div class="mb-3 col-md-6">
                          <label class="form-label">Utilisateur</label>
                          <p class="form-control">
                            <a href="<?= BASE_URL_ADMIN ?>/user/<?= $post['id_user'] ?>">
                              <?= $post['id_user'] ?>
                            </a>
                          </p>
                        </div>
                        <div class="mb-3 col-md-6">
                          <label class="form-label">Crée le</label>
                          <p class="form-control">
                            <?= $post['create_at'] ?>
                          </p>
                        </div>
                        <div class="d-flex justify-content-end mt-2">
                          <a
                            title="Supprimer"
                            href="<?= BASE_URL_ADMIN ?>/post/<?= $post['id'] ?>/delete"
                            type="button"
                            class="btn btn-danger mx-3"
                          >
                            <i class="bx bx-trash"></i>
                            Supprimer
                          </a>
                          <a
                            title="Modifier"
                            href="<?= BASE_URL_ADMIN ?>/post/<?= $post['id'] ?>/edit"
                            type="button"
                            class="btn btn-warning"
                          >
                            <i class="bx bx-edit"></i>
                            Modifier
                          </a>
                        </div>
                      </div>
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
