<?= $this->extend('layouts/dashboard/boss') ?>

<?= $this->section('content') ?>
<?= view_cell('ShowRequestCell', 'id='. $id) ?>
<?= $this->endSection() ?>