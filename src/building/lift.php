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

    private function stdOut($string){

        return fwrite(STDOUT,$string);
    }

    private function showState() {
        $string = '< < < The lift is on the ' . $this->floor . ' floor and contains ' . $this->people . ' people > > >'. PHP_EOL . PHP_EOL;
        $this->stdOut($string);
    }

    private function askHowManyPeopleGoOut(){
        $string = 'How many people are going out from the lift now?:'. PHP_EOL;
        $this->stdOut($string);
        $goOutPeople = intval(fgets(STDIN));
        return $goOutPeople;
    }

    private function checkHowManyPeopleGoOut(){

        $goOutPeople = $this->askHowManyPeopleGoOut();

        if ($goOutPeople > $this->people){
            $string = 'ERROR: You can not get out more people then the lift contains!'. PHP_EOL;
            $this->stdOut($string);
            $this->checkHowManyPeopleGoOut();
        }else{
            $this->people -= $goOutPeople;
        }
    }

    private function askHowManyPeopleGoIn(){
        $string = 'There are ' . $this->people . ' people in the lift now' . PHP_EOL . PHP_EOL . 'How many people are going into the lift now? (MAX amount 4 people)' . PHP_EOL;
        $this->stdOut($string);
        $goInPeople = intval(fgets(STDIN));
        return $goInPeople;
    }


    private function checkHowManyPeopleInLiftNow() {

        $currentPeople = $this->askHowManyPeopleGoIn() + $this->people;

        if ($currentPeople > self::MAX_PEOPLE || $currentPeople < self::MIN_PEOPLE){

            $string = 'Lift blocked!' . PHP_EOL .  'The number of people in the lift MUST be from ' . self::MIN_PEOPLE . ' to ' . self::MAX_PEOPLE .'!'. PHP_EOL .
            'Free lift completely and press ENTER';
            $this->stdOut($string);
            $waitForEnter = intval(fgets(STDIN));
            $this->people = 0;
            $this->checkHowManyPeopleInLiftNow();
        }else{
            $this->people = $currentPeople;
        }

    }

    private function askWhatFloor(){
        $string = 'Enter on what floor you want to go:' . PHP_EOL;
        $this->stdOut($string);
        $whatFloor = intval(fgets(STDIN));
        return $whatFloor;
    }


    private function checkFloor() {

        $whatFloor = $this->askWhatFloor();

        if ($whatFloor < self::MIN_FLOOR || $whatFloor > self::MAX_FLOOR){

            $string = 'Enter floor number from ' . self::MIN_FLOOR . ' to ' . self::MAX_FLOOR .'!'. PHP_EOL;
            $this->stdOut($string);
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