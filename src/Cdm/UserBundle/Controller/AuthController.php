<?php

namespace Cdm\UserBundle\Controller;

use Cdm\UserBundle\Controller\BaseController as Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;

class AuthController extends Controller
{
    public function loginAction(Request $request)
    {
        if($this->getUser()){
            return $this->redirect($this->generateUrl('dashboard'));
        }
        
        $message = null;
        
        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $exception = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $exception = $request->getSession()->get(SecurityContext::AUTHENTICATION_ERROR);
        }

        if ($exception && method_exists($exception, 'getMessage')) {
            $message = $exception->getMessage();
        }
        
        $userCount = $this->getRepository('CdmUserBundle:User')->findAll();
                
        return $this->render('CdmUserBundle:Auth:login.html.twig', array('message' => $message, 'userCount' => count($userCount)));

    }
    
    
    public function forgotPasswordAction(Request $request)
    {
        if ($this->getUser()) { // user already logged in
            return $this->redirect($this->generateUrl('dashboard'));
        }
        
        $message = '';
        
        if($request->getMethod() === 'POST'){
            $email = $request->get('email'); 

            $user = $this->getRepository('CdmUserBundle:User')->findOneBy(array('email'=>$email, 'active'=>true));
            
            if(!$user){
               $message = 'Oops! no match found in our record';
               
               return $this->render('CdmUserBundle:Auth:forgotPassword.html.twig', array('message'=>$message)); 
            }
            
            // generate token and send as activation link via email
            $token = $this->generateToken($email);        
            
            $user->setToken($token);

            $this->getRepository('CdmUserBundle:User')->save($user); 

            $emailOptions = array('to' => $email,
                                    'token' => $token,
                                    'subject' => 'Verification for Password Reset',
                                    'content' => 'Click Reset Password',
                                    'action' => 'forgotpassword');

            $this->sendMail($emailOptions);       

            //return $this->render('CdmUserBundle:Email:authenticate.html.twig', array('options' => $emailOptions));
        }
        
        return $this->render('CdmUserBundle:Auth:forgotPassword.html.twig', array('message'=>$message));
    }

    
    public function resetPasswordAction(Request $request, $token)
    {
        if ($this->getUser()) { // user already logged in
            return $this->redirect($this->generateUrl('dashboard'));
        }

        $user = $this->getRepository('CdmUserBundle:User')->findOneBy(array('token' => $token));

        if(!$user){            
            return $this->redirect($this->generateUrl('login'));
        }
        
        $passwordResetForm = $this->createForm(new \Cdm\UserBundle\Form\ResetpasswordType());
        
        if($request->getMethod() === 'POST'){
            //if($passwordResetForm->isValid()){
            
            if($_POST['resetpassword']['password']['first'] === $_POST['resetpassword']['password']['first']){

                $factory = $this->get('security.encoder_factory');

                $encoder = $factory->getEncoder($user);

                $generatePassword = $_POST['resetpassword']['password']['first'];

                $password = $encoder->encodePassword($generatePassword, $user->getSalt()); // encrypt password

                $user->setPassword($password);

                $this->getRepository('CdmUserBundle:User')->save($user);

                return $this->redirect($this->generateUrl('login'));

            }                
            
           // }
                    
        }
        
        return $this->render('CdmUserBundle:Auth:resetpassword.html.twig', array('form'=>$passwordResetForm->createView()));
    }



    
}