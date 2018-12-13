<?php

/*
  Created on : 12 Dec, 2018, 14 PM
  Author     : groot (Aditya Pandey)
  Description: Default Controller to access model and views from Child controllers
 */

class DefaultController {

    public function model($model) {
        require_once '../app/models/' . $model . '.php';
        return new $model();
    }

    public function view($view, $data = []) {
        require_once '../app/views/' . $view . '.php';
    }

}
