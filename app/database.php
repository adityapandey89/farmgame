<?php

/*
  Created on : 12 Dec, 2018, 14 PM
  Author     : groot (Aditya Pandey)
  Description: Simple Database Class to have some basic db operations
 * used JSON file to save data
 */

class Database {

    public $data;
    public $death;

    public function __construct() {

        if (!file_exists("../runtime")) {
            echo "Please create a runtime Folder under your root dir, with write permission";
            die;
        }

        if (!file_exists('../runtime/results.json')) {
            $fp = fopen('../runtime/results.json', 'w');
            fwrite($fp, json_encode(''));
            fclose($fp);
        }
        if (!file_exists('../runtime/dead.json')) {
            $fp = fopen('../runtime/dead.json', 'w');
            fwrite($fp, json_encode(''));
            fclose($fp);
        }
    }

    public function addRecord() {

        $oldData = $this->getRecord();
        array_push($oldData, $this->data);
        $fp = fopen('../runtime/results.json', 'w');
        fwrite($fp, json_encode($oldData));
        fclose($fp);
    }

    public function getRecord() {

        $str = file_get_contents('../runtime/results.json');
        $json = json_decode($str, true); // decode the JSON into an associative array        
        return !empty($json) ? $json : [];
    }

    public function deleteAllRecord() {
        unlink('../runtime/results.json');
        unlink('../runtime/dead.json');
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

    public function addDeathRecord() {
        $data = $this->getDeathRecord();
        array_push($data, $this->death);
        $fp = fopen('../runtime/dead.json', 'w');
        fwrite($fp, json_encode($data));
        fclose($fp);
    }

    public function getDeathRecord() {
        $str = file_get_contents('../runtime/dead.json');
        $json = json_decode($str, true); // decode the JSON into an associative array        
        return !empty($json) ? $json : [];
    }

    /*
     * Checking if the game is over and player has won or lost
     * Criteria :- Alive FARMER, 1 Alive COW and 1 Alive Bunny
     */

    public function checkWin() {

        $data = $this->getDeathRecord();
        $data = array_map(function($d) {
            return $d[key($d)];
        }, $data);

        if ($data) {
            if (in_array("FARMER", $data)) {
                return FALSE;
            }
            if (in_array("COW_1", $data) && in_array("COW_2", $data)) {
                return FALSE;
            }
            if (in_array("BUNNY_1", $data) && in_array("BUNNY_2", $data) && in_array("BUNNY_4", $data) && in_array("BUNNY_4", $data)) {
                return FALSE;
            }
        }
        return true;
    }

}
