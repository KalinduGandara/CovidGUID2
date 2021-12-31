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

}