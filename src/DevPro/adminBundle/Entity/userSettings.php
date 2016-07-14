<?php

namespace DevPro\adminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="ip_userSettings")
 */
class userSettings
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
    protected $repo;

    /**
     * @ORM\Column(type="boolean", length=255)
     */
    protected $ip_view;

    /**
     * @ORM\Column(type="boolean", length=255)
     */
    protected $ip_edit;

    /**
     * @ORM\Column(type="boolean", length=255)
     */
    protected $ip_delete;

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
     * @return userSettings
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
     * Set repo
     *
     * @param string $repo
     * @return userSettings
     */
    public function setRepo($repo)
    {
        $this->repo = $repo;

        return $this;
    }

    /**
     * Get repo
     *
     * @return string 
     */
    public function getRepo()
    {
        return $this->repo;
    }

    /**
     * Set view
     *
     * @param boolean $view
     * @return userSettings
     */
    public function setView($view)
    {
        $this->view = $view;

        return $this;
    }

    /**
     * Get view
     *
     * @return boolean 
     */
    public function getView()
    {
        return $this->view;
    }

    /**
     * Set edit
     *
     * @param boolean $edit
     * @return userSettings
     */
    public function setEdit($edit)
    {
        $this->edit = $edit;

        return $this;
    }

    /**
     * Get edit
     *
     * @return boolean 
     */
    public function getEdit()
    {
        return $this->edit;
    }

    /**
     * Set delete
     *
     * @param boolean $delete
     * @return userSettings
     */
    public function setDelete($delete)
    {
        $this->delete = $delete;

        return $this;
    }

    /**
     * Get delete
     *
     * @return boolean 
     */
    public function getDelete()
    {
        return $this->delete;
    }

    /**
     * Set ip_view
     *
     * @param boolean $ipView
     * @return userSettings
     */
    public function setIpView($ipView)
    {
        $this->ip_view = $ipView;

        return $this;
    }

    /**
     * Get ip_view
     *
     * @return boolean 
     */
    public function getIpView()
    {
        return $this->ip_view;
    }

    /**
     * Set ip_edit
     *
     * @param boolean $ipEdit
     * @return userSettings
     */
    public function setIpEdit($ipEdit)
    {
        $this->ip_edit = $ipEdit;

        return $this;
    }

    /**
     * Get ip_edit
     *
     * @return boolean 
     */
    public function getIpEdit()
    {
        return $this->ip_edit;
    }

    /**
     * Set ip_delete
     *
     * @param boolean $ipDelete
     * @return userSettings
     */
    public function setIpDelete($ipDelete)
    {
        $this->ip_delete = $ipDelete;

        return $this;
    }

    /**
     * Get ip_delete
     *
     * @return boolean 
     */
    public function getIpDelete()
    {
        return $this->ip_delete;
    }
}
