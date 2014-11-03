<?php

namespace Cdm\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BaseController extends Controller
{
    /**
     * Get Repository
     * 
     * @param type $name
     * @return type
     */
    protected function getRepository($name)
    {
        return $this->getManager()->getRepository($name);
    }
    
    /**
     * Get Manager
     * @return type
     */
    protected function getManager()
    {
        return $this->getDoctrine()->getManager();
    }
    
    /**
     * Get Session
     * 
     * @return type
     */
    protected function getSession()
    {
        return $this->getRequest()->getSession();
    }
    
    /**
     * Generate Token for email validation
     * 
     * @param type $userEmail
     * @return type
     */
    protected function generateToken($userEmail = null)
    {
        $params = array($userEmail, 
                        time(),
                        rand(),
                        );
        
        $paramsToString = implode(':', $params);
            
        $token = base64_encode($paramsToString);
        
        return $token;
    }
    
    /**
     * Decode token string and validate
     * 
     * @param type $token
     * @return type
     */
    protected function getTokenParams($token = null)
    {
        $params =array();
        
        if($token != null){
            $stringParams = base64_decode($token);
            
            $params = explode(':', $stringParams);  
        }
        
        return $params;
    }
    

    /**
     * Send Mail
     * @param type $options
     */
    protected function sendMail($options = array())
    {
        if(!isset($options['from']) || $options['from'] == ''){

            $options['from'] = 'admin@cdm.com';
        }

        $mail = \Swift_Message::newInstance()
                ->setSubject($options['subject'])
                ->setFrom($options['from'])
                ->setTo($options['to']);        

        // content body with token and activation link        
        if(isset($options['token'])){
            $mail->setBody($this->renderView('CdmUserBundle:Email:authenticate.html.twig', array('options' => $options)), 'text/html');    
        }        
        else{
        // content body for general message
        $mail->setBody($this->renderView('CdmUserBundle:Email:message.html.twig', array('options' => $options)), 'text/html');
        }
        
        $this->get('mailer')->send($mail);
    }
    

    public function dateToTimestamp($dateString)
    { 
        if(strpos($dateString, '-')!==false){
            
            list($month, $day, $year) = explode('-', $dateString); // change the order of list based on timeformat
        
            $timestamp = mktime(0, 0, 0, $month, $day, $year);
        
        }else{
            $timestamp = $dateString;
        }
        
        return $timestamp;
    }

    public function timestampToDate($timestamp)
    {
        $format = 'm-d-Y';
        
        return date($format, $timestamp);
    }
    
  public function generatePassword()
  {
    $randomNum = rand(10, 1000);
      
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    
    $randomString = '';
    
    for ($i = 0; $i < 5; $i++){
      $randomString .= $characters[mt_rand(0, 61)];  
    }
      
    $randomPassword = $randomString.$randomNum;
      
    return $randomPassword;
  }
  
  public function getAccessRight($dataAssociatedUserId = null)
  {
      $hasAccess = false; // default access rights is false
      
      $currentUser = $this->getUser();
      
      if( ($currentUser->getEntity()->getGroup()->getDescription() == 'administration') ||
             ($currentUser->getEntity()->getGroup()->getId() == 1)){// means 1st group which is administration group
      
            $hasAccess = true;
        }
        
      return $hasAccess;
  }

  /**
   * Check if the application is just initialize
   * If true add first record as 
   */

  public function isInitialEnv()
  {
    // count entity numbers
    $users = $this->getRepository('CdmUserBundle:User')->findAll();
        
    if(count($users) > 0){
        return false;
    }else{
        return true;        
    }

  }


  
}
