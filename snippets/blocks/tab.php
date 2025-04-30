<?php 
$tabs = $block->tabs()->toStructure(); 
$tablinie_ausrichtung = $block->tablinie_ausrichtung();
$tab_art = $block->tab_art();

if ($tablinie_ausrichtung == "uk-tab-left" || $tablinie_ausrichtung == "uk-tab-right") {
    $tablinie_ausrichtung_leftright = true;
} else {
    $tablinie_ausrichtung_leftright = false;
}

$switcher_ausrichtung = $block->switcher_ausrichtung();
?>
<?php if($tablinie_ausrichtung_leftright) { ?>
<div uk-grid>
    <div class="uk-width-auto@m">
        <?php } ?>
        <?php if($tab_art != "button") { ?>
        <ul <?php } else { echo '<div'; } ?>
            class="<?php if($tab_art == "uk-tab") { echo $tablinie_ausrichtung; } else if($tab_art == "button") { echo $tablinie_ausrichtung; } else { echo $switcher_ausrichtung; } ?> <?php if($tablinie_ausrichtung != "normal" && $tab_art != "uk-switcher") { echo $tablinie_ausrichtung;} ?> <?php if($tab_art == "uk-switcher") { ?>uk-subnav uk-subnav-pill<?php } ?>"
            <?php if($tab_art == "uk-tab") { 
                if($tablinie_ausrichtung == "uk-tab-left") {
                    echo 'uk-tab="connect: #component-tab-left"';
                } else if($tablinie_ausrichtung == "uk-tab-right") {
                    echo 'uk-tab="connect: #component-tab-right"';
                } else {
                    echo 'uk-tab'; 
                }
                } else if($tab_art == "uk-switcher") { echo 'uk-switcher'; } else { echo 'uk-switcher="toggle: > *"'; } ?>>
            <?php if($tab_art != "button") { ?>
            <?php foreach ($tabs as $tab): ?>
            <?php $toggle_disabled = $tab->toggle_disabled()->toBool(); ?>
            <li <?php if($toggle_disabled === true) { ?>class="uk-disabled" <?php } ?>>
                <a <?php if($toggle_disabled !== true) { ?>href="#" <?php } ?>><?= $tab->headline() ?></a>
            </li>
            <?php endforeach ?>
            <?php } else if($tab_art == "button") { ?>
            <?php foreach ($tabs as $tab): ?>
            <?php $toggle_disabled = $tab->toggle_disabled()->toBool(); ?>
            <button class="uk-button uk-button-default <?php if($toggle_disabled === true) { ?>uk-disabled<?php } ?>"
                type="button"><?= $tab->headline() ?></button>
            <?php endforeach ?>
            <?php } ?>
            <?php if($tab_art != "button") { ?>
        </ul> <?php } else { ?>
    </div> <?php } ?>
    <?php if($tablinie_ausrichtung_leftright) { ?>
</div>
<?php } ?>

<?php if($tablinie_ausrichtung_leftright) { ?>
<div class="uk-width-expand@m">
    <?php } ?>
    <div <?php if($tablinie_ausrichtung == "uk-tab-left") {
                        echo 'id="component-tab-left"';
                    } else if($tablinie_ausrichtung == "uk-tab-right") {
                        echo 'id="component-tab-right"';
                    } ?> class="uk-switcher uk-margin">
        <?php foreach ($tabs as $tab): ?>
        <?= $tab->blocks()->toBlocks(); ?>
        <?php endforeach ?>
    </div>
    <?php if($tablinie_ausrichtung_leftright) { ?>
</div>
<?php } ?>
<?php if($tablinie_ausrichtung_leftright) { ?>
</div>
<?php } ?>