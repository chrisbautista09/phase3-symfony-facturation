<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Sensiolabs\GotenbergBundle\GotenbergPdfInterface;
use Sensiolabs\GotenbergBundle\Processor\TempfileProcessor;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Part\DataPart;
use Symfony\Component\Mime\Part\File;

final class MailController extends AbstractController
{
    public function __construct(private LoggerInterface $logger){}


    #[Route('/mail', name: 'app_mail')]
    public function index(MailerInterface $mailer, GotenbergPdfInterface $gotenberg): Response
    {
        $filePdf = $gotenberg->html()
        ->content($this->renderView('test/index.html.twig'))
        ->processor(new TempfileProcessor())
        ->generate()
        ->process();

        $email = new Email();
        $email->from("trucmachin@laposte.com")
        ->to("bidulle.chouet@gladalle.com")
        ->subject("le peuple à faim")
        ->html("Coucou")
        ->attachFromPath($filePdf->getPathname(), 'document.pdf');
        
        $mailer->send($email);
        
        return $this->render('mail/index.html.twig', [
            'controller_name' => 'MailController',
        ]);
    }
}
