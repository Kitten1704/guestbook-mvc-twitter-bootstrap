<?php
//функция преобразования имен классов в пути к файлам
//и подключения этих файлов
 function __autoload ($class_name)
 {
    $path=str_replace("_", "/", $class_name);
	include_once($path .".php");	
 }
 
?>
