<?php
// src/AppBundle/Entity/Settings.php

namespace DevPro\BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="less")
 */
class Less
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
    protected $primary_color;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $secondary_color;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $primary_color_light;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $secondary_color_dark;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $highlight_success;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $highlight_info;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $highlight_notice;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $highlight_error;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $text_color;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $link_color;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $link_color_hover;


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
     * Set primary_color
     *
     * @param string $primaryColor
     * @return Settings
     */
    public function setPrimaryColor($primaryColor)
    {
        $this->primary_color = $primaryColor;

        return $this;
    }

    /**
     * Get primary_color
     *
     * @return string
     */
    public function getPrimaryColor()
    {
        return $this->primary_color;
    }

    /**
     * Set secondary_color
     *
     * @param string $secondaryColor
     * @return Settings
     */
    public function setSecondaryColor($secondaryColor)
    {
        $this->secondary_color = $secondaryColor;

        return $this;
    }

    /**
     * Get secondary_color
     *
     * @return string
     */
    public function getSecondaryColor()
    {
        return $this->secondary_color;
    }

    /**
     * Set primary_color_light
     *
     * @param string $primaryColorLight
     * @return Less
     */
    public function setPrimaryColorLight($primaryColorLight)
    {
        $this->primary_color_light = $primaryColorLight;

        return $this;
    }

    /**
     * Get primary_color_light
     *
     * @return string 
     */
    public function getPrimaryColorLight()
    {
        return $this->primary_color_light;
    }

    /**
     * Set secondary_color_dark
     *
     * @param string $secondaryColorDark
     * @return Less
     */
    public function setSecondaryColorDark($secondaryColorDark)
    {
        $this->secondary_color_dark = $secondaryColorDark;

        return $this;
    }

    /**
     * Get secondary_color_dark
     *
     * @return string 
     */
    public function getSecondaryColorDark()
    {
        return $this->secondary_color_dark;
    }

    /**
     * Set highlight_success
     *
     * @param string $highlightSuccess
     * @return Less
     */
    public function setHighlightSuccess($highlightSuccess)
    {
        $this->highlight_success = $highlightSuccess;

        return $this;
    }

    /**
     * Get highlight_success
     *
     * @return string 
     */
    public function getHighlightSuccess()
    {
        return $this->highlight_success;
    }

    /**
     * Set highlicht_info
     *
     * @param string $highlichtInfo
     * @return Less
     */
    public function setHighlichtInfo($highlichtInfo)
    {
        $this->highlicht_info = $highlichtInfo;

        return $this;
    }

    /**
     * Get highlicht_info
     *
     * @return string 
     */
    public function getHighlichtInfo()
    {
        return $this->highlicht_info;
    }

    /**
     * Set highlight_notice
     *
     * @param string $highlightNotice
     * @return Less
     */
    public function setHighlightNotice($highlightNotice)
    {
        $this->highlight_notice = $highlightNotice;

        return $this;
    }

    /**
     * Get highlight_notice
     *
     * @return string 
     */
    public function getHighlightNotice()
    {
        return $this->highlight_notice;
    }

    /**
     * Set hightlight_error
     *
     * @param string $hightlightError
     * @return Less
     */
    public function setHightlightError($hightlightError)
    {
        $this->hightlight_error = $hightlightError;

        return $this;
    }

    /**
     * Get hightlight_error
     *
     * @return string 
     */
    public function getHightlightError()
    {
        return $this->hightlight_error;
    }

    /**
     * Set highlight_info
     *
     * @param string $highlightInfo
     * @return Less
     */
    public function setHighlightInfo($highlightInfo)
    {
        $this->highlight_info = $highlightInfo;

        return $this;
    }

    /**
     * Get highlight_info
     *
     * @return string 
     */
    public function getHighlightInfo()
    {
        return $this->highlight_info;
    }

    /**
     * Set highlight_error
     *
     * @param string $highlightError
     * @return Less
     */
    public function setHighlightError($highlightError)
    {
        $this->highlight_error = $highlightError;

        return $this;
    }

    /**
     * Get highlight_error
     *
     * @return string 
     */
    public function getHighlightError()
    {
        return $this->highlight_error;
    }

    /**
     * Set text_color
     *
     * @param string $textColor
     * @return Less
     */
    public function setTextColor($textColor)
    {
        $this->text_color = $textColor;

        return $this;
    }

    /**
     * Get text_color
     *
     * @return string 
     */
    public function getTextColor()
    {
        return $this->text_color;
    }

    /**
     * Set link_color
     *
     * @param string $linkColor
     * @return Less
     */
    public function setLinkColor($linkColor)
    {
        $this->link_color = $linkColor;

        return $this;
    }

    /**
     * Get link_color
     *
     * @return string 
     */
    public function getLinkColor()
    {
        return $this->link_color;
    }

    /**
     * Set link_color_hover
     *
     * @param string $linkColorHover
     * @return Less
     */
    public function setLinkColorHover($linkColorHover)
    {
        $this->link_color_hover = $linkColorHover;

        return $this;
    }

    /**
     * Get link_color_hover
     *
     * @return string 
     */
    public function getLinkColorHover()
    {
        return $this->link_color_hover;
    }

    /**
     * Set h1
     *
     * @param string $h1
     * @return Less
     */
    public function setH1($h1)
    {
        $this->h1 = $h1;

        return $this;
    }
}
