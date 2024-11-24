<?= $this->extend('layouts/dashboard/employee') ?>

<?= $this->section('content') ?>
<?= view_cell('ShowRequestCell', 'id='. $id) ?>
<?= $this->endSection() ?>