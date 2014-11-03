<?php

namespace Cdm\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * The Role (role) entity
 * @ORM\Table(name="role")
 * @ORM\Entity(repositoryClass="Cdm\UserBundle\Repository\RoleRepository")
 * @package UserBundle
 */

class Role
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
     * @ORM\ManyToMany(targetEntity="Group", mappedBy="role")
     * @var group object 
     */
    protected $group;
    
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
        $this->updated = time();
        
        $this->created = time();
        
        $this->group = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Role
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
     * @return Role
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
     * @return Role
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
     * @return Role
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
     * @return Role
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
     * Add group
     *
     * @param \Cdm\UserBundle\Entity\Group $group
     * @return Role
     */
    public function addGroup(\Cdm\UserBundle\Entity\Group $group)
    {
        $this->group[] = $group;

        return $this;
    }

    /**
     * Remove group
     *
     * @param \Cdm\UserBundle\Entity\Group $group
     */
    public function removeGroup(\Cdm\UserBundle\Entity\Group $group)
    {
        $this->group->removeElement($group);
    }

    /**
     * Get group
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getGroup()
    {
        return $this->group;
    }
}
