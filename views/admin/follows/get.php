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
                    <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#follow-infos" aria-controls="follow-infos" aria-selected="true">
                      Informations
                    </button>
                  </li>
                </ul>
                <div class="tab-content card">
                  <div class="tab-pane fade show active" id="follow-infos" role="tabpanel">
                    <div class="row">
                      <div class="mb-3 col-md-6">
                        <label class="form-label">Abonné</label>
                        <p class="form-control">
                          <a href="<?= BASE_URL_ADMIN ?>/user/<?= $follows['id_following'] ?>">
                            <?= $follows['follower_lastname'] . ' ' . $follows['follower_firstname'] ?>
                          </a>
                        </p>
                      </div>
                      <div class="mb-3 col-md-6">
                        <label class="form-label">Qui abonne</label>
                        <p class="form-control">
                          <a href="<?= BASE_URL_ADMIN ?>/user/<?= $follows['id_follower'] ?>">
                            <?= $follows['following_lastname'] . ' ' . $follows['following_firstname']  ?>
                          </a>
                        </p>
                      </div>
                      <div class="mb-3 col-md-6">
                        <label class="form-label">Abonné le</label>
                        <p class="form-control">
                          <?= (new DateTime($follows['follow_at']))->format('d-m-Y') ?>
                        </p>
                      </div>
                      <div class="d-flex justify-content-end mt-2">
                        <a title="Supprimer" href="<?= BASE_URL_ADMIN ?>/follows/<?= $follows['id'] ?>/delete" type="button" class="btn btn-danger mx-3">
                          <i class="bx bx-trash"></i>
                          Supprimer
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