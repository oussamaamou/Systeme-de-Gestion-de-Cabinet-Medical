<?php
require_once 'config/config.php';
require_once 'core/Database.php';

use Core\Database;

$config = require 'config/config.php';
Database::connect($config);
$db = Database::getConnection();

if ($db) {
    echo "✅ Connexion réussie à PostgreSQL !";
} else {
    echo "❌ Échec de la connexion.";
}
?>
