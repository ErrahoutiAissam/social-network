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
                    <h4 class="card-header d-flex justify-content-between align-items-center">
                      Accueil
                    </h4>
                    <form action="<?= BASE_URL ?>/post/add" method="POST" class="px-4">
                      <textarea
                        class="form-control mb-3"
                        type="text"
                        id="firstName"
                        name="content"
                        placeholder="What's happening?"
                      ></textarea>
                      <button type="submit" class="btn btn-primary me-2">
                        Poster
                      </button>
                    </form>
                    <div class="px-4 mt-4"><hr></div>
                    <h4 class="card-header d-flex justify-content-between align-items-center">
                      Posts
                    </h4>
                    <div class="px-4">
                      <?php foreach($posts as $post): ?>
                        <div class="row mb-5">
                          <div class="col-1">
                            <img class="rounded-circle" src="<?= BASE_URL ?>/assets/images/users/default.jpg" alt="avtar" width="100%" />
                          </div>
                          <div class="col-11">
                            <h5>
                              <?= ucfirst($post['firstname']) . ' ' . strtoupper($post['lastname']) ?>
                              <a>@<?= $post['username'] ?></a>
                            </h5>
                            <p><?= $post['content'] ?></p>
                            <div>
                              <?php if($post['liked']): ?>
                                <a href="<?= BASE_URL ?>/unlike/<?= $post['id'] ?>" class="unlike">
                                  <i class="menu-icon tf-icons bx bx-dislike"></i>
                                </a>
                              <?php endif; ?>
                              <?php if(!$post['liked']): ?>
                                <a href="<?= BASE_URL ?>/like/<?= $post['id'] ?>" class="like">
                                  <i class="menu-icon tf-icons bx bx-like"></i>
                                </a>
                              <?php endif; ?>
                              <span><?= $post['nbr_likes'] ?> likes</span>
                            </div>
                          </div>
                        </div>
                      <?php endforeach; ?>
                    </div>
                  </div>
                </div>
                <div class="col-4">
                  <?php require(ROOT . 'views/templates/aside.php'); ?>
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
