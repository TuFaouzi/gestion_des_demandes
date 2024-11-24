<?= $this->extend('layouts/dashboard/admin') ?>

<?= $this->section('content') ?>

<div class="form-box box box--shadow">
    <div class="form-box__desc">
        <span class="title--sub--sub font-medium">Ajouter un utilisateur</span>
        <p class="text--secondary">Remplissez ce formulaire pour ajouter un utilisateur au système</p>
    </div>
    <form class="form" method="post" action="<?= site_url('admin/add-user') ?>">
        <?= csrf_field() ?>
        <div class="form__inputs">
            <div class="form__inputs__input">
                <label>First Name:</label>
                <input placeholder="" type="text" name="firstName" value="<?= set_value('firstName') ?>" required>
                <?php if (isset($errors['firstName'])): ?>
                    <span><?= $errors['firstName']; ?></span>
                <?php endif; ?>
            </div>
            <div class="form__inputs__input">
                <label>Last Name:</label>
                <input placeholder="" type="text" name="lastName" value="<?= set_value('lastName') ?>" required>
                <?php if (isset($errors['lastName'])): ?>
                    <span><?= $errors['lastName']; ?></span>
                <?php endif; ?>
            </div>
            <div class="form__inputs__input">
                <label>Email:</label>
                <input placeholder="" type="email" name="email" value="<?= set_value('email') ?>" required>
                <?php if (isset($errors['email'])): ?>
                    <span><?= $errors['email']; ?></span>
                <?php endif; ?>
            </div>
            <div class="form__inputs__input">
                <label>Numéro de téléphone:</label>
                <input placeholder="" type="tel" name="phoneNumber" value="<?= set_value('phoneNumber') ?>" required>
                <?php if (isset($errors['phoneNumber'])): ?>
                    <span><?= $errors['phoneNumber']; ?></span>
                <?php endif; ?>
            </div>
            <div class="form__inputs__input">
                <label>Password:</label>
                <input placeholder="" type="password" name="password" required>
                <?php if (isset($errors['password'])): ?>
                    <span><?= $errors['password']; ?></span>
                <?php endif; ?>
            </div>
            <div class="form__inputs__input">
                <label>Role:</label>
                <select name="role">
                    <option value="Employee">Employee</option>
                    <option value="Manager">Manager</option>
                    <option value="Boss">Boss</option>
                </select>
            </div>
        </div>
        <button class="form__submit btn btn--callToAction" type="submit">Ajouter l'utilisateur</button>
    </form>
</div>
<?= $this->endSection() ?>