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
                  <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                      <h5>Abonnés</h5>
                      <a href="<?= BASE_URL_ADMIN ?>/follows/add" class="menu-link btn btn-primary">
                        <i class="menu-icon tf-icons bx bx-plus"></i>
                        <span>Ajouter</span>
                      </a>
                    </div>
                    <div class="card-body">
                      <div class="table-responsive">
                        <table
                          class="table table-striped table-borderless border-bottom"
                        >
                          <thead>
                            <tr>
                              <th class="text-nowrap"># ID</th>
                              <th class="text-nowrap text-center">
                                # ID abonné
                              </th>
                              <th class="text-nowrap text-center">
                                # ID qui abonne
                              </th>
                              <th class="text-nowrap text-center">
                                Abonné le
                              </th>
                              <th class="text-nowrap text-center">🖥 Actions</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php foreach($follows as $f): ?>
                              <tr>
                                <td class="text-nowrap"><?= $f['id'] ?></td>
                                <td>
                                  <div class="d-flex justify-content-center">
                                    <a href="<?= BASE_URL_ADMIN ?>/user/<?= $f['id_following'] ?>/">
                                      <?= $f['follower_lastname'] . ' ' . $f['follower_firstname'] ?>
                                    </a>
                                  </div>
                                </td>
                                <td>
                                  <div class="d-flex justify-content-center">
                                    <a href="<?= BASE_URL_ADMIN ?>/user/<?= $f['id_follower'] ?>/">
                                      <?= $f['following_lastname'] . ' ' . $f['following_firstname'] ?>
                                    </a>
                                  </div>
                                </td>
                                <td>
                                  <div class="d-flex justify-content-center">
                                    <?= (new DateTime($f['follow_at']))->format('d-m-Y') ?>
                                  </div>
                                </td>
                                <td>
                                  <div class="d-flex justify-content-around">
                                    <a
                                      href="<?= BASE_URL_ADMIN ?>/follows/<?= $f['id'] ?>/"
                                      title="Voir"
                                      type="button"
                                      class="btn btn-icon btn-outline-success"
                                    >
                                      <i class="bx bx-show"></i>
                                    </a>
                                    <a
                                      href="<?= BASE_URL_ADMIN ?>/follows/<?= $f['id'] ?>/delete"
                                      title="Supprimer"
                                      type="button"
                                      class="btn btn-icon btn-outline-danger"
                                    >
                                      <i class="bx bx-trash"></i>
                                    </a>
                                  </div>
                                </td>
                              </tr>
                            <?php endforeach; ?>
                          </tbody>
                        </table>
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
