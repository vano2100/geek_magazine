<?php

class M_User{
  private $userName;
  private $userLogin;
  private $userId;
  private $role;

  public function login($login, $pass){
    $sql = "SELECT u.id_user, r.role_name, u.user_name, u.user_login, u.user_password FROM user u join role r on u.id_role = r.id_role WHERE u.user_login = :login";
    $arg = ['login' => $login];
    $passHash = md5($pass);
    $user = db::getRow($sql, $arg);
    if ($user){
      if ($user['user_login'] == $login){
        if ($user['user_password'] == $passHash){
          $this->userName = $user['user_name'];
          $this->userLogin = $user['user_login'];
          $this->userId = $user['id_user'];
          $this->role = $user['role_name'];
          return true;
        }
      }
    }    
    return false;
  }

  public function getId(){
    return $this->userId;
  }

  public function getLogin(){
    return $this->userLogin;
  }

  public function getName(){
    return $this->userName;
  }

  public function getRole(){
    return $this->role;
  }

  public function new($userName, $login, $password){
    $sql = "INSERT INTO user (user_name, user_login, user_password) VALUES (:name, :login, :password)";
    $arg = ['name' => $userName, 'login' => $login, 'password' => md5($password)];
    db::insert($sql, $arg);
  }

  public function getAll(){
    return $user = db::getRows("SELECT u.id_user, u.user_name, u.user_login, r.role_name FROM user u join role r on u.id_role = r.id_role", []);
  }

  public function delete($id){
    $sql = "DELETE FROM user WHERE id_user = :id";
    $arg = ['id' => $id];
    db::delete($sql, $arg);   
  }

  public function getById($id){
    $sql = "SELECT id_user, user_name, user_login, id_role FROM user WHERE id_user = :id";
    return db::getRow($sql, ['id' => $id]);
  }

  public function update($id, $id_role, $name, $login){
    $sql = "UPDATE user SET user_name = :username, user_login = :login, id_role = :id_role WHERE id_user = :id";
    $arg = ['id' => $id, 'username' => $name, 'login' => $login, 'id_role' => $id_role];
    return db::update($sql, $arg);
  }  

}
