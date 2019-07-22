<?php

class M_Order {
    public function getAll(){
        $sql = 'SELECT o.id_order, o.amount, o.datetime_create, os.order_status_name FROM orders o JOIN order_status os ON o.id_order_status = os.id_order_status';
        return db::getRows($sql, []);
    } 

    public function getById($id){
        $sql = "SELECT * FROM orders where id_order = :id";
        $arg = ['id' => $id];
        return db::getRow($sql, $arg);
    } 
    
    public function send($id){
        $sql = "UPDATE orders SET id_order_status = 2 WHERE id_order = :id";
        $arg = ['id' => $id];
        return db::update($sql, $arg);
    }
}