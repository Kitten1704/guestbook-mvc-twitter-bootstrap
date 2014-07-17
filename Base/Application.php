<?php
//базовый класс приложения
//осуществляет маршрутизацию запросов пользователя
 class Base_Application
 {
 //функция getRoute() получает маршрут для вызова соответсвующего контроллера
    private function getRoute()
    {
	   if (empty($_GET['route']))
       {
           $route = 'Home';
	   }
         else
	   {
             $route = $_GET['route'];
			 
	   }
	  	return $route;
    }
//функция getController() вызывает контроллер согласно полученному маршруту
    private function getController()
	{
       $route=$this->getRoute();//получение маршрута
	   $path_contr = 'Application/Controllers/';//базовый путь к контроллерам
       $controller= $path_contr. $route . '.php';//формирование пути к определенному контроллеру
//проверка существования сформированного пути, 
//если существует - возвращает путь, если нет - false
	   if (file_exists($controller))
	   {
			return $controller;
	   }
	   else
	   {
			return false;
	   }
    }
//функция Run() осуществляет вызов контроллеров
	public function Run()
	{ 
	   $controller=$this->getController();
	   if($controller)
		{
		   $cl=explode('.', $controller);
		   $cl=$cl[0];
		   $name_contr=str_replace("/", "_", $cl);
		   $contr=new $name_contr;
		   $contr->callController();
		}
		else 
		{
			require_once('Application/Views/404.php');
		
		}
	
	}
 }
?>