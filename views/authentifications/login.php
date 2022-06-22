<?php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?= BASE_URL ?>/assets/test.css">
    <title>Se connecter</title>
</head>
<body>
    <form action="<?= BASE_URL ?>/login" method="POST">
        <div class="login-wrap">
            <div class="login-html">
                <h5>Se connecter</h5>
                <div class="login-form">
                    <div class="group">
                        <label for="user" class="label">Username</label>
                        <input id="user" type="text" class="input" name="username">
                    </div>
                    <?php if(isset($errors)): if(isset($errors['username'])): foreach($errors['username'] as $error):?>
                        <div class="error"><?= $error ?></div>
                    <?php endforeach; endif; endif; ?>
                    <div class="group">
                        <label for="pass" class="label">Password</label>
                        <input id="pass" type="password" class="input" name="password">
                    </div>
                    <?php if(isset($errors)): if(isset($errors['password'])): foreach($errors['password'] as $error):?>
                        <div class="error"><?= $error ?></div>
                    <?php endforeach; endif; endif; ?>
                    <?php if(isset($errors)): if(isset($errors['auth'])): ?>
                        <div class="error"><?= $errors['auth'] ?></div>
                    <?php endif; endif; ?>
                    <div class="group">
                        <button type="submit" class="button">
                            Se connecter
                        </button>
                    </div>
                    <div class="foot-lnk">
                        <a href="<?= BASE_URL ?>/register">Vous n'avez encore un compte?</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</body>
</html>