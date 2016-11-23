<?php
// src/AppBundle/Entity/settings.php

namespace DevPro\adminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="newsletter")
 */
class Newsletter
{

    public function __construct()
    {
        $this->date = new \DateTime();
    }

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $absender;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $titel;

    /**
     * @ORM\Column(type="text")
     */
    protected $content;

    /**
     * @ORM\Column(type="text")
     */
    protected $sort;



    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Newsletter
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set titel
     *
     * @param string $titel
     * @return Newsletter
     */
    public function setTitel($titel)
    {
        $this->titel = $titel;

        return $this;
    }

    /**
     * Get titel
     *
     * @return string 
     */
    public function getTitel()
    {
        return $this->titel;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return Newsletter
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set sort
     *
     * @param string $sort
     * @return Newsletter
     */
    public function setSort($sort)
    {
        $this->sort = $sort;

        return $this;
    }

    /**
     * Get sort
     *
     * @return string 
     */
    public function getSort()
    {
        return $this->sort;
    }

    /**
     * Set absender
     *
     * @param string $absender
     * @return Newsletter
     */
    public function setAbsender($absender)
    {
        $this->absender = $absender;

        return $this;
    }

    /**
     * Get absender
     *
     * @return string 
     */
    public function getAbsender()
    {
        return $this->absender;
    }
}
