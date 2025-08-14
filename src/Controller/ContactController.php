<?php

namespace App\Controller;

use App\Entity\ContactMessage;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ContactController extends AbstractController
{
    #[Route('/kontakt', name: 'contact', methods: ['GET','POST'])]
    public function contact(Request $request, EntityManagerInterface $em): Response
    {
        $message = new ContactMessage();

        $form = $this->createForm(ContactType::class, $message)->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($message);
            $em->flush();

            $this->addFlash('success', 'Dziękuję za wiadomość. Skontaktuję się wkrótce.');
            return $this->redirectToRoute('contact');
        }

        return $this->render('contact.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
