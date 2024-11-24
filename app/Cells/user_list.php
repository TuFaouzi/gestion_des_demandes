<table class="table">
    <thead>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Role</th>
        </tr>
    </thead>
    <tbody>
        <tr class="table__emptyRow"></tr>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= esc($user['firstName']) ?></td>
                <td><?= esc($user['lastName']) ?></td>
                <td><?= esc($user['email']) ?></td>
                <td><?= esc($user['phoneNumber']) ?></td>
                <td><?= esc($user['role']) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<div>
    <?= $pager->links() ?>
</div>
