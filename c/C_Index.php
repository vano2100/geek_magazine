<?php

class C_Index extends C_Base
{
	//
	// Конструктор.
	//
	
	public function action_index(){
		$this->title .= '::Главная';
		$this->render('index.html', ['title' => $this->title, 'main' => '1']);	
	}
}