<?php

class Farm {

    public $farm_life = ['FARMER', 'COW_1', 'COW_2', 'BUNNY_1', 'BUNNY_2', 'BUNNY_3', 'BUNNY_4'];
    public $fedLife;
    public $gameStatus;
    protected $db;

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

        $this->gameStatus = self::PROGRESS;
        $tempData = [];
        $newData = [];
        $finalData = [];
        $this->db = new Database();
        $totalRound = !($this->db->getTotalRound()) ? 0 : count($this->db->getTotalRound());
        $totalRound++;
        $this->fedLife = array_rand($this->farm_life);

        $this->checkFedStatus($totalRound);

        $newData[$totalRound] = $this->farm_life[$this->fedLife];
        $tempData = $this->db->getRecord();
        array_push($tempData, $newData);
        $this->db->data = $tempData;
        $this->db->addRecord();

        if ($totalRound == self::TOTALFEED)
            if ($this->checkWin()) {
                $this->gameStatus = self::WON;
            } else {
                $this->gameStatus = self::LOST;
            }
    }

    public function checkFedStatus($round) {
        foreach ($this->farm_life as $life) {
            $this->checkLiveStatus($life);
        }
    }

    /*
     * Killing Farm Life if not fed at respective interval
     * FARMER every 15 Interval, COWs every 10 Interval and BUNNIES every 8 Interval
     */

    public function checkLiveStatus($life) {

        $record = $this->db->getRecord();
        $record = array_map(function($d) {
            return $d[key($d)];
        }, $record);

        if (!in_array($life, $record)) {
            if (preg_match("/FARMER/", $life) && count($record) > 15) {
                unset($this->farm_life[0]);
                $this->gameStatus = self::LOST;
                return;
            }
            if (preg_match("/COW_1/", $life) && count($record) > 10) {
                unset($this->farm_life[1]);
                return;
            }
            if (preg_match("/COW_2/", $life) && count($record) > 10) {
                unset($this->farm_life[2]);
                return;
            }
            if (preg_match("/BUNNY_1/", $life) && count($record) > 8) {
                unset($this->farm_life[3]);
                return;
            }
            if (preg_match("/BUNNY_2/", $life) && count($record) > 8) {
                unset($this->farm_life[4]);
                return;
            }
            if (preg_match("/BUNNY_3/", $life) && count($record) > 8) {
                unset($this->farm_life[5]);
                return;
            }
            if (preg_match("/BUNNY_4/", $life) && count($record) > 8) {
                unset($this->farm_life[6]);
                return;
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
        if (!in_array(["COW_1", "COW_2"], $this->farm_life)) {
            return FALSE;
        }
        if (!in_array(["BUNNY_1", "BUNNY_2", "BUNNY_3", "BUNNY_4"], $this->farm_life)) {
            return FALSE;
        }
        return true;
    }

}
