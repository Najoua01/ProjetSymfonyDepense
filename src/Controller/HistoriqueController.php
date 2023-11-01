<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HistoriqueController extends AbstractController
{
    #[Route('/historique', name: 'app_historique')]
    public function index(): Response
    {
        // Exemple de données
        $dailyTotals = [
            ['date' => '2023-11-01', 'total' => 150.0],
            ['date' => '2023-11-02', 'total' => 200.0],
            // ... Ajoutez vos données ici
        ];

        return $this->render('historique/index.html.twig', [
            'controller_name' => 'HistoriqueController',
            'dailyTotals' => $dailyTotals,
        ]);
    }
}
