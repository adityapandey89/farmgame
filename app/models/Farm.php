<?php

/*
  Created on : 12 Dec, 2018, 14 PM
  Author     : groot (Aditya Pandey)
  Description: Farm model file to manage data level operations
 */

class Farm {

    public $farm_life = [
        'FARMER',
        'COW_1',
        'COW_2',
        'BUNNY_1',
        'BUNNY_2',
        'BUNNY_3',
        'BUNNY_4'
    ];
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

    public function randomFeed() {

        $this->gameStatus = self::PROGRESS;
        $newData = [];
        $rnd = $this->db->getTotalRound();
        $deadLife = $this->db->getDeathRecord();
        $deadLife = array_map(function($d) {
            return $d[key($d)];
        }, $deadLife);

        $this->farm_life = array_diff($this->farm_life, $deadLife);
        $this->round = !($rnd) ? 1 : count($rnd) + 1;
        $this->checkFedStatus();

        if (!$this->db->checkWin()) {
            $this->gameStatus = self::LOST;
            return false;
        }

        if ((int) $this->round == self::TOTALFEED) {
            $this->gameStatus = self::WON;
            return;
        }

        $deadLife = $this->db->getDeathRecord();
        $deadLife = array_map(function($d) {
            return $d[key($d)];
        }, $deadLife);

        $this->farm_life = array_diff($this->farm_life, $deadLife);
        $this->fedLife = array_rand($this->farm_life);
        $newData[$this->round] = $this->farm_life[$this->fedLife];
        $this->db->data = $newData;
        $this->db->addRecord();
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

        if (!$this->db->checkWin()) {
            $this->gameStatus = self::LOST;
            return true;
        }
        $this->gameStatus = self::PROGRESS;
        if ($this->round >= (int) self::TOTALFEED) {
            $this->gameStatus = self::WON;
            return true;
        }

        if (preg_match("/FARMER/", $life)) {
            if ($this->checkIfDead($life, self::FARMERFEEDTIME))
                $this->gameStatus = self::LOST;
        }
        if (preg_match("/COW_(\d+)/", $life)) {
            $this->checkIfDead($life, self::COWFEEDTIME);
        }
        if (preg_match("/BUNNY_(\d+)/", $life)) {
            $this->checkIfDead($life, self::BUNNIESFEEDTIME);
        }
    }

    public function checkIfDead($life, $time) {

        $deathFlag = false;
        if ($this->round > 1) {

            $record = $this->db->getRecord();
            $record = array_map(function($d) {
                return $d[key($d)];
            }, $record);
            krsort($record);

            if (!in_array($life, $record)) {
                $key = 1;
                if (preg_match("/FARMER/", $life) && (self::FARMERFEEDTIME == ($this->round - $key))) {
                    $deathFlag = true;
                }
                if (preg_match("/COW/", $life) && (self::COWFEEDTIME == ($this->round - $key))) {
                    $deathFlag = true;
                }
                if (preg_match("/BUNNY/", $life) && (self::BUNNIESFEEDTIME == ($this->round - $key))) {
                    $deathFlag = true;
                }
            } else {
                $key = array_search($life, $record) + 1;
                if (preg_match("/FARMER/", $life) && (self::FARMERFEEDTIME == ($this->round - $key))) {
                    $deathFlag = true;
                }
                if (preg_match("/COW/", $life) && (self::COWFEEDTIME == ($this->round - $key))) {
                    $deathFlag = true;
                }
                if (preg_match("/BUNNY/", $life) && (self::BUNNIESFEEDTIME == ($this->round - $key))) {
                    $deathFlag = true;
                }
            }
            if ($deathFlag) {
                $newData[$this->round] = $life;
                $this->db->death = $newData;
                $this->db->addDeathRecord();
                return true;
            }
        }
        return FALSE;
    }

}
