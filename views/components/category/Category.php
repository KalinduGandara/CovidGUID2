<?php

namespace app\views\components\category;

abstract class Category implements \app\views\components\IComponent
{
    protected \app\models\Category $category;
    protected function __construct(\app\models\Category $category)
    {
        $this->category = $category;
    }
}