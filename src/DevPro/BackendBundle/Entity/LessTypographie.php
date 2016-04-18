<?php
// src/AppBundle/Entity/Settings.php

namespace DevPro\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="less_typographie")
 */
class LessTypographie
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
    protected $h_one;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $h_two;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $h_three;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $font_size;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $font;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $font_family;

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
     * Set font_size
     *
     * @param string $fontSize
     * @return LessTypographie
     */
    public function setFontSize($fontSize)
    {
        $this->font_size = $fontSize;

        return $this;
    }

    /**
     * Get font_size
     *
     * @return string 
     */
    public function getFontSize()
    {
        return $this->font_size;
    }

    /**
     * Set font
     *
     * @param string $font
     * @return LessTypographie
     */
    public function setFont($font)
    {
        $this->font = $font;

        return $this;
    }

    /**
     * Get font
     *
     * @return string 
     */
    public function getFont()
    {
        return $this->font;
    }

    /**
     * Set font_family
     *
     * @param string $fontFamily
     * @return LessTypographie
     */
    public function setFontFamily($fontFamily)
    {
        $this->font_family = $fontFamily;

        return $this;
    }

    /**
     * Get font_family
     *
     * @return string 
     */
    public function getFontFamily()
    {
        return $this->font_family;
    }

    /**
     * Set h_one
     *
     * @param string $hOne
     * @return LessTypographie
     */
    public function setHOne($hOne)
    {
        $this->h_one = $hOne;

        return $this;
    }

    /**
     * Get h_one
     *
     * @return string 
     */
    public function getHOne()
    {
        return $this->h_one;
    }

    /**
     * Set h_two
     *
     * @param string $hTwo
     * @return LessTypographie
     */
    public function setHTwo($hTwo)
    {
        $this->h_two = $hTwo;

        return $this;
    }

    /**
     * Get h_two
     *
     * @return string 
     */
    public function getHTwo()
    {
        return $this->h_two;
    }

    /**
     * Set h_three
     *
     * @param string $hThree
     * @return LessTypographie
     */
    public function setHThree($hThree)
    {
        $this->h_three = $hThree;

        return $this;
    }

    /**
     * Get h_three
     *
     * @return string 
     */
    public function getHThree()
    {
        return $this->h_three;
    }
}
