<?php
  class Application_Controllers_Home
  extends Base_Controller 
  {
  
  
  function __construct()
    {
        $this->model = new Application_Models_Usermodel();
        $this->view = new Base_View();
    }
      function callController() 
	  {
		$arr = $this->model->getMessage();
        $arr2=$this->model->extractInfo($_SESSION['uID']);
		if ($arr == 0)
		{
			$this->view->generate("Home.php",false,false);
		}
		else
		{
			$this->view->generate("Home.php",$arr,$arr2);
		}
     }
  } 
?>