<?php
namespace Config;

use Core\Router;

class Routes
{
    public static function registerRoutes(Router $router)
    {
        $router->get('/log', 'AuthControllers@loginForm');
        $router->get('/inscription', 'AuthControllers@inscriptionForm');
        $router->post('/inscription', 'AuthControllers@inscription');
        $router->post('/login', 'AuthControllers@login');
        $router->get('/logout', 'AuthControllers@logout');
        $router->get('/patients', 'PatientControllers@index');
        $router->get('/reservations', 'PatientControllers@reservations');
        $router->get('/consultations', 'PatientControllers@consultations');
        $router->get('/consultations', 'PatientControllers@afficherMesReservations');
        $router->get('/reservations', 'PatientControllers@listeconsultations');
        $router->post('/reservations', 'PatientControllers@reservezConsultation');
        $router->get('/medecins', 'MedecinControllers@index');
        $router->get('/mesconsultations', 'MedecinControllers@mesconsultations');
        $router->get('/mesconsultations', 'MedecinControllers@afficherMesConsultations');
        $router->post('/rendezvous/confirmer', 'MedecinControllers@confirmerRendezVous');
        $router->post('/rendezvous/annuler', 'MedecinControllers@annulerRendezVous');
        $router->get('/rendezvous', 'RendezVousControllers@index');
        $router->post('/rendezvous/create', 'RendezVousControllers@create');
    }
}
?>
