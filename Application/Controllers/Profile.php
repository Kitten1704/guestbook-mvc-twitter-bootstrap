<?php

  class Application_Controllers_Profile
  extends Base_Controller 
  {
     
  function __construct()
    {
        $this->model = new Application_Models_Usermodel();
        $this->view = new Base_View();
    }
      function callController() 
	  {
		$uID=$_SESSION['uID'];
		$arr=$this->model->extractInfo($uID);
		$this->view->generate("Profile.php",$arr,false);
		
	  }
	  
	
  } 
?> 
 
 