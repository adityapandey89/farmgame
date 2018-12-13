<?php

/*
  Created on : 12 Dec, 2018, 14 PM
  Author     : groot (Aditya Pandey)
  Description: Base class to initialize and make the controller/models/views work
 */

class App {

    protected $controller = 'farm';
    protected $method = 'index';
    protected $params = [];

    public function __construct() {

        $database = new Database(); // Initializing database

        $this->controller = ucfirst($this->controller) . "Controller";
        $url = $this->parseUrl();
        unset($url[0]); // getting rid of public folder in path

        if (file_exists("../app/controllers/" . ucfirst($url[1]) . "Controller.php")) {
            $this->controller = ucfirst($url[1]) . "Controller";
            unset($url[1]);
        }

        require_once '../app/controllers/' . $this->controller . '.php';

        $this->controller = new $this->controller;
        if (isset($url[2])) {
            if (method_exists($this->controller, $url[2])) {
                $this->method = $url[2];
                unset($url[2]);
            }
        }
        $this->params = $url ? array_values($url) : [];

        call_user_func([$this->controller, $this->method], $this->params);
    }

    public function parseUrl() {
        if (isset($_GET['url'])) {
            return $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
    }

}
