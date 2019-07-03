<?php

class C_Catalog extends C_Base
{
	//
	// Конструктор.
	//
	
	public function action_index(){
        $this->title .= '::Каталог товаров';
        $loader = new \Twig\Loader\FilesystemLoader('./tpl/');
        $twig = new \Twig\Environment($loader);
        if (isset($_SESSION['basket'])){
            $goodsInBasket = count($_SESSION['basket']);
        } else {
            $goodsInBasket = 0;
        }
        $goods = db::getRows('SELECT * FROM goods', []);
        echo $twig->render('Catalog.html', ['title' => $this->title, 
        'catalog' => '1', 'goods' => $goods,'goodsInBasket' => $goodsInBasket]);	
    }
    
    public function action_view(){
        $this->action_index();
    }

    public function action_buy(){
        
        if ($this->IsPost()){
            if (isset($_SESSION['basket'])){
                $_SESSION['basket'][] = (int)$_POST['add'];
            } else {
                $_SESSION['basket'] = [];
                $_SESSION['basket'][] = (int)$_POST['add'];
            }
            	
        }
        $this->action_index();
    }
}