<?php

class M_Basket{

  public function __construct($userId){
    $this->userId = $userId;
  }

  public function getTotal(){
    $sql = "SELECT SUM(price) as 'sum' FROM basket where id_user = :userId and id_order IS NULL";
    $arg = ['userId' => $this->userId];
    return db::getRow($sql, $arg)['sum'];
  }

  public function clear(){
    $sql = "DELETE FROM basket where id_order IS NULL and id_user = :userId";
    $arg = ['userId' => $this->userId];
    db::delete($sql, $arg);    
  }

  public function addGood($goodId){
    $sql = "INSERT INTO basket (id_user, id_good, price) VALUES (:userId, :goodId, (SELECT price FROM goods WHERE id_good = :goodId))";
    $arg = ['userId' => $this->userId, 'goodId' => $goodId];
    db::insert($sql, $arg);
  }

  private $userId;
}