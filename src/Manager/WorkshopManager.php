<?php

namespace App\Manager;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class WorkshopManager 

{

    protected $mailer;


    public function __construct( MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendMail($subject, $body)
    {
        $email = (new Email())
            ->from('gonzadelarge@gmail.com')
            ->to('gonzapaint@gmail.com')
            ->subject($subject)
            ->text($body);

        $this->mailer->send($email);
    }


}