<?php

namespace DevPro\BackendBundle\DependencyInjection;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\ContainerInterface;


class globals
{
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    // Beispiel..
    public function getMailNotifactions()
    {
        $data = $em = $this->container->get('doctrine.orm.entity_manager')
            ->getRepository("DevProBackendBundle:Anmeldungen")
            ->findBy(["status" => 0]);

        $counter = count($data);

        return $counter;
    }
}