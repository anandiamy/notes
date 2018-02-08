<?php
namespace App\Models;
use Medoo\Medoo;
class Account {
public $db;
	public function __construct(){
        $this->db = new \Medoo\Medoo(['database_type' => 'sqlite',
                'database_file' => ROOT.'storage/fe.db']);
	}
	public function getAccount($username){
		$account = $this->db->get('users', ['id','username','password'], [
			'username' => $username 
		]);
		return $account;
	}
	public function register($username,$password){
		return $this->db->insert('users', [
	    	'username'=>$username,
	    	'password'=> password_hash($password,PASSWORD_DEFAULT)
	    ]);
	}
	public function check() {
		return isset($_SESSION['authentique']);
  	}
	public function login($username,$password){
        	$account = new Account($this->db);
        	$account_info = $account->getAccount($username);
        		if(password_verify($password, $account_info['password'])){
                		$_SESSION['authentique'] = true;
                		$_SESSION['username'] = $username;
                		$_SESSION['csrf'] = base64_encode(openssl_random_pseudo_bytes(32));
                		return true;
        		}else{
                		return false;
        		}
    	}

}
