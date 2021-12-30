<?php

namespace app\views\components\category;

use app\models\proxy\CategoryProxy;
use app\models\proxy\SubcategoryProxy;
use app\views\components\subcategory\OfficerSubcategory;

class CategoryBuilder
{

    /**
     * @param CategoryProxy $categoryProxy
     * @return Category
     */
    public static function buildOfficerCategory(CategoryProxy $categoryProxy):Category{
        $category = new OfficerCategory($categoryProxy);
        foreach (SubcategoryProxy::getAllWhere(['cat_id'=> $categoryProxy->getCatId()]) as $subcategory){
            $category->subcategories[] = new OfficerSubcategory($subcategory->getSubcategoryObject());
        }
        return $category;
    }

    /**
     * @param CategoryProxy $categoryProxy
     * @return Category
     */
    public static function buildPublicCategory(CategoryProxy $categoryProxy):Category{
        $category = new PublicCategory($categoryProxy);
        foreach (SubcategoryProxy::getAllWhere(['cat_id'=> $categoryProxy->getCatId()]) as $subcategory){
            $category->subcategories[] = new OfficerSubcategory($subcategory->getSubcategoryObject());
        }
        return $category;
    }



}
