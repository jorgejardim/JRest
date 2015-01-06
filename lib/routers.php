<?php
// ADD action index
$app->hook('slim.before.router', function () use ($app) {
    if($app->environment['PATH_INFO'] == '/') {
        $app->environment['PATH_INFO'] = DEFAULT_ROUTER;
    } elseif(substr_count($app->environment['PATH_INFO'], '/')<2 && $app->environment['PATH_INFO']!='/') {
        $app->environment['PATH_INFO'] = $app->environment['PATH_INFO'].'/index';
    }
});

//GET - Controller
$app->get('/:controller/:action(/:parameter)', function ($controller, $action, $parameter = null) use($app, $db, $function) {

    $controller = $function->clear_controller($controller);
    $class      = $function->clear_class($controller);
    $action     = $function->clear_action($action);

    require_once ROOT.APP.'controllers'.DS."{$controller}.php";
    $class_name         = '\\Controller\\'.$controller;
    $classe             = new $class_name($app, $db, $function);
    $return = call_user_func_array(array($classe, $action), array($parameter));

    $function->render($app, $return);
});

//POST - Controller
$app->post('/:controller/:action', function ($controller, $action) use ($app, $db, $function) {

    $controller = $function->clear_controller($controller);
    $class      = $function->clear_class($controller);
    $action     = $function->clear_action($action);

    $request = $app->request()->getBody();

    require_once ROOT.APP.'controllers'.DS."{$controller}.php";
    $class_name         = '\\Controller\\'.$controller;
    $classe             = new $class_name($app, $db, $function);
    $return = call_user_func_array(array($classe, $action), array($request));

    $function->render($app, $return);
});

//PUT - Controller
$app->put('/:controller/:action', function ($controller, $action) use ($app, $db, $function) {

    $controller = $function->clear_controller($controller);
    $class      = $function->clear_class($controller);
    $action     = $function->clear_action($action);

    $request = $app->request()->getBody();

    require_once ROOT.APP.'controllers'.DS."{$controller}.php";
    $class_name         = '\\Controller\\'.$controller;
    $classe             = new $class_name($app, $db, $function);
    $return = call_user_func_array(array($classe, $action), array($request));

    $function->render($app, $return);
});

//DELETE - Controller
$app->delete('/:controller/:action(/:parameter)', function ($controller, $action, $parameter = null) use($app, $db, $function) {

    $controller = $function->clear_controller($controller);
    $class      = $function->clear_class($controller);
    $action     = $function->clear_action($action);

    require_once ROOT.APP.'controllers'.DS."{$controller}.php";
    $class_name         = '\\Controller\\'.$controller;
    $classe             = new $class_name($app, $db, $function);
    $return = call_user_func_array(array($classe, $action), array($parameter));

    $function->render($app, $return);
});