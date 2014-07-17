<?php
//базовый класс, от которого наследуются все контроллеры проекта
 class Base_Controller 
 {
 
    public $model;
    public $view;
    	
	function isEmpty($string)
	{
		if(strlen($string) > 0)
		 return false;
		 else
		 return true;	
	}
	       			 
 }
?>