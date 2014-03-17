<?php 

require 'vendor/autoload.php';

use \Payutc\Casper\Config;
use \Picasso\Session;
use \Picasso\Cas;
use \Picasso\DB;
use \Picasso\Curl;
use \Payutc\Casper\JsonClientMiddleware;
use \Payutc\Casper\JsonClientFactory;

require 'config.incl.php';

Config::initFromArray($_CONFIG);

// Set the current mode
$app = new \Slim\Slim(Config::get('slim_config'));

// Settings for cookies
$sessionPath = parse_url(Config::get("casper_url"), PHP_URL_PATH);
session_set_cookie_params(0, $sessionPath);
session_start();

// Only invoked if mode is "production"
$app->configureMode('production', function () use ($app) {
    $app->config(array(
        'log.enable' => true,
        'debug' => false
    ));
});

// Only invoked if mode is "development"
$app->configureMode('development', function () use ($app) {
    $app->config(array(
        'log.enable' => false,
        'debug' => true
    ));
});

/*
En attente du service CATALOG
********************************************************************************************************************
// This middleware loads all our json clients
//$app->add(new JsonClientMiddleware);
********************************************************************************************************************
*/

function sanitize(array $_files, $top = true){
    $files = array();
    foreach($_files as $name=>$file){
        if($top) $sub_name = $file['name'];
        else    $sub_name = $name;
        
        if(is_array($sub_name)){
            foreach(array_keys($sub_name) as $key){
                $files[$name][$key] = array(
                    'name'     => $file['name'][$key],
                    'type'     => $file['type'][$key],
                    'tmp_name' => $file['tmp_name'][$key],
                    'error'    => $file['error'][$key],
                    'size'     => $file['size'][$key],
                );
                $files[$name] = sanitize($files[$name], FALSE);
            }
        }else{
            $files[$name] = $file;
        }
    }
    return $files;
}

$isLogged = function() {
    return function (){
        if(!Session::isLogged()){
            $app = \Slim\Slim::getInstance();
            $app->error();
        }
    };
};

$CASauthenticate = function($url = 'home') {
    return function () use ( $url ) {
        $app = \Slim\Slim::getInstance();
        if(!Session::read('login')){
            $service = $app->request()->getUrl().$app->urlFor($url);
            if(isset($_GET['ticket'])){
                $ticket = $_GET['ticket'];
                $login = CAS::validate_url($app->request()->getUrl().$app->urlFor($url),$ticket);
                if(preg_match("/^[a-z]{8}$/", $login)){
                  if(User::fetchByLogin($login)){
                      Session::login($login);
                      $app->flash('success', "Vous êtes bien connecté avec votre login $login.<br>Celui-ci est rattaché à vos idées postées pour permettre la suppression mais n'est pas visible.");
                      $app->redirect($app->urlFor('admin'));
                  }
                }
            }else{
                $app->redirect(CAS::login_url($service));
            }
        }
    };
};

$app->map('/admin/edit-:action-:id', $isLogged(),  function ($action,$id) use ($app){
    if($app->request()->isAjax()){
      $pdo = new DB();
      if($action == "users"){
        $res = $pdo->find("select * from $action where login = '$login");
        $res['action'] = $action;
        echo json_encode((!empty($res)) ? $res : false);
      }else{
        $res = $pdo->find("select * from $action where id = $id");
        $res['action'] = $action;
        echo json_encode((!empty($res)) ? $res : false);
      }
    }
})->name('edit')->via('POST','GET')->conditions(array('action' => '(goodies|bieres|snacks|softs|users)'));

$app->get('/admin/delete-:action-:id', $isLogged(),  function ($action,$id) use ($app){
    if($app->request()->isAjax()){
      $pdo = new DB();
      if($action == "users"){
        $res = $pdo->delete($action,"login = '$id'");
        echo json_encode(($res) ? array('id' => $id, 'action' => $action) : false);
      }else{
        $res = $pdo->delete($action,"id = $id");
        echo json_encode(($res) ? array('id' => $id, 'action' => $action) : false);
      }
    }
})->name('delete')->conditions(array('action' => '(goodies|bieres|snacks|softs|users)'));

