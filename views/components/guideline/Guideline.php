<?php

namespace app\views\components\guideline;

class Guideline
{
    private State $state;

    /**
     * @param State $state
     */
    public function __construct(State $state)
    {
        $this->state = $state;
    }


}
