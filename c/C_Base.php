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
	
	//
	// Генерация базового шаблонаы
	//	
}
