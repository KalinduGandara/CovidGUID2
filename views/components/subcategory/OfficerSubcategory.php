<?php

namespace app\views\components\subcategory;

class OfficerSubcategory extends Subcategory
{


    protected function getLayout(): array
    {
        $start = "<table class='table table-bordered table-hover'>
                            <thead><tr>
                            <th> Guideline </th>
                            <th> valid from </th>
                            <th> expires on </th>
                            <th> last modified </th>
                            <th></th>
                            <th></th>
                            <th></th>
                            </tr></thead>";
        $end = "</table>";
        return [
            'start' => $start,
            'end' => $end,
        ];
    }
}