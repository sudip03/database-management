<?php 

namespace Cdm\UserBundle\Controller;

use Cdm\UserBundle\Controller\BaseController as Controller;
use Symfony\Component\HttpFoundation\Request;
use Cdm\UserBundle\Entity\Group;
use Cdm\UserBundle\Form\GroupType;

class GroupController extends Controller
{
    public function createAction(Request $request)
    {
      // Facilitate group addition, for first super user
      if( ($this->isInitialEnv() == false) && ($this->getAccessRight() != true) ){
    
        return $this->redirect($this->generateUrl('login'));
      
      }

       $groupForm = $this->createForm(new GroupType());
       
       if($request->getMethod() === 'POST'){
           $groupForm->handleRequest($request);
           
           if($groupForm->isValid()){   
               $group = $groupForm->getData();
               
               $this->getRepository('CdmUserBundle:Group')->save($group);
               
               return $this->redirect($this->generateUrl('read_group'));
           }
       }
       
       return $this->render('CdmUserBundle:Group:save.html.twig', array('form'=>$groupForm->createView()));
   }
    
   
    public function readAction()
    {
        $groups = $this->getRepository('CdmUserBundle:Group')->findAll();
        
        return $this->render('CdmUserBundle:Group:view.html.twig', array('groups' => $groups));
    }
    
    
    public function updateAction(Request $request, $id)
    {
        $group = $this->getRepository('CdmUserBundle:Group')->find($id);
        
        if(!$group){
            die('no such group found');
        }
        
       $groupForm = $this->createForm(new GroupType(), $group);
       
       if($request->getMethod() === 'POST'){
           $groupForm->handleRequest($request);
           
           if($groupForm->isValid()){   
               $group = $groupForm->getData();
              
//               \Doctrine\Common\Util\Debug::dump($groupForm->getData());
//               die();
                                  
               $this->getRepository('CdmUserBundle:Group')->save($group);
          
               
               return $this->redirect($this->generateUrl('read_group'));
           }
       }
       
       return $this->render('CdmUserBundle:Group:save.html.twig', array('form'=>$groupForm->createView()));
    }
    
    /**
     * Delete Group
     * @param type $group
     */
    public function deleteAction(Request $request, $id)
    {
        $currentUser = $this->getUser();
        
        if(!$currentUser){
         return $this->redirect($this->generateUrl('login')); 
        }
        
        $group = $this->getRepository('CdmUserBundle:Group')->find($id);
        
        if(!$group){
         return $this->redirect($this->generateUrl('read_group'));   
        }
        
        $hasAccess = $this->getAccessRight();
        
        if($hasAccess === true){
            $this->getRepository('CdmUserBundle:Group')->remove($group);
        }
        
        return $this->redirect($this->generateUrl('read_group'));
    }

  }
