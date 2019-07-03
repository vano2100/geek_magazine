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
		if($this->isPost()){

			if (M_User::login($_POST['login'],$_POST['pass'])){
				$_SESSION['user'] = M_User::getName();
				header('location: index.php');
				exit();
			} else {
				$error = 'Не верное имя пользователя / пароль';
			}
			
		}		
		$this->title .= '::Личный кабинет';
		$this->content = $this->Template('v/v_login.php', ['error' => $error]);		
	}	

	public function action_logout(){
		unset($_SESSION['user']);
		header('location: index.php');
		exit();	
	}		
}
