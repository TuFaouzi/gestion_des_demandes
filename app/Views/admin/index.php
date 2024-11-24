<?= $this->extend('layouts/dashboard/admin') ?>

<?= $this->section('content') ?>
<div class="Admin__userList users box box--shadow">
    <span class="Admin__userList__title title--sub--sub font-medium">Liste des utilisateurs</span>
    <?= view_cell('UserListCell', 'limit='. $perPage .', page='. $page) ?>
</div>
<?= $this->endSection() ?>