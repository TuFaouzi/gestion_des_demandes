<?= $this->extend('layouts/dashboard/manager') ?>

<?= $this->section('content') ?>
<?= view_cell('ShowRequestCell', 'id='. $id) ?>
<?= $this->endSection() ?>