<?php
//
// Конттроллер страницы чтения.
//
include_once('m/M_User.php');

class C_User extends C_Base
{
	//
	// Конструктор.
	//
	
	public function action_auth(){
		$this->title .= '::Чтение';
		$text = text_get();
		$this->content = $this->Template('v/v_index.php', array('text' => $text));	
		/*$user = new M_User();
		if($user->auth($login,$pass))
		*/	
	}
	
	public function action_edit(){
		$this->title .= '::Редактирование';
		
		if($this->isPost())
		{
			text_set($_POST['text']);
			header('location: index.php');
			exit();
		}
		
		$text = text_get();
		$this->content = $this->Template('v/v_edit.php', array('text' => $text));	
		echo $twig->render($pagename . '.html', $vars);	
	}

	public function action_lk(){
		$this->title .= '::Личный кабинет';
		$history = $_SESSION['history'];
		$username = isset($_SESSION['user']) ? $_SESSION['user'] : "anonimus";
		$this->content = $this->Template('v/v_lk.php', array('username' => $username, 'lasturls' => $history));		
	}

	public function action_login(){
    $this->title .= '::Вход';
		if (isset($_SESSION['basket'])){
      $goodsInBasket = count($_SESSION['basket']);
    } else {
      $goodsInBasket = 0;
		}
		if($this->isPost()){

			echo '<pre>';
			print_r($_POST['userlogin'] );
			print_r($_POST['userpassword'] );
			echo '</pre>';
			
		}	
		$this->render('login.html', ['title' => $this->title, 'username' => '1','goodsInBasket' => $goodsInBasket]);	
	
	}	

	public function action_logout(){
		unset($_SESSION['user']);
		header('location: index.php');
		exit();	
	}	
	
	public function action_registration(){
    $this->title .= '::Регистрация нового пользователя';
		if (isset($_SESSION['basket'])){
      $goodsInBasket = count($_SESSION['basket']);
    } else {
      $goodsInBasket = 0;
		}
		if($this->isPost()){

			echo '<pre>';
			print_r($_POST['username'] );
			print_r($_POST['userlogin'] );
			print_r($_POST['userpassword'] );
			echo '</pre>';
			
		}	
		$this->render('registration.html', ['title' => $this->title, 'username' => '1','goodsInBasket' => $goodsInBasket]);	
	
	}
}
