<?php
$table = $block->table()->toTable(); 

$size = $block->size();
$ausrichtung = $block->ausrichtung();
$toggle_divider = $block->toggle_divider()->toBool();
$toggle_striped = $block->toggle_striped()->toBool();
?>

<?php if (!empty($table['headers']) && !empty($table['rows'])): ?>
<div class="uk-overflow-auto">
    <table
        class="uk-table <?= $size ?> <?= $ausrichtung ?><?php if($toggle_divider) { echo ' uk-table-divider'; } ?><?php if($toggle_striped) { echo ' uk-table-striped'; } ?>">
        <thead>
            <tr>
                <?php foreach ($table['headers'] as $header): ?>
                <th><?= $header ?></th>
                <?php endforeach ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($table['rows'] as $row): ?>
            <tr>
                <?php foreach ($row as $cell): ?>
                <td><?= $cell ?></td>
                <?php endforeach ?>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>
<?php endif ?>