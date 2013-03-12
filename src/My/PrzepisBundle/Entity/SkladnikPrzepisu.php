<?php

namespace My\PrzepisBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SkladnikPrzepisu
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class SkladnikPrzepisu
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
     * @ORM\ManyToOne(targetEntity="Skladnik", inversedBy="sp")
     * @ORM\JoinColumn(name="skladnik_id", referencedColumnName="id")
     * */
    protected $skladnik;

    /**
     * @ORM\ManyToOne(targetEntity="Przepis", inversedBy="sp")
     * @ORM\JoinColumn(name="przepis_id", referencedColumnName="id")
     * */
    protected $przepis;

    /**
     * @var integer
     *
     * @ORM\Column(name="ilosc", type="integer")
     */
    private $ilosc;


    public function __toString()
    {
        return $this->skladnik->getNazwa();
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
     * Set ilosc
     *
     * @param integer $ilosc
     * @return SkladnikPrzepisu
     */
    public function setIlosc($ilosc)
    {
        $this->ilosc = $ilosc;
    
        return $this;
    }

    /**
     * Get ilosc
     *
     * @return integer 
     */
    public function getIlosc()
    {
        return $this->ilosc;
    }

    /**
     * Set skladnik
     *
     * @param \My\PrzepisBundle\Entity\Skladnik $skladnik
     * @return SkladnikPrzepisu
     */
    public function setSkladnik(\My\PrzepisBundle\Entity\Skladnik $skladnik = null)
    {
        $this->skladnik = $skladnik;
    
        return $this;
    }

    /**
     * Get skladnik
     *
     * @return \My\PrzepisBundle\Entity\Skladnik 
     */
    public function getSkladnik()
    {
        return $this->skladnik;
    }

    /**
     * Set przepis
     *
     * @param \My\PrzepisBundle\Entity\Przepis $przepis
     * @return SkladnikPrzepisu
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