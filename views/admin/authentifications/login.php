<!DOCTYPE html>
<html lang="fr">
  <?php require(ROOT . 'views/templates/admin/head.php'); ?>
  <body>
    <?php if(isset($errors['auth'])): ?>
      <div
        class="alert alert-danger alert-dismissible position-absolute"
        style="right: 20px; top: 20px"
        role="alert"
      >
        <?= $errors['auth'] ?>
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="alert"
          aria-label="Close"
        ></button>
      </div>
    <?php endif; ?>
    <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
          <div class="card">
            <div class="card-body">
              <div class="app-brand justify-content-center">
                <a class="app-brand-link gap-2">
                  <span
                    class="app-brand-text demo text-body fw-bolder"
                    style="text-transform: inherit"
                  >
                    Se connecter
                  </span>
                </a>
              </div>
              <form class="mb-3" method="POST">
                <div class="mb-3">
                  <label for="username" class="form-label">
                    Nom d'utilisateur
                  </label>
                  <input
                    type="text"
                    class="form-control"
                    id="username"
                    name="username"
                    placeholder="Enter votre nom d'utilisateur"
                    autofocus
                    autocomplete="off"
                  />
                </div>
                <?php if(isset($errors['username'])): ?>
                  <ul>
                    <?php foreach($errors['username'] as $error): ?>
                      <li class="form-text text-danger"><?= $error ?></li>
                    <?php endforeach; ?>
                  </ul>
                <?php endif; ?>
                <div class="mb-3 form-password-toggle">
                  <label class="form-label" for="password">Password</label>
                  <div class="input-group input-group-merge">
                    <input
                      type="password"
                      id="password"
                      class="form-control"
                      name="password"
                      placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                    />
                    <span class="input-group-text cursor-pointer"
                      ><i class="bx bx-hide"></i
                    ></span>
                  </div>
                </div>
                <?php if(isset($errors['password'])): ?>
                  <ul>
                    <?php foreach($errors['password'] as $error): ?>
                      <li class="form-text text-danger"><?= $error ?></li>
                    <?php endforeach; ?>
                  </ul>
                <?php endif; ?>
                <div class="mb-3">
                  <button class="btn btn-primary d-grid w-100" type="submit">
                    Se connecter
                  </button>
                </div>

                <p class="text-center">
                  <span>Vous n'avez pas un compte ?</span>
                  <a href="<?= BASE_URL_ADMIN ?>/register">
                    <span>S'inscrire</span>
                  </a>
                </p>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php require(ROOT . 'views/templates/admin/scripts.php'); ?>
  </body>
</html>