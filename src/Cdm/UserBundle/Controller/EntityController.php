<?php

namespace Cdm\UserBundle\Controller;

use Cdm\UserBundle\Controller\BaseController as Controller;
use Cdm\UserBundle\Form\EntityType;
use Cdm\UserBundle\Entity\User;
use Symfony\Component\HttpFoundation\Request;


class EntityController extends Controller
{
    /**
     * Create new entity (CRUD)
     */
    public function createAction(Request $request)
    {         

       // if no admin is created, then facilitate new admin creation
       $initialSetup = false;

       if($this->isInitialEnv() == true){
        $initialSetup = true; // true if no user exist, false if count user > 0
       }

        if($initialSetup == false){
          $user = $this->getUser();

          if(!$user){
           return $this->redirect($this->generateUrl('login'));   
          }
         
          if(isset($user) && $user->getIsSuperAdmin() == false){
           return $this->redirect($this->generateUrl('dashboard'));    
          }

        }

        
     
       $entityForm = $this->createForm(new EntityType());
              
       if($request->getMethod() === 'POST'){
            
            $entityForm->handleRequest($request);
            
            $entity = $entityForm->getData();
            
            $roles = $entity->getGroup()->getRole();

            $adminRole = false; // By default adminRole is false; 

            // check if admin role is associeted with the entity, 
            //if yes create a login user and send cerdentials via email;
            foreach($roles as $role){
              if($role->getDescription() == 'admin'  || 
                    $role->getDescription() == 'Admin'){
                 $adminRole = true; 
              }
            }

            $entity->setCreatedBy($this->getUser())
                   ->setUpdatedBy($this->getUser());


            $this->getRepository('CdmUserBundle:Entity')->save($entity);
             
            if($adminRole == true){
              
              $userEntity = $this->getRepository('CdmUserBundle:Entity')->findOneBy(array('email' => $entity->getEmail()));

              $user = new User();

              $factory = $this->get('security.encoder_factory');
                
              $encoder = $factory->getEncoder($user);
            
              $generatePassword = $this->generatePassword(); // the password string
            
              $password = $encoder->encodePassword($generatePassword, $user->getSalt()); // encrypt password

              $user->setEmail($userEntity->getEmail())
                  ->setEntity($userEntity)
                  ->setPassword($password)
                  ->setCreatedBy($this->getUser())
                  ->setUpdatedBy($this->getUser())
                  ->setToken($generatePassword);

               // set first user as superadmin   
               if($initialSetup == true){
                $user->setIsSuperAdmin(true);
               }   
               
              $this->getRepository('CdmUserBundle:User')->save($user);

              $emailOptions = array('to' => $user->getEmail(),
                                    'subject' => 'Your Club Database Account Information',
                                    'content' => 'Your temporary account information. Username: '.$user->getEmail().' and password: '.$generatePassword,
                                    );

              $this->sendMail($emailOptions);       
    
            } 


            return $this->redirect($this->generateUrl('dashboard'));
        }
        
        return $this->render('CdmUserBundle:Entity:save.html.twig', array('form'=>$entityForm->createView()));
    }
    
    /**
     * View entity
     * 
     * if entity params found, single entity else all entity
     * @param type $entity
     */

    public function readAction()
    {

      
      $user = $this->getUser();
      
      if(!$user){
          return $this->redirect($this->generateUrl('login'));
      }

      // assuming that administration group having id = 0
      
      if($user->getEntity()->getGroup()->getDescription() === 'administration' ||
            $user->getEntity()->getGroup()->getId() === 1 ){ 
          // show all users entity
          $entities = $this->getRepository('CdmUserBundle:Entity')->findAll();             
      }else{
          // show only user related entity
          $entities = $this->getRepository('CdmUserBundle:Entity')->findBy(array('email' => $user->getEmail()));   
      }
      
      return $this->render('CdmUserBundle:Entity:view.html.twig', array('entities'=>$entities));
    }
    
            
    /**
     * Update entity
     * @param type $entity
     */
    public function updateAction(Request $request, $id)
    {
        $user = $this->getUser();
        
        if(!$user){
          return $this->redirect($this->generateUrl('login'));
        }

        $entity = $this->getRepository('CdmUserBundle:Entity')->find($id);
                
        if(!$entity){
            return $this->redirect($this->generateUrl('dashboard'));
        }
        
        // set timestamp to date (m-d-Y)
        $entity->setDob($this->timestampToDate($entity->getDob()));

        $entityForm = $this->createForm(new EntityType(), $entity);
        
        if($request->getMethod() === 'POST'){
            
            $entityForm->handleRequest($request);

            $entity = $entityForm->getData();
            
            $dateString = $entity->getDob();
            
            $timeStamp = $this->dateToTimestamp($dateString);
            
            $entity->setDob($timeStamp)
                   ->setUpdatedBy($this->getUser());
            
        //\Doctrine\Common\Util\Debug::dump($entity);        
        //die();         

            $this->getRepository('CdmUserBundle:Entity')->save($entity);
            
            return $this->redirect($this->generateUrl('dashboard'));
        }
        
        return $this->render('CdmUserBundle:Entity:save.html.twig', array('form'=>$entityForm->createView(), 'entity'=>$entity));
    }
    
    /**
     * Delete Entity
     * @param type $entity
     */
    public function deleteAction(Request $request, $id)
    {
        $currentUser = $this->getUser();
        
        if(!$currentUser){
         return $this->redirect($this->generateUrl('login')); 
        }
        
        $entity = $this->getRepository('CdmUserBundle:Entity')->find($id);
        
        if(!$entity){
         return $this->redirect($this->generateUrl('dashboard'));   
        }
        
        $hasAccess = $this->getAccessRight();
        
        if($hasAccess === true){
            $this->getRepository('CdmUserBundle:Entity')->remove($entity);
        }
        
        return $this->redirect($this->generateUrl('dashboard'));
    }
}