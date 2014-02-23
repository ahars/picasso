<?php
require_once("curl.class.php");

class Cas {

    public static function login_url($url){
        return 'https://cas.utc.fr/cas/login?service='.$url;
    }

    public static function logout_url($url){
        return 'https://cas.utc.fr/cas/logout?url='.$url;
    }
    
    public static function validate_url($url, $ticket){
        if(isset($ticket)){
            $curl = new CURL();
            $url = 'https://cas.utc.fr/cas/serviceValidate?service='.$url.'&ticket='.$ticket;
            $xmlstring = trim($curl->get($url));
            try { 
                $xml = new SimpleXMLElement($xmlstring); 
            } catch (Exception $e) { 
                
            } 
            $namespaces = $xml->getNamespaces();
    
            $serviceResponse = $xml->children($namespaces['cas']);
            $user = $serviceResponse->authenticationSuccess->user;
            
            if ($user) {
                return (string)$user; // cast simplexmlelement to string
            }else {
                $authFailed = $serviceResponse->authenticationFailure;
                if ($authFailed) {
                    $attributes = $authFailed->attributes();
                    throw new Exception((string)$attributes['code']);
                }else {
                    throw new Exception($r->body);
                }
            }
        }else {
            throw new Exception('Aucun ticket n\'a été récupéré.'); 
        }
    }

}
?>
