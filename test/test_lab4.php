<?php

declare(strict_types=1);

// ===============================
// AUTLOAD PSR-4 MINIMAL
// ===============================
spl_autoload_register(function(string $class) {
    $prefix = 'App\\';
    $baseDir = __DIR__ . '/../src/';

    $len = strlen($prefix);
    if (strncmp($class, $prefix, $len) !== 0) {
        return;
    }

    $relativeClass = substr($class, $len);
    $file = $baseDir . str_replace('\\', DIRECTORY_SEPARATOR, $relativeClass) . '.php';

    if (file_exists($file)) {
        require $file;
    }
});

use App\Container\AppFactory;
use App\Controller\Response;

// ===============================
// HELPER AFFICHAGE
// ===============================
function printResponse(string $label, Response $res) {
    echo "[RESPONSE] $label => success=" . ($res->isSuccess() ? 'true' : 'false');

    if ($res->isSuccess()) {
        echo ' data=' . json_encode($res->getData(), JSON_UNESCAPED_UNICODE) . PHP_EOL;
    } else {
        echo ' error=' . $res->getError() . PHP_EOL;
    }
}

// ===============================
// CREATION CONTROLLER
// ===============================
$ctrl = AppFactory::createController();

// ===============================
// 1) OK: Transaction combinée
// ===============================
// Code unique pour éviter erreur duplicate
$uniqueCode = 'BIO' . rand(100, 999);

$r1 = $ctrl->handle([
    'action' => 'create_filiere_then_student',
    'code' => $uniqueCode,
    'libelle' => 'Biologie',
    'cne' => 'CNE7777',
    'nom' => 'Test',
    'prenom' => 'Tx',
    'email' => 'test.tx@example.com'
]);

printResponse('Create Filiere + Etudiant', $r1);

// ===============================
// 2) Erreur: Email interdit
// ===============================
$r2 = $ctrl->handle([
    'action' => 'create_etudiant',
    'cne' => 'CNE1234',
    'nom' => 'Doe',
    'prenom' => 'Jane',
    'email' => 'jane@mailinator.com',
    'filiere_id' => 1
]);

printResponse('Email interdit', $r2);

// ===============================
// 3) Erreur: CNE invalide
// ===============================
$r3 = $ctrl->handle([
    'action' => 'create_etudiant',
    'cne' => 'ABC9999',
    'nom' => 'Bad',
    'prenom' => 'Cne',
    'email' => 'ok@example.com',
    'filiere_id' => 1
]);

printResponse('CNE invalide', $r3);

// ===============================
// 4) Erreur: Suppression interdite
// ===============================
$r4 = $ctrl->handle([
    'action' => 'delete_filiere',
    'id' => 1
]);

printResponse('Suppression filière interdite', $r4);