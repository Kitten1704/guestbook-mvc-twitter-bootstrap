<?php
  include('Base/SimpleImage.php');
  
  class Application_Controllers_Profupdate
  extends Base_Controller 
  {
     
  function __construct()
    {
        $this->model = new Application_Models_Usermodel();
        $this->view = new Base_View();
    }
      function callController() 
	  {
		$update['pass'] = false;
		$update['ava'] = false;
		$uploadfile ="";
		
		$arr['uname'] = mysql_real_escape_string($_POST['name']);
		$arr['usname'] = mysql_real_escape_string($_POST['sname']);
		$arr['uemail'] = mysql_real_escape_string($_POST['email']);
		$arr['upassword'] = mysql_real_escape_string($_POST['password']);
		$arr['repassword'] = mysql_real_escape_string($_POST['re_password']);
		$errors=0;
		
		//echo "Пароль ".$arr['upassword'];
	
		if ($this->isEmpty($arr['uname']))
		{
			$_SESSION['er_name']="Введите имя.";
			$errors++;
			//echo 1;
		}
		
		if ($this->isEmpty($arr['uemail']))
		{
			$_SESSION['er_email']="Введите e-mail.";
			$errors++;
			//echo 2;
		}
		else
		{	
			if (!preg_match("|^[-0-9a-z_\.]+@[-0-9a-z_^\.]+\.[a-z]{2,6}$|i", $arr['uemail']))
			{
				$_SESSION['er_emaillenght'] = "Введите корректный e-mail. Например: mail@mail.ru";
				$errors++;
				//echo 3;
			}
		}
		
		
		
		if (($arr['upassword']!= "" && $arr['upassword']!=$arr['repassword'])
		|| ($arr['repassword'] != "" && $arr['upassword']!=$arr['repassword']))
		{
			$_SESSION['er_password']="Введенные пароли не совпадают.";
			$errors++;
			//echo 6;
		}
		
			
		
		
			
		$sql_arr=$this->model->extractInfo($_SESSION['uID']);
		//echo "Старый пароль".$sql_arr['upassword'];
		//echo "Новый пароль".md5($arr['upassword']);
		
		if(($errors==0)&&($sql_arr['upassword']!=md5($arr['upassword']))&&(strlen($arr['upassword'])!=0)) 
		{
			
			//$arr['upassword']=md5($arr['upassword']);
			//$arr['repassword']=md5($arr['repassword']);
			$update['pass'] = true;
			//	echo $arr['repassword'];
		}
		else
		{	
			//unset($arr['upassword']);
			//unset($arr['repassword']);
			$update['pass'] = false;	
		}
		
		//echo $errors;
		if ($errors>0)
		{
			//echo 12;
			$this->view->generate("Profile.php",$arr,false);
		}
		else 
		{	
			if ($_FILES['avatar']['size']!=0)
			
			{
				
				//echo 11;
				if($_FILES['avatar']['type'] != "image/gif" AND $_FILES['avatar']['type'] !="image/jpeg" AND $_FILES['avatar']['type'] !="image/jpg" AND $_FILES['avatar']['type'] !="image/png")
				{
					$_SESSION['er_file'] = "Загружен файл недопустимого формата.";
					//echo $_SESSION['er_file'];
				}	
				else
				{
					//echo 13;
				// сохраняем исходное расширение файла
					if ($_FILES['avatar']['type'] == "image/jpeg" OR $_FILES['avatar']['type'] == "image/jpg")
					{
						$ftype = "jpg";
					}
					if ($_FILES['avatar']['type'] == "image/gif")
					{
						$ftype = "gif";
					}
					if ($_FILES['avatar']['type'] == "image/png")
					{
						$ftype = "png";
					}
					//директори¤ загрузки
					$uploaddir = "img/";
					//echo $uploaddir; 
					//новое им¤ изображени¤
					$fname=$_SESSION['uID'].'.'.$ftype;
					//путь к новому изображению
					$uploadfile = "$uploaddir$fname";
					$image = new SimpleImage();
					$image->load($_FILES['avatar']['tmp_name']);
					$image->resize(100,100);
					$image->save($_FILES['avatar']['tmp_name']);
					$file_uploaded = move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadfile);
					
					
					$update['ava'] =true;
				}
			} 
			else
			{
				$update['ava'] =false;
			
			}
			
			$result= $this->model->updateInfo($arr, $uploadfile , $_SESSION['uID'], $update);
			//echo $result;
			if ($result)
			{
				//echo $result;
				$arr = $this->model->getMessage();
                $arr2=$this->model->extractInfo($_SESSION['uID']);
                                
				$this->view->generate("Home.php",$arr,$arr2);
			}
			
		}
		
		unset($_SESSION['er_name']);
		unset($_SESSION['er_email']);
		unset($_SESSION['er_emaillenght']);
		unset($_SESSION['er_password']);
		unset($_SESSION['er_repassword']);
		unset($_SESSION['er_file']);
	  }
	  
	
  } 
?> 
 
 