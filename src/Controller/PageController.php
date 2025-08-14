<?php

namespace App\Controller;

use App\Entity\Pricing;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function home(): Response
    {
        return $this->render('home.html.twig');
    }

    #[Route('/uslugi', name: 'services')]
    public function services(): Response
    {
        return $this->render('services.html.twig');
    }

    #[Route('/warunki', name: 'conditions')]
    public function conditions(): Response
    {
        return $this->render('conditions.html.twig');
    }

    #[Route('/cennik', name: 'pricing')]
    public function pricing(ManagerRegistry $doctrine): Response
    {
        $items = $doctrine->getRepository(Pricing::class)->findAll();

        return $this->render('pricing.html.twig', [
            'items' => $items,
        ]);
    }

    #[Route('/klienci', name: 'clients')]
    public function clients(): Response
    {
        return $this->render('clients.html.twig');
    }
}
