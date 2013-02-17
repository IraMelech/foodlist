<?php

namespace My\PrzepisBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Krok
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Krok
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
     * @ORM\Column(name="opis", type="string", length=255)
     */
    private $opis;

    /**
     * @var integer
     *
     * @ORM\Column(name="czas", type="integer")
     */
    private $czas;

   /**
     * @ORM\ManyToOne(targetEntity="Przepis", inversedBy="sp")
     * @ORM\JoinColumn(name="przepis_id", referencedColumnName="id")
     * */
    protected $przepis;


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
     * Set opis
     *
     * @param string $opis
     * @return Krok
     */
    public function setOpis($opis)
    {
        $this->opis = $opis;
    
        return $this;
    }

    /**
     * Get opis
     *
     * @return string 
     */
    public function getOpis()
    {
        return $this->opis;
    }

    /**
     * Set czas
     *
     * @param integer $czas
     * @return Krok
     */
    public function setCzas($czas)
    {
        $this->czas = $czas;
    
        return $this;
    }

    /**
     * Get czas
     *
     * @return integer 
     */
    public function getCzas()
    {
        return $this->czas;
    }



    /**
     * Set przepis
     *
     * @param \My\PrzepisBundle\Entity\Przepis $przepis
     * @return Krok
     */
    public function setPrzepis(\My\PrzepisBundle\Entity\Przepis $przepis = null)
    {
        $this->przepis = $przepis;
    
        return $this;
    }

    /**
     * Get przepis
     *
     * @return \My\PrzepisBundle\Entity\Przepis 
     */
    public function getPrzepis()
    {
        return $this->przepis;
    }
}