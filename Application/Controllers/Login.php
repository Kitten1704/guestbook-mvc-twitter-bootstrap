<?php

  class Application_Controllers_Login
  extends Base_Controller 
  {
     
  function __construct()
    {
    
        $this->view = new Base_View();
    }
      function callController() 
	  {
		$this->view->generate("Login.php",false,false);

      }
	
  } 
?> 
 
 