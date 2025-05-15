<?php

namespace App\Service;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class MailerService
{
    public function __construct(
        private readonly MailerInterface $mailer,
        private readonly string $noReplyEmail,
        private readonly string $replyEmail,
        private readonly string $fromName,
    ) {
    }

    public function sendEmail(string $to, string $subject, string $content, $fromName = null)
    {
        // On récupère le paramètre s'il est différent de nul
        // sinon on prends la valeur de la variable d'environnement
        $fromName = $fromName ?? $this->fromName;

        $email = (new Email())
            ->from('PortfolioMail@gmail.com')
            ->replyTo($this->replyEmail)
            ->to($to)
            ->subject($subject)
            ->text($content)
            ->html('<p>' . $content . '</p>');

        $this->mailer->send($email);
    }
}