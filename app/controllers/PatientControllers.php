<?php
namespace App\Controllers;

use App\Models\Medecin;
use Core\Controller;
use App\Models\Patient;
use App\Models\RendezVous;

class PatientControllers extends Controller
{
    public function index()
    {
        $this->view('patients/index');
    }

    public function reservations()
    {
        $this->view('patients/rendezvous');
    }

    public function consultations()
    {
        $this->view('patients/consultations');
    }

    public function listeconsultations()
    {
        $medecins = Medecin::all();
        $this->view('patients/rendezvous', ['medecins' => $medecins]);
    }

    public function reservezConsultation(){

        session_start();

        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            $patient_id = $_SESSION['id'];
            $medecin_id = $_POST['medecin_id'];
            $date_reservation = $_POST['date_reservation'];

            $patientModel = new Patient();
            $success = $patientModel->prendreRendezVous($patient_id, $medecin_id, $date_reservation);
            exit;
        }
        
    }

    public function afficherMesReservations(){
        session_start();

        $patient_id = $_SESSION['id'];

        $reservationModel = new RendezVous;
        $reservations = $reservationModel->getMyReservation($patient_id);
        $this->view('patients/consultations', ['reservations' => $reservations]);

    }
}
?>