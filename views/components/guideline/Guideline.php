<?php

namespace app\views\components\guideline;

use app\views\components\IComponent;
use Couchbase\InvalidStateException;

abstract class Guideline implements IComponent
{
    private const ACTIVE = '0';
    private const DRAFTED = '1';
    private const EXPIRED = '2';

    protected State $state;
    protected \app\models\Guideline $guideline;

    /**
     * @param State $state
     */
    public function __construct(\app\models\Guideline $guideline)
    {
        $this->guideline = $guideline;
        self::setState($guideline);
    }

    private function setState(\app\models\Guideline $guideline){
        switch ($guideline->guid_status){
            case self::ACTIVE:
                $this->state = Active::getInstance();
                break;
            case self::DRAFTED:
                $this->state = Drafted::getInstance();
                break;
            case self::EXPIRED:
                $this->state = Expired::getInstance();
                break;
            default:
                throw new InvalidStateException("not a valid state for guideline");

        }
    }


}
