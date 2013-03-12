<?php

namespace My\PrzepisBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Przepis
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="PrzepisRespository")
 */
class Przepis
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
    * @var string $slug
    *
    * @Gedmo\Slug(fields={"nazwa"})
    * @ORM\Column(length=255, unique=true)
    */
    private $slug;

    /**
     * @ORM\OneToMany(targetEntity="SkladnikPrzepisu", mappedBy="przepis", cascade={"all"})
     * */
    protected $sp;

    /**
     * @ORM\OneToMany(targetEntity="Krok", mappedBy="przepis", cascade={"all"})
     * */
    protected $krok;

    /**
     * @ORM\OneToMany(targetEntity="Images", mappedBy="przepis", cascade={"all"})
     * */
    public $image;

    /**
    * @ORM\OneToMany(targetEntity="My\PlanBundle\Entity\PrzepisyListy", mappedBy="przepis", cascade={"all"})
    * */
    protected $listy;
    
    /**
     * @ORM\ManyToOne(targetEntity="My\UserBundle\Entity\User", inversedBy="przepis")
     * */
    protected $user;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->sp = new \Doctrine\Common\Collections\ArrayCollection();
        $this->krok = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Przepis
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
     * @return Przepis
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

    public function __toString()
    {
    return $this->nazwa;
    }


    /**
     * Add krok
     *
     * @param \My\PrzepisBundle\Entity\Krok $krok
     * @return Przepis
     */
    public function addKrok(\My\PrzepisBundle\Entity\Krok $krok)
    {
        $this->krok[] = $krok;
    
        return $this;
    }

    /**
     * Remove krok
     *
     * @param \My\PrzepisBundle\Entity\Krok $krok
     */
    public function removeKrok(\My\PrzepisBundle\Entity\Krok $krok)
    {
        $this->krok->removeElement($krok);
    }

    /**
     * Get krok
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getKrok()
    {
        return $this->krok;
    }

    /**
     * Add image
     *
     * @param \My\PrzepisBundle\Entity\Images $image
     * @return Przepis
     */
    public function addImage(\My\PrzepisBundle\Entity\Images $image)
    {
        $this->image[] = $image;
    
        return $this;
    }

    /**
     * Remove image
     *
     * @param \My\PrzepisBundle\Entity\Images $image
     */
    public function removeImage(\My\PrzepisBundle\Entity\Images $image)
    {
        $this->image->removeElement($image);
    }

    /**
     * Get image
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Przepis
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    
        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set user
     *
     * @param \My\UserBundle\Entity\User $user
     * @return Przepis
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

    /**
     * Add listy
     *
     * @param \My\PlanBundle\Entity\PrzepisyListy $listy
     * @return Przepis
     */
    public function addListy(\My\PlanBundle\Entity\PrzepisyListy $listy)
    {
        $this->listy[] = $listy;
    
        return $this;
    }

    /**
     * Remove listy
     *
     * @param \My\PlanBundle\Entity\PrzepisyListy $listy
     */
    public function removeListy(\My\PlanBundle\Entity\PrzepisyListy $listy)
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