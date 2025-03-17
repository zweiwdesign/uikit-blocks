<?php
namespace TilmannRuppert\UIKITLess;

use Kirby\Cms\App;
use Kirby\Exception\Exception;
use Kirby\Http\Response;
use Less_Parser;

require_once kirby()->root('index') . "/vendor/wikimedia/less.php/lib/Less/Autoloader.php";
\Less_Autoloader::register();

Kirby::plugin('tilmannruppert/uikit-blocks', [
    'routes' => [
        [
            'pattern' => '/assets/js/uikit.min.js',
            'action'  => function () {
                $filePath = kirby()->root('index') . '/vendor/uikit/uikit/dist/js/uikit.min.js';
                return file_exists($filePath) ? Response::file($filePath, ['mime' => 'application/javascript']) : Response::json(['error' => 'File not found'], 404);
            }
        ],
        [
            'pattern' => '/assets/js/uikit-icons.min.js',
            'action'  => function () {
                $filePath = kirby()->root('index') . '/vendor/uikit/uikit/dist/js/uikit-icons.min.js';
                return file_exists($filePath) ? Response::file($filePath, ['mime' => 'application/javascript']) : Response::json(['error' => 'File not found'], 404);
            }
        ]
    ],
    'blueprints' => [
        'pages/uikit-less' => __DIR__ . '/blueprints/pages/uikit-less.yml',
        'pages/default' => __DIR__ . '/blueprints/pages/default.yml',
        'fields/uikit' => __DIR__ . '/blueprints/fields/base.yml',
        'fields/subblocks' => __DIR__ . '/blueprints/fields/subblocks.yml',
        'fields/sections' => function ($kirby) {
            return include __DIR__ . '/blueprints/fields/sections.php';
        },
        'blocks/buttons' => __DIR__ . '/blueprints/blocks/buttons.yml',
        'blocks/button' => __DIR__ . '/blueprints/blocks/button.yml',
        'blocks/overlay' => __DIR__ . '/blueprints/blocks/overlay.yml',
        'blocks/heading' => __DIR__ . '/blueprints/blocks/heading.yml',
        'blocks/list' => __DIR__ . '/blueprints/blocks/list.yml',
        //'blocks/image' => __DIR__ . '/blueprints/blocks/image.yml',
        'blocks/text' => __DIR__ . '/blueprints/blocks/text.yml',
        'blocks/card' => __DIR__ . '/blueprints/blocks/card.yml',
        'blocks/divider' => __DIR__ . '/blueprints/blocks/divider.yml',
        'blocks/iconflex' => __DIR__ . '/blueprints/blocks/iconflex.yml',
        'blocks/countup' => __DIR__ . '/blueprints/blocks/countup.yml',
        'blocks/table' => __DIR__ . '/blueprints/blocks/table.yml',
        'blocks/accordion' => __DIR__ . '/blueprints/blocks/accordion.yml',
        'blocks/inner_accordion' => __DIR__ . '/blueprints/blocks/inner_accordion.yml',
        'blocks/tab' => __DIR__ . '/blueprints/blocks/tab.yml',

    ],
    'snippets' => [
        'blocks/overlay' => __DIR__ . '/blocks/overlay.php',
        'blocks/image' => __DIR__ . '/blocks/image.php',
        'blocks/heading' => __DIR__ . '/blocks/heading.php',
        'blocks/buttons' => __DIR__ . '/blocks/buttons.php',
        'blocks/button' => __DIR__ . '/blocks/button.php',
        'blocks/list' => __DIR__ . '/blocks/list.php',
        'blocks/text' => __DIR__ . '/blocks/text.php',
        'blocks/card' => __DIR__ . '/blocks/card.php',
        'blocks/divider' => __DIR__ . '/blocks/divider.php',
        'blocks/iconflex' => __DIR__ . '/blocks/iconflex.php',
        'blocks/countup' => __DIR__ . '/blocks/countup.php',
        'blocks/table' => __DIR__ . '/blocks/table.php',
        'blocks/accordion' => __DIR__ . '/blocks/accordion.php',
        'blocks/inner_accordion' => __DIR__ . '/blocks/inner_accordion.php',
        'blocks/tab' => __DIR__ . '/blocks/tab.php',
        'layout' => __DIR__ . '/snippets/layout.php',
    ],
    'templates' => [
        'default' => __DIR__ . '/templates/default.php',
    ],
    'hooks' => [
        'page.update:after' => function ($newPage, $oldPage) {
            // Überprüfe, ob das Template der Seite "uikit-less" ist
            if ($newPage->intendedTemplate() != 'uikit-less') {
                return;
            }

            $name = __DIR__;

            try {
                // Initialisiere den Less-Parser
                $options = [ 'compress' => true ];
                $parser = new Less_Parser( $options );
                $panel = new Less_Parser( $options );

                // Erstelle die Less-Zeichenkette mit importierten Werten
                $lessCode = '@import "' . kirby()->root('index') . '/vendor/uikit/uikit/src/less/uikit.theme.less"; ';

                //Hauptfarben
                $lessCode .= '@global-primary-background:' . $newPage->primary()->value() . '; ';
                $lessCode .= '@global-background:' . $newPage->background()->value() . '; ';
                $lessCode .= '@global-secondary-background:' . $newPage->secondary()->value() . '; ';
                $lessCode .= '@global-muted-background:' . $newPage->muted()->value() . ';';
                $lessCode .= '@base-selection-background: ' . $newPage->selection()->value() . ' !important;';
                $lessCode .= '@base-selection-color: #fff;';

                $lessCode .= '@global-font-size:' . $newPage->basefontsize()->value() . 'px;';
                $lessCode .= '@global-line-height:' . $newPage->basefontline()->value() . ';';
                $lessCode .= '@global-color:' . $newPage->basecolor()->value() . ';';

                //Headlines
                $lessCode .= '@base-heading-color:' . $newPage->headingcolor()->value() . ';';
                $lessCode .= '@base-heading-font-weight:' . $newPage->headingweight()->value() . ';';
                $lessCode .= '@base-heading-text-transform:' . $newPage->headingstyle()->value() . ';';

                //Links
                $lessCode .= '@global-link-color:' . $newPage->linkcolor()->value() . ';';
                $lessCode .= '@global-link-hover-color:' . $newPage->linkhovercolor()->value() . ';';

                //Meta
                $lessCode .= '@text-meta-color:' . $newPage->metacolor()->value() . ';';
                $lessCode .= '.hook-text-meta() { text-transform:' . $newPage->metastyle()->value() . ';}';

                //Buttons
                $lessCode .= '.hook-button() { border-radius:' . $newPage->buttonradius() . 'px; text-transform:' . $newPage->buttonstyle()->value() . ';}';

                //Cards
                $lessCode .= '.hook-card() { border-radius:' . $newPage->cardradius() . 'px;}';

                //Divider
                if ($dividerlineborder =  $newPage->dividerlineborder()->isEmpty()) {
                    $lessCode .= '@global-border: #e5e5e5;';
                } else {
                    $lessCode .= '@global-border:' . $newPage->dividerlineborder() . ';';
                };
                $lessCode .= '@global-border-width: ' . $newPage->dividerlineborderwidth() . 'px;';
                //$lessCode .= '@global-border: ' . $newPage->dividerlineborder() . ';';

                $lessCode .= '@divider-icon-line-border: ' . $newPage->dividericonlineborder() . ';';
                $lessCode .= '@divider-icon-line-border-width: ' . $newPage->dividericonlineborderwidth() . 'px;';
                $lessCode .= '@divider-icon-color: ' . $newPage->dividericoncolor() . ';';
                if ($dividericon = $newPage->dividericon()->toFile()) {
                    $lessCode .= '@internal-divider-icon-image: ' . $dividericon->url() . ';';
                } else {
                    $lessCode .= '.uk-divider-icon {
                        .svg-fill(@internal-divider-icon-image, "#000", ' . $newPage->dividericoncolor() . ');
                    }';
                };
                $lessCode .= '@divider-small-width: ' . $newPage->dividersmallwidth() . 'px;';
                $lessCode .= '@divider-small-border-width: ' . $newPage->dividersmallborderwidth() . ';';
                $lessCode .= '@divider-small-border: ' . $newPage->dividersmallborder() . 'px;';
                $lessCode .= '@divider-vertical-height: ' . $newPage->dividerverticalheight() . 'px;';
                $lessCode .= '@divider-vertical-border-width: ' . $newPage->dividerverticalborderwidth() . ';';
                $lessCode .= '@divider-vertical-border: ' . $newPage->dividerverticalborder() . 'px;';
                
                //Accordion
                $lessCode .= '@accordion-title-color:' . $newPage->accordiontitlecolor() . ';';
                $lessCode .= '@accordion-title-hover-color:' . $newPage->accordiontitlehovercolor() . ';';
                $lessCode .= '.hook-accordion-title() { text-transform:' . $newPage->accordionstyle()->value() . ';}';
                $lessCode .= '@accordion-icon-color:' . $newPage->accordiontitlecolor() .';';
                if ($openimage = $newPage->accordioniconopen()->toFile()) :
                    $lessCode .= '@internal-accordion-open-image:' . $openimage->url() . ';';
                endif;
                if ($closeimage = $newPage->accordioniconclose()->toFile()) :
                    $lessCode .= '@internal-accordion-close-image:' . $closeimage->url() . ';';
                endif;

                //Navigation
                $lessCode .= '.uk-navbar-container, .uk-dropbar { background:' . $newPage->navbackgroundcolor() . ' !important;}';
                $lessCode .= '.uk-navbar-nav > li > a, .uk-nav > li > a { text-transform:' . $newPage->navstyle()->value() . ';}';
                $lessCode .= '.uk-navbar-nav > li > a, .uk-nav > li > a { color:' . $newPage->navitemcolor()->value() . ';}';
                $lessCode .= '.uk-navbar-nav > li:hover > a, .uk-nav > li:hover > a { color:' . $newPage->navitemhovercolor()->value() . ' !important;}';
                $lessCode .= '.uk-navbar-nav > li.uk-active > a, .uk-nav > li.uk-active > a { color:' . $newPage->navitemactivecolor()->value() . ';}';
                
                //Preheader
                $lessCode .= '.preheader { background:' . $newPage->preheaderbackgroundcolor() . ';}';
                $lessCode .= '.preheader-text { text-transform:' . $newPage->preheaderstyle()->value() . ';}';
                $lessCode .= '.preheader-text { color:' . $newPage->preheaderitemcolor() . ' !important;}';
                
                
                $lessCode .= $newPage->lesscode()->value();

                // Kompiliere das Less zu CSS
                $parser->parse($lessCode);
                $css = $parser->getCss();

                $panel->parse(':root {
                                            --primary: ' . $newPage->primary()->value() . ';
                                            --secondary: ' . $newPage->secondary()->value() . ';
                                            --muted: ' . $newPage->muted()->value() . ';
                                }');
                $panelcss = $panel->getCss();

                // Speicherpfad für das CSS relativ zum Projektverzeichnis
                $cssFilePath = kirby()->root('index') . '/assets/css/uikit-theme.css';

                // Erstelle das Verzeichnis, falls es nicht existiert
                if (!is_dir(dirname($cssFilePath))) {
                    mkdir(dirname($cssFilePath), 0777, true);
                }

                // Speicherpfad für das CSS relativ zum Projektverzeichnis
                $cssFilePathPanel = kirby()->root('index') . '/assets/css/panel.css';

                // Erstelle das Verzeichnis, falls es nicht existiert
                if (!is_dir(dirname($cssFilePathPanel))) {
                    mkdir(dirname($cssFilePathPanel), 0777, true);
                }

                // CSS in Datei speichern
                if (file_put_contents($cssFilePath, $css) === false) {
                    throw new Exception("Fehler beim Schreiben der CSS-Datei.");
                }
                if (file_put_contents($cssFilePathPanel, $panelcss) === false) {
                    throw new Exception("Fehler beim Schreiben der Panel-CSS-Datei.");
                }

            } catch (\Less_Exception_Parser $e) {
                // Fehler beim Parsen der Less-Datei
                throw new Exception("Less Parser Fehler: " . $e->getMessage());
            } catch (Exception $e) {
                // Allgemeiner Fehler
                throw new Exception("Allgemeiner Fehler: " . $e->getMessage());
            }
        }
    ]
]);