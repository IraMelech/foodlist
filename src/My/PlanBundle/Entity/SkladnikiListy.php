<?php

namespace My\PlanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SkladnikiListy
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class SkladnikiListy
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
    * @ORM\ManyToOne(targetEntity="Lista", inversedBy="skladniki")
    * */
    protected $lista;
    
    /**
    * @ORM\ManyToOne(targetEntity="My\PrzepisBundle\Entity\Skladnik", inversedBy="listy")
    * @ORM\JoinColumn(name="skladnik_id", referencedColumnName="id")
    * */
    protected $skladnik;
    


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
     * Set lista
     *
     * @param \My\PlanBundle\Entity\Lista $lista
     * @return SkladnikiListy
     */
    public function setLista(\My\PlanBundle\Entity\Lista $lista = null)
    {
        $this->lista = $lista;
    
        return $this;
    }

    /**
     * Get lista
     *
     * @return \My\PlanBundle\Entity\Lista 
     */
    public function getLista()
    {
        return $this->lista;
    }

    /**
     * Set skladnik
     *
     * @param \My\PrzepisBundle\Entity\Skladnik $skladnik
     * @return SkladnikiListy
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
}