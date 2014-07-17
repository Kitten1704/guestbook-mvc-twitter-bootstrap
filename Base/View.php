<?php
//базовый класс с функцией для подключения файлов представления
//$content_view-имя файла представления
//$arr-данные для отображения на странице
class Base_View
{
       
    function generate($content_view,$arr,$arr2)
    {
		include 'Application/Views/'.$content_view;

    }

}
?>