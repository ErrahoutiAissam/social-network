<!DOCTYPE html>
<html lang="fr">
  <?php require(ROOT . 'views/templates/admin/head.php'); ?>
  <body>
    <?php if(isset($success)): if ($success): ?>
      <div
        class="alert alert-info alert-dismissible position-absolute"
        style="right: 20px; top: 20px"
        role="alert"
      >
        Vous êtes enregistré avec succées
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="alert"
          aria-label="Close"
        ></button>
      </div>
    <?php endif; endif; ?>
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
                    S'inscrire
                  </span>
                </a>
              </div>
              <form class="mb-3" action="" method="POST">
                <div class="mb-3">
                  <label for="firstname" class="form-label">prenom</label>
                  <input
                    type="text"
                    class="form-control"
                    id="firstname"
                    name="firstname"
                    placeholder="Entrer votre prénom"
                    autofocus
                  />
                </div>
                <?php if(isset($errors['firstname'])): ?>
                  <ul>
                    <?php foreach($errors['firstname'] as $error): ?>
                      <li class="form-text text-danger"><?= $error ?></li>
                    <?php endforeach; ?>
                  </ul>
                <?php endif; ?>
                <div class="mb-3">
                  <label for="lastname" class="form-label">nom</label>
                  <input
                    type="text"
                    class="form-control"
                    id="lastname"
                    name="lastname"
                    placeholder="Entrer votre nom"
                  />
                </div>
                <?php if(isset($errors['lastname'])): ?>
                  <ul>
                    <?php foreach($errors['lastname'] as $error): ?>
                      <li class="form-text text-danger"><?= $error ?></li>
                    <?php endforeach; ?>
                  </ul>
                <?php endif; ?>
                <div class="mb-3">
                  <label for="username" class="form-label">
                    nom d'utilisateur
                  </label>
                  <input
                    type="text"
                    class="form-control"
                    id="username"
                    name="username"
                    placeholder="Entrer votre nom d'utilisateur"
                  />
                </div>
                <?php if(isset($errors['username'])): ?>
                  <ul>
                    <?php foreach($errors['username'] as $error): ?>
                      <li class="form-text text-danger"><?= $error ?></li>
                    <?php endforeach; ?>
                  </ul>
                <?php endif; ?>
                <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input
                    type="text"
                    class="form-control"
                    id="email"
                    name="email"
                    placeholder="Entrer votre mail"
                  />
                </div>
                <?php if(isset($errors['email'])): ?>
                  <ul>
                    <?php foreach($errors['email'] as $error): ?>
                      <li class="form-text text-danger"><?= $error ?></li>
                    <?php endforeach; ?>
                  </ul>
                <?php endif; ?>
                <div class="mb-3 form-password-toggle">
                  <label class="form-label" for="password">mot de passe</label>
                  <div class="input-group input-group-merge">
                    <input
                      type="password"
                      id="password"
                      class="form-control"
                      name="password"
                      placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                      aria-describedby="password"
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
                <button class="btn btn-primary d-grid w-100">S'inscrire</button>
              </form>

              <p class="text-center">
                <span>Avez-vous déja un compte ?</span>
                <a href="<?= BASE_URL_ADMIN ?>/login">
                  <span>Se connecter</span>
                </a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php require(ROOT . 'views/templates/admin/scripts.php'); ?>
  </body>
</html>