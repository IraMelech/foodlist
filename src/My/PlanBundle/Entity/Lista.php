<?php

namespace My\PlanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Lista
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Lista
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
    * @ORM\OneToMany(targetEntity="PrzepisyListy", mappedBy="lista", cascade={"all"})
    * */
    protected $przepisy;


    /**
    * @ORM\OneToMany(targetEntity="SkladnikiListy", mappedBy="lista", cascade={"all"})
    * */
    protected $skladniki;
    

    /**
    * @ORM\ManyToOne(targetEntity="My\UserBundle\Entity\User", inversedBy="Listy")
    * */
    protected $user;
    
    public function __toString()
    {
        return $this->nazwa;
    }


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->przepisy = new \Doctrine\Common\Collections\ArrayCollection();
        $this->skladniki = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Lista
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
     * Add przepisy
     *
     * @param \My\PlanBundle\Entity\PrzepisyListy $przepisy
     * @return Lista
     */
    public function addPrzepisy(\My\PlanBundle\Entity\PrzepisyListy $przepisy)
    {
        $this->przepisy[] = $przepisy;
    
        return $this;
    }

    /**
     * Remove przepisy
     *
     * @param \My\PlanBundle\Entity\PrzepisyListy $przepisy
     */
    public function removePrzepisy(\My\PlanBundle\Entity\PrzepisyListy $przepisy)
    {
        $this->przepisy->removeElement($przepisy);
    }

    /**
     * Get przepisy
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPrzepisy()
    {
        return $this->przepisy;
    }

    /**
     * Add skladniki
     *
     * @param \My\PlanBundle\Entity\SkladnikiListy $skladniki
     * @return Lista
     */
    public function addSkladniki(\My\PlanBundle\Entity\SkladnikiListy $skladniki)
    {
        $this->skladniki[] = $skladniki;
    
        return $this;
    }

    /**
     * Remove skladniki
     *
     * @param \My\PlanBundle\Entity\SkladnikiListy $skladniki
     */
    public function removeSkladniki(\My\PlanBundle\Entity\SkladnikiListy $skladniki)
    {
        $this->skladniki->removeElement($skladniki);
    }

    /**
     * Get skladniki
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSkladniki()
    {
        return $this->skladniki;
    }

    /**
     * Set user
     *
     * @param \My\UserBundle\Entity\User $user
     * @return Lista
     */
    public function setUser(\My\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;
    
        return $this;
    }

    /**
     * Get user
     *
     * @return \My\UserBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }
}