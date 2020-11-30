<?php

use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookSession;
use Facebook\FacebookRequest;

    //n nap fe apel a fichye autoload la pou n ka atoloaderfichye composer a
    require 'vendor/autoload.php';

    session_start();
    $appId='797987531007147';
    $appSecret='6dd826e6ea0b72cb85304013e17d4b14';

    FacebookSession::setDefaultApplication($appId,$appSecret);
    
    //nou pral itilize un lien de koneksyon
    $helper=new Facebook\FacebookRedirectLoginHelper('http://localhost/FbConnect/');


  //  var_dump($session);
    //echo $helper->getLoginUrl();
    if(isset($_SESSION) && isset($_SESSION['fb_token'])){
       $session=new FacebookSession($_SESSION['fb_token']);

    }else{
      $session=$helper->getSessionFromRedirect();
    }

    //nou meten token objet facbook session a nan yon session pou nou pa ap plede mande itilizate a pou l aksede

    if($session)
    {
      $_SESSION['fb_token']=$session->getToken();
      //nou itilize api a an get an itilizan sesyon a
      $request=new FacebookRequest($session,'GET','/me/?fields=email,gender,birthday,link');
      //n ap rekipere reket la
      $profile=$request->execute()->getGraphObject('Facebook\GraphUser');
      var_dump($profile);
      //$_SESSION['fb_token']=null;
      //session_unset();
 
    // On détruit la session
    //session_destroy();
    }else{
  
     echo '<a href="' . $helper->getLoginUrl() .'">Se connecter avec facebook</a>';

    }
    

?>


