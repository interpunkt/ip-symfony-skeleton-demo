<?php

namespace DevPro\BackendBundle\Newsletter;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Templating\EngineInterface;
use Symfony\Bridge\Twig\TwigEngine;


class NewsletterManager
{
    protected $mailer;

    protected $templating;

    public function __construct(
        \Swift_Mailer $mailer,
        EngineInterface $templating
    ) {
        $this->mailer = $mailer;
        $this->templating = $templating;
    }

    public function sendmail($mail)
    {
        $message = \Swift_Message::newInstance()
            ->setSubject('Hello Email')
            ->setFrom('send@example.com')
            ->setTo('recipient@example.com')
            ->setBody(
                $this->templating->renderView(
                // app/Resources/views/Emails/registration.html.twig
                    'Backend/index.html.twig',
                    array('name' => 'foo')
                ),
                'text/html'
            )
            /*
             * If you also want to include a plaintext version of the message
            ->addPart(
                $this->renderView(
                    'Emails/registration.txt.twig',
                    array('name' => $name)
                ),
                'text/plain'
            )
            */
        ;
        $this->mailer->send($message);


    }
}