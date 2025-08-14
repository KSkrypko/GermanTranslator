<?php

namespace App\Controller;

use App\Entity\ContactMessage;
use App\Repository\ContactMessageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/messages')]
final class AdminContactController extends AbstractController
{
    #[Route('', name: 'admin_messages_index', methods: ['GET'])]
    public function index(ContactMessageRepository $repo): Response
    {
        return $this->render('admin/contact/index.html.twig', [
            'items' => $repo->findBy([], ['createdAt' => 'DESC']),
        ]);
    }

    #[Route('/{id}/delete', name: 'admin_messages_delete', methods: ['POST'])]
    public function delete(ContactMessage $message, EntityManagerInterface $em): Response
    {
        $em->remove($message);
        $em->flush();

        $this->addFlash('success', 'Wiadomość usunięta.');
        return $this->redirectToRoute('admin_messages_index');
    }
}
