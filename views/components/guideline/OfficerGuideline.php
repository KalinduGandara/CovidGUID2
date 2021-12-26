<?php

namespace app\views\components\guideline;

class OfficerGuideline extends Guideline
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
                <td>'.$this->guideline->getLastModifiedDate().'</td>
                <td><a href="/officer/guidelines?edit_id='.$this->guideline->getGuidId().'"><i class="ms-3 mt-2 fa fa-pencil"></i></a></td>
                <td><a href="/officer/guidelines?delete_id='.$this->guideline->getGuidId().'"><i class="ms-3 mt-2 fa fa-minus-circle"></i></a></td>            
            ';

        return
            $this->state->setLayout($render);
    }
}
