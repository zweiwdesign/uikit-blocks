<?php

$sectionfieldsets = [];

// Verwende den korrekten Pfad zu Plugins, um nur dort nach Dateien zu suchen
$pluginPath = kirby()->root('plugins');

// Suche im Plugin-Ordner nach allen Ordnern oder Dateien, die mit "section" beginnen
foreach (glob($pluginPath . '/section*') as $sectionplugin) {
    $sectionfieldsets[] = basename($sectionplugin); // Nur der Ordnername oder Dateiname
}

return [ 
    'label' => 'Vorgestylte Sectionen (1/1)',
    'type'  => 'group',
    'fieldsets' => $sectionfieldsets,
];