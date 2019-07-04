<?

class M_User{

  public function login($login, $pass){
    if (($login == self::$validName) && ($pass == self::$validPass)){
      return true;
    } 
    return false;
  }
  public function getName(){
    return self::$validName;
  }

  public function new($userName, $login, $password){
    $sql = "INSERT INTO user (user_name, user_login, user_password) VALUES (:name, :login, :password)";
    $arg = ['name' => $userName, 'login' => $login, 'password' => md5($password)];
    db::insert($sql, $arg);
  }


}
