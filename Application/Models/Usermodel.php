<?php
 class Application_Models_Usermodel
  {	  
		/*private static $dblocation = "mysql.sitescopy.ru"; 
		private static $dbuser = "u231625535_root"; 
		private static $dbpassword = "111111"; 	
		private static $dbname="u231625535_gbook"; 
		private static $db = "";
		private static $userId="";*/
		private static $dblocation = "localhost"; 
		private static $dbuser = "root"; 
		private static $dbpassword = ""; 	
		private static $dbname="guestbook"; 
		private static $db = "";
		private static $userId="";
		
//конструктор с подключением к БД
		function __construct()
		{
			self::$db=mysql_connect (self::$dblocation,self::$dbuser,self::$dbpassword);
			mysql_select_db (self::$dbname,self::$db); 
		}
		
//функция извлечения сообщений из БД
		  function getMessage()
		  {
			
			$sql_select_messages = mysql_query ("SELECT  posts.ptext, posts.pdate, users.uID, users.uname, users.usname, users.uemail, users.uavatar FROM posts LEFT JOIN users ON users.uID = posts.userID ORDER BY posts.pdate DESC");
			
			$arr2=array();
			$i=0;
			while ($arr = mysql_fetch_array ($sql_select_messages))
			{
			$arr2[$i] = $arr;
			$i++;
			}
			
			mysql_free_result($sql_select_messages);
		
			return $arr2;
		 }
//функция создания нового пользователя в БД
		function newUser ($formdata)
		{	
			
			$sql_new_user = "INSERT INTO users(uname,usname,uemail,upassword) VALUES('".$formdata['name']."','".$formdata['sname']."','".$formdata['email']."','".md5($formdata['password'])."')";
			//echo $sql_new_user;
			$result = mysql_query($sql_new_user);
			if (!$result) 
			{
				return false;
					
			}
			else 
			{
				return true;
			}
		}
//функция получения идентификатора пользователя
		function checkUser ($email,$password)
		{
			
			$sql_select_user = "SELECT * FROM users WHERE uemail = '{$email}'";
			$sql = mysql_query($sql_select_user);
			$arr = mysql_fetch_array($sql);
			
			if(!$arr)
			{
				return -1;
			} 
			else 
			{
				
				return $arr['uID'];
			
			}
	
		}
//функция добавления нового сообщения в БД
		function addMessage($message, $userID)
		{	
			$sql_add_message = "INSERT INTO posts(userID,ptext) VALUES('".$userID."','".$message."')";
			//echo $sql_add_message;
			$result = mysql_query($sql_add_message);
			return $result;
			
		}
//функция извлечения данных определенного пользователя из БД
		function extractInfo($uID)
		{
			$sql_extract_info = "SELECT * FROM users WHERE uID='{$uID}'";
			//echo $sql_extract_info;
			$sql = mysql_query($sql_extract_info);
			$result_arr = mysql_fetch_array($sql);
			return $result_arr;
		}
//функция обновления данных определенного пользователя в БД
		function updateInfo($arr,$file,$uID, $updateFlag)
		{
			$name = "uname ='{$arr['uname']}'";
			$sname = ",usname='{$arr['usname']}'";
			$email = ",uemail='{$arr['uemail']}'";
			if($updateFlag['pass'])
			{
				echo "Пароль ".$arr['upassword'];
				$upassword=md5($arr['upassword']);
				echo "Хэш ".$upassword;
				$password = ",upassword ='{$upassword}'";
			}
			else
				$password="";
				
			if($updateFlag['ava'])
			{
				
				$avatar = ",uavatar ='{$file}'";
				}
			else
				$avatar = "";
	
			
			$sql_update_info = "UPDATE users SET ".$name.$sname.$email.$password.$avatar." WHERE uID = '{$uID}'";
			//echo $sql_update_info;
			$result = mysql_query($sql_update_info);
			return $result;
		}

  }  
?>