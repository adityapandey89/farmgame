<?php

/*
  Created on : 12 Dec, 2018, 14 PM
  Author     : groot (Aditya Pandey)
  Description: Farm model file to manage data level operations
 */

class Farm {

    public $farm_life = ['FARMER', 'COW_1', 'COW_2', 'BUNNY_1', 'BUNNY_2', 'BUNNY_3', 'BUNNY_4'];
    public $fedLife;
    public $gameStatus;
    public $db;
    public $round;

    const TOTALFEED = 50;
    const FARMERFEEDTIME = 15;
    const COWFEEDTIME = 10;
    const BUNNIESFEEDTIME = 8;
    const WON = "WON";
    const LOST = "LOST";
    const PROGRESS = "In Progress";
    const ALIVE = "ALIVE";
    const DEAD = "DEAD";

    public function randomFeed() {

        $tempData = [];
        $newData = [];
        $finalData = [];
//        $this->db = new Database();
        $rnd = $this->db->getTotalRound();
        $this->round = !($rnd) ? 1 : count($rnd);
        $this->checkFedStatus();
        $this->fedLife = array_rand($this->farm_life);

        $newData[$this->round] = $this->farm_life[$this->fedLife];
        $tempData = $this->db->getRecord();
        array_push($tempData, $newData);
        $this->db->data = $tempData;
        $this->db->addRecord();

        if (!$this->checkWin()) {
            $this->gameStatus = self::LOST;
            return;
        }

        if ((int) $this->round == self::TOTALFEED) {
            $this->gameStatus = self::WON;
            return;
        }
    }

    public function checkFedStatus() {
        foreach ($this->farm_life as $life) {
            $this->checkLiveStatus($life);
        }
    }

    /*
     * Killing Farm Life if not fed at respective interval
     * FARMER every 15 Interval, COWs every 10 Interval and BUNNIES every 8 Interval
     */

    public function checkLiveStatus($life) {

        $this->gameStatus = self::PROGRESS;
        $record = $this->db->getRecord();
        $record = array_map(function($d) {
            return $d[key($d)];
        }, $record);

        if (!$this->checkWin()) {
            $this->gameStatus = self::LOST;
            return true;
        }
        if ($this->round >= (int) self::TOTALFEED) {
            $this->gameStatus = self::WON;
            return true;
        }

        if (!in_array($life, $record)) {
            if (preg_match("/FARMER/", $life) && $this->round >= (self::FARMERFEEDTIME * ceil($this->round / self::FARMERFEEDTIME))) {
                unset($this->farm_life[0]);
                $this->gameStatus = self::LOST;
                return false;
            }
            if (preg_match("/COW_1/", $life) && $this->round >= (self::COWFEEDTIME * ceil($this->round / self::COWFEEDTIME))) {
                unset($this->farm_life[1]);
                return false;
            }
            if (preg_match("/COW_2/", $life) && $this->round >= (self::COWFEEDTIME * ceil($this->round / self::COWFEEDTIME))) {
                unset($this->farm_life[2]);
                return false;
            }
            if (preg_match("/BUNNY_1/", $life) && $this->round >= (self::BUNNIESFEEDTIME * ceil($this->round / self::BUNNIESFEEDTIME))) {
                unset($this->farm_life[3]);
                return false;
            }
            if (preg_match("/BUNNY_2/", $life) && $this->round >= (self::BUNNIESFEEDTIME * ceil($this->round / self::BUNNIESFEEDTIME))) {
                unset($this->farm_life[4]);
                return false;
            }
            if (preg_match("/BUNNY_3/", $life) && $this->round >= (self::BUNNIESFEEDTIME * ceil($this->round / self::BUNNIESFEEDTIME))) {
                unset($this->farm_life[5]);
                return FALSE;
            }
            if (preg_match("/BUNNY_4/", $life) && $this->round >= (self::BUNNIESFEEDTIME * ceil($this->round / self::BUNNIESFEEDTIME))) {
                unset($this->farm_life[6]);
                return FALSE;
            }
        } else {
            return true;
        }
    }

    /*
     * Checking if the game is over and player has won or lost
     * Criteria :- Alive FARMER, 1 Alive COW and 1 Alive Bunny
     */

    public function checkWin() {

        if (!in_array("FARMER", $this->farm_life)) {
            return FALSE;
        }
        if (!in_array("COW_1", $this->farm_life) && !in_array("COW_2", $this->farm_life)) {
            return FALSE;
        }
        if (!in_array("BUNNY_1", $this->farm_life) && !in_array("BUNNY_2", $this->farm_life) && !in_array("BUNNY_4", $this->farm_life) && !in_array("BUNNY_4", $this->farm_life)) {
            return FALSE;
        }
        return true;
    }

}
