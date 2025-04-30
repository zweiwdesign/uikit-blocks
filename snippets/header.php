<!DOCTYPE html>
<html class="cc--dbtr" lang="<?= $site->lang() ?>" style="scrollbar-gutter: stable;">

<head>
    <?php snippet('seo/head'); ?>
    <?php snippet('cookieconsentCss') ?>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" type="image/x-icon" href="<?= $site->favicon()->toFile()->url() ?>">
    <?php $items = $site->scripts()->toStructure(); foreach ($items as $item): ?>
    <script type="text/plain" data-category="<?= $item->datacategory() ?>" data-service="<?= $item->dataservice() ?>">
        <?= $item->code() ?>
        </script>
    <?php endforeach ?>

    <!-- UIkit CSS -->

    <?php
$primaryFont = option('primaryfont', $kirby->page('style')->primaryfont()->toFile());
$secondaryFont = option('secondaryfont', $kirby->page('style')->secondaryfont()->toFile());
?>

    <style>
    <?php if ($primaryFont): ?>@font-face {
        font-family: 'PrimaryFont';
        src: url('<?= $primaryFont->url() ?>') format('<?= $primaryFont->extension() ?>');
    }

    :root {
        --primary-font: 'PrimaryFont', Arial, sans-serif;
    }

    <?php else:?> :root {
        --primary-font: Arial, sans-serif;
    }

    <?php endif;

    ?><?php if ($secondaryFont): ?>@font-face {
        font-family: 'SecondaryFont';
        src: url('<?= $secondaryFont->url() ?>') format('<?= $secondaryFont->extension() ?>');
    }

    :root {
        --secondary-font: 'SecondaryFont', Arial, sans-serif;
    }

    <?php else:?> :root {
        --primary-font: Arial, sans-serif;
    }

    <?php endif;
    ?>
    </style>
    <?php
        // Pfad zur CSS-Datei
        $cssFilePath = kirby()->root('index') . '/assets/css/uikit-theme.css';

        // Prüfen, ob die Datei existiert, und den Zeitstempel holen
        if (file_exists($cssFilePath)) {
            $version = filemtime($cssFilePath);
        } else {
            $version = time(); // Falls die Datei nicht existiert, verwenden wir den aktuellen Zeitpunkt
        }
        ?>
    <link rel="stylesheet" href="<?= url('assets/css/uikit-theme.css') ?>?v=<?= $version ?>">

    <!-- UIkit JS -->
    <script src="<?= url('/vendor/uikit/uikit/dist/js/uikit.min.js') ?>"></script>
    <script src="<?= url('/vendor/uikit/uikit/dist/js/uikit-icons.min.js') ?>"></script>
</head>

<body>
    <?php snippet('navbar') ?>