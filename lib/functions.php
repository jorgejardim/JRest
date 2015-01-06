<?php
class Functions {

    function render($app, $return) {
        $app->render(
            isset($return['status'])?$return['status']:200,
            !is_array($return)?array('return'=>$return):$return
        );
    }

    function clear_class($parameter) {
        $parameter = preg_replace("/[^a-zA-Z0-9_]/i", '', $parameter);
        $parameter = str_replace('_', ' ', $parameter);
        $parameter = strtolower($parameter);
        $parameter = ucwords($parameter);
        $parameter = str_replace(' ', '', $parameter);
        return $parameter;
    }

    function clear_controller($parameter) {
        $parameter = preg_replace("/[^a-zA-Z0-9_]/i", '', $parameter);
        return strtolower($parameter);
    }

    function clear_action($parameter) {
        return $this->clear_controller($parameter);
    }

    function is_json($string) {
        return is_array(json_decode($string));
    }

    function debug($debug) {
        echo '<pre>';
        print_r($debug);
        echo '</pre>';
    }
    function d($debug) {
        $this->debug($debug);
    }

    function print_result($result) {
        print_r($result);
    }
}