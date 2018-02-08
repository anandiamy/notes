<?php

namespace App\Controllers;

class PageController {

	public function __construct(){
        $this->app = new \App\Kit();
		$this->auth = new \App\Models\Account();
    }
    public function home(){
        $getting=$this->app->lister->folderOnly(MARQUES);
		$prelist = $this->app->lister->leaves(MARQUES);
        $data = [
            'title' => basename($k),
            'breadcrumbs' => \App\Sys\BreadProvider::makeBread($k),
            'files' => $this->app->lister->sidebarList($getting),
			'list' => bonsai($prelist)
        ];
        echo $this->app->render('landing', $data);
    }

    public function getLogin(){
		if ($this->auth->check()) $flashy='already logged-in';
		else $flashy='login first';
		echo $this->app->render('pages/hospitality', ['flashy' =>$flashy]);
    }
    public function getRegister(){
		echo $this->app->render('register');
    }
    public function postRegister(){
			$u = $_POST['username'];
            $e = $_POST['email'];
            $p = $_POST['password'];
    if($this->auth->register($u,$e,$p)){
                header("Location: /");die();
        }else{
            $this->app->msg->error('Sadly, no.');
			echo $this->app->render('register', ['msg'=>$msg]);
            }
	}
    public function postLogin(){
            $e = $_POST['username'];
            $p = $_POST['password'];
    if($this->auth->login($e,$p)){
                header("Location: /");die();
        }
	else{
		$this->app->msg->error('Sadly, no.');
		echo $this->app->render('pages/hospitality', ['msg' =>$msg]);
        }
	}
    public function newPage(){
        echo $this->app->render('new');
    }
    public function logout() {
        session_destroy();
        header("Location: /login");
        die();
    }
}
