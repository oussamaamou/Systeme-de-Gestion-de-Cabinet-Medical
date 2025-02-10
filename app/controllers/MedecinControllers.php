<?php
namespace App\Controllers;

use Core\Controller;
use Core\Database;
use App\Models\Medecin;
use App\Models\RendezVous;

class MedecinControllers extends Controller
{
    public function index()
    {
        $medecins = Medecin::all();
        $this->view('medecins/index', ['medecins' => $medecins]);
    }

    public function mesconsultations()
    {
        $this->view('medecins/consultation');
    }

    public function afficherMesConsultations(){
        session_start();

        $medecin_id = $_SESSION['id'];

        $reservationModel = new RendezVous;
        $reservations = $reservationModel->getMyConsultations($medecin_id);
        $this->view('medecins/consultation', ['reservations' => $reservations]);

    }

    public function confirmerRendezVous(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reservation_ID'])) {
            $reservationID = $_POST['reservation_ID'];

            $db = Database::getConnection();
            $stmt = $db->prepare("UPDATE rendezvous SET Statut = 'confirmé' WHERE ID = ?");
            $stmt->execute([$reservationID]);

            header("Location: mesconsultations");
            exit();
        }
    }

    public function annulerRendezVous(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reservation_ID'])) {
            $reservationID = $_POST['reservation_ID'];

            $db = Database::getConnection();
            $stmt = $db->prepare("UPDATE rendezvous SET Statut = 'annulé' WHERE ID = ?");
            $stmt->execute([$reservationID]);

            header("Location: mesconsultations");
            exit();
        }
    }

}

?>