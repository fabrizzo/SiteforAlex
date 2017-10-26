<?php
class conn_mysqli extends mysqli 
{
    public function __construct($host, $user, $pass, $db) 
	{
    	parent::__construct($host, $user, $pass, $db);
        if (mysqli_connect_error()) 
		{
            die('Ошибка подключения (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
        }
    }
}

$db = new mysqli('localhost', 'root', '', 'test'); //передаем переменной данные сервера
session_start();
?>