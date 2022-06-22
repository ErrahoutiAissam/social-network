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
                    <h5>Posts</h5>
                    <div class="d-flex align-items-center">
                      <form class="d-flex mx-4" id="search-posts">
                        <div class="input-group">
                          <span class="input-group-text"><i class="tf-icons bx bx-search"></i></span>
                          <input type="text" class="form-control" placeholder="Chercher posts...">
                        </div>
                      </form>
                      <a href="<?= BASE_URL_ADMIN ?>/post/add" class="menu-link btn btn-primary">
                        <i class="menu-icon tf-icons bx bx-plus"></i>
                        <span>Ajouter</span>
                      </a>
                    </div>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped table-borderless border-bottom">
                        <thead>
                          <tr>
                            <th class="text-nowrap"># ID</th>
                            <th class="text-nowrap text-center">
                              # ID utilisateur
                            </th>
                            <th class="text-nowrap text-center">
                              Crée le
                            </th>
                            <th class="text-nowrap text-center">🖥 Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php foreach ($posts as $post) : ?>
                            <tr>
                              <td class="text-nowrap"><?= $post['id'] ?></td>
                              <td>
                                <div class="d-flex justify-content-center">
                                  <?= $post['id_user'] ?>
                                </div>
                              </td>
                              <td>
                                <div class="d-flex justify-content-center">
                                  <?= $post['create_at'] ?>
                                </div>
                              </td>
                              <td>
                                <div class="d-flex justify-content-around">
                                  <a href="<?= BASE_URL_ADMIN ?>/post/<?= $post['id'] ?>/" title="Voir" type="button" class="btn btn-icon btn-outline-success">
                                    <i class="bx bx-show"></i>
                                  </a>
                                  <a title="Modifier" href="<?= BASE_URL_ADMIN ?>/post/<?= $post['id'] ?>/edit" type="button" class="btn btn-icon btn-outline-warning">
                                    <i class="bx bx-edit"></i>
                                  </a>
                                  <a href="<?= BASE_URL_ADMIN ?>/post/<?= $post['id'] ?>/delete" title="Supprimer" type="button" class="btn btn-icon btn-outline-danger">
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
  <script>
    document.querySelector('#search-posts').addEventListener('submit', (e) => {
      e.preventDefault();
      const query = e.target[0].value;
      if (query != "")
        window.location = `<?= BASE_URL_ADMIN . '/search/posts/' ?>${query}`;
    })
  </script>
</body>

</html>