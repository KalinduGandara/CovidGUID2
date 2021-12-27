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
        echo $this->getRenderString();
    }

    function getRenderString(): string
    {
        $layout = $this->getLayout();
        $render = $layout['start'];
        foreach ($this->guidelines as $guideline){
            $render .= $guideline->getRenderString();
        }

        $render .= $layout['end'];

        return $render;
    }

    public function filterByStatus(string $state):void{
        $this->guidelines = array_filter($this->guidelines,function ($guid) use($state){
            return $guid->getState()->getIdentifier() === $state;
        });
    }


}