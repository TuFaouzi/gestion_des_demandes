<?= $this->extend('layouts/dashboard/boss') ?>

<?= $this->section('content') ?>
<div class="Boss__stats box box--shadow">
    <div class="Boss__stats__desc">
        <span class="Boss__requestList__title title--sub--sub font-medium">Apercus des demandes</span>
        <p class="text--secondary">Résumé de toutes les demandes et leurs status actuel</p>
    </div>
    <div class="Boss__stats__content">
        <div class="stats-box box box--shadow">
            <div class="text--secondary">Demandes en attentes</div>
            <span class="title--sub font-bold"><?= esc($pendingRequestsCount) ?></span>
        </div>
        <div class="stats-box box box--shadow">
            <div class="text--secondary">Approuvées</div>
            <span class="title--sub font-bold"><?= esc($approvedRequestsCount) ?></span>
        </div>
        <div class="stats-box box box--shadow">
            <div class="text--secondary">Rejetées</div>
            <span class="title--sub font-bold"><?= esc($rejectedRequestsCount) ?></span>
        </div>
        <div class="stats-box box box--shadow">
            <div class="text--secondary">Escaladées</div>
            <span class="title--sub font-bold"><?= esc($forwardedRequestsCount) ?></span>
        </div>
    </div>
</div>
<div class="Boss__requestList box box--shadow">
    <span class="Boss__requestList__title title--sub--sub font-medium">Liste des demandes</span>
    <?= view_cell('BossRequestListCell', 'limit='. $perPage .', page='. $page) ?>
</div>
<?= $this->endSection() ?>