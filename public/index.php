<?php

/*
  Created on : 12 Dec, 2018, 14 PM
  Author     : groot (Aditya Pandey)
  Description: Bootstrap File from public directory
 */

ini_set('display_errors', 1);     # don't show any errors... to check error replace 0 with 1
error_reporting(E_ALL);                # don't show any errors... to check error replace "" with E_ALL or other warnings

require_once '../app/init.php';
$_SERVER['REQUEST_URI'] = "/farmgame/public"; // Setting Request URI to avoid broken calls
$app = new App;

