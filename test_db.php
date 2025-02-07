<?php
require_once __DIR__ . '/core/Database.php';
use Core\Database;

$db = Database::getInstance();
if ($db) {
    echo "✅ Connexion réussie à PostgreSQL !";
} else {
    echo "❌ Échec de la connexion.";
}
