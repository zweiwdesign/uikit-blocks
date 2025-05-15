<?php
namespace TilmannRuppert\UIKITLess;
 
use Kirby\Cms\App;
use Kirby\Exception\Exception;
use Kirby\Http\Response;
use Less_Parser;
 
require_once kirby()->root('index') . "/vendor/wikimedia/less.php/lib/Less/Autoloader.php";
\Less_Autoloader::register();
 
App::plugin('tilmannruppert/uikit-blocks', [
    'blueprints' => [
        # Pages
        'pages/uikit-less' => __DIR__ . '/blueprints/pages/uikit-less.yml',
        'pages/default' => __DIR__ . '/blueprints/pages/default.yml',
        'pages/blog' => __DIR__ . '/blueprints/pages/blog.yml',
        'pages/blogs' => __DIR__ . '/blueprints/pages/blogs.yml',
        
        # Fields
        'fields/subblocks' => __DIR__ . '/blueprints/fields/subblocks.yml',
        'fields/global' => __DIR__ . '/blueprints/fields/global.yml',
        'fields/builder' => __DIR__ . '/blueprints/fields/builder.yml',
        'main/sections' => function ($kirby) {
            return include __DIR__ . '/blueprints/main/sections.php';
        },

        # Base
        'fields/uikit' => __DIR__ . '/blueprints/main/base/fieldsets.yml',
        'base/base' => __DIR__ . '/blueprints/main/base/base.yml',
        'base/groups' => __DIR__ . '/blueprints/main/base/groups.yml',
        'base/settings' => __DIR__ . '/blueprints/main/base/settings.yml',


        'main/fieldsets' => __DIR__ . '/blueprints/main/fieldsets.yml',

        # Preheader
        'preheader/fieldsets' => __DIR__ . '/blueprints/main/preheader/fieldsets.yml',

        # Header
        'header/builder_fieldsets' => __DIR__ . '/blueprints/main/header/builder_fieldsets.yml',
        'header/fieldsets' => __DIR__ . '/blueprints/main/header/fieldsets.yml',

        # Offcanvas
        'offcanvas/fieldsets' => __DIR__ . '/blueprints/main/offcanvas/fieldsets.yml',
        'offcanvas/settings' => __DIR__ . '/blueprints/main/offcanvas/settings.yml',

        # Footer
        'footer/fieldsets' => __DIR__ . '/blueprints/main/footer/fieldsets.yml',
        'footer/settings' => __DIR__ . '/blueprints/main/footer/settings.yml',

        'fieldsets/tab' => __DIR__ . '/blueprints/main/fieldsets/tab.yml',

        # Blocks
        'blocks/buttons' => __DIR__ . '/blueprints/blocks/buttons.yml',
        'blocks/button' => __DIR__ . '/blueprints/blocks/button.yml',
        'blocks/to_top' => __DIR__ . '/blueprints/blocks/to_top.yml',
        'blocks/overlay' => __DIR__ . '/blueprints/blocks/overlay.yml',
        'blocks/heading' => __DIR__ . '/blueprints/blocks/heading.yml',
        'blocks/list' => __DIR__ . '/blueprints/blocks/list.yml',
        'blocks/image' => __DIR__ . '/blueprints/blocks/image.yml',
        'blocks/logo' => __DIR__ . '/blueprints/blocks/logo.yml',
        'blocks/text' => __DIR__ . '/blueprints/blocks/text.yml',
        'blocks/card' => __DIR__ . '/blueprints/blocks/card.yml',
        'blocks/divider' => __DIR__ . '/blueprints/blocks/divider.yml',
        'blocks/iconflex' => __DIR__ . '/blueprints/blocks/iconflex.yml',
        'blocks/countup' => __DIR__ . '/blueprints/blocks/countup.yml',
        'blocks/table' => __DIR__ . '/blueprints/blocks/table.yml',
        'blocks/accordion' => __DIR__ . '/blueprints/blocks/accordion.yml',
        'blocks/language_switcher' => __DIR__ . '/blueprints/blocks/language_switcher.yml',
        'blocks/tab' => __DIR__ . '/blueprints/blocks/tab.yml',
        'blocks/social_icons' => __DIR__ . '/blueprints/blocks/social_icons.yml',
        'blocks/sticky_badge' => __DIR__ . '/blueprints/blocks/sticky_badge.yml',

        'blocks/navmenu' => __DIR__ . '/blueprints/blocks/navmenu.yml',
        'blocks/menu_horizontal' => __DIR__ . '/blueprints/blocks/menu_horizontal.yml',
        'blocks/menu_vertikal' => __DIR__ . '/blueprints/blocks/menu_vertikal.yml',

        'blocks/preheader' => __DIR__ . '/blueprints/blocks/preheader.yml',
        'blocks/header' => __DIR__ . '/blueprints/blocks/header.yml',

        'blocks/inner_accordion' => __DIR__ . '/blueprints/blocks/inner_accordion.yml',
        'blocks/subnavigation' => __DIR__ . '/blueprints/blocks/subnavigation.yml',

        'blocks/form' => __DIR__ . '/blueprints/blocks/form.yml',

        # Files
        'files/default' => __DIR__ . '/blueprints/files/default.yml',
        'files/fonts' => __DIR__ . '/blueprints/files/fonts.yml',
    ],
    'snippets' => [
        'blocks/overlay' => __DIR__ . '/snippets/blocks/overlay.php',
        'blocks/image' => __DIR__ . '/snippets/blocks/image.php',
        'blocks/logo' => __DIR__ . '/snippets/blocks/logo.php',
        'blocks/heading' => __DIR__ . '/snippets/blocks/heading.php',
        'blocks/buttons' => __DIR__ . '/snippets/blocks/buttons.php',
        'blocks/button' => __DIR__ . '/snippets/blocks/button.php',
        'blocks/to_top' => __DIR__ . '/snippets/blocks/to_top.php',
        'blocks/list' => __DIR__ . '/snippets/blocks/list.php',
        'blocks/text' => __DIR__ . '/snippets/blocks/text.php',
        'blocks/card' => __DIR__ . '/snippets/blocks/card.php',
        'blocks/divider' => __DIR__ . '/snippets/blocks/divider.php',
        'blocks/iconflex' => __DIR__ . '/snippets/blocks/iconflex.php',
        'blocks/countup' => __DIR__ . '/snippets/blocks/countup.php',
        'blocks/table' => __DIR__ . '/snippets/blocks/table.php',
        'blocks/accordion' => __DIR__ . '/snippets/blocks/accordion.php',
        'blocks/inner_accordion' => __DIR__ . '/snippets/blocks/inner_accordion.php',
        'blocks/tab' => __DIR__ . '/snippets/blocks/tab.php',
        'blocks/social_icons' => __DIR__ . '/snippets/blocks/social_icons.php',
        'blocks/sticky_badge' => __DIR__ . '/snippets/blocks/sticky_badge.php',

        'blocks/navmenu' => __DIR__ . '/snippets/blocks/navmenu.php',
        'blocks/menu_horizontal' => __DIR__ . '/snippets/blocks/menu_horizontal.php',
        'blocks/menu_vertikal' => __DIR__ . '/snippets/blocks/menu_vertikal.php',

        'blocks/preheader' => __DIR__ . '/snippets/blocks/preheader.php',
        'blocks/header' => __DIR__ . '/snippets/blocks/header.php',

        'blocks/language_switcher' => __DIR__ . '/snippets/blocks/language_switcher.php',
        'blocks/subnavigation' => __DIR__ . '/snippets/blocks/subnavigation.php',

        'blocks/form' => __DIR__ . '/snippets/blocks/form.php',

        'layout' => __DIR__ . '/snippets/layout.php',
        'header' => __DIR__ . '/snippets/header.php',
        'navbar' => __DIR__ . '/snippets/navbar.php',
        'footer' => __DIR__ . '/snippets/footer.php',
    ],
    'templates' => [
        'default' => __DIR__ . '/templates/default.php',
        'error' => __DIR__ . '/templates/error.php',

        'blog' => __DIR__ . '/templates/blog.php',
        'blogs' => __DIR__ . '/templates/blogs.php',
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
                $lessCode .= '@global-primary-background:' . $newPage->primary() . '; ';
                $lessCode .= '@global-background:' . $newPage->background() . '; ';
                $lessCode .= '@global-secondary-background:' . $newPage->secondary() . '; ';
                $lessCode .= '@global-muted-background:' . $newPage->muted() . ';';
                $lessCode .= '@base-selection-background: ' . $newPage->selection()->or('@global-primary-background') . ';';
               
 
                $lessCode .= '@global-font-size:' . $newPage->basefontsize() . 'px;';
                $lessCode .= '@global-line-height:' . $newPage->basefontline() . ';';
                $lessCode .= '@global-color:' . $newPage->basecolor()->or('lighten(@global-secondary-background, 12%)') . ';';
 
                //Headlines
                $lessCode .= '@base-heading-color:' . $newPage->headingcolor()->or('@global-secondary-background') . ';';
                $lessCode .= '@base-heading-font-weight:' . $newPage->headingweight()->or('400') . ';';
                $lessCode .= '@base-heading-text-transform:' . $newPage->headingstyle() . ';';
 
                //Links
                $lessCode .= '@global-link-color:' . $newPage->linkcolor()->or('@global-primary-background') . ';';
                $lessCode .= '@global-link-hover-color:' . $newPage->linkhovercolor()->or('darken(@global-link-color, 12%)') . ';';
 
                //Meta
                $lessCode .= '@text-meta-color:' . $newPage->metacolor()->or('@global-primary-background') . ';';
                $lessCode .= '.hook-text-meta() { text-transform:' . $newPage->metastyle()->or('none') . ';}';
 
                //Buttons
                $lessCode .= '.hook-button() { border-radius:' . $newPage->buttonradius() . 'px; text-transform:' . $newPage->buttonstyle()->value() . ';}';
 
                //Cards
                $lessCode .= '.hook-card() { border-radius:' . $newPage->cardradius() . 'px;}';
 
                //Divider
                $lessCode .= '@base-hr-border:' . $newPage->dividerlineborder()->or('#e5e5e5') . ';';
                $lessCode .= '@base-hr-border-width: ' . $newPage->dividerlineborderwidth() . 'px;';
 
                $lessCode .= '@divider-icon-line-border: ' . $newPage->dividericonlineborder()->or('#e5e5e5') . ';';
                $lessCode .= '@divider-icon-line-border-width: ' . $newPage->dividericonlineborderwidth() . 'px;';
                $lessCode .= '@divider-icon-color: ' . $newPage->dividericoncolor()->or('#e5e5e5') . ';';
                
                if ($dividericon = $newPage->dividericon()->toFile()) {
                    $lessCode .= '.hook-divider-icon() { background-image: url(' . $dividericon->url() . ') !important; background-size: contain;}';
                } else {
                    $lessCode .= '.hook-divider-icon() {
                        .svg-fill(@internal-divider-icon-image, "#000", ' . $newPage->dividericoncolor()->or('#e5e5e5') . ');
                    }';
                };


                if ($newPage->toggle_dividersmallimage()->toBool()) {
                    $dividersmallimage = $newPage->dividersmallimage()->toFile();
                    $dividersmallheight = $newPage->dividersmallheight();
                    $dividersmallrepeat = $newPage->dividersmallrepeat()->or('no-repeat');

                    if($dividersmallimage) {
                        $lessCode .= '.hook-divider-small() { 
                            background-image: url(' . $dividersmallimage->url() . ') !important;
                            border-color: transparent;
                            background-size: contain;
                            }';
                    }

                    if($dividersmallheight) {
                        $lessCode .= '.hook-divider-small() { 
                            height: ' . $dividersmallheight . 'px;
                            }';
                    }

                        $lessCode .= '.hook-divider-small() { 
                            background-repeat: ' . $dividersmallrepeat . ';
                            }';
                    
                
                } else {
                    $lessCode .= '@divider-small-width: ' . $newPage->dividersmallwidth() . 'px;';
                    $lessCode .= '@divider-small-border-width: ' . $newPage->dividersmallborderwidth() . 'px;';
                    $lessCode .= '@divider-small-border: ' . $newPage->dividersmallbordercolor()->or('#e5e5e5') . ';';
                    $lessCode .= '.uk-divider-small.uk-preserve-color {
                        border-left: ' . $newPage->dividersmallborderwidth() .'px solid ' . $newPage->dividersmallbordercolor() . '!important;
                    }';
                }
 
                $lessCode .= '@divider-vertical-height: ' . $newPage->dividerverticalheight() . 'px;';
                $lessCode .= '@divider-vertical-border-width: ' . $newPage->dividerverticalborderwidth() . 'px;';
                $lessCode .= '@divider-vertical-border: ' . $newPage->dividerverticalbordercolor()->or('#e5e5e5') . ';';
                $lessCode .= '.uk-divider-vertical.uk-preserve-color {
                    border-left: ' . $newPage->dividerverticalborderwidth() .'px solid ' . $newPage->dividerverticalbordercolor() . '!important;
                }';
                
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
                
                //Preheader
                $lessCode .= '.preheader { background:' . $newPage->preheaderbackgroundcolor()->or('@global-primary-background') . ';}';
                $lessCode .= '.preheader p { text-transform:' . $newPage->preheaderstyle()->value() . ';}';
                $lessCode .= '.preheader p { color:' . $newPage->preheaderitemcolor() . ' !important;}';
                
                //Header
                $lessCode .= '@navbar-background:' . $newPage->headerbackgroundcolor()->or('@global-background') . ';';
                $lessCode .= '@navbar-dropdown-background:' . $newPage->headerbackgroundcolor()->or('@global-background') . ';';
                $lessCode .= '@dropbar-background:' . $newPage->headerbackgroundcolor()->or('@global-muted-background') . ';';

                // Navigation - Header
                $lessCode .= '.hook-navbar-nav-item() { text-transform:' . $newPage->navstyle()->value() . ';}';
                $lessCode .= '.hook-navbar-dropdown-nav-item() { text-transform:' . $newPage->navstyle()->value() . ';}';
                $lessCode .= '@navbar-nav-item-color:' . $newPage->navitemcolor()->or('@global-color') . ';';
                $lessCode .= '@navbar-nav-item-hover-color:' . $newPage->navitemhovercolor()->or('@global-secondary-background') . ';';
                $lessCode .= '@navbar-nav-item-active-color:' . $newPage->navitemactivecolor()->or('@global-primary-background') . ';';

                // Dropdown
                $lessCode .= '@navbar-dropdown-nav-item-color:' . $newPage->navitemcolor()->or('@global-color') . ';';
                $lessCode .= '@navbar-dropdown-nav-item-hover-color:' . $newPage->navitemhovercolor()->or('@global-secondary-background') . ';';
                $lessCode .= '.hook-navbar-dropdown-nav-item-active() { color:' . $newPage->navitemactivecolor()->or('@global-primary-background') . ';}';
                $lessCode .= '@dropdown-nav-item-color:' . $newPage->navitemcolor()->or('@global-color') . ' !important;';

                // Menus - Subnav
                $lessCode .= '.hook-subnav-item() { text-transform:' . $newPage->menustyle()->value() . ';}';
                $lessCode .= '.hook-dropdown-nav-item() { text-transform:' . $newPage->menustyle()->value() . ';}';
                $lessCode .= '@subnav-item-color:' . $newPage->menuitemcolor()->or('@global-muted-color') . ';';
                $lessCode .= '@subnav-item-hover-color:' . $newPage->menuitemhovercolor()->or('@global-color') . ';';
                $lessCode .= '@subnav-item-active-color:' . $newPage->menuitemactivecolor()->or('@global-emphasis-color') . ';';

                // Menus - Nav
                $lessCode .= '.hook-nav-default-item() { text-transform:' . $newPage->menustyle()->value() . ';}';
                $lessCode .= '@nav-default-item-color:' . $newPage->menuitemcolor()->or('@global-muted-color') . ';';
                $lessCode .= '@nav-default-item-hover-color:' . $newPage->menuitemhovercolor()->or('@global-color') . ';';
                $lessCode .= '@nav-default-item-active-color:' . $newPage->menuitemactivecolor()->or('@global-emphasis-color') . ';';

                //Form
                $lessCode .= 'em { color:' . $newPage->form_emcolor()->or('#f0506e') . ';}';
                $lessCode .= '@base-body-font-family: var(--primary-font);';
                $lessCode .= '@base-heading-font-family: var(--secondary-font);';
 
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