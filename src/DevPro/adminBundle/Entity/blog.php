<?php
// src/adminBundle/Entity/Settings.php

namespace DevPro\adminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="blog")
 */
class blog
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
    protected $titel;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $image;

    /**
     * @ORM\Column(type="text")
     */
    protected $content;

    /**
     * @ORM\Column(type="string", length=255)
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
     * Set titel
     *
     * @param string $titel
     * @return Blog
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
     * @return Blog
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
     * @return Blog
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
     * Set seo_titel
     *
     * @param string $seoTitel
     * @return Blog
     */
    public function setSeoTitel($seoTitel)
    {
        $this->seo_titel = $seoTitel;

        return $this;
    }

    /**
     * Get seo_titel
     *
     * @return string 
     */
    public function getSeoTitel()
    {
        return $this->seo_titel;
    }

    /**
     * Set seo_description
     *
     * @param string $seoDescription
     * @return Blog
     */
    public function setSeoDescription($seoDescription)
    {
        $this->seo_description = $seoDescription;

        return $this;
    }

    /**
     * Get seo_description
     *
     * @return string 
     */
    public function getSeoDescription()
    {
        return $this->seo_description;
    }

    /**
     * Set date
     *
     * @param \Datetime $date
     * @return Blog
     */
    public function setDate(\Datetime $date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \Datetime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set image
     *
     * @param string $image
     * @return blog
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string 
     */
    public function getImage()
    {
        return $this->image;
    }
}
