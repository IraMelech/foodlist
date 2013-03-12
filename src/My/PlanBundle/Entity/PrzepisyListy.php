<?php

namespace My\PlanBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PrzepisyListy
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class PrzepisyListy
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
    * @ORM\ManyToOne(targetEntity="Lista", inversedBy="przepisy")
    * */
    protected $lista;

    /**
    * @ORM\ManyToOne(targetEntity="My\PrzepisBundle\Entity\Przepis", inversedBy="listy")
    * @ORM\JoinColumn(name="przepis_id", referencedColumnName="id")
    * */
    protected $przepis;
    
    public function __toString()
    {
        return $this->przepis->getNazwa;
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
     * Set lista
     *
     * @param \My\PlanBundle\Entity\Lista $lista
     * @return PrzepisyListy
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
     * Set przepis
     *
     * @param \My\PrzepisBundle\Entity\Przepis $przepis
     * @return PrzepisyListy
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