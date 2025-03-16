<?php
$headline = $block->headline();
$toggle_open = $block->toggle_open()->toBool();
$blocks = $block->blocks()->toBlocks();
?>

<li <?php if($toggle_open === true) { ?>class="uk-open" <?php } ?>>
    <a class="uk-accordion-title" href><?= $headline ?></a>
    <div class="uk-accordion-content">
        <?= $blocks ?>
    </div>
</li>