<?php

namespace app\views\components\category;

use app\models\proxy\CategoryProxy;

class PublicCategory extends Category
{
    private bool $isSubscribed = false;

    public function __construct(CategoryProxy $category)
    {
        parent::__construct($category);
    }

    function render(): void
    {
        echo self::getRenderString();
    }
    function renderSubscribeButton():string
    {
//        return '<div href="asd" class="btn btn-danger pull-right">Subscribe</div>';
        if ($this->isSubscribed)
        return '<a style="margin-top: -26px" class="btn btn-warning pull-right" href="unsubscribe?cat_id='.$this->category->getCatId().'">UnSubscribe</a>';
        return '<a style="margin-top: -26px" class="btn btn-danger pull-right" href="subscribe?cat_id='.$this->category->getCatId().'">Subscribe</a>';

    }

    function getRenderString(): string
    {
        return
            '<div class="panel panel-default">
                <div class="panel-heading" style="padding: 20px">                
                        <a href="?cat_id='.$this->category->getCatId().'" >
                            <h3 class="panel-title">'.$this->category->getCatTitle().'</h3>
                        </a>     
                          '.self::renderSubscribeButton().'
                </div>
                <div class="panel-body">'.
                    $this->category->getCategoryDescription()
                    .'
                </div>
            </div>';
    }
    /**
     * @return bool
     */
    public function isSubscribed(): bool
    {
        return $this->isSubscribed;
    }

    /**
     * @param bool $isSubscribed
     */
    public function setIsSubscribed(bool $isSubscribed): void
    {
        $this->isSubscribed = $isSubscribed;
    }
}