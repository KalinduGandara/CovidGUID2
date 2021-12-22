<?php

namespace app\views\components\guideline;

class OfficerGuideline extends Guideline
{

    public function __construct(\app\models\Guideline $guideline)
    {
        parent::__construct($guideline);
    }

    function render(): void
    {
        // TODO: Implement render() method.
    }

    function getRenderString(): string
    {
        $render =
            '   <td>'. $this->guideline->getGuideline() .'</td>
                <td>'. $this->guideline->getActivateDate().'</td>
                <td>'.$this->guideline->getExpiryDate().'</td>
                <td>'.$this->guideline->getLastModifiedDate().'</td>
                <td><a href="/officer/guidelines?edit_id='.$this->guideline->getGuidId().'" class="btn btn-primary">Edit</a></td>
                <td><a href="/officer/guidelines?delete_id='.$this->guideline->getGuidId().'" class="btn btn-danger">Delete</a></td>            
            ';

        return
            $this->state->setLayout($render);
    }
}
