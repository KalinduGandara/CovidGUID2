<?php

namespace app\views\components\subcategory;

use app\models\proxy\CategoryProxy;
use app\models\proxy\SubcategoryProxy;

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
    public static function renderAllSubCategories(){
        $subcategories = \app\models\proxy\SubcategoryProxy::getAll();
        $subcategories = array_filter($subcategories, function (SubcategoryProxy $subcategoryProxy){return $subcategoryProxy->getSubCategoryStatus() === '0';});

        $render = '<table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>Subcategory name</th>
                                    <th>Category</th>

                                </tr>
                                </thead>
                                <tbody>';

        foreach ($subcategories as $subcategory) {
            $sub_category_id = $subcategory->getSubCategoryId();
            $sub_category_name = $subcategory->getSubCategoryName();
            $cat_id = $subcategory->getCatId();
            $category_title = CategoryProxy::getById($cat_id)->getCatTitle();

            $render .= "<tr>
                                            <td>$sub_category_name</td>
                                            <td>$category_title</td>
                            
                                            <td><a href='subcategories?delete_id=$sub_category_id'>Delete</a></td>
                                            <td><a href='subcategories?edit_id=$sub_category_id'>Edit</a></td>
                                            </tr>";
        }

        $render .= '</tbody>
                </table>';
        echo $render;
    }
}