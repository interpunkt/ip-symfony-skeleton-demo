<?php
/*
 * The Doctrine Class is used from the Controllers to perform some Entity Functions like fetch, update, ...
 */
namespace DevPro\adminBundle\Utils;

use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\DependencyInjection\ContainerInterface;


class DoctrineClass
{
    private $container;

    public function __construct(ContainerInterface $container, $entity)
    {
        $this->container = $container;
        $this->entity = $entity;
    }

    public function fetch($id)
    {
        $em = $this->container->get('doctrine.orm.entity_manager');
        $object = $em->getRepository('DevProBackendBundle:' . $this->entity)->find($id);

        if (!$object) {
            throw $this->createNotFoundException(
                'Keine Datensätze gefunden mit ID: ' . $id
            );
        }

        return $object;
    }

    public function fetchAll()
    {
        $em = $this->container->get('doctrine.orm.entity_manager');
        $object = $em->getRepository('DevProBackendBundle:' . $this->entity)->findby(
            array(),
            array(
                "sort" => "ASC"
            ));

        if (!$object) {
            return false;
        }

        return $object;
    }
}