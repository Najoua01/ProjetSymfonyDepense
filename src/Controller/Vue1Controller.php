<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Vue1Controller extends AbstractController
{
    #[Route('/vue1/webpack', name: 'vue1_webpack')]
    public function vue1Webpack(): Response
    {
        return $this->render('exemples_routing/vue1_webpack.html.twig');
    }
}
