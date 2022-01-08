<?php

namespace app\views\components\guideline;


class PublicGuideline extends Guideline
{
    public function __construct(\app\models\Guideline $guideline)
    {
        parent::__construct($guideline);
    }

    function getRenderString(): string
    {
        $render =
            '   <td>'. $this->guideline->getGuideline() .'</td>
                <td>'. $this->guideline->getActivateDate().'</td>
                <td>'.$this->guideline->getExpiryDate().'</td>
            ';

        return
            $this->state->setLayout($render);
    }
}
