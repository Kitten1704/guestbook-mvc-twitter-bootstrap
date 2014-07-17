<?php

  class Application_Controllers_Registration
  extends Base_Controller 
  {
      function __construct()
    {
        $this->view = new Base_View();
    }
      function callController() 
	  {
		$this->view->generate("Registration.php",false,false);
      }
  } 
?> 
 
 