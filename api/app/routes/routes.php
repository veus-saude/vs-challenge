<?php
namespace app\routes;

use Route66 as R;

class Routes {
    
    private $header;
    private $metodo;
    private $users;

    public function __construct() {
        $header = apache_request_headers();
        if (isset($header['Authorization'])) {
            $this->header = $header['Authorization'];
        } else {
            $this->header = null;
        }
        $base = $_SERVER['SCRIPT_NAME'];
        $base = str_replace('/index.php', '', $base);
        $this->metodo = $_SERVER["REQUEST_METHOD"];
        $this->users = [
            'teste' => '$2y$10$mubSIBuoGHRaJiXfr8LpPO2dBwqVyVrXU6HKzPayirOgwB/ed62a6',
        ];
        R::any($base.'(/@version/@controller(/:all))', function($version = null, $controller = null, $params = null) {
            $request = [
                'version' => $version,
                'controller' => $controller,
                'params' => $params,
                'metodo' => $this->metodo,
                'auth' => $this->header
            ];
            $this->head($request);
        });
        R::dispatch();
    }
    
    public function head(Array $route) {
        if (!is_null($route['controller'])) {
            $controller = "\\app\controller\\" . $route['version'] . "\\" . $route['controller'] . 'Controller';
        } else {
            $controller = "\\app\controller\\IndexController";
        }
        $class = class_exists($controller);
        if ($route['controller'] != 'createtable') {
            $auth = $this->auth_validate($route['auth']);
        } else {
            $auth = true;
        }
        if ($class && $auth) {
            $request = [
                'params' => $route['params'],
                'metodo' => $route['metodo']
            ];
            $obj = new $controller($request);
        } else if (!$auth) {
            header('HTTP/1.0 401 Unauthorized');
            exit();
        } else {
            header('HTTP/1.0 404 Not Found');
            exit();
        }
    }
    
    public function auth_validate($auth) {
        $user = $pass = null;
        $data = explode(' ', $auth);
        if ($data[0] == 'Basic') {
            $dados = explode(':', base64_decode($data[1]));
            $user = $dados[0];
            $pass = $dados[1];
        }
        if (!is_null($user) && !empty($user) && !is_null($pass) && !empty($pass)) {
            return password_verify($pass, $this->users[$user]);
        }
        return false;
    }
}