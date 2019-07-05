<?php
session_start();

// Загрузка классов шаблонизатора
require_once './vendor/autoload.php';

// Класс для работы с БД
require_once './db.php';

spl_autoload_register('c_autoload');
//TODO переписать автозагрузчик для подключения всех классов
function c_autoload($classname){
	include_once("c/$classname.php");
}

//site.ru/index.php?act=auth&c=User

$action = 'action_';
$action .= (isset($_GET['act'])) ? $_GET['act'] : 'index';

if (!empty($_GET['c'])){
	$controllerName = 'C_' . ucfirst($_GET['c']);
	if (class_exists($controllerName)){
		$controller = new $controllerName();
	} else{
		$controller = new C_Index();
	}
} else {
	$controller = new C_Index();
}

$controller->Request($action);
