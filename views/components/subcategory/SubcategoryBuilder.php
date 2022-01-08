<?php

namespace app\views\components\subcategory;

use app\models\Guideline;
use app\views\components\guideline\OfficerGuideline;
use app\views\components\guideline\PublicGuideline;

class SubcategoryBuilder
{
    private Subcategory $subcategory;

    public static function buildOfficerVeiw(string $subcategoryId):OfficerSubcategory{
        $subcategory = new OfficerSubcategory(\app\models\SubCategory::findOne(['sub_category_id' => $subcategoryId]));
        foreach (Guideline::getAllWhere(['sub_category_id' => $subcategoryId]) as $guideline){
            $subcategory->guidelines[] = new OfficerGuideline($guideline);
        }
        return $subcategory;
    }

    public static function buildPublicVeiw(string $subcategoryId):PublicSubcategory{
        $subcategory = new PublicSubcategory(\app\models\SubCategory::findOne(['sub_category_id' => $subcategoryId]));
        //show only active guidelines
        foreach (Guideline::getAllWhere(['sub_category_id' => $subcategoryId, 'guid_status' => '1']) as $guideline){
            $subcategory->guidelines[] = new PublicGuideline($guideline);
        }
        return $subcategory;
    }

}