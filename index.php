<?php
session_start();
//файл autoloader.php содержит функцию автоматической генерации путей к файлам из имен классов
require_once "./autoloader.php";
//создаем объект класса Base_Application
$router=new Base_Application;
//вызываем функцию run 
$router->Run();
?>