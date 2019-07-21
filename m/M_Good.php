<?php

class M_Good {
    private $table = "goods";

    private $id_good;
    private $name;
    private $price;
    private $id_category;
    private $status;

    public function save($name, $price){
        $sql = "INSERT INTO goods (name, price) VALUES (:name, :price)";
        $arg = ['name' => $name, 'price' => $price];
        return db::insert($sql, $arg);        
    }

    public function update($id, $name, $price){
        $sql = "UPDATE goods SET name = :name, price = :price WHERE id_good = :id";
        $arg = ['id' => $id, 'name' => $name, 'price' => $price];
        return db::update($sql, $arg);
    }

    public function getById($id){
        $sql = "SELECT id_good, name, price FROM goods where id_good = :id";
        $arg = ['id' => $id];
        return db::getRow($sql, $arg);
    }

    public function findByName($name){

    }

    public function getAll(){
        return db::getRows('SELECT * FROM goods', []);
    }

    public function delete($id){
        $sql = "DELETE FROM goods where id_good = :id";
        $arg = ['id' => $id];
        db::delete($sql, $arg);
    }
}