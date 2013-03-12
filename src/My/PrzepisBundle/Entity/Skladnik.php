<?php

namespace My\PrzepisBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Skladnik
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Skladnik
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nazwa", type="string", length=255)
     */
    private $nazwa;

    /**
    * @ORM\OneToMany(targetEntity="My\PlanBundle\Entity\SkladnikiListy", mappedBy="skladnik", cascade={"all"})
    * */
    protected $listy;
    
    /**
     * @ORM\OneToMany(targetEntity="SkladnikPrzepisu" , mappedBy="skladnik" , cascade={"all"})
     * */
    protected $sp;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->sp = new \Doctrine\Common\Collections\ArrayCollection();
    }
    public function __toString()
    {
    return $this->nazwa;
    }
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
     * Set nazwa
     *
     * @param string $nazwa
     * @return Skladnik
     */
    public function setNazwa($nazwa)
    {
        $this->nazwa = $nazwa;
    
        return $this;
    }

    /**
     * Get nazwa
     *
     * @return string 
     */
    public function getNazwa()
    {
        return $this->nazwa;
    }

    /**
     * Add sp
     *
     * @param \My\PrzepisBundle\Entity\SkladnikPrzepisu $sp
     * @return Skladnik
     */
    public function addSp(\My\PrzepisBundle\Entity\SkladnikPrzepisu $sp)
    {
        $this->sp[] = $sp;
    
        return $this;
    }

    /**
     * Remove sp
     *
     * @param \My\PrzepisBundle\Entity\SkladnikPrzepisu $sp
     */
    public function removeSp(\My\PrzepisBundle\Entity\SkladnikPrzepisu $sp)
    {
        $this->sp->removeElement($sp);
    }

    /**
     * Get sp
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSp()
    {
        return $this->sp;
    }

    /**
     * Add listy
     *
     * @param \My\PlanBundle\SkladnikiListy $listy
     * @return Skladnik
     */
    public function addListy(\My\PlanBundle\Entity\SkladnikiListy $listy)
    {
        $this->listy[] = $listy;
    
        return $this;
    }

    /**
     * Remove listy
     *
     * @param \My\PlanBundle\SkladnikiListy $listy
     */
    public function removeListy(\My\PlanBundle\Entity\SkladnikiListy $listy)
    {
        $this->listy->removeElement($listy);
    }

    /**
     * Get listy
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getListy()
    {
        return $this->listy;
    }
}