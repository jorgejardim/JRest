<?php
// Exemplos
// https://github.com/thangufo/angularphp/blob/master/api/controllers/AppController.php

require ROOT.'vendor'.DS.'autoload.php';
require ROOT.APP.'configs'.DS.'config.php';
require CORE.'db.php';
require CORE.'functions.php';
require CORE.'controller.php';
require CORE.'model.php';
require CORE.'mail.php';
require ROOT.APP.'controllers'.DS.'app_controller.php';
require ROOT.APP.'models'.DS.'app_model.php';
session_save_path(sys_get_temp_dir());
session_cache_expire(30);
session_start();

if(DEBUG) {
    ini_set('display_errors', 1);
    error_reporting(E_ALL & ~E_STRICT & ~E_DEPRECATED);
} else {
    error_reporting(0);
}

// Start Functions
$function = new \Functions();

// Start SlimFramework
$app = new \Slim\Slim();
$app->add(new \Slim\Middleware\ContentTypes());
$app->config(array(
    'debug' => DEBUG,
    'log.enabled' => true,
    'log.writer' => new \Slim\Logger\DateTimeFileWriter(array('path' => ROOT.APP.'logs'))
));

//Log
$logger = $app->getLog();

//Json
$app->view(new \JsonApiView());
$app->add(new \JsonApiMiddleware());

//Database
$database = new DB\DB();
try {
    $connection = new \PDO('mysql:dbname='.$database->default['database'].';host='.$database->default['host'], $database->default['login'], $database->default['password']);
    $connection->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    $db = new \NotORM($connection);
} catch ( Exception $e ) {
    if(DEBUG) {
        echo json_encode(array('error' => true, 'msg' => 'Erro ao conectar no banco de dados: '.print_r($e->getMessage(), true),));
    } else {
        echo json_encode(array('error' => true, 'msg' => 'Erro ao conectar no banco de dados.',));
    }
    exit;
}

//Routers
require CORE.'routers.php';

$app->run();