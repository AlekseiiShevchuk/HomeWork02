<?php

namespace lift;


class lift
{
    const MIN_FLOOR = 1;
    const MAX_FLOOR = 9;
    const MAX_PEOPLE = 4;
    const MIN_PEOPLE = 0;

    private $people;
    private $floor;

    /**
     * lift constructor.
     * @param $people
     * @param $floor
     */
    function __construct($people, $floor)
    {
        $this->people = $people;
        $this->floor = $floor;
        $this->showState();
        $this->liftManagement();
    }

    private function showState() {
        echo 'The lift is on the ' . $this->floor . ' floor and contains ' . $this->people . ' people'. PHP_EOL;
    }

    private function askHowManyPeopleNow(){
        echo 'Enter what number of people in the lift now:'. PHP_EOL;
        $currentPeople = intval(fgets(STDIN));
        return $currentPeople;
    }

    private function askWhatFloor(){
        echo 'Enter on what floor you want to go:'. PHP_EOL;
        $whatFloor = intval(fgets(STDIN));
        return $whatFloor;
    }

    private function checkPeople() {

        $currentPeople = $this->askHowManyPeopleNow();
        $this->people = $currentPeople;

        if ($currentPeople > 4 || $currentPeople < 0){

            echo 'The number of people in the lift MUST be from ' . self::MAX_PEOPLE . ' to ' . self::MAX_PEOPLE .'!'. PHP_EOL;
            $this->checkPeople();
        }

    }

    private function checkFloor() {

        $whatFloor = $this->askWhatFloor();
        $this->floor = $whatFloor;

        if ($whatFloor < self::MIN_FLOOR || $whatFloor > self::MAX_FLOOR){

            echo 'Enter floor number from ' . self::MIN_FLOOR . ' to ' . self::MAX_FLOOR .'!'. PHP_EOL;
            $this->checkFloor();
        }

    }


    private function liftManagement(){

        $this->checkPeople();
        $this->checkFloor();
        $this->showState();
        $this->liftManagement();

    }
}