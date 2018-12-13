<?php

/*
  Created on : 12 Dec, 2018, 14 PM
  Author     : groot (Aditya Pandey)
  Description: Farm controller to handle FARMGAME request and respond to view
 */

class FarmController extends DefaultController {

    public function index() {

        $finalRecord = [];

        $farm = $this->model('Farm');

        $farm->db = new Database();
        $fedRecord = $farm->db->getRecord();
        $fedRecord = array_map(function($d) {
            return $d[key($d)];
        }, $fedRecord);

        $deathRecord = $farm->db->getDeathRecord();
        $deathRecord = array_map(function($d) {
            return $d[key($d)];
        }, $deathRecord);
        
        $farm->round = !(count($fedRecord)) ? 1 : count($fedRecord);
        $farm->checkFedStatus();

        if (!$farm->db->checkWin()) {
            $farm->gameStatus = Farm::LOST;
        }

        $finalRecord['record'] = $fedRecord;
        $finalRecord['dead_life'] = $deathRecord;
        $finalRecord['game_status'] = $farm->gameStatus;
        $this->view('farm/index', $finalRecord);
    }

    public function feed() {
        $farm = $this->model('Farm');
        $farm->db = new Database();
        $farm->randomFeed();
        if ($farm->gameStatus == Farm::PROGRESS) {
            echo json_encode([$farm->fedLife, count($farm->db->getRecord())]);
        } else {
            echo $farm->gameStatus;
        }
    }

    public function newGame() {
        $db = new Database();
        $db->deleteAllRecord();
    }

}
