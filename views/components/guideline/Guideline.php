<?php

namespace app\views\components\guideline;

use app\core\exception\IllegalStateException;
use app\views\components\IComponent;

abstract class Guideline implements IComponent
{
    private const CREATED = '0';
    private const ACTIVE = '1';
    private const DRAFTED = '2';
    private const EXPIRED = '3';
    private const DELETED = '4';

    protected State $state;
    protected \app\models\Guideline $guideline;

    /**
     * @param State $state
     */
    public function __construct(\app\models\Guideline $guideline)
    {
        $this->guideline = $guideline;
        self::initiateState($guideline);
    }

    private function initiateState(\app\models\Guideline $guideline){

        switch ($guideline->guid_status){
            case self::CREATED:
                $this->state = Created::getInstance();
                break;
            case self::ACTIVE:
                $this->state = Active::getInstance();
                break;
            case self::DRAFTED:
                $this->state = Drafted::getInstance();
                break;
            case self::EXPIRED:
                $this->state = Expired::getInstance();
                break;
            case self::DELETED:
                $this->state = Deleted::getInstance();
            default:
                throw new IllegalStateException();

        }
        $this->checkForStateChanges($guideline);
    }
    /*
     * Check for guideline status changes
     * Update the database status if necessary*/
    private function checkForStateChanges(\app\models\Guideline $guideline){
        //TODO: implement the logic
    }

    public function render(): void
    {
        echo $this->getRenderString();
    }

    public function setState(State $state):void{
        $this->guideline->update(['guid_id' => $this->guideline->getGuidId()], ['guid_status' => $state::$identifier]);
        $this->$state = $state;
    }

}
