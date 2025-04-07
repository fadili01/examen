<?php
include_once '../database/database.php';

class Instructeur {
    private $db;

    public function __construct() {
        $this->db = new DB('rijschool_casus');
    }

    public function getAutos() {
        $sql = "SELECT id, merk, model FROM autos";
        $stmt = $this->db->execute($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createInstructeur($naam, $email, $wachtwoord, $auto_id = null) {
        $hashedWachtwoord = password_hash($wachtwoord, PASSWORD_DEFAULT);

        $sql = "INSERT INTO instructeurs (naam, email, wachtwoord, auto_id) 
                VALUES (:naam, :email, :wachtwoord, :auto_id)";

        // Placeholder voor de arryes
        $placeholders = [
            ':naam' => $naam,
            ':email' => $email,
            ':wachtwoord' => $hashedWachtwoord,
            ':auto_id' => ($auto_id === null || $auto_id === '') ? null : (int)$auto_id
        ];

        return $this->db->execute($sql, $placeholders);
    }
}
