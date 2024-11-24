<?php if (count($results) !== 0): ?>
    <table class="table">
        <thead class="box--shadow">
            <tr>
                <th>Titre</th>
                <th>Statut</th>
                <th>Type</th>
                <th>Crée le</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr class="table__emptyRow"></tr>
            <?php foreach ($results as $request): ?>
                <tr class="
                <?= $request['status'] === "DeclinedByManager" || $request['status'] === "DeclinedByBoss" ? "table__row__rejected" :
                    ($request['status'] === "Validated" ? "table__row__validated" : "")
                    ?>">
                    <td><?= esc($request['title']) ?></td>
                    <td><?= esc($request['status']) ?></td>
                    <td><?= esc($request['type']) ?></td>
                    <td><?= esc($request['created_at']) ?></td>
                    <td class="request_list__buttons">
                        <a class="link" href="<?= site_url("request/" . $request['id']) ?>">Voir</a>
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