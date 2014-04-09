<?php

$_CONFIG['semestre'] = 'P14';

$_CONFIG['slim_config'] = array(
    'mode' => 'development',
    'log.level' => \Slim\Log::DEBUG,
    'log.writer' => new \Picasso\Log\DateTimeFileWriter(array(
        'path' => __DIR__.'/logs',
        'name_format' => 'Y-m-d',
        'message_format' => '%label% - %date% - %message%'
    ))
);

$_CONFIG['application_key'] = 'picasso';

// Date d'ouverture du Pic.
$_CONFIG['ouverture_matin'] = '05:05:2014:10:00:00';
$_CONFIG['ouverture_soir'] = '05:05:2014:18:30:00';

// Type d'évènement dans le calendrier du portail
$_CONFIG['perm'] = 'Perm au Picasso';

// Horaire des différentes permanences
$_CONFIG['perm_1'] = '10:15:00;12:15:00';
$_CONFIG['perm_2'] = '12:15:00;14:15:00';
$_CONFIG['perm_3'] = '14:15:00;18:15:00';
$_CONFIG['perm_4'] = '18:15:00;21:15:00';

// Nom de l'instance de payutc (pour affichage)
$_CONFIG['title'] = 'picasso';

// URL de picasso (avec le / final)
$_CONFIG['picasso_url'] = 'http://localhost/picasso/';

// URL de casper (avec le / final)
$_CONFIG['casper_url'] = 'http://localhost/payutc/casper/';

// URL du serveur payutc (avec le / final)
$_CONFIG['server_url'] = 'http://localhost/payutc/server/web/';

// URL du portail des assos
$_CONFIG['portail_url'] = 'http://assos.utc.fr';

// URL des articles du portail des assos
$_CONFIG['article_url'] = 'http://assos.utc.fr/asso/picasso';

// URL du calendrier du portail des assos
$_CONFIG['calendar_url'] = 'http://assos.utc.fr/event.json';

$_CONFIG['database'] =  array(
    'datasource' => 'Database/MySQL',
    'persistent' => false,
    'host' => '127.0.0.1',
    'login' => 'picasso',
    'password' => 'picasso',
    'database' => 'picasso',
    'prefix' => '',
    'encoding' => 'utf8',
);

?>
