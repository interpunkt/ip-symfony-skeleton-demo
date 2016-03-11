<?php
// src/BackendBundle/Entity/Settings.php

namespace DevPro\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="blog_seo")
 */
class BlogSeo
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $seo_titel;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $seo_description;



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
     * Set seo_titel
     *
     * @param string $seoTitel
     * @return BlogSeo
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
     * @return BlogSeo
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
}
