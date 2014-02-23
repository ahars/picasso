<?php 
class Session {
 
    public static function read($key) {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : false;
    }
 
    public static function write($key, $value) {
        $_SESSION[$key] = $value;
    }

    public static function del($key) {
        $_SESSION[$key] = null;
    }
 
    public static function login($login,$pass=null) {
        $_SESSION['authentication_ip'] = $_SERVER['REMOTE_ADDR'];
        $_SESSION['login'] = $login;
        if(isset($pass))
            $_SESSION['pass'] = md5($pass);
    }
 
    public static function logout() {
        $_SESSION = array();
        session_unset();
        session_destroy();
    }

    public static function flush(){
        $_SESSION = array();
    }
 
    public static function isLogged() {
        return isset($_SESSION['authentication_ip']) && $_SESSION['authentication_ip'] == $_SERVER['REMOTE_ADDR'];
    }

    public static function setNotif($msg = "", $type = "success"){
		if ($msg != "") {
			$_SESSION['message'] = array('notifs' => array('msg' => $msg, 'type' => $type));
		}
	}
    public static function emptyNotif(){
        $_SESSION['message'] = array();
    }
}
