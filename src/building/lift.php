<?php

namespace building;


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
        echo '< < < The lift is on the ' . $this->floor . ' floor and contains ' . $this->people . ' people > > >'. PHP_EOL . PHP_EOL;
    }

    private function askHowManyPeopleGoOut(){
        echo 'How many people are going out from the lift now?:'. PHP_EOL;
        $goOutPeople = intval(fgets(STDIN));
        return $goOutPeople;
    }

    private function checkHowManyPeopleGoOut(){

        $goOutPeople = $this->askHowManyPeopleGoOut();

        if ($goOutPeople > $this->people){
            echo 'ERROR: You can not get out more people then the lift contains!'. PHP_EOL;
            $this->checkHowManyPeopleGoOut();
        }else{
            $this->people -= $goOutPeople;
        }
    }

    private function askHowManyPeopleGoIn(){
        echo 'There are ' . $this->people . ' people in the lift now' . PHP_EOL . PHP_EOL;
        echo 'How many people are going into the lift now?' . PHP_EOL;
        $goInPeople = intval(fgets(STDIN));
        return $goInPeople;
    }


    private function askWhatFloor(){
        echo 'Enter on what floor you want to go:' . PHP_EOL;
        $whatFloor = intval(fgets(STDIN));
        return $whatFloor;
    }


    private function checkHowManyPeopleInLiftNow() {

        $currentPeople = $this->askHowManyPeopleGoIn() + $this->people;

        if ($currentPeople > 4 || $currentPeople < 0){

            echo 'The number of people in the lift MUST be from ' . self::MIN_PEOPLE . ' to ' . self::MAX_PEOPLE .'!'. PHP_EOL;
            $this->checkHowManyPeopleInLiftNow();
        }else{
            $this->people = $currentPeople;
        }

    }

    private function checkFloor() {

        $whatFloor = $this->askWhatFloor();

        if ($whatFloor < self::MIN_FLOOR || $whatFloor > self::MAX_FLOOR){

            echo 'Enter floor number from ' . self::MIN_FLOOR . ' to ' . self::MAX_FLOOR .'!'. PHP_EOL;
            $this->checkFloor();
        }else{
            $this->floor = $whatFloor;
        }

    }

    private function liftManagement(){

        $this->checkHowManyPeopleGoOut();
        $this->checkHowManyPeopleInLiftNow();
        $this->checkFloor();
        $this->showState();
        $this->liftManagement();

    }
}