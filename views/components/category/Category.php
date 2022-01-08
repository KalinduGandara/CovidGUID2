<?php

namespace app\views\components\category;

use app\models\proxy\CategoryProxy;
use app\views\components\subcategory\Subcategory;

abstract class Category implements \app\views\components\IComponent
{
    public array $subcategories;
    protected CategoryProxy $category;
    public function __construct(CategoryProxy $category)
    {
        $this->category = $category;
        $this->subcategories = [];
    }
}