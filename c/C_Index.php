<?php

class C_Index extends C_Base
{
	//
	// Конструктор.
	//
	
	public function action_index(){
        $this->title .= '::Главная';
        $loader = new \Twig\Loader\FilesystemLoader('./tpl/');
		$twig = new \Twig\Environment($loader);
		if (isset($_SESSION['basket'])){
            $goodsInBasket = count($_SESSION['basket']);
        } else {
            $goodsInBasket = 0;
        }
		echo $twig->render('index.html', ['title' => $this->title, 'main' => '1','goodsInBasket' => $goodsInBasket]);	
	}
}