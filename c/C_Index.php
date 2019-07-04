<?php

class C_Index extends C_Base
{
	//
	// Конструктор.
	//
	
	public function action_index(){
    $this->title .= '::Главная';
 		if (isset($_SESSION['basket'])){
            $goodsInBasket = count($_SESSION['basket']);
        } else {
            $goodsInBasket = 0;
        }
		$this->render('index.html', ['title' => $this->title, 'main' => '1','goodsInBasket' => $goodsInBasket]);	
	}
}