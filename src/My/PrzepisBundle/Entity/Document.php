<?php

namespace My\PrzepisBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Document
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Document
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    public $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    public $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public $path;

	/**
	* @Assert\File(maxSize="6000000")
	*/
	public $file;
	
	/**
     * @ORM\ManyToOne(targetEntity="Przepis", inversedBy="image")
     * @ORM\JoinColumn(name="przepis_id", referencedColumnName="id")
     * */
    protected $przepis;
	
    public function getAbsolutePath()
    {
        return null === $this->path
            ? null
            : $this->getUploadRootDir().'/'.$this->path;
    }

    public function getWebPath()
    {
        return null === $this->path
            ? null
            : $this->getUploadDir().'/'.$this->path;
    }

    protected function getUploadRootDir()
    {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'images';
    }
	public function upload()
	{
	    // the file property can be empty if the field is not required
	    if (null === $this->file) {
	        return;
	    }
        // name of the file 
        $name = uniqid().'.jpg';
	    // use the original file name here but you should
	    // sanitize it at least to avoid any security issues
	
	    // move takes the target directory and then the
	    // target filename to move to
	    $this->file->move(
	        $this->getUploadRootDir(),
	        $name
	    );
	
	    // set the path property to the filename where you've saved the file
	    $this->path = $name;
	
	    // clean up the file property as you won't need it anymore
	    $this->file = null;
	}


    /**
     * Set przepis
     *
     * @param \My\PrzepisBundle\Entity\Przepis $przepis
     * @return Document
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
     * Set name
     *
     * @param string $name
     * @return Document
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set path
     *
     * @param string $path
     * @return Document
     */
    public function setPath($path)
    {
        $this->path = $path;
    
        return $this;
    }

    /**
     * Get path
     *
     * @return string 
     */
    public function getPath()
    {
        return $this->path;
    }
}