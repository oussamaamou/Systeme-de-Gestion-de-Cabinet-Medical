<?php
namespace App\Models;

use Core\Database;

class RendezVous{

    public function getMyReservation($ID_patient) {
        $db = Database::getConnection();

        $stmt = $db->prepare("SELECT rendezvous.ID, rendezvous.Patient_id, rendezvous.Medecin_id, rendezvous.Date_reservation, 
                                     rendezvous.Statut, utilisateurs.Nom, utilisateurs.Prenom, utilisateurs.Email
                              FROM rendezvous 
                              JOIN utilisateurs ON utilisateurs.ID = rendezvous.Medecin_id
                              WHERE rendezvous.Patient_id = :ID_patient AND Statut = 'en attente'");
                              
        $stmt->bindParam(':ID_patient', $ID_patient, \PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getMyConsultations($ID_medecin) {
        $db = Database::getConnection();

        $stmt = $db->prepare("SELECT rendezvous.ID, rendezvous.Patient_id, rendezvous.Medecin_id, rendezvous.Date_reservation, 
                                     rendezvous.Statut, utilisateurs.Nom, utilisateurs.Prenom, utilisateurs.Email
                              FROM rendezvous 
                              JOIN utilisateurs ON utilisateurs.ID = rendezvous.Patient_id
                              WHERE rendezvous.Medecin_id = :ID_medecin AND Statut = 'en attente'");
                              
        $stmt->bindParam(':ID_medecin', $ID_medecin, \PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    
    
   
}