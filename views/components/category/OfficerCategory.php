<?php

namespace app\views\components\category;

class OfficerCategory extends Category
{
    private static array $categories = [];

    private function __construct(\app\models\Category $category)
    {
        parent::__construct($category);
    }

    function render(): void
    {
        // TODO: Implement render() method.
    }

    function getRenderString(): string
    {
        // TODO: Implement getRenderString() method.
        return '';
    }

    public static function getInstance(\app\models\Category $category):OfficerCategory{
        if (! isset($categories[$category->getCatId()] )){
            $categories[$category->getCatId()] = new OfficerCategory($category);
        }
        return $categories[$category->getCatId()];
    }
}