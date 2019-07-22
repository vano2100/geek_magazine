<?php

class C_Good extends C_Base
{
    public function action_index(){
        $this->title .= '::Каталог товаров';
        
        $goods = new M_Good();
        $this->render('Catalog.html', ['title' => $this->title, 
        'goods' => $goods->getAll()]);	
    }

    public function action_delete(){
        if ($this->isAdmin()){
            $id = (int)$_GET['id'];
            $good = new M_Good();
            $good->delete($id);
            header('location: index.php?act=index&c=good');
        }   else {
            header('location: index.php');
        }      
    }

    public function action_edit(){
        $this->title .= ':: Редактирование';
        if ($this->isAdmin()){
            $id = (int)$_GET['id'];
            $goods = new M_Good();
            $good = $goods->getById($id);
            $this->render('good.html', ['title' => $this->title, 
            'good' => $good]);
        } else {
            header('location: index.php');
        }
    }

    public function action_create(){
        $this->title .= ':: Новый';
        if ($this->isAdmin()){
            $this->render('good.html', ['title' => $this->title]);
        } else {
            header('location: index.php');
        }
    }

    public function action_save(){
        if ($this->isAdmin()){
            if ($this->IsPost()){
                $name = $_POST['name'];
                $price = (double) $_POST['price'];
                $good = new M_Good();
                if ($_POST['id']){
                    $id = (int)$_POST['id'];
                    $good->update($id, $name, $price);
                } else {
                    $good->save($name, $price);
                }
                header('location: index.php?act=index&c=good');
            }
        }else {
            header('location: index.php');
        }
        
    }
}