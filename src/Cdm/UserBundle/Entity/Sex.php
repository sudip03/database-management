<?php

namespace Cdm\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * The Sex (sexo) entity
 * @ORM\Table(name="sexo")
 * @ORM\Entity(repositoryClass="Cdm\UserBundle\Repository\SexRepository")
 * @package UserBundle
 */

class Sex
{
    /**
     * Entity ID
     *
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */

    protected $id;
    
   /**
    * @ORM\Column(name="descripcion", type="string", nullable=false)
    * @var string 
    */
    protected $description;
    
    /**
     * @ORM\OneToMany(targetEntity="Entity", mappedBy="sex", cascade={"persist"})
     * @var entity object 
     */
    protected $entity;
    
    /**
     * Date of Creation
     * @ORM\Column(name="fecha_insercion", type="integer", nullable=false)
     * @var integer
     */
    protected $created;    
    
    /**
     * @ORM\OneToOne(targetEntity="user", cascade={"all"})
     * @var user 
     */
    protected $createdBy;
    
    
    /**
     * Date of Creation
     * @ORM\Column(name="fecha_actualizacion", type="integer", nullable=false)
     * @var integer
     */
    protected $updated;
    
    
    /**
     * @ORM\OneToOne(targetEntity="user", cascade={"all"}) 
     * @var user 
     */
    protected $updatedBy;
  
    public function __construct()
    {
        $this->created = time();

        $this->updated = time();

        $this->entity = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set description
     *
     * @param string $description
     * @return Sex
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set created
     *
     * @param integer $created
     * @return Sex
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return integer 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param integer $updated
     * @return Sex
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return integer 
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set createdBy
     *
     * @param \Cdm\UserBundle\Entity\user $createdBy
     * @return Sex
     */
    public function setCreatedBy(\Cdm\UserBundle\Entity\user $createdBy = null)
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * Get createdBy
     *
     * @return \Cdm\UserBundle\Entity\user 
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * Set updatedBy
     *
     * @param \Cdm\UserBundle\Entity\user $updatedBy
     * @return Sex
     */
    public function setUpdatedBy(\Cdm\UserBundle\Entity\user $updatedBy = null)
    {
        $this->updatedBy = $updatedBy;

        return $this;
    }

    /**
     * Get updatedBy
     *
     * @return \Cdm\UserBundle\Entity\user 
     */
    public function getUpdatedBy()
    {
        return $this->updatedBy;
    }
    

    /**
     * Add entity
     *
     * @param \Cdm\UserBundle\Entity\Entity $entity
     * @return Sex
     */
    public function addEntity(\Cdm\UserBundle\Entity\Entity $entity)
    {
        $this->entity[] = $entity;

        return $this;
    }

    /**
     * Remove entity
     *
     * @param \Cdm\UserBundle\Entity\Entity $entity
     */
    public function removeEntity(\Cdm\UserBundle\Entity\Entity $entity)
    {
        $this->entity->removeElement($entity);
    }

    /**
     * Get entity
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEntity()
    {
        return $this->entity;
    }
}
