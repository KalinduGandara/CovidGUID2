<?php

namespace app\views\components\category;

use app\models\proxy\CategoryProxy;

class PublicCategory extends Category
{

    public function __construct(CategoryProxy $category)
    {
        parent::__construct($category);
    }

    function render(): void
    {
        echo self::getRenderString();
    }

    function getRenderString(): string
    {
        return
            '<div class="panel panel-default">
                <div class="panel-heading">                
                        <a href="?cat_id='.$this->category->getCatId().'" >
                            <h3 class="panel-title">'.$this->category->getCatTitle().'</h3>
                        </a>           
                </div>
                <div class="panel-body">'.
                    $this->category->getCategoryDescription()
                    .'
                </div>
            </div>';
    }
}