<!DOCTYPE html>
<html lang="fr" class="light-style layout-menu-fixed">
  <?php require(ROOT . 'views/templates/admin/head.php'); ?>
  <body>
    <div class="layout-wrapper layout-content-navbar layout-without-menu">
      <div class="layout-container">
        <div class="layout-page">
          <?php require(ROOT . 'views/templates/navbar.php'); ?>
          <div class="content-wrapper">
            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">
                <div class="col-8 container">
                  <div class="card">
                    <h4 class="mb-2 card-header d-flex justify-content-between align-items-center">
                      Résultat de la requête: "<?= $query ?>"
                    </h4>
                    <div class="px-4">
                      <?php if (count($results) > 0): ?>
                        <?php foreach ($results as $r): ?>
                          <div class="row mb-5">
                            <div class="col-1 d-flex align-items-center">
                              <img class="rounded-circle" src="<?= BASE_URL ?>/assets/images/users/default.jpg" alt="avtar" width="100%" />
                            </div>
                            <div class="col-11 d-flex align-items-center">
                              <h5 class="m-0">
                                <a href="<?= BASE_URL ?>/user/<?= $r['id'] ?>">
                                  <?= ucfirst($r['firstname']) . ' ' . strtoupper($r['lastname']) ?>
                                  @<?= $r['username'] ?>
                                </a>
                              </h5>
                            </div>
                          </div>
                        <?php endforeach; ?>
                      <?php endif; ?>
                      <?php if (count($results) == 0): ?>
                        <h5>Pas de résultat pour la requête: "<?= $query ?>"</h5>
                      <?php endif; ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <?php require(ROOT . 'views/templates/admin/scripts.php'); ?>
    <script>
      const likes = document.querySelectorAll('.like, .unlike');
      [...likes].forEach((elem) => {
        elem.addEventListener('click', (e) => {
          e.preventDefault();
          fetch(elem.href)
            .then(result => result.json())
            .then(({success, message, nbr_likes} )=> {
              if (success) {
                elem.nextElementSibling.innerHTML = `${nbr_likes} likes`;
                if (elem.className === "like") {
                  console.log('prev href', elem.href);
                  elem.href = elem.href.replace('like', 'unlike');
                  elem.classList.remove('like')
                  elem.classList.add('unlike')
                  elem.children[0].classList.remove('bx-like')
                  elem.children[0].classList.add('bx-dislike')
                  elem.title = 'unlike'
                } else if (elem.className === "unlike") {
                  elem.href = elem.href.replace('unlike', 'like');
                  elem.classList.remove('unlike')
                  elem.classList.add('like')
                  elem.children[0].classList.remove('bx-dislike')
                  elem.children[0].classList.add('bx-like')
                  elem.title = 'like'
                }
              }
            })
        });
      });
      document.querySelector('.search-form').addEventListener('submit', (e) => {
        e.preventDefault();
        const query = e.target[0].value;
        if (query != "")
          window.location += `search/${query}`;
      })
    </script>
  </body>
</html>
