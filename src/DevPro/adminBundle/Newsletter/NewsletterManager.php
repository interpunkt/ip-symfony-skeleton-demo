<?php

namespace DevPro\adminBundle\Newsletter;

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

    public function sendmail($htmlbody, $from, $recipient)
    {
        foreach($recipient as $value)
        {
            $message = \Swift_Message::newInstance()
                ->setSubject($htmlbody)
                ->setFrom($from)
                ->setTo($value->getEmail())
                ->setBody(
                // Render the Mesagge from DB set with TinyMCE in Backend...
                    $htmlbody
                    ,
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
            $result[] = $this->mailer->send($message, $failures);

        }

        return $result;

    }
}