<?php

namespace app\views\components\subcategory;

use app\views\components\IComponent;

abstract class Subcategory implements IComponent
{
    private \app\models\SubCategory $subCategory;
    public array $guidelines;

    /**
     * @param \app\models\SubCategory $subCategory
     */
    public function __construct(\app\models\SubCategory $subCategory)
    {
        $this->subCategory = $subCategory;
        $this->guidelines = [];
    }


    /**
     * get the an array with two properties
     * start -> string to start the layout
     * end -> to end the layout
     * @return array
     */
    abstract protected function getLayout():array;

    function render():void{
        $layout = $this->getLayout();
        echo $layout['start'];
        foreach ($this->guidelines as $guideline){
            $guideline->render();
        }

        echo $layout['end'];
    }

    function getRenderString(): string
    {
        // TODO: Implement getRenderString() method.
        return '';
    }


}