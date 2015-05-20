<?php

namespace TD\TodoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tache
 */
class Tache
{
    /**
     * @var integer
     */
    private $id;
	
	/**
     * @var string
     */
    private $nom;


    /**
     * @var string
     */
    private $libeller;

    /**
     * @var \DateTime
     */
    private $date;


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
     * Set libeller
     *
     * @param string $libeller
     * @return Tache
     */
    public function setLibeller($libeller)
    {
        $this->libeller = $libeller;

        return $this;
    }

    /**
     * Get libeller
     *
     * @return string 
     */
    public function getLibeller()
    {
        return $this->libeller;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Tache
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
     * Set nom
     *
     * @param string $nom
     * @return Tache
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }
}
