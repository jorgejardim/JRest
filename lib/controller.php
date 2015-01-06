<?php
namespace Controller;

class Controller {

    protected $app;
    protected $db;
    protected $function;
    protected $name;
    protected $models;
    public $controller;
    public $action;

    public function __construct($app, $db, $function) {
        $this->app        = $app;
        $this->db         = $db;
        $this->function   = $function;

        $route = $this->app->router()->getCurrentRoute()->getParams();
        $this->controller = $route['controller'];
        $this->action     = $route['action'];

        $this->name       = get_class($this);
        $this->load_model();
    }

    protected function load_model($model=null) {

        if($model) {

            $file = $this->function->clear_controller($model);
            require_once ROOT.APP.'models'.DS."{$file}.php";
            $class_name = '\\Model\\'.$model;
            $this->$model = new $class_name($this->db, $this->function);

        } elseif(is_array($this->models)) {

            foreach ($this->models as $model) {
                $file = $this->function->clear_controller($model);
                require_once ROOT.APP.'models'.DS."{$file}.php";
                $class_name = '\\Model\\'.$model;
                $this->$model = new $class_name($this->db, $this->function);
            }
        }
    }

    public function no_id($values, $key=null) {

        $error = false;

        if(is_array($values)) {
            if(empty($values[$key])) {
                $error = true;
            }
        } elseif(empty($values)) {
            $error = true;
        }

        if($error) {
            $this->app->render(400, array(
                'error' => true,
                'msg' => 'Deve ser informado um identificador.'
            ));
            exit;
        }
    }
}