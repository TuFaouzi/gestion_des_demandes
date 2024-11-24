<?= $this->extend('layouts/dashboard/index') ?>

<?= $this->section('style') ?>
<link rel="stylesheet" href="<?= base_url('css/layouts/dashboard/manager.css') ?>">
<?= $this->endSection() ?>

<?= $this->section('title') ?>
Gestion des requêtes
<?= $this->endSection() ?>

<?= $this->section('nav-content') ?>
<a class="link <?= uri_string() == "" ? 'nav__selected' : '' ?>" href="<?= site_url('/') ?>">Tableau de bord</a>
<?= $this->endSection() ?>

<?= $this->section('main-content') ?>
<?= $this->renderSection('content') ?>
<?= $this->endSection() ?>
