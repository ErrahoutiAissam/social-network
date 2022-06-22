<?php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?= BASE_URL ?>/assets/test.css">
    <title>Sign up</title>
</head>
<body>
    <?php if(isset($success)): if($success): ?>
        <div class="alert alert-info">
            Vous avez inscrit avec succés
        </div>
    <?php endif; endif; ?>
    <form action="<?= BASE_URL ?>/register" method="POST">
        <div class="login-wrap">
            <div class="login-html">
                <h5>S'inscrire</h5>
                <div class="login-form">
                    <div class="group">
                        <label for="firstuser" class="label">Prénom</label>
                        <input id="firstuser" type="text" class="input" name="firstname">
                    </div>
                    <?php if(isset($errors)): if(isset($errors['firstname'])): foreach($errors['firstname'] as $error):?>
                        <div class="error"><?= $error ?></div>
                    <?php endforeach; endif; endif; ?>
                    <div class="group">
                        <label for="lastname" class="label">Nom</label>
                        <input id="lastname" type="text" class="input" name="lastname">
                    </div>
                    <?php if(isset($errors)): if(isset($errors['lastname'])): foreach($errors['lastname'] as $error):?>
                        <div class="error"><?= $error ?></div>
                    <?php endforeach; endif; endif; ?>
                    <div class="group">
                        <label class="label">Username</label>
                        <input type="text" class="input" name="username">
                    </div>
                    <?php if(isset($errors)): if(isset($errors['username'])): foreach($errors['username'] as $error):?>
                        <div class="error"><?= $error ?></div>
                    <?php endforeach; endif; endif; ?>
                    <div class="group">
                        <label class="label">Password</label>
                        <input type="password" class="input" name="password">
                    </div>
                    <?php if(isset($errors)): if(isset($errors['password'])): foreach($errors['password'] as $error):?>
                        <div class="error"><?= $error ?></div>
                    <?php endforeach; endif; endif; ?>
                    <div class="group">
                        <label for="email" class="label">Email Address</label>
                        <input id="email" type="text" class="input" name="email">
                    </div>
                    <?php if(isset($errors)): if(isset($errors['email'])): foreach($errors['email'] as $error):?>
                        <div class="error"><?= $error ?></div>
                    <?php endforeach; endif; endif; ?>
                    <?php if(isset($errors)): if(isset($errors['auth'])): ?>
                        <div class="error"><?= $errors['auth'] ?></div>
                    <?php endif; endif; ?>
                    <div class="group">
                        <button type="submit" class="button">
                            Sign Up
                        </button>
                    </div>
                    <div class="foot-lnk">
                        <a href="<?= BASE_URL ?>/login">Avez-vous déja un compte?</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</body>
</html>