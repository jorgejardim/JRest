<?php
namespace Controller;

class AppController extends Controller {

    private $routesAllow  = array('/login/index', '/login/logout', '/login/forgot_password');

    public function __construct($app, $db, $function) {
        parent::__construct($app, $db, $function);
        $this->auth();
    }

    private function auth() {

        $uri = '/'.$this->controller.'/'.$this->action;

        if(!in_array($uri, $this->routesAllow)) {

            $headers = apache_request_headers();

            if(empty($_SESSION['auth']['token'])) {
                $this->app->render(401, array(
                    'error' => true,
                    'msg' => 'Não logado.'
                ));
                exit;
            } elseif(empty($headers['Authorization'])) {
                $this->app->render(401, array(
                    'error' => true,
                    'msg' => 'Token de autenticação não enviado.'
                ));
                exit;
            } elseif($_SESSION['auth']['token']!=$headers['Authorization']) {
                $this->app->render(401, array(
                    'error' => true,
                    'msg' => 'Token de autenticação inválido.'
                ));
                exit;
            }
        }
    }
}