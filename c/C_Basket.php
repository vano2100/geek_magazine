<?php

class C_Basket extends C_Base
{
	//
	// Конструктор.
	//
	
	public function action_index(){
        $this->title .= '::Корзина';
        $loader = new \Twig\Loader\FilesystemLoader('./tpl/');
        $twig = new \Twig\Environment($loader);
        if (isset($_SESSION['basket'])){
            $goodsInBasket = count($_SESSION['basket']);
            $goods = [];
            foreach($_SESSION['basket'] as $id){
                $goods[] = db::getRow('SELECT * FROM goods where id_good = :id', ['id' => $id]);
            }
            $total = 0;
            foreach($goods as $good){
                $total += (int)$good['price'];
            }
        } else {
            $goodsInBasket = 0;
        }
        echo $twig->render('basket.html', ['title' => $this->title, 'goods' => $goods,
        'basket' => '1','goodsInBasket' => $goodsInBasket, 'total' => $total]);	
    }
    
    public function action_view(){
        $this->action_index();
    }

    public function action_clear(){
        unset($_SESSION['basket']);
        $this->action_index();
    }
}