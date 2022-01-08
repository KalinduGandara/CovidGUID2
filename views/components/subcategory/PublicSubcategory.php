<?php

namespace app\views\components\subcategory;

class PublicSubcategory extends Subcategory
{
    protected function getLayout(): array
    {
        $start = "<table class='table table-bordered'>
                            <thead><tr>
                            <th> Guideline </th>
                            <th> valid from </th>
                            <th> expires on </th>                            
                            </tr></thead>";
        $end = "</table>";
        return [
            'start' => $start,
            'end' => $end,
        ];
    }
}