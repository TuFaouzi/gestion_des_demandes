<?php if (count($results) !== 0): ?>
    <table class="table">
        <thead>
            <tr>
                <th>Titre</th>
                <th>Statut</th>
                <th>Type</th>
                <th>De</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr class="table__emptyRow"></tr>
            <?php foreach ($results as $request): ?>
                <tr>
                    <td><?= esc($request['title']) ?></td>
                    <td><?= esc($request['statusLabel']) ?></td>
                    <td><?= esc($request['type']) ?></td>
                    <td><?= esc($request['firstName'] . ' ' . $request['lastName']) ?></td>
                    <td class="request_list__buttons">
                    <a class="link" href="<?= site_url("manager/request/" . $request['id']) ?>">Voir</a>
                    <a class="link request_list__buttons__approve"
                            href="<?= site_url("manager/approve/" . $request['id']) ?>">Escalader</a>
                        <a class="link request_list__buttons__reject" href="/manager/reject/<?= $request['id']; ?>">Rejeter</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <span class="text--secondary">Aucune requête trouvée</span>
<?php endif; ?>

<div>
    <?= $pager->links() ?>
</div>