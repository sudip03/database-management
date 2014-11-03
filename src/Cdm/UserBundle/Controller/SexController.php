<?php

namespace Cdm\UserBundle\Controller;

use Cdm\UserBundle\Controller\BaseController as Controller;
use Symfony\Component\HttpFoundation\Request;
use Cdm\UserBundle\Entity\Sex;
use Cdm\UserBundle\Form\SexType;

class SexController extends Controller
{
    public function createAction(Request $request)
    {
      // Facilitate sex addtion, for first super user

      if( ($this->isInitialEnv() == false) && ($this->getAccessRight() != true) ){
    
        return $this->redirect($this->generateUrl('login'));
      
      }

       $sexForm = $this->createForm(new SexType());
       
       if($request->getMethod() === 'POST'){
           
           $sexForm->handleRequest($request);
           
           if($sexForm->isValid()){   
               
               $sex = $sexForm->getData();
               
               $this->getRepository('CdmUserBundle:Sex')->save($sex);
               
               return $this->redirect($this->generateUrl('read_sex'));
           }
       }
       
       return $this->render('CdmUserBundle:Sex:save.html.twig', array('form'=>$sexForm->createView()));
    }
    
    public function readAction()
    {
        $sexes = $this->getRepository('CdmUserBundle:Sex')->findAll();
        
        return $this->render('CdmUserBundle:Sex:view.html.twig', array('sexes' => $sexes));
    }
    
    public function updateAction(Request $request, $id)
    {
        $sex = $this->getRepository('CdmUserBundle:Sex')->find($id);
        
        if(!$sex){
            die('no such group found');
        }
        
       $sexForm = $this->createForm(new SexType(), $sex);
       
       if($request->getMethod() === 'POST'){
           
           $sexForm->handleRequest($request);
           
           if($sexForm->isValid()){   
               
               $sex = $sexForm->getData();
               
               $this->getRepository('CdmUserBundle:Sex')->save($sex);
               
               return $this->redirect($this->generateUrl('read_sex'));
           }
       }
       
       return $this->render('CdmUserBundle:Sex:save.html.twig', array('form'=>$sexForm->createView()));
    }
    
    
    /**
     * Delete Sex
     * @param type $group
     */
    public function deleteAction(Request $request, $id)
    {
        $currentUser = $this->getUser();
        
        if(!$currentUser){
         return $this->redirect($this->generateUrl('login')); 
        }
        
        $sex = $this->getRepository('CdmUserBundle:Sex')->find($id);
        
        if(!$sex){
         return $this->redirect($this->generateUrl('read_sex'));   
        }
        
        $hasAccess = $this->getAccessRight();
        
        if($hasAccess === true){
            $this->getRepository('CdmUserBundle:Sex')->remove($sex);
        }
        
        return $this->redirect($this->generateUrl('read_sex'));
    }
}
