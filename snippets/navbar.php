<?php 
$toggle_preheader = $site->toggle_preheader()->or('davor');
?>

<?php if($toggle_preheader == "davor") : ?>
<?php snippet('blocks/preheader') ?>
<?php endif; ?>

<?php snippet('blocks/header') ?>

<?php if($toggle_preheader == "danach") : ?>
<?php snippet('blocks/preheader') ?>
<?php endif; ?>