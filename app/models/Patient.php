<?php
namespace App\Models;

use Core\Database;

class Patient
{
    public static function all()
    {
        $db = Database::getConnection();
        $stmt = $db->query("SELECT * FROM utilisateurs WHERE Role = 'Patient' ");
        return $stmt->fetchAll();
    }
}
?>