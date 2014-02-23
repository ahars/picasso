<?php

$_CONFIG['semestre'] = "P14";

$_CONFIG['slim_config'] = array(
    'mode' => 'development',
    'log.level' => \Slim\Log::DEBUG,
    'log.writer' => new \Picasso\Log\DateTimeFileWriter(array(
        'path' => __DIR__.'/logs',
        'name_format' => 'Y-m-d',
        'message_format' => '%label% - %date% - %message%'
    ))
);

$_CONFIG["application_key"] = "casper";

// Nom de l'instance de payutc (pour affichage)
$_CONFIG["title"] = "picasso";

// URL de casper (avec le / final)
$_CONFIG["casper_url"] = "http://localhost/payutc/casper/";

// URL du serveur payutc (avec le / final)
$_CONFIG["server_url"] = "http://localhost/payutc/server/web/";


?>