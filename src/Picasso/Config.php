<?php 

namespace Picasso;

class Config {

    const LVL_DEFAULT = 10;
    const LVL_ADMIN = 100;
    const LVL_SUDO = 200;

    private static $config = array();
    
    public static function init($arr){
        self::$config = $arr;
    }
    
    public static function get($name, $default = null){
        if (array_key_exists($name, self::$config)) {
            return self::$config[$name];
        }else {
            return $default;
        }
    }
    
    public static function set($name, $value){
        self::$config[$name] = $value;
    }

} 
?>
