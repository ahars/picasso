<?php 

namespace Picasso;

use \Picasso\DB;

class User{

	private $_user = array(
		'login' => null
	);

	function __construct(array $user = null){
		if ($user != null && $this->insert($user)) {
			return $this->getLogin();
		}
	}

	public function getLogin(){
		return $this->$_user['login'];
	}

	public function insert(array $user=null){

	}

	public function update(array $user = null){

	}

	public static function fetchByLogin($login = null){
		$pdo = new DB();
		$datas = $pdo->find("select count(login) as nb from users where login = :login;",array('login'=>$login));
		if(isset($datas[0]['nb']) && $datas[0]['nb'] > 0){	
			return true;
		}
	}


}
