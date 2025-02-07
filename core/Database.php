<?php



class Database {
    private static $instance = null;
    private $conn;

    private function __construct() {
        $config = require 'config/config.php';

        $dsn = "pgsql:host={$config['db_host']};port={$config['db_port']};dbname={$config['db_name']}";

        try {
            $this->conn = new PDO($dsn, $config['db_user'], $config['db_pass'], [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ]);
        } catch (PDOException $e) {
            die("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance->conn;
    }
}
