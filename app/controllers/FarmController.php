<?php

class FarmController extends DefaultController {

    public function index() {
        $db = new Database();
        $record = $db->getRecord();
        $record = array_map(function($d) {
            return $d[key($d)];
        }, $record);
        $this->view('farm/index', $record);
    }

    public function feed() {
        $farm = $this->model('Farm');
        $db = new Database();
        $farm->randomFeed();
        if ($farm->gameStatus == Farm::PROGRESS) {
            echo json_encode([$farm->fedLife, count($db->getRecord())]);
        } else if ($farm->gameStatus == Farm::WON) {
            
        } else if ($farm->gameStatus == Farm::WON) {
            
        }
    }

    public function newGame() {
        $db = new Database();
        $db->deleteAllRecord();
    }

}
