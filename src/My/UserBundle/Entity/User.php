<?php
namespace My\UserBundle\Entity;
use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
/**
* @ORM\Entity
* @ORM\Table(name="fos_user")
*/
class User extends BaseUser
{
	/**
	* @ORM\Id
	* @ORM\Column(type="integer")
	* @ORM\GeneratedValue(strategy="AUTO")
	*/
	protected $id;

	/**
     * @ORM\OneToMany(targetEntity="My\PrzepisBundle\Entity\Przepis" , mappedBy="user" , cascade={"all"})
     * */
    protected $przepis;
	

    /**
    * @ORM\OneToMany(targetEntity="My\PlanBundle\Entity\Lista", mappedBy="user", cascade={"all"})
    * */
    protected $listy;
    
	public function __construct()
	{
		parent::__construct();
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
     * Add przepis
     *
     * @param \My\PrzepisBundle\Entity\Przepis $przepis
     * @return User
     */
    public function addPrzepis(\My\PrzepisBundle\Entity\Przepis $przepis)
    {
        $this->przepis[] = $przepis;
    
        return $this;
    }

    /**
     * Remove przepis
     *
     * @param \My\PrzepisBundle\Entity\Przepis $przepis
     */
    public function removePrzepis(\My\PrzepisBundle\Entity\Przepis $przepis)
    {
        $this->przepis->removeElement($przepis);
    }

    /**
     * Get przepis
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPrzepis()
    {
        return $this->przepis;
    }

    /**
     * Add przepis
     *
     * @param \My\PrzepisBundle\Entity\Przepis $przepis
     * @return User
     */
    public function addPrzepi(\My\PrzepisBundle\Entity\Przepis $przepis)
    {
        $this->przepis[] = $przepis;
    
        return $this;
    }

    /**
     * Remove przepis
     *
     * @param \My\PrzepisBundle\Entity\Przepis $przepis
     */
    public function removePrzepi(\My\PrzepisBundle\Entity\Przepis $przepis)
    {
        $this->przepis->removeElement($przepis);
    }

    /**
     * Add listy
     *
     * @param \My\PlanBundle\Entity\Lista $listy
     * @return User
     */
    public function addListy(\My\PlanBundle\Entity\Lista $listy)
    {
        $this->listy[] = $listy;
    
        return $this;
    }

    /**
     * Remove listy
     *
     * @param \My\PlanBundle\Entity\Lista $listy
     */
    public function removeListy(\My\PlanBundle\Entity\Lista $listy)
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