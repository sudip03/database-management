<?php

namespace Cdm\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * The Invite Entity 
 * @ORM\Table(name="invite")
 * @ORM\Entity(repositoryClass="Cdm\UserBundle\Repository\InviteRepository")
 * @package UserBundle
 */

class Invite
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
     * @ORM\Column(name="email")
     * @Assert\Email
     * @var String 
     */
    protected $email;
    
    /**
     * @ORM\Column(name="token", nullable=true);
     * @var string
     */
    protected $token;
        
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
     * Set Invite Email
     * @param type $email
     * @return \Cdm\UserBundle\Entity\Invite
     */
    public function setEmail($email)
    {
        $this->email = $email;
        
        return $this;
    }
    
    /**
     * Get Email
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }
    
    /**
     * Set Token
     * @param type $token
     * @return \Cdm\UserBundle\Entity\Invite
     */
    public function setToken($token)
    {
        $this->token = $token;
        
        return $this;
    }
    
    /**
     * Get Token
     * @return type
     */
    public function getToken()
    {
        return $this->token;
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

}
