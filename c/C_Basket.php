<?php
require_once('m/M_Basket.php');

class C_Basket extends C_Base
{
	//
	// Конструктор.
	//
	
	public function action_index(){
        $this->title .= '::Корзина';
        if (isset($_SESSION['basket'])){
            $basket = new M_Basket($_SESSION['user']['id']);
            $goods = [];
            foreach($_SESSION['basket'] as $id){
                $goods[] = db::getRow('SELECT * FROM goods where id_good = :id', ['id' => $id]);
            }            
            $total = $basket->getTotal();
            echo 1;
        } 
        $this->render('basket.html', ['title' => $this->title, 'goods' => $goods,
        'basket' => '1', 'total' => $total]);	
    }
    
    public function action_view(){
        $this->action_index();
    }

    public function action_clear(){
        unset($_SESSION['basket']);
        $basket = new M_Basket($_SESSION['user']['id']);
        $basket->clear();
        $this->action_index();
    }

    public function action_toOrder(){
        print_r($_POST['adr']);
    }    

}