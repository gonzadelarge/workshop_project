<?php

namespace App\Manager;

use Mael\InterventionImageBundle\MaelInterventionImageManager;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class WorkshopManager 
{


    protected $imageManger;
    protected $mailer;


    public function __construct(MaelInterventionImageManager $mensaje, MailerInterface $mailer)
    {
        $this->imageManger = $mensaje;
        $this->mailer-> $mailer;
    }

    public function sendMail($subject, $body)
    {
        $email = (new Email())
            ->from('moycarretero@gmail.com')
            ->to('gonzapaint@gmail.com')
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject($subject)
            ->text($body);
            //->html('<p>See Twig integration for better HTML integration!</p>');

        $this->mailer->send($email);
    }


}