<?php

namespace Cdm\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * The User entity
 * 
 * @ORM\Table(name="users",uniqueConstraints={@ORM\UniqueConstraint(name="unique_email", columns={"email"})})
 * @ORM\Entity(repositoryClass="Cdm\UserBundle\Repository\UserRepository")  
 * @UniqueEntity(fields="email", message="Email id entered is already registered. Please try a new email id")
 * @package UserBundle
 */

class User implements AdvancedUserInterface
{
    const DEFAULT_ACTIVE_STATUS = false;
    const HASH = 'cdm';
    
    /**
     * User ID
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
     * user password
     * @ORM\Column(name="password", type="string") 
     * @var string
     */
    protected $password;
    
    /**
     * @ORM\Column(name="activo", type="boolean")
     * @var boolean
     */
    protected $active;
    
    /**
     * @ORM\Column(name="token", nullable=true);
     * @var string
     */
    protected $token;
    
    /**
     * @ORM\Column()
     * @var string 
     */
    protected $hash = self::HASH;

    /**
     * @ORM\Column()
     * @var string Password salt
     */
    protected $salt;
    
    /**
     * @ORM\OneToOne(targetEntity="Entity", cascade={"all"})
     * @var entity object 
     */
    protected $entity;
    
    /**
     * Is Super Admin
     * 
     * @ORM\Column(type="boolean")
     * @var boolean 
     */
    protected $isSuperAdmin;
    
    /**
     * Date of Creation
     * @ORM\Column(name="fecha_insercion", type="integer", nullable=false)
     * @var integer
     */
    protected $created;    
    
    /**
     * @ORM\ManyToOne(targetEntity="user", cascade={"all"})
     * @ORM\JoinColumn(name="createdBy", referencedColumnName="id", nullable=true)
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
     * @ORM\ManyToOne(targetEntity="user", cascade={"all"})
     * @ORM\JoinColumn(name="updatedBy", referencedColumnName="id", nullable=true) 
     * @var user 
     */
    protected $updatedBy;
    
    public function __construct() 
    {
        $this->salt = rand();
        
        $this->created = time();
        
        $this->updated = time();
        
        $this->isSuperAdmin = false;

        $this->active = true;
    }
    
    /**
     * {@inheritdoc}
     */
    public function isAccountNonExpired()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function isCredentialsNonExpired()
    {
        return true;
    }

    /**
     * 
     * {@inheritdoc}
     */
    public function isAccountNonLocked()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function eraseCredentials()
    {
        return true;
    }
    
    public function isEnabled()
    {
       return $this->active;
    }
    
    public function getRoles()
    {
        $roles = $this->getEntity()->getGroup()->getRole();
        
        foreach($roles as $role){
            $description[] = 'ROLE_' . strtoupper($role->getDescription());
        }
        
        //return $description;

        return array('ROLE_ADMIN');
    }
        
    public function getPassword()
    {
        return $this->password;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getUsername()
    {
        return $this->getEmail();
    }
    
    public function getEmail()
    {
        return $this->email;
    }
    
    public function getSalt()
    {
        return $this->salt;
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
     * Set email
     *
     * @param string $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Set active
     *
     * @param boolean $active
     * @return User
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
     * Set token
     *
     * @param string $token
     * @return User
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Get token
     *
     * @return string 
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set hash
     *
     * @param string $hash
     * @return User
     */
    public function setHash($hash)
    {
        $this->hash = $hash;

        return $this;
    }

    /**
     * Get hash
     *
     * @return string 
     */
    public function getHash()
    {
        return $this->hash;
    }

    /**
     * Set salt
     *
     * @param string $salt
     * @return User
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }

    public function getIsSuperAdmin()
    {
        return $this->isSuperAdmin;
    }
    
    public function setIsSuperAdmin($status = false)
    {
        $this->isSuperAdmin = $status;
        
        return $this;
    }
    /**
     * Set created
     *
     * @param integer $created
     * @return User
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
     * @return User
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
     * Set entity
     *
     * @param \Cdm\UserBundle\Entity\entity $entity
     * @return User
     */
    public function setEntity(\Cdm\UserBundle\Entity\entity $entity = null)
    {
        $this->entity = $entity;

        return $this;
    }

    /**
     * Get entity
     *
     * @return \Cdm\UserBundle\Entity\entity 
     */
    public function getEntity()
    {
        return $this->entity;
    }

    /**
     * Set createdBy
     *
     * @param \Cdm\UserBundle\Entity\user $createdBy
     * @return User
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
     * @return User
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
