<?php

namespace DevPro\adminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;

class LayoutController extends Controller
{
    private $entity;
    public function __construct(EntityManager $entityManager)
    {
        $this->entity = $entityManager;
    }

    public function indexAction()
    {
        return new Response('Hello World');
    }
}