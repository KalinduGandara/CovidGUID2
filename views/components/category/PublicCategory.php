<?php

namespace app\views\components\category;

class PublicCategory extends Category
{

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
}