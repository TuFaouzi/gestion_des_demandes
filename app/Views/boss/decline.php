<?= $this->extend('layouts/dashboard/boss') ?>

<?= $this->section('content') ?>

<div class="form-box box box--shadow">
    <div class="form-box__desc">
        <span class="title--sub--sub font-medium">Rejeter une demande</span>
        <p class="text--secondary">Remplissez ce formulaire pour décliner la demande d'un employé</p>
    </div>
    <form class="form" action="/boss/decline/<?= esc($requestId); ?>" method="POST">
        <?= csrf_field(); ?>

        <div class="form__inputs">
            <div class="form__inputs__input">
                <label for="comment">Commentaire:</label>
                <textarea name="comment" id="comment" required placeholder=""></textarea>
            </div>
        </div>
        <button class="form__submit btn btn--callToAction" type="submit">Décliner</button>
    </form>
</div>

<?= $this->endSection() ?>