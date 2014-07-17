<?php

  class Application_Controllers_Enter
  extends Base_Controller 
  {
      function __construct()
    {
        $this->model = new Application_Models_Usermodel();
        $this->view = new Base_View();
    }
	
	  function callController() 
	  {
		$errors = 0;
		$userarr = array();
		$userarr['email'] = mysql_real_escape_string($_POST['email']);
		$userarr['password'] = mysql_real_escape_string($_POST['password']);
		if (strlen($userarr['email'])==0 || !preg_match("|^[-0-9a-z_\.]+@[-0-9a-z_^\.]+\.[a-z]{2,6}$|i", $userarr['email']))
		{
			$_SESSION['er_emaillenght'] = "Введите корректный e-mail. Например: mail@mail.ru";
			$errors++;
			
		}
		if ($errors == 0 && strlen($userarr['password'])==0)
		{
			$_SESSION['uemail'] =$userarr['email'];
			$_SESSION['er_passlenght'] = "Введите пароль.";
			$errors++;
			
		}
		
		if ($errors > 0)
		{
			$this->view->generate("Login.php",false,false);
		
		}
		else {
		
			 $userId = $this->model->checkUser ($userarr['email'] ,$userarr['password']);
			//echo $userId;
			 if ($userId > 0) 
			 {
				$arr = $this->model->getMessage();
                $arr2=$this->model->extractInfo($userId);

				
				if($arr2['upassword']==md5($userarr['password']))
				{
					$_SESSION['uID']=$userId;
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
					$_SESSION['uemail'] =$userarr['email'];
					$_SESSION['er_passlenght'] = "Неверный пароль.";
					$this->view->generate("Login.php",false,false);
					$errors++;
				}
				
			 }
			 else
			 {
			   
				$_SESSION['er_noemail'] = "Пользователь не зарегистрирован. Зарегистрируйтесь.";
				$this->view->generate("Login.php",false,false);
			 
			 }
	
		}
		
			unset($_SESSION['er_emaillenght']);
			unset($_SESSION['er_passlenght']);
			unset($_SESSION['uemail']);
	  }
		
  } 
?> 
 
 