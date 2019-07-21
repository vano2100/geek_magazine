<?php

class C_Catalog extends C_Base
{
	
	public function action_index(){
        $this->title .= '::Каталог товаров';
        
        $goods = db::getRows('SELECT * FROM goods', []);
        $this->render('Catalog.html', ['title' => $this->title, 
        'catalog' => '1', 'goods' => $goods]);	
    }
    
    public function action_view(){
        $this->action_index();
    }

    public function action_viewItem(){
        $id = (int)$_GET['id'];
        $goods = new M_Good();
        $good = $goods->getById($id);
        $this->render('Good.html', ['title' => $this->title, 
        'catalog' => '1', 'good' => $good]);
    }

    public function action_buy(){
        
        if ($this->IsPost()){
            if (!isset($_SESSION['basket'])){
                $_SESSION['basket'] = [];
            } 
            $_SESSION['basket'][] = (int)$_POST['add'];
            $basket = new M_Basket($_SESSION['user']['id']);
            $basket->addGood((int)$_POST['add']);
        }
        $this->action_index();
    }
}