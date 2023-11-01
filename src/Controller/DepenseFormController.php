<?php

namespace App\Controller;

use App\Entity\Depense;
use App\Form\DepenseFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DepenseFormController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/depense/form', name: 'app_depense_form')]
    public function index(Request $request): Response
    {
        $depense = new Depense();
        $form = $this->createForm(DepenseFormType::class, $depense);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($depense);
            $this->entityManager->flush();

            return $this->redirectToRoute('page_apres_creation');
        }

        $dateDuJour = new \DateTime();
        $dateDuJour->setTimezone(new \DateTimeZone('Europe/Paris')); 
        $dateDuJour = $dateDuJour->format('d/m/Y');

        return $this->render('depense_form/index.html.twig', [
            'form' => $form->createView(),
            'dateDuJour' => $dateDuJour,
        ]);
    }
}
