<?php

namespace App\Controller;

use App\Service\MailerService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MailerController extends AbstractController
{
    private MailerService $mailerService;

    public function __construct(MailerService $mailerService)
    {
        $this->mailerService = $mailerService;
    }

    #[Route('/send-mail', name: 'send_mail', methods: [Request::METHOD_POST])]
    public function index(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);
        $email = $data['to'];
        $subject = $data['subject'];
        $message = $data['message'];

        $this->mailerService->sendEmail($email, $subject, $message);

        return new Response('Email envoyé avec succès !');
    }
}