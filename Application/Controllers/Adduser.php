<?php

  class Application_Controllers_Adduser
  extends Base_Controller 
  {
     
  function __construct()
    {
        $this->model = new Application_Models_Usermodel();
        $this->view = new Base_View();
    }
      function callController() 
	  {
		
		$formData = array();
		$formData['name'] = mysql_real_escape_string($_POST['name']);
		$formData['sname'] = mysql_real_escape_string($_POST['sname']);
		$formData['email'] = mysql_real_escape_string($_POST['email']);
		$formData['password'] = mysql_real_escape_string($_POST['password']);
		$formData['re_password'] = mysql_real_escape_string($_POST['re_password']);
		$errors=0;
		if ($this->isEmpty($formData['name']))
		{
			$_SESSION['er_name']="Введите имя.";
			$errors++;
		}
		else
		{	
			$_SESSION['name'] = $formData['name'];
		}
		if ($this->isEmpty($formData['email']))
		{
			$_SESSION['er_email']="Введите e-mail.";
			$errors++;
		}
		else
		{	
			if (!preg_match("|^[-0-9a-z_\.]+@[-0-9a-z_^\.]+\.[a-z]{2,6}$|i", $formData['email']))
			{
				$_SESSION['er_emaillenght'] = "Введите корректный e-mail. Например: mail@mail.ru";
				$errors++;
			}
			else
			{
				$_SESSION['email'] = $formData['email'];
			}
		}
		if ($this->isEmpty($formData['password']))
		{
			$_SESSION['er_password']="Введите пароль.";
			$errors++;
		}
		else
		{	
			$_SESSION['password'] = $formData['password'];
		}
		if ($this->isEmpty($formData['re_password']))
		{
			$_SESSION['er_repassword']="Подтвердите пароль.";
			$errors++;
		}
		else
		{	
			$_SESSION['re_password'] = $formData['re_password'];
		}
		$_SESSION['sname'] = $formData['sname'];
		if ($errors==0 && ($formData['password'] != $formData['re_password']))
		{
			$_SESSION['er_password']="Введенные пароли не совпадают.";
			$errors++;
		}
		
		if ($errors>0)
		{	
			$this->view->generate("Registration.php",false,false);
		}
		else 
		{	
			$uID = $this->model->checkUser($formData['email'],$formData['password']);
			if ($uID>0)
			{
				$_SESSION['er_email']="Пользователь с таким e-mail уже зарегистрирован.";
				$this->view->generate("Registration.php",false,false);
				$errors++;
			}
			else
			{
				$result = $this->model->newUser($formData);
				if ($result)
				{
					$this->view->generate("Login.php",false,false);
				}
			}
			
		}
		
		unset($_SESSION['er_name']);
		unset($_SESSION['er_email']);
		unset($_SESSION['er_emaillenght']);
		unset($_SESSION['er_password']);
		unset($_SESSION['er_repassword']);

		
      }
	
  } 
?> 
 
 