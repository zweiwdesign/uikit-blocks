<?php
$table = $block->table()->toTable(); 

$size = $block->size();
$ausrichtung = $block->ausrichtung();
$toggle_divider = $block->toggle_divider()->toBool();
$toggle_striped = $block->toggle_striped()->toBool()
?>

<?php if (!empty($table['headers']) && !empty($table['rows'])): ?>
<table
    class="uk-table uk-overflow-auto <?= $size ?> <?= $ausrichtung ?> <?php if($toggle_divider === true) { echo 'uk-table-divider'; } ?><?php if($toggle_striped === true) { echo ' uk-table-striped'; } ?>">
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
<?php endif ?>