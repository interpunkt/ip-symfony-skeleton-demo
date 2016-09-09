<?php
/*
 * The Doctrine Class is used from the Controllers to perform some Entity Functions like fetch, update, ...
 */
namespace DevPro\adminBundle\Utils;

use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\ContainerInterface;


class database
{
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param $entity
     * @return array
     */
    public function fetchAllDesc( $entity)
    {
        $repository = $this->entityManager->getRepository('DevProadminBundle:' . $entity)
            ->findby(
            [],
            [
                "id" => "DESC"
            ] );

        if ( ! $repository) {
            throw $this->createNotFoundException(
                'Keine Datensätze gefunden für Entity:  ' . $entity . ' in adminBundle/Utils/DoctrineClass'
            );
        }

        return $repository;
    }
}