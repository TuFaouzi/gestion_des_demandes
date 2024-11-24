<?= $this->extend('layouts/dashboard/employee'); ?>

<?= $this->section('content'); ?>
<?php if (session()->getFlashdata('errors')): ?>
    <ul class="errors">
        <?php foreach (session()->getFlashdata('errors') as $error): ?>
            <li><?= esc($error); ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<div class="form-box box box--shadow">
    <div class="form-box__desc">
        <span class="title--sub--sub font-medium">Faire une demande</span>
        <p class="text--secondary">Remplissez ce formulaire pour faire une demande</p>
    </div>

    <form class="form" action="<?= site_url('/employee/add-request') ?>" method="post">
        <?= csrf_field() ?>

        <div class="form__inputs">
            <div class="form__inputs__input">
                <label for="title">Title:</label>
                <input type="text" name="title" id="title" value="<?= old('title') ?>" placeholder="" required>
            </div>

            <div class="form__inputs__input">
                <label for="title">Description:</label>
                <textarea name="comment" id="comment" value="<?= old('comment') ?>" placeholder="" required></textarea>
            </div>

        </div>
        <div class="form__inputs__input">
            <label for="type_id">Type:</label>
            <select name="type_id" id="type_id" required>
                <option value="">Type de la demande</option>
                <?php foreach ($types as $type): ?>
                    <option value="<?= esc($type['id']) ?>" <?= set_select('type_id', $type['id']) ?>>
                        <?= esc($type['label']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <button class="form__submit btn btn--callToAction" type="submit">Envoyer la demande</button>
    </form>
</div>

<?= $this->endSection(); ?>