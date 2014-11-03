<?php

namespace Cdm\UserBundle\Repository;

use Doctrine\ORM\EntityRepository as BaseEntityRepository;
use Cdm\UserBundle\Entity\Sex;

/**
 * SexRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class SexRepository extends BaseEntityRepository
{
    public function save(Sex $sex)
    {          
        $this->getEntityManager()->persist($sex);
        
        $this->getEntityManager()->flush();
    }
    
    public function remove(Sex $sex)
    {
       $this->getEntityManager()->remove($sex);
       
       $this->getEntityManager()->flush();  
    }
}
