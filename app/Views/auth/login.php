<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <link rel="stylesheet" href="<?= base_url('css/auth/login.css') ?>">
</head>

<body id="Login">
    <main class="Login__main">
        <span class="title font-bold">Connectez-vous à votre compte</span>

        <form class="form" method="post" action="<?= site_url('/login') ?>">
            <?= csrf_field() ?>
            <div class="form__inputs">
                <div class="form__inputs__input">
                    <input type="email" name="email" placeholder="Email" required>
                </div>
                <div class="form__inputs__input">
                    <input class="form__inputs__input" type="password" name="password" placeholder="Mot de passe" required>
                </div>
            </div>
            <?php if (session()->getFlashdata('error')): ?>
                <p class="form__error"><?= session()->getFlashdata('error'); ?></p>
            <?php endif; ?>
            <button class="form__submit btn btn--callToAction" type="submit">Login</button>
        </form>
    </main>
</body>

</html>