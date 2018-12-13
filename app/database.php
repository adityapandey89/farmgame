<?php

class Database {

    public $data;

    public function __construct() {

        if (!file_exists("../runtime")) {
            echo "Please create a runtime Folder under your root dir";
            die;
        }

        if (!file_exists('../runtime/results.json')) {
            $fp = fopen('../runtime/results.json', 'w');
            fwrite($fp, json_encode(''));
            fclose($fp);
        }
    }

    public function addRecord() {
        $fp = fopen('../runtime/results.json', 'w');
        fwrite($fp, json_encode($this->data));
        fclose($fp);
    }

    public function getRecord() {
        $str = file_get_contents('../runtime/results.json');
        $json = json_decode($str, true); // decode the JSON into an associative array
        return !empty($json) ? $json : [];
    }

    public function deleteAllRecord() {
        unlink('../runtime/results.json');
    }

    public function updateRecord() {
        
    }

    public function getTotalRound() {
        $str = file_get_contents('../runtime/results.json');
        $json = json_decode($str, true); // decode the JSON into an associative array        
        if (!$json)
            return 0;

        return $json;
    }

}
