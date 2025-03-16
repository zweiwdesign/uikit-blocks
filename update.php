<?php

// Verzeichniswechsel zum Kirby-Root
chdir(kirby()->root('index'));

// Sicherstellen, dass Composer erreichbar ist (falls Composer nicht global installiert ist)
$composerPath = kirby()->root('index') . '/composer.phar';
$composerCommand = file_exists($composerPath) 
    ? 'php ' . escapeshellarg($composerPath) . ' update 2>&1' 
    : 'composer update 2>&1';

// Composer Update ausführen
$output = shell_exec($composerCommand);

// Ausgabe formatieren
echo '<pre>' . htmlspecialchars($output) . '</pre>';