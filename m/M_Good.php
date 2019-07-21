<?php

class M_Good {
    private $table = "goods";

    private $id_good;
    private $name;
    private $price;
    private $id_category;
    private $status;

    public function save(){

    }

    public function update(){

    }

    public function getById($id){
        $sql = "SELECT id_good, name, price FROM goods where id_good = :id";
        $arg = ['id' => $id];
        return db::getRow($sql, $arg);
    }

    public function findByName($name){

    }

    public function getAll(){
        
    }
}