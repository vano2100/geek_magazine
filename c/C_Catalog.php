<?php

class C_Catalog extends C_Base
{
	//
	// Конструктор.
	//
	
	public function action_index(){
        $this->title .= '::Каталог товаров';
        
        $goods = db::getRows('SELECT * FROM goods', []);
        $this->render('Catalog.html', ['title' => $this->title, 
        'catalog' => '1', 'goods' => $goods]);	
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