$app->post('/admin/add-:action(-:id)', $isLogged(),  function ($action,$id = null) use ($app){
    if($app->request()->isAjax() && $app->request()->params('data')){
      $d = $app->request()->params('data');
      $pdo = new DB();
      if(isset($d['disabled']))
        $d['disabled'] = ($d['disabled'] == "on")? "1" : "0";

      if($action == 'bieres' && !isset($d['checkbox']) && isset($d['semaine'])){
        if($d['semaine'] != "")
          unset($d['semaine']);
        unset($d['checkbox']);
      }

      if(!empty($_FILES)){
        $files = sanitize($_FILES);
        $uploadfile = "uploads/".basename($files['img_url']['name']);
        if (move_uploaded_file($files['img_url']['tmp_name'], __DIR__."/".$uploadfile)) {
          $d['img_url'] = $uploadfile;
          $app->flash('success', "Image uploadée avec succès.");
        }else{
          $app->flash('error', "L'image n'a pas été uploadée.");
        }
      }

      if($id){
        if($action == "users"){
          $pdo->update($action,$d,"login = ${d['login']}");
        }else{
          $pdo->update($action,$d,"id = ${d['id']}");
        }
        $d['isUpdate'] = true;
        echo json_encode($d);
      }else{
        if($action == "users"){
          $pdo->save($action,$d,false);
        }else{
          $pdo->save($action,$d);
          $d['id'] = $pdo->lastId();
        }
        echo json_encode($d);
      }
    }
})->name('add')->conditions(array('action' => '(goodies|bieres|snacks|softs|users)'));

$app->get('/admin', $CASauthenticate('admin'),  function () use ($app){

    $pdo = new DB();
    $day = date('w');
    $semaine = date('W');
    $week_start = date('Y-m-d', strtotime('-'.$day.' days'));
    $week_end = date('Y-m-d', strtotime('+'.(6-$day).' days'));
    $datas = array();
    try{
      $datas['goodies'] = $pdo->find("select * from goodies order by semaine DESC, numero, nom, prenom;");
      $datas['bieres'] = $pdo->find("select * from bieres order by semaine DESC, category, nom, prix;");
      $datas['softs'] = $pdo->find("select * from softs order by nom, prix;");
      $datas['snacks'] = $pdo->find("select * from snacks order by nom, prix;");
      $datas['users'] = $pdo->find("select * from users order by login;");
    }catch(PDOException $e){
      $app->flashNow('error','Une erreur est survenue lors des requêtes à la BDD!');
    }
    $app->render('admin.php',array(
        'server'  => $app->request()->getRootUri(),
        'week_start' => $week_start,
        'week_end' => $week_end,
        'semaine' => $semaine,
        'datas'   => $datas
    ));
})->name('admin');

// --- CAS
$app->get('/login', function() use ($app) {
    /*// Si pas de ticket, c'est une invitation à se connecter
    if(empty($_GET["ticket"])) {
        $app->getLog()->debug("No CAS ticket, unsetting cookies and redirecting to CAS");
        // On jette les cookies actuels
        JsonClientFactory::getInstance()->destroyCookie();
        
        // Redirection vers le CAS
        $app->redirect(JsonClientFactory::getInstance()->getClient("MYACCOUNT")->getCasUrl()."/login?service=".Config::get("casper_url").'login');
    } else {
        // Connexion au serveur avec le ticket CAS
        try {
            $app->getLog()->debug("Trying loginCas");
            
            $result = JsonClientFactory::getInstance()->getClient("MYACCOUNT")->loginCas(array(
                "ticket" => $_GET["ticket"],
                "service" => Config::get("casper_url").'login'
            ));
        } catch (\JsonClient\JsonException $e) {
            // Si l'utilisateur n'existe pas, go inscription
            if($e->getType() == "Payutc\Exception\UserNotFound"){
                // On doit garder le cookie car le serveur garde le login de son côté
                JsonClientFactory::getInstance()->setCookie(JsonClientFactory::getInstance()->getClient("MYACCOUNT")->cookie);
                
                // Redirection vers la charte
                $app->redirect($app->urlFor('register'));
            }
            
            $app->getLog()->warn("Error with CAS ticket ".$_GET["ticket"].": ".$e->getMessage());
            
            // Affichage d'une page avec juste l'erreur
            $app->render('header.php', array("title" => Config::get("title", "payutc")));
            $app->render('error.php', array('login_erreur' => 'Erreur de login CAS<br /><a href="'.$app->urlFor('login').'">Réessayer</a>'));
            $app->render('footer.php');
            $app->stop();
        }

        // On stocke le cookie
        JsonClientFactory::getInstance()->setCookie(JsonClientFactory::getInstance()->getClient("MYACCOUNT")->cookie);
            
        // Go vers la page d'accueil
        $app->redirect($app->urlFor('home'));
    }
    */
})->name('login');

