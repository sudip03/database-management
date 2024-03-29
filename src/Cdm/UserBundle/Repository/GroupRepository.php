<?php

namespace Cdm\UserBundle\Repository;
 
use Doctrine\ORM\EntityRepository as BaseEntityRepository;
use Cdm\UserBundle\Entity\Group;

/**
 * GroupRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */

class GroupRepository extends BaseEntityRepository
{
    public function save(Group $group)
    {          
        $this->getEntityManager()->persist($group);
        
        $this->getEntityManager()->flush();
    }
    
    public function remove(Group $group)
    {
    	$this->getEntityManager()->remove($group);
       
       $this->getEntityManager()->flush();        
    }
}
