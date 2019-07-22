<?php

class C_Order extends C_Base
{
    public function action_index(){
        $this->title .= '::Заказы';
        
        $orders = new M_Order();
        $this->render('index.html', ['title' => $this->title, 
        'orders' => $orders->getAll()]);	
    }

    public function action_send(){
        if ($this->isManager()){
            if ($this->isPost()){
                $id = (int) $_POST['id'];
                $order = new M_Order();
                $order->send($id);
            }
            header('location: index.php?act=index&c=order');
        } else {
            header('location: index.php');
        }      
    }

    public function action_view(){
        if ($this->isManager()){
            $id = (int)$_GET['id'];
            $orders = new M_Order();
            $order = $orders->getById($id);
            $basket = new M_Basket(0);
            $goods = $basket->getByOrder($id);
            $this->title .= '::Заказ №' . $order['id_order'];
            $this->render('view.html', ['title' => $this->title, 
            'order' => $order, 'goods' => $goods]);
        }          
    }
}