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
                    <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#user-infos" aria-controls="user-infos" aria-selected="true">
                      Informations personnelles
                    </button>
                  </li>
                  <li class="nav-item mx-3">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#user-posts" aria-controls="user-posts" aria-selected="false">
                      Posts
                    </button>
                  </li>
                  <li class="nav-item mx-3">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#user-followers" aria-controls="user-followers" aria-selected="false">
                      Abonnés
                    </button>
                  </li>
                  <li class="nav-item mx-3">
                    <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#user-following" aria-controls="user-following" aria-selected="false">
                      Suivis
                    </button>
                  </li>
                </ul>
                <div class="tab-content card">
                  <div class="tab-pane fade show active" id="user-infos" role="tabpanel">
                    <div class="row">
                      <div class="mb-3 col-md-6">
                        <label class="form-label">Prénom</label>
                        <input disabled class="form-control" type="text" id="firstName" value="<?= $user['firstname'] ?>" />
                      </div>
                      <div class="mb-3 col-md-6">
                        <label class="form-label">Nom</label>
                        <input disabled class="form-control" type="text" value="<?= $user['lastname'] ?>" />
                      </div>
                      <div class="mb-3 col-md-6">
                        <label class="form-label">E-mail</label>
                        <input disabled class="form-control" type="text" value="<?= $user['email'] ?>" />
                      </div>
                      <div class="d-flex justify-content-end mt-2">
                        <?php if ($user['type'] != 'admin') : ?>
                          <a title="Supprimer" href="<?= BASE_URL_ADMIN ?>/user/<?= $user['id'] ?>/delete" type="button" class="btn btn-danger mx-3">
                            <i class="bx bx-trash"></i>
                            Supprimer
                          </a>

                          <a title="Modifier" href="<?= BASE_URL_ADMIN ?>/user/<?= $user['id'] ?>/edit" type="button" class="btn btn-warning">
                            <i class="bx bx-edit"></i>
                            Modifier
                          </a>
                        <?php endif; ?>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="user-posts" role="tabpanel">
                    <div class="table-responsive">
                      <table class="table table-striped table-borderless border-bottom">
                        <thead>
                          <tr>
                            <th class="text-nowrap"># ID post</th>
                            <th class="text-nowrap text-center">Contenu</th>
                            <th class="text-nowrap text-center">Crée le</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach ($posts as $post) : ?>
                            <tr>
                              <td class="text-nowrap">
                                <a href="<?= BASE_URL_ADMIN ?>/post/<?= $post['id'] ?>">
                                  <strong>
                                    <?= $post['id'] ?>
                                  </strong>
                                </a>
                              </td>
                              <td>
                                <div class="d-flex justify-content-center">
                                  <?= strToTitle($post['content'], 10); ?>
                                </div>
                              </td>
                              <td>
                                <div class="d-flex justify-content-center">
                                  <?= (new DateTime($post['create_at']))->format('d/m/Y'); ?>
                                </div>
                              </td>
                            </tr>
                          <?php endforeach; ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="user-followers" role="tabpanel">
                    <div class="table-responsive">
                      <table class="table table-striped table-borderless border-bottom">
                        <thead>
                          <tr>
                            <th class="text-nowrap"># ID follow</th>
                            <th class="text-nowrap text-center"># ID following</th>
                            <th class="text-nowrap text-center">Abonné le</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach ($followers as $follower) : ?>
                            <tr>
                              <td class="text-nowrap">
                                <strong><?= $follower['id'] ?></strong>
                              </td>
                              <td>
                                <div class="d-flex justify-content-center">
                                  <a href="<?= BASE_URL_ADMIN ?>/user/<?= $follower['id_follower'] ?>">
                                    <?= $follower['following_firstname'] . ' ' . $follower['following_lastname']; ?>
                                  </a>
                                </div>
                              </td>
                              <td>
                                <div class="d-flex justify-content-center">
                                  <?= (new DateTime($follower['follow_at']))->format('d-m-Y'); ?>
                                </div>
                              </td>
                            </tr>
                          <?php endforeach; ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="user-following" role="tabpanel">
                    <div class="table-responsive">
                      <table class="table table-striped table-borderless border-bottom">
                        <thead>
                          <tr>
                            <th class="text-nowrap"># ID follow</th>
                            <th class="text-nowrap text-center"># ID following</th>
                            <th class="text-nowrap text-center">Abonné le</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach ($following as $f) : ?>
                            <tr>
                              <td class="text-nowrap">
                                <strong><?= $f['id'] ?></strong>
                              </td>
                              <td>
                                <div class="d-flex justify-content-center">
                                  <a href="<?= BASE_URL_ADMIN ?>/user/<?= $f['id_following'] ?>">
                                    <?= $f['follower_firstname'] . ' ' . $f['follower_lastname']; ?>
                                  </a>
                                </div>
                              </td>
                              <td>
                                <div class="d-flex justify-content-center">
                                  <?= (new DateTime($f['follow_at']))->format('d-m-Y'); ?>
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