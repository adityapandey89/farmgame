<?php
ini_set('display_errors', 1);     # don't show any errors...
error_reporting(E_ALL);

require_once '../app/init.php';
$_SERVER['REQUEST_URI'] = "/farmgame/public";
$app = new App;

