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
        $record = $farm->db->getRecord();
        $record = array_map(function($d) {
            return $d[key($d)];
        }, $record);

        $tempLife = [];
        $farm->round = count($record);
        foreach ($farm->farm_life as $life) {
            $tempLife[] = !($farm->checkLiveStatus($life)) ? $life : "";
        }
        $finalRecord['record'] = $record;
        $finalRecord['life'] = array_filter($tempLife);
        $finalRecord['game_status'] = $farm->gameStatus;
        $this->view('farm/index', $finalRecord);
    }

    public function feed() {
        $farm = $this->model('Farm');
        $db = new Database();
        $farm->randomFeed();
        if ($farm->gameStatus == Farm::PROGRESS) {
            echo json_encode([$farm->fedLife, count($db->getRecord())]);
        } else {
            echo $farm->gameStatus;
        }
    }

    public function newGame() {
        $db = new Database();
        $db->deleteAllRecord();
    }

}
