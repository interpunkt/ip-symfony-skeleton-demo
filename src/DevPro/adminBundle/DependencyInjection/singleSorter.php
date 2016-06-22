<?php
namespace DevPro\adminBundle\DependencyInjection;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\ContainerInterface;


class singleSorter
{
    private $container;
    public function __construct(ContainerInterface $container, $entity, $namespace)
    {
        $this->container = $container;
        $this->entity = $entity;
        $this->namespace = $namespace;
    }
    public $error; // Error Meldungen
    private $entity; // table Name
    private $direction; // Hier ist definiert ob "up" oder "down" sort
    private $anzahlSort;
    private $namespace;

    // erstes Object
    public  $object_1_id;
    public $object_1_sort_number;
    public $object_1_new_sort_number;
    // zweites Object
    public  $object_2_id;
    public $object_2_sort_number;
    public $object_2_new_sort_number;
    // Methoden
    // Main Action welche im Controller aufgerufen wird
    // Parameter: entityObject(Table), sortDirection(sortup und sortdown), anzahlSorter ( 2 oder 4)
    public function setSort($object, $sortDirection)
    {
        $this->direction = $sortDirection;
        $this->getObjectOne($object);
        if(!empty($this->error))
        {
            return false;
        }
        $this->getSecondObject();
    }
    public function flushSort()
    {
        $this->flushObjectOne();
        $this->flushObjectTwo();
    }
    private function flushObjectOne()
    {
        $em = $this->container->get('doctrine.orm.entity_manager');
        $object = $em->getRepository($this->namespace.':' . $this->entity)->find($this->object_1_id);
        $object->setSort($this->object_1_new_sort_number);
        $em->flush();
    }
    private function flushObjectTwo()
    {
        $em = $this->container->get('doctrine.orm.entity_manager');
        $object = $em->getRepository($this->namespace.':' . $this->entity)->find($this->object_2_id);
        $object->setSort($this->object_2_new_sort_number);
        $em->flush();
    }
    /*
     * 1. Object
     *
     */
    // Hole Object Daten
    private function getObjectOne($object)
    {
        $this->object_1_id = $object->getId();
        $this->object_1_sort_number = $object->getSort();
        $this->getNewSortNumberSortUpObjectOne();
    }
    // sort up - store neue Sort Number
    private function getNewSortNumberSortUpObjectOne()
    {
        //$sort_number++;
        // Ersetze Inkrement mit get next SortNumber
        $em = $this->container->get('doctrine.orm.entity_manager');
        if($this->direction == 'sortup')
        {
            $object = $em->getRepository($this->namespace.':'.$this->entity)->findby([], ["sort" => "ASC"]);
        }
        else
        {
            $object = $em->getRepository($this->namespace.':'.$this->entity)->findby([], ["sort" => "DESC"]);
        }
        foreach($object as $value)
        {
            if(isset($treffer))
            {
                $this->object_1_new_sort_number = $value->getSort();
                break;
            }
            if($value->getId() == $this->object_1_id)
            {
                $treffer = true;
            }
        }
        if($this->object_1_new_sort_number == null)
        {
            /* var_dump($this->object_1_new_sort_number);*/
            if($this->direction == 'sortup')
            {
                $this->error = 'Sortieren nach oben nicht möglich.';
            }
            else
            {
                $this->error = 'Sortieren nach unten nicht möglich.';
            }
            return false;
        }
        //$this->object_1_new_sort_number = $sort_number;
    }
    // Das 2. Object holen wir uns über die neue Sort Number
    private function getSecondObject()
    {
        $em = $this->container->get('doctrine.orm.entity_manager');
        $object = $em->getRepository($this->namespace.':'.$this->entity)->findby(["sort" => $this->object_1_new_sort_number]);
        $this->object_2_id = $object[0]->getId();
        $this->object_2_sort_number = $object[0]->getSort();
        $this->object_2_new_sort_number = $this->object_1_sort_number;
    }
    /*
     * 2. Object
     *
     */
    private function getObjectTwo($object)
    {
        $this->object_2_id = $object->getId();
        $this->object_2_sort_number = $object->getSort();
    }
}