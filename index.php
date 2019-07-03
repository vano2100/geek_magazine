<?php
session_start();

// Загрузка классов шаблонизатора
require_once './vendor/autoload.php';
require_once './db.php';


spl_autoload_register(c_autoload);
function c_autoload($classname){
	include_once("c/$classname.php");
}


//site.ru/index.php?act=auth&c=User

$action = 'action_';
$action .= (isset($_GET['act'])) ? $_GET['act'] : 'index';

switch ($_GET['c'])
{
	case 'сatalog':
		$controller = new C_Catalog();
		break;
	case 'basket':
		$controller = new C_Basket();
		break;
	default:
		$controller = new C_Index();
}

$controller->Request($action);
