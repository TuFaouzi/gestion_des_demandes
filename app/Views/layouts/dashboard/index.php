<!DOCTYPE html>
<html>

<head>
    <title><?= $this->renderSection('title', true) ?></title>
    <link rel="stylesheet" href="<?= base_url('css/layouts/dashboard/Index.css') ?>">
    <?= $this->renderSection('style') ?>
</head>

<body>


    <div id="AppLayout">
        <nav id="AppLayout__nav">
            <div class="AppLayout__nav__profile">
                <span>
                    <?= isset($user) ? '' . $user['firstName'] . ' ' . $user['lastName'] : '' ?>
                </span>
            </div>
            <div class="AppLayout__nav__main">
                <?= $this->renderSection('nav-content') ?>
            </div>
        </nav>

        <div class="AppLayout__main">
            <!-- Header -->
            <header class="header pad box--shadow">
                <button id="AppLayout__main__toggleNavBar"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.7.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path d="M0 96C0 78.3 14.3 64 32 64l384 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 128C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32l384 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 288c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32L32 448c-17.7 0-32-14.3-32-32s14.3-32 32-32l384 0c17.7 0 32 14.3 32 32z"/></svg></button>
                <div class="header__main">
                    <a class="header__main__logout link" href="<?= site_url('/logout') ?>">Déconnexion</a>
                </div>
            </header>

            <!-- Main Content -->
            <main>
                <?= $this->renderSection('main-content') ?>
            </main>
        </div>
    </div>

    <script src="<?= base_url('js/toggleNavBar.js') ?>"></script>

</body>

</html>