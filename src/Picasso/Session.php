<?php 

namespace Picasso;

class Session {

    public function init($sessionPath){
        session_set_cookie_params(0, $sessionPath);
        session_start();
    }

    public function getIP(){
        if(!empty($_SERVER["HTTP_X_FORWARDED_FOR"]))
            return $_SERVER["HTTP_X_FORWARDED_FOR"]; // On récupère la vrai IP
        else
            return $_SERVER["REMOTE_ADDR"]; // On récupère l'IP normale
    }
    
    //On lit la clé dans le tableau
    public function read($key) {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : false;
    }
    
    //On écrit la valeur dans le tableau avec la clé
    public function write($key, $value) {
        $_SESSION[$key] = $value;
    }
    
    //On supprimer un élément du tableau avec la clé
    public function del($key) {
        $_SESSION[$key] = null;
    }
    
    //On rajoute les informations de la session logguée
    public function login($login,$role=null,$groups=null) {

        $_SESSION['authentication_ip'] = self::getIP();
        $_SESSION['login'] = $login;
        if(isset($role))
            $_SESSION['role'] = $role;
        if(isset($groups))
            $_SESSION['groups'] = $groups;
    }
    
    //On récupère les informations de la session logguée
    public function parse(){
        return array(
            'login' => self::read('login'),
            'role' => self::read('role'),
            'groups' => self::read('groups')
        );
    }
    
    //On déconnecte la session
    public function logout() {
        $_SESSION = array();
        session_unset();
        session_destroy();
    }
    
    //On néttoie la session
    public function flush(){
        $_SESSION = array();
    }
    
    //On vérifie si une session est logguée
    public function isLogged() {
        return isset($_SESSION['login']) && $_SESSION['authentication_ip'] == self::getIP();
    }
    
    //Pour le système de notif (pas utilisé car géré dans SLIM)
    public function setNotif($msg = "", $type = "success"){
		if ($msg != "") {
			$_SESSION['message'] = array('notifs' => array('msg' => $msg, 'type' => $type));
		}
	}
    
    //Pour vider les messages de la session
    public function emptyNotif(){
        $_SESSION['message'] = array();
    }
}