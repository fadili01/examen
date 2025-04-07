<?php
include_once '../database/database.php';

class Les {
    private $db;

    public function __construct() {
        $this->db = new DB('rijschool_casus');
    }

    public function voegOpmerkingToe($lesId, $opmerking) {
        $sql = "UPDATE lessen SET opmerkingen = :opmerking WHERE id = :lesId";
        $placeholders = [
            ':opmerking' => $opmerking,
            ':lesId' => $lesId
            
        ];

        return $this->db->execute($sql, $placeholders);
    }

    // Ophalen van lessen op basis van leerlingnaam
    public function getLessenVoorInstructeur($instructeurId) {
        $sql = "SELECT l.id, l.datum, l.tijd, le.naam AS leerling_naam
                FROM lessen l
                JOIN leerlingen le ON l.gekoppelde_leerling = le.id
                WHERE l.gekoppelde_instructeur = :instructeurId
                ORDER BY l.datum DESC";
        $placeholders = [':instructeurId' => $instructeurId];
        $stmt = $this->db->execute($sql, $placeholders);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
}
