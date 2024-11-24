<?= $this->extend('layouts/dashboard/employee') ?>

<?= $this->section('content') ?>
<div class="Employee__requestList box box--shadow">
<span class="Employee__requestList__title title--sub--sub font-medium">Liste des demandes</span>
<?= view_cell('UserRequestListCell', 'limit='. $perPage .', page='. $page) ?>
</div>
<?= $this->endSection() ?>