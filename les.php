<?php
include_once '../database/database.php';


    
    class Les {
        private $db;
    
        public function __construct() {
            $this->db = new DB('rijschool_casus');
        }
    
        // Instructeur voegt opmerking toe
        public function voegInstructeurOpmerkingToe($lesId, $opmerking, $instructeurId) {
            $sqlCheck = "SELECT id FROM lessen WHERE id = :lesId AND gekoppelde_instructeur = :instructeurId";
            $check = $this->db->execute($sqlCheck, [
                ':lesId' => $lesId,
                ':instructeurId' => $instructeurId
            ]);
            if ($check->rowCount() === 0) {
                return false;
            }
    
            $sql = "UPDATE lessen SET opmerkingen = :opmerking WHERE id = :lesId";
            return $this->db->execute($sql, [
                ':opmerking' => $opmerking,
                ':lesId' => $lesId
            ]);
        }
    
        // Leerling voegt opmerking toe
        public function voegLeerlingOpmerkingToe($lesId, $opmerking, $leerlingId) {
            $sqlCheck = "SELECT id FROM lessen WHERE id = :lesId AND gekoppelde_leerling = :leerlingId";
            $check = $this->db->execute($sqlCheck, [
                ':lesId' => $lesId,
                ':leerlingId' => $leerlingId
            ]);
            if ($check->rowCount() === 0) {
                return false;
            }
    
            $sql = "UPDATE lessen SET leerling_opmerking = :opmerking WHERE id = :lesId";
            return $this->db->execute($sql, [
                ':opmerking' => $opmerking,
                ':lesId' => $lesId
            ]);
        }
    
        // Ophalen van lessen voor instructeur
        public function getLessenVoorInstructeur($instructeurId) {
            $sql = "SELECT l.id, l.datum, l.tijd, le.naam AS leerling_naam
                    FROM lessen l
                    JOIN leerlingen le ON l.gekoppelde_leerling = le.id
                    WHERE l.gekoppelde_instructeur = :instructeurId
                    ORDER BY l.datum DESC";
            $stmt = $this->db->execute($sql, [':instructeurId' => $instructeurId]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    
        // Ophalen van lessen voor leerling
        public function getLessenVoorLeerling($leerlingId) {
            $sql = "SELECT * FROM lessen WHERE gekoppelde_leerling = :leerlingId ORDER BY datum DESC";
            $stmt = $this->db->execute($sql, [':leerlingId' => $leerlingId]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
    