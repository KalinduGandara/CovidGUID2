<?php

namespace app\views\components\subcategory;

use app\views\components\IComponent;

abstract class Subcategory implements IComponent
{
    private \app\models\SubCategory $subCategory;
    public array $guidelines;
    private bool $include_heading;

    /**
     * @param \app\models\SubCategory $subCategory
     */
    public function __construct(\app\models\SubCategory $subCategory)
    {
        $this->subCategory = $subCategory;
        $this->guidelines = [];
        $this->include_heading = false;
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

        if ($this->include_heading){
            $render = '<h4>'.$this->subCategory->getSubCategoryName().'</h4>'.$render;
        }
        if(empty($this->guidelines))
            return '<div class="container"><h4>'.$this->subCategory->getSubCategoryName().'</h4>
                    <br/>
                    <p> --- No Guidelines Found --- </p>
                    <br/><br/>
                    </div>';
        return $render;
    }

    public function filterByStatus(string $state):void{
        $this->guidelines = array_filter($this->guidelines,function ($guid) use($state){
            return $guid->getState()->getIdentifier() === $state;
        });
    }

    public function filterOutDeleted(){
        $this->guidelines = array_filter($this->guidelines,function ($guid){
            return $guid->getState()->getIdentifier() != '4';
        });
    }

    public function includeTitle():Subcategory{
        $this->include_heading = true;
        return $this;
    }


}