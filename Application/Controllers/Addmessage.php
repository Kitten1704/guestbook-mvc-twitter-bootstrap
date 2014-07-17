<?php
  class Application_Controllers_Addmessage
  extends Base_Controller 
  {
      function __construct()
    {
        $this->model = new Application_Models_Usermodel();
        $this->view = new Base_View();
    }
      function callController() 
	  {
		
		$usermessage = mysql_real_escape_string($_POST['message']);
		unset($_POST['message']);
		
		//echo isset($_POST['message_form_button'])?"0SET":"0UNSET";
		if (isset($_POST['message_form_button']))
		{
			
			unset($_POST['message_form_button']);
			//echo isset($_POST['message_form_button'])?"1SET":"1UNSET";
			
			if ($this->isEmpty($usermessage))
			{
				$_SESSION['er_umessage']="Введите текст сообщения.";
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
			else 
			{
				
				$result=$this->model->addMessage($usermessage, $_SESSION['uID']);
				
				if ($result)
				{
				
					unset($_POST['messform']);
					unset ($usermessage);
					$arr = $this->model->getMessage();
					$arr2=$this->model->extractInfo($_SESSION['uID']);
											
					
					if ($arr == 0)
					{
						//clean($_POST);
						$this->view->generate("Home.php",false,false);
						
					}
					else
					{
					//echo isset($_POST['message_form_button'])?"4SET":"4UNSET";
						//clean($_POST);
						$this->view->generate("Home.php",$arr,$arr2);
					}
				}
				
			}
		}
		else
		{
			$this->view->generate("Home.php",$arr,$arr2);
		}
		unset($_SESSION['er_umessage']);
	
	  }
	
  } 
?>	