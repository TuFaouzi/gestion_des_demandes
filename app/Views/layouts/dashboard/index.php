<!DOCTYPE html>
<html>

<head>
    <title><?= $this->renderSection('title', true) ?></title>
    <link rel="stylesheet" href="<?= base_url('css/layouts/dashboard/Index.css') ?>">
    <?= $this->renderSection('style') ?>
</head>

<body id="AppLayout">
    <!-- Header -->
    <header class="header pad box--shadow">
        <span class="header__title title--sub font-bold"><?= $this->renderSection('title') ?></span>
        <div class="header__main">
            <nav class="nav">
                <?= $this->renderSection('nav-content') ?>
            </nav>
            <a class="header__main__logout link" href="<?= site_url('/logout') ?>">Déconnexion</a>
        </div>
    </header>

    <!-- Main Content -->
    <main class="pad">
        <?= $this->renderSection('main-content') ?>
    </main>

</body>

</html>