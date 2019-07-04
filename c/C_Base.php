<?php
//
// Базовый контроллер сайта.
//
abstract class C_Base extends C_Controller
{
	protected $title;		// заголовок страницы
	protected $content;		// содержание страницы


	protected function before()
	{
		$this->title = 'Название сайта';

	}
	
	protected function render($template, $args){
		$loader = new \Twig\Loader\FilesystemLoader('./tpl/');
		$twig = new \Twig\Environment($loader);
		echo $twig->render($template, $args);	
	}
}