$app->get('/logout', function() use ($app) {
    // On clot la session avec le serveur
    try {
        JsonClientFactory::getInstance()->getClient("MYACCOUNT")->logout();        
    }
    catch (\JsonClient\JsonException $e){
        // No worries, we'll just continue
    }
    
    // Throw our cookies away
    JsonClientFactory::getInstance()->destroyCookie();
    
    // Logout from CAS
    $app->redirect(JsonClientFactory::getInstance()->getClient("MYACCOUNT")->getCasUrl()."/logout?service=".Config::get("casper_url").'login');
})->name('logout');

$app->get('/', function () use ($app){
    $pdo = new DB();
    $curl = new CURL();
    $day = date('w');
    $semaine = date('W');
    $annee = date('Y');
    $schema = $annee."-W".$semaine;
    $week_start = date('Y-m-d', strtotime('-'.$day.' days'));
    $week_end = date('Y-m-d', strtotime('+'.(6-$day).' days'));
    $datas = array();
    
    $app->log->info('Calling getCategories function on CATALOG service');
    try {
        $products = JsonClientFactory::getInstance()->getClient("CATALOG")->getProductsByCategories();
    } catch (Exception $e) {
        $products = null;
        $app->log->error('Impossible de charger les produits depuis Payutc');
        $app->flashNow('error','Impossible de charger les produits depuis Payutc');
    }
    
    $datas['goodies'] = $pdo->find("SELECT numero,nom,prenom FROM goodies WHERE semaine = '$schema' ORDER BY numero,nom,prenom; ");
    $datas['weekbieres'] = $pdo->find("SELECT nom,degre,prix,img_url FROM bieres WHERE disabled = 0 AND semaine = '$schema' ORDER BY prix ASC, degre DESC, nom ;");
    $datas['softs'] = $pdo->find("SELECT nom,prix FROM softs WHERE disabled = 0 ORDER BY prix, nom;");
    $datas['snacks'] = $pdo->find("SELECT nom,prix FROM snacks WHERE disabled = 0 ORDER BY prix, nom; ");
    $datas['bouteilles'] = $pdo->find("SELECT nom,degre,prix FROM bieres WHERE semaine = NULL AND category = 'BOUTEILLE' AND disabled = 0 ORDER BY prix ASC, degre DESC, nom; ");
    $datas['pressions'] = $pdo->find("SELECT nom,degre,prix FROM bieres WHERE semaine = NULL AND category = 'PRESSION' AND disabled = 0 ORDER BY prix ASC, degre DESC, nom; ");
  
    $app->render('default.php',array(
        'server'   => $app->request()->getRootUri(),
        'week_start' => $week_start,
        'week_end' => $week_end,
        'semaine' => $semaine,
        'datas' => $datas
    ));
})->name('home');


$app->notFound(function () use ($app) {
  $app->render('404.php',array(
    'server' => $app->request()->getRootUri()
  ));
});

$app->error(function ($type = "500") use ($app) {
  $app->render($type.'.php',array(
    'server' => $app->request()->getRootUri()
  ));
});

$app->run();

 ?>
