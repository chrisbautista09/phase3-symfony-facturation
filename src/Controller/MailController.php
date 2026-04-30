<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

final class MailController extends AbstractController
{
    #[Route('/mail', name: 'app_mail')]
    public function index(MailerInterface $mailer): Response
    {
        $email = new Email();
        $email->from("trucmachin@laposte.com")
        ->to("bidulle.chouet@gladalle.com")
        ->subject("le peuple à faim")
        ->text("alors qui mange");

        $mailer->send($email);
        
        return $this->render('mail/index.html.twig', [
            'controller_name' => 'MailController',
        ]);
    }
}
