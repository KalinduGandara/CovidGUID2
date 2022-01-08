<?php

namespace app\views\components\category;

use app\models\proxy\CategoryProxy;

class OfficerCategory extends Category
{

    public function __construct(CategoryProxy $category)
    {
        parent::__construct($category);
    }

    function render(): void
    {
        return;
    }

    function getRenderString(): string
    {
        return '';
    }

    public static function renderAllCategories(){
        $categories = \app\models\proxy\CategoryProxy::getAll();
        $categories = array_filter($categories, function (CategoryProxy $categoryProxy){return $categoryProxy->getCatStatus() === '0';});

        $render = '<table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Category name</th>
                                <th>Category description</th>
                            </tr>
                            </thead>
                            <tbody>';

        foreach ($categories as $category) {
            $cat_id = $category->getCatId();
            $cat_title = $category->getCatTitle();
            $category_description = $category->getCategoryDescription();
            $render.= "<tr>
                                <td>$cat_id</td>
                                <td>$cat_title</td>
                                <td>$category_description</td>
                                <td><a href=\"categories?edit_id=$cat_id\"><i class=\"ms-3 mt-2 fa fa-pencil\" data-bs-toggle=\"tooltip\" data-bs-placement=\"top\" title=\"Edit\"></i></a></td>
                                <td><a href=\"categories?delete_id=$cat_id\"><i class=\"ms-3 mt-2 fa fa-minus-circle\" data-bs-toggle=\"tooltip\" data-bs-placement=\"top\" title=\"Delete\"></i></a></td>
                                </tr>";
        }

        $render .= '</tbody>
                </table>';
        echo $render;
    }


}