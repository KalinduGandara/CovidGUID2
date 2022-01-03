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
        $date=date_create($this->guideline->getLastModifiedDate());
        $render =
            '   <td>'. $this->guideline->getGuideline() .'</td>
                <td>'. $this->guideline->getActivateDate().'</td>
                <td>'.$this->guideline->getExpiryDate().'</td>
                <td>'.date_format($date,"Y/m/d H:i:s").'</td>
                <td><a href="/officer/guidelines?edit_id='.$this->guideline->getGuidId().'"><i class="ms-3 mt-2 fa fa-pencil" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"></i></a></td>
                <td><a href="/officer/guidelines?delete_id='.$this->guideline->getGuidId().'"><i class="ms-3 mt-2 fa fa-minus-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete"></i></a></td>
                <td><a href="/officer/guidelines?draft_id='.$this->guideline->getGuidId().'"><i class="ms-3 mt-2 fa fa-print" data-bs-toggle="tooltip" data-bs-placement="top" title="Draft/Undraft"></i></a></td>           
            ';

        return
            $this->state->setLayout($render);
    }
}
