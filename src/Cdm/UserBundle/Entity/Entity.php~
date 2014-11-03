<?php

namespace Cdm\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * The Entidades entity
 * 
 * @ORM\Table(name="entidades",uniqueConstraints={@ORM\UniqueConstraint(name="unique_email", columns={"email"})})
 * @ORM\Entity(repositoryClass="Cdm\UserBundle\Repository\EntityRepository")
 * @UniqueEntity(fields="email", message="Email id entered is already registered. Please try a new email id")
 * @package UserBundle
 */
class Entity
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
     * Name
     * @ORM\Column(name="nombre", type="string", nullable=false)
     * @var string 
     */
    protected $name;
    
    
    /**
     * SurName
     * @ORM\Column(name="apellidos", type="string", nullable=false)
     * @var string 
     */
    protected $surname;
    
    
    /**
     * Dni
     * @ORM\Column(name="dni", type="string", nullable=true)
     * @var string 
     */
    protected $dni;
    
    /**
     * Alias
     * @ORM\Column(name="alias", type="string", nullable=true)
     * @var string 
     */
    protected $alias;

    /**
     * Date of Birth (DOB)
     * @ORM\Column(name="f_nacimiento", type="integer", nullable=false)
     * @var integer
     */
    protected $dob;
    
    /**
     * F_Ata (ata)
     * @ORM\Column(name="f_ata", type="integer", nullable=true)
     * @var integer 
     */
    protected $ata;
    
    /**
     * Come Down
     * @ORM\Column(name="f_baja", type="integer", nullable=true)
     * @var integer 
     */
    protected $baja;
    
    /**
     * @ORM\Column(name="email", nullable=false)
     * @Assert\Email
     * @var String 
     */
    protected $email;
    
    /**
     * Phone
     * @ORM\Column(name="telefono", type="string", nullable=true)
     * @var string 
     */
    protected $phone;
    
    /**
     * Street
     * @ORM\Column(name="calle", type="string", nullable=false)
     * @var string 
     */
    protected $street;
    
    /**
     * City
     * @ORM\Column(name="city", type="string", nullable=false)
     * @var string 
     */
    protected $city;
    
    /**
     * Country
     * @ORM\Column(name="country", type="string", nullable=false)
     * @var string
     */
    protected $country;
    
    /**
     * Zip
     * @ORM\Column(name="zip", type="string", nullable=false)
     * @var string
     */
    protected $zip;
    
    /**
     * Population
     * @ORM\Column(name="poblacion", type="string", nullable=true)
     * @var string 
     */
    protected $population;
    
    /**
     * Sex of this Entity, related with sexo(sex) entity of user bundle
     * 
     * @ORM\ManyToOne(targetEntity="Sex", inversedBy="entity", cascade={"persist"})
     * @var object
     */
    protected $sex;
    
    /**
     * Group associated with this entity
     *
     * @ORM\ManyToOne(targetEntity="Group", inversedBy="entity", cascade={"persist"})
     * @var Group 
     */
    protected $group;
    
    /**
     * Maneger of this Entity, related with manejo
     * @ORM\ManyToOne(targetEntity="Manager", inversedBy="entity", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     * @var object
     */
    protected $manager;
    
    /**
     * Photo
     * @ORM\OneToOne(targetEntity="\Cdm\CommonBundle\Entity\Upload", cascade={"all"})
     * @ORM\JoinColumn(nullable=true)
     * @var upload
     */
    protected $photo;
    
    /**
     * Date of Creation
     * @ORM\Column(name="fecha_insercion", type="integer", nullable=false)
     * @var integer
     */
    protected $created;    
    
    /**
     * @ORM\ManyToOne(targetEntity="user", inversedBy="Entitymanager" , cascade={"all"})
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
     * Set name
     *
     * @param string $name
     * @return Entity
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
     * Set surname
     *
     * @param string $surname
     * @return Entity
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get surname
     *
     * @return string 
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Set dni
     *
     * @param string $dni
     * @return Entity
     */
    public function setDni($dni)
    {
        $this->dni = $dni;

        return $this;
    }

    /**
     * Get dni
     *
     * @return string 
     */
    public function getDni()
    {
        return $this->dni;
    }

    /**
     * Set alias
     *
     * @param string $alias
     * @return Entity
     */
    public function setAlias($alias)
    {
        $this->alias = $alias;

        return $this;
    }

    /**
     * Get alias
     *
     * @return string 
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * Set dob
     *
     * @param integer $dob
     * @return Entity
     */
    public function setDob($dob)
    {
        $this->dob = $dob;

        return $this;
    }

    /**
     * Get dob
     *
     * @return integer 
     */
    public function getDob()
    {
        return $this->dob;
    }

    /**
     * Set ata
     *
     * @param integer $ata
     * @return Entity
     */
    public function setAta($ata)
    {
        $this->ata = $ata;

        return $this;
    }

    /**
     * Get ata
     *
     * @return integer 
     */
    public function getAta()
    {
        return $this->ata;
    }

    /**
     * Set baja
     *
     * @param integer $baja
     * @return Entity
     */
    public function setBaja($baja)
    {
        $this->baja = $baja;

        return $this;
    }

    /**
     * Get baja
     *
     * @return integer 
     */
    public function getBaja()
    {
        return $this->baja;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Entity
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set phone
     *
     * @param string $phone
     * @return Entity
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string 
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set street
     *
     * @param string $street
     * @return Entity
     */
    public function setStreet($street)
    {
        $this->street = $street;

        return $this;
    }

    /**
     * Get street
     *
     * @return string 
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Set population
     *
     * @param string $population
     * @return Entity
     */
    public function setPopulation($population)
    {
        $this->population = $population;

        return $this;
    }

    /**
     * Get population
     *
     * @return string 
     */
    public function getPopulation()
    {
        return $this->population;
    }

    /**
     * Set created
     *
     * @param integer $created
     * @return Entity
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
     * @return Entity
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
     * Set sex
     *
     * @param \Cdm\UserBundle\Entity\sexo $sex
     * @return Entity
     */
    public function setSex(\Cdm\UserBundle\Entity\Sex $sex = null)
    {
        $this->sex = $sex;

        return $this;
    }

    /**
     * Get sex
     *
     * @return \Cdm\UserBundle\Entity\sexo 
     */
    public function getSex()
    {
        return $this->sex;
    }

    /**
     * Set manager
     *
     * @param \Cdm\UserBundle\Entity\manejo $manager
     * @return Entity
     */
    public function setManager(\Cdm\UserBundle\Entity\Manager $manager = null)
    {
        $this->manager = $manager;

        return $this;
    }

    /**
     * Get manager
     *
     * @return \Cdm\UserBundle\Entity\manejo 
     */
    public function getManager()
    {
        return $this->manager;
    }

    /**
     * Set photo
     *
     * @param \Cdm\CommonBundle\Entity\Upload $photo
     * @return Entity
     */
    public function setPhoto(\Cdm\CommonBundle\Entity\Upload $photo = null)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get photo
     *
     * @return \Cdm\CommonBundle\Entity\Upload 
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set createdBy
     *
     * @param \Cdm\UserBundle\Entity\user $createdBy
     * @return Entity
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
     * @return Entity
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
     * Set city
     *
     * @param string $city
     * @return Entity
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string 
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set country
     *
     * @param string $country
     * @return Entity
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string 
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set zip
     *
     * @param string $zip
     * @return Entity
     */
    public function setZip($zip)
    {
        $this->zip = $zip;

        return $this;
    }

    /**
     * Get zip
     *
     * @return string 
     */
    public function getZip()
    {
        return $this->zip;
    }


    /**
     * Set group
     *
     * @param \Cdm\UserBundle\Entity\Group $group
     * @return Entity
     */
    public function setGroup(\Cdm\UserBundle\Entity\Group $group = null)
    {
        $this->group = $group;

        return $this;
    }

    /**
     * Get group
     *
     * @return \Cdm\UserBundle\Entity\Group 
     */
    public function getGroup()
    {
        return $this->group;
    }
    
    public function getFullName()
    {
        return $this->getName().' '.$this->getSurname();
    }
}
