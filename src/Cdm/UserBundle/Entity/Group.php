<?php

namespace Cdm\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * The Group (grupos) entity
 * @ORM\Table(name="grupos")
 * @ORM\Entity(repositoryClass="Cdm\UserBundle\Repository\GroupRepository")
 * @package UserBundle
 */

class Group
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
     * @ORM\Column(name="activo", type="boolean")
     * @var entity object 
     */
    protected $active;
    
    /**
     * @ORM\OneToMany(targetEntity="Entity", mappedBy="group", cascade={"persist"})
     * @var entity object 
     */
    protected $entity;
    
    /**
     * @ORM\ManyToMany(targetEntity="Role", inversedBy="group")
     * @var role object 
     */
    protected $role;
    
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
        $this->active = false;
        
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
     * @return Group
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
     * Set active
     *
     * @param boolean $active
     * @return Group
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return boolean 
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set created
     *
     * @param integer $created
     * @return Group
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
     * @return Group
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
     * @return Group
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
     * @return Group
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
     * @return Group
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



    /**
     * Add role
     *
     * @param \Cdm\UserBundle\Entity\Role $role
     * @return Group
     */
    public function addRole(\Cdm\UserBundle\Entity\Role $role)
    {
        $this->role[] = $role;

        return $this;
    }

    /**
     * Remove role
     *
     * @param \Cdm\UserBundle\Entity\Role $role
     */
    public function removeRole(\Cdm\UserBundle\Entity\Role $role)
    {
        $this->role->removeElement($role);
    }

    /**
     * Get role
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRole()
    {
        return $this->role;
    }
}
