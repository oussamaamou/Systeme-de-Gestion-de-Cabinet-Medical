<?php
namespace App\Controllers;

use App\Models\Medecin;
use Core\Controller;
use App\Models\Patient;

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
}
?>