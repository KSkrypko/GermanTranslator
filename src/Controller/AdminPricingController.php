<?php

namespace App\Controller;

use App\Entity\Pricing;
use App\Form\PricingType;
use App\Repository\PricingRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/pricing')]
class AdminPricingController extends AbstractController
{
    #[Route('', name: 'admin_pricing_index', methods: ['GET'])]
    public function index(PricingRepository $repo): Response
    {
        return $this->render('admin/pricing/index.html.twig', ['items' => $repo->findAll()]);
    }

    #[Route('/new', name: 'admin_pricing_new', methods: ['GET','POST'])]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $item = new Pricing();
        $form = $this->createForm(PricingType::class, $item)->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($item);
            $em->flush();
            $this->addFlash('success', 'Dodano pozycję.');
            return $this->redirectToRoute('admin_pricing_index');
        }
        return $this->render('admin/pricing/form.html.twig', ['form' => $form, 'title' => 'Nowa pozycja']);
    }

    #[Route('/{id}/edit', name: 'admin_pricing_edit', methods: ['GET','POST'])]
    public function edit(Pricing $item, Request $request, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(PricingType::class, $item)->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash('success', 'Zapisano zmiany.');
            return $this->redirectToRoute('admin_pricing_index');
        }
        return $this->render('admin/pricing/form.html.twig', ['form' => $form, 'title' => 'Edycja']);
    }

    #[Route('/{id}/delete', name: 'admin_pricing_delete', methods: ['POST'])]
    public function delete(Pricing $item, Request $request, EntityManagerInterface $em): Response
    {
        if ($this->isCsrfTokenValid('del'.$item->getId(), (string)$request->request->get('_token'))) {
            $em->remove($item);
            $em->flush();
            $this->addFlash('success', 'Usunięto pozycję.');
        }
        return $this->redirectToRoute('admin_pricing_index');
    }
}
