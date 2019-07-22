<?php

class C_User extends C_Base
{
	//
	// Конструктор.
	//

	public function action_login(){
    	$this->title .= '::Вход';
		if($this->isPost()){
			$user = new M_User();
			if ($user->login($_POST['userlogin'], $_POST['userpassword'])){
				$_SESSION['user']['id'] = $user->getId();
				$_SESSION['user']['name'] = $user->getName();
				$_SESSION['user']['login'] = $user->getLogin();
				$_SESSION['user']['role'] = $user->getRole();
				header('location: index.php');
			}
			
		}	
		$this->render('login.html', ['title' => $this->title, 'username' => '1']);	
	
	}	

	public function action_logout(){
		unset($_SESSION['user']);
		header('location: index.php');
		exit();	
	}	
	
	public function action_registration(){
    	$this->title .= '::Регистрация нового пользователя';
		
		if($this->isPost()){
			$user = new M_User();
			$user->new($_POST['username'], $_POST['userlogin'], $_POST['userpassword']);
			header('location: index.php?act=login&c=user');
		}	
		$this->render('registration.html', ['title' => $this->title, 'username' => '1']);	
	
	}

	public function action_list(){
		if ($this->isAdmin()){
			$this->title .= '::Пользователи';
			$user = new M_User();
			$users = $user->getAll();			
			$this->render('userlist.html', ['title' => $this->title, 'users' => $users]);	
		} else {
            header('location: index.php');
        }
	}

	public function action_delete(){
		if ($this->isAdmin()){
			$id = (int) $_GET['id'];
			$user = new M_User();
			$users = $user->delete($id);			
			header('location: index.php?act=list&c=user');	
		} else {
            header('location: index.php');
        }
	}

	public function action_edit(){
		if ($this->isAdmin()){
			$this->title .= '::Пользователи - редактирование';
			$id = (int) $_GET['id'];
			$users = new M_User();
			$user = $users->getById($id);			
			$this->render('edit.html', ['title' => $this->title, 'ruser' => $user]);	
		} else {
            header('location: index.php');
        }
	}

	public function action_save(){
		if ($this->isAdmin()){
			$id = (int) $_POST['id'];
			$id_role = (int) $_POST['role'];
			$name = $_POST['username'];
			$login = $_POST['login'];
			$user = new M_User();
			$user->update($id, $id_role, $name, $login);			
			header('location: index.php?act=list&c=user');	
		} else {
            header('location: index.php');
        }		
	}
}
