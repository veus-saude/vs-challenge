<?php

namespace app\controller;

class Controller {

    public $content;
    public $route;

    public function __construct($route = null) {
        
        $this->route = $route;
        
        $funcao = $this->convertRequest($route['metodo']);
        
        if (is_callable(array($this, $funcao))) {

            $this->$funcao(@$route['params']);
            
        } else {
            
            $this->listar();
            
        }
        
        $this->template();
    }

    public function view($name, Array $options = null) {

        ob_start();
        ob_implicit_flush(false);
        
        if (isset($options)) {

            foreach ($options as $key => $value) {
                
                $$key = $value;
                extract($$key, EXTR_OVERWRITE);
                
            }
        }

        require('./app/view/' . $name . '.php');

        $this->content = ob_get_clean();
    }

    public function template($name = null) {
        
        if ($name == null) {
            $name = "index";
        }
        
        $request = $_REQUEST;
        
        include './public/template/' . $name . '.php';
    }
    
    public function convertRequest($metodo) {
        switch ($metodo) {
            case 'PUT':
                return 'create';
                break;
            case 'GET':
                return 'read';
                break;
            case 'POST':
                return 'update';
                break;
            case 'DELETE':
                return 'delete';
                break;
            default:
                return '';
                break;
        }
    }

}
