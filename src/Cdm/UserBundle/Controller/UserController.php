<?php

namespace Cdm\UserBundle\Controller;

use Cdm\UserBundle\Controller\BaseController as Controller;
use Symfony\Component\HttpFoundation\Request;
use Cdm\UserBundle\Entity\User;
use Cdm\UserBundle\Entity\Invite;
use Cdm\UserBundle\Entity\Entity;
use Cdm\UserBundle\Form\InviteType;

class UserController extends Controller
{
  /**
   * Inivite new User or Entity
   * 
   * @param \Symfony\Component\HttpFoundation\Request $request
   * @return type
   */
  public function inviteAction(Request $request)
  { 
    $inviteForm = $this->createForm(new InviteType());
  
    if($request->getMethod() === 'POST')
    {
        $inviteForm->handleRequest($request);
        
        if($inviteForm->isValid()){
            $user = $inviteForm->getData();
            
            $isExist = $this->getRepository('CdmUserBundle:Entity')->findOneBy(array('email'=>$user->getEmail()));
            
            if($isExist){
                die('record already exist');
            }
            
            $name = $inviteForm->get('name')->getData();
            
            $surname = $inviteForm->get('surname')->getData();
            
            $manager = $inviteForm->get('description')->getData();
            
            $email  = $inviteForm->get('email')->getData();
            
            // add new entity record
            $entity = new Entity();
            
            $entity->setName($name)
                    ->setSurname($surname)
                    ->setManager($manager)
                    ->setEmail($email)
                    ->setCreatedBy($this->getUser());
                       
            $this->getRepository('CdmUserBundle:Entity')->save($entity);
                    
            // add user record for login authentication
            $factory = $this->get('security.encoder_factory');
                
            $encoder = $factory->getEncoder($user);
            
            $generatePassword = $this->generatePassword(); // the password string
            
            $password = $encoder->encodePassword($generatePassword, $user->getSalt()); // encrypt password
            
            $user->setPassword($password)
                ->setActive(true)
                ->setToken('')
                ->setEntity($entity)
                ->setCreatedBy($this->getUser());
            
            $this->getRepository('CdmUserBundle:User')->save($user);
            
            // send mail to user with userName and Password, Thankyou message
        }
    }
    
    return $this->render('CdmUserBundle:User:invite.html.twig', array('form'=>$inviteForm->createView()));
  }
  
}




