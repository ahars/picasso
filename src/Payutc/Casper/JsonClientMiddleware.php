<?php
namespace Payutc\Casper;

use \Payutc\Casper\Config;
use \Payutc\Casper\JsonClientFactory;

class JsonClientMiddleware extends \Slim\Middleware
{
    protected $services = array(
        "CATALOG"
    );
    
    public function call()
    {   
        // Get reference to application
        $app = $this->app;
        
        // Create the client for each service (if it does not exist)
        foreach($this->services as $service){
            $app->getLog()->debug("Creating json_client for service $service");
            JsonClientFactory::getInstance()->createClient($service);
        }
        
        // Get app status
        $status = JsonClientFactory::getInstance()->getClient("CATALOG")->getStatus();

        // Connect the application
        if(empty($status->application)){
            $app->getLog()->debug("No app logged in, calling loginApp");
            // Connexion de l'application
            try {
                JsonClientFactory::getInstance()->getClient("CATALOG")->loginApp(array(
                    "key" => Config::get("application_key")
                ));
            } catch (\JsonClient\JsonException $e) {
                $app->getLog()->error("Application login error: ".$e->getMessage());
                throw $e;
            }
        }
    
        try {
            // Run inner middleware and application
            $this->next->call();
        }
        catch(\JsonClient\JsonException $e){
            if($app->request()->getResourceUri() != '/login' && $e->getType() == "Payutc\Exception\CheckRightException"){
                $app->getLog()->debug("Caught CheckRightException (".$e->getMessage()."), redirect to login route");
                $app->response()->redirect($app->urlFor('login'));
            }
        }
    }
}