<?php
namespace Cdm\CommonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\PersistentCollection;

/**
 * File Upload Entity
 *
 * @ORM\Table(name="uploads")
 * @ORM\Entity(repositoryClass="Cdm\CommonBundle\Repository\UploadRepository")
 * @ORM\HasLifecycleCallbacks
 * 
 */
class Upload
{
    const KEY           = 'AKIAI2MU3CRJL5JYYOJQ';
    const SECRET        = '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';
    const BUCKET        = 'Cdm';
    const BUCKET_PREFIX = '/uploads/';
    const STATUS_ACTIVE = 1;
    
    /**
     * @ORM\Column(type="integer", name="id", options={"unsigned"=true})
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Id
     * @var integer
     */
    protected $id; 
    
    /**
     * @Assert\File(maxSize="6000000")
     * @var UploadedFile
     */
    protected $file;
    
    /**
     * The file key
     * 
     * @var string file key
     * @ORM\Column(name="file_key", nullable=true)
     */
    protected $key;

    /**
     * @var string
     *
     * @ORM\Column(name="file_name", nullable=true)
     */
    protected $name;
    
    /**
     * The mime type
     * 
     * @var string
     * @ORM\Column(name="mime_type", nullable=true)
     */
    protected $type;
    
    /**
     * @ORM\Column(type="integer", options={"unsigned"=true})
     * @var integer 
     */
    protected $created;
    
     /**
     * @ORM\Column(type="integer", options={"unsigned"=true})
     * @var integer 
     */
    protected $updated;
    /**
     * @ORM\Column(type="integer")
     * @var int User Status
     */
    protected $status;
    
    /**
     * Default constructor
     */
    public function __construct()
    {
        $this->created = time();
        $this->updated = time();
        $this->status = self::STATUS_ACTIVE;

    }
    
    /**
     * Set key
     *
     * @param string $key
     * @return Upload
     */
    
    public function setKey($key)
    {
        $this->key = $key;
    
        return $this;
    }

    /**
     * Get key
     *
     * @return string 
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Upload
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
     * Set type
     *
     * @param string $type
     * @return Upload
     */
    public function setType($type)
    {
        $this->type = $type;
    
        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }
    
    /**
     * Set file
     * 
     * @param \Symfony\Component\HttpFoundation\File\UploadedFile $file
     * @return Upload
     */
    public function setFile(UploadedFile $file)
    {
        $this->file = $file;
        
        return $this;
    }
    
    /**
     * Get file
     * 
     * @return UploadedFile File
     */
    public function getFile()
    {
        return $this->file;
    }
    
    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
        if (null !== $this->getFile()) {
            // do whatever you want to generate a unique name
            $filename = sha1(uniqid(mt_rand(), true));
            
            $this->key  = $filename.'.'.$this->getFile()->guessExtension();
            $this->name = $this->getFile()->getClientOriginalName();
            $this->type = $this->getFile()->getClientMimeType();
        }
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        // the file property can be empty if the field is not required
    if (null === $this->getFile()) {
        return;
    }

    // use the original file name here but you should
    // sanitize it at least to avoid any security issues

    // move takes the target directory and then the
    // target filename to move to
    $this->getFile()->move(
        $this->getUploadRootDir(),
        $this->getFile()->getClientOriginalName()
    );

    // set the path property to the filename where you've saved the file
    $this->path = $this->getFile()->getClientOriginalName();

    // clean up the file property as you won't need it anymore
    $this->file = null;
    }
    
    protected function getUploadRootDir()
    {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }
    
    /**
     * 
     * @return string
     */    
    protected function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'uploads/documents';
    }
    
    
    
    public function getURL()
    {
        $this->awsClient = $this->getClient();
        
        return $this->awsClient->getObjectUrl(self::BUCKET, self::BUCKET_PREFIX . $this->key, '+10 minutes');
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
     * Set status
     *
     * @param integer $status
     * @return Upload
     */
    public function setStatus($status)
    {
        $this->status = $status;
    
        return $this;
    }

    /**
     * Get status
     *
     * @return integer 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set created
     *
     * @param integer $created
     * @return Upload
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
     * @return Upload
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

    
    
    public function __toString()
    {
        return $this->getURL();
    }
}
