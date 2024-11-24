<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('css/request/request.css') ?>">
    <title>Request</title>
</head>

<body>
    <div class="showRequest">
        <div class="showRequest__main box box--shadow">
            <a class="link link__secondary" href="<?= site_url('/') ?>">Retour au tableau de bord</a>
            <div class="showRequest__main__header">
                <span class="title--sub font-bold"><?= $request['title'] ?></span>
                <div>
                    <span>Status: </span>
                    <span
                        class=" <?= $request['status'] === 'Validated' ? 'text--approved' : '' ?> <?= $request['status'] === 'DeclinedByBoss' || $request['status'] === 'DeclinedByManager' ? 'text--danger' : '' ?>"><?= $request['statusLabel'] ?></span>
                </div>
                <div>
                    <span>par</span>
                    <span class="text--secondary">
                        <?= $request['firstName'] . ' ' . $request['lastName'] ?></span>
                </div>
                <div>
                    <span>pour </span>
                    <span class="text--secondary"><?= $request['type'] ?></span>
                </div>
            </div>
            <div class="showRequest__main__body">
                <?php foreach ($interactions as $interaction) { ?>
                    <?php if ($interaction['status'] === 'Waiting'): ?>
                        <div class="showRequest__main__body__desc">
                            <span class="title--sub--sub">Description de la demande</span>
                            <p><?= $interaction['comment'] ?></p>
                        </div>
                    <?php endif; ?>
                <?php } ?>
            </div>

            <?php foreach ($interactions as $interaction) { ?>
                <?php if ($interaction['status'] === 'DeclinedByManager'): ?>
                    <div class="showRequest__main__box">
                        <span class="title--sub--sub showRequest__main__title">Commentaire du Responsable</span>
                        <p><?= $interaction['comment'] ?></p>
                    </div>
                <?php endif; ?>
            <?php } ?>

            <?php foreach ($interactions as $interaction) { ?>
                <?php if ($interaction['status'] === 'DeclinedByBoss'): ?>
                    <div class="showRequest__main__box">
                        <span class="title--sub--sub showRequest__main__title">Commentaire du Manager</span>
                        <p><?= $interaction['comment'] ?></p>
                    </div>
                <?php endif; ?>
            <?php } ?>
        </div>
    </div>
</body>

</html>