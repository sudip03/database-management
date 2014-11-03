<?php

namespace Cdm\UserBundle\Controller;

use Cdm\UserBundle\Controller\BaseController as Controller;
use Symfony\Component\HttpFoundation\Request;
use Cdm\UserBundle\Entity\Role;
use Cdm\UserBundle\Form\RoleType;

class RoleController extends Controller
{
    public function createAction(Request $request)
    {
      // Facilitate role addition, for first super user
      if( ($this->isInitialEnv() == false) && ($this->getAccessRight() != true) ){
    
        return $this->redirect($this->generateUrl('login'));
      
      }

       $roleForm = $this->createForm(new RoleType());
       
       if($request->getMethod() === 'POST'){
           
           $roleForm->handleRequest($request);
           
           if($roleForm->isValid()){   
               
               $role = $roleForm->getData();
               
               $this->getRepository('CdmUserBundle:Role')->save($role);
               
               return $this->redirect($this->generateUrl('read_role'));
           }
       }
       
       return $this->render('CdmUserBundle:Role:save.html.twig', array('form'=>$roleForm->createView()));
    }
    
    public function readAction()
    {
        $roles = $this->getRepository('CdmUserBundle:Role')->findAll();
        
        return $this->render('CdmUserBundle:Role:view.html.twig', array('roles' => $roles));
    }
    
    public function updateAction(Request $request, $id)
    {
        $role = $this->getRepository('CdmUserBundle:Role')->find($id);
        
        if(!$role){
            die('no such role found');
        }
        
       $roleForm = $this->createForm(new RoleType(), $role);
       
       if($request->getMethod() === 'POST'){
           
           $roleForm->handleRequest($request);
           
           if($roleForm->isValid()){   
               
               $role = $roleForm->getData();
               
               $this->getRepository('CdmUserBundle:Role')->save($role);
               
               return $this->redirect($this->generateUrl('read_role'));
           }
       }
       
       return $this->render('CdmUserBundle:Role:save.html.twig', array('form'=>$roleForm->createView()));
    }
    
    
    /**
     * Delete Role
     * @param type $group
     */
    public function deleteAction(Request $request, $id)
    {
        $currentUser = $this->getUser();
        
        if(!$currentUser){
         return $this->redirect($this->generateUrl('login')); 
        }
        
        $role = $this->getRepository('CdmUserBundle:Role')->find($id);
        
        if(!$role){
         return $this->redirect($this->generateUrl('read_role'));   
        }
        
        $hasAccess = $this->getAccessRight();
        
        if($hasAccess === true){
            $this->getRepository('CdmUserBundle:Role')->remove($role);
        }
        
        return $this->redirect($this->generateUrl('read_role'));
    }
}
