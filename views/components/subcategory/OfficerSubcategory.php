<?php

namespace app\views\components\subcategory;

class OfficerSubcategory extends Subcategory
{


    protected function getLayout(): array
    {
        $start = "<table class='table table-bordered'>
                            <thead><tr>
                            <th> Guideline </th>
                            <th> valid from </th>
                            <th> expires on </th>
                            <th> last modified </th>
                            </tr></thead>";
        $end = "</table>";
        return [
            'start' => $start,
            'end' => $end,
        ];
    }
}