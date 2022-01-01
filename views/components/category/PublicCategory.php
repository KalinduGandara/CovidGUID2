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
        return '<a style="margin-top: -40px" class="btn btn-warning float-end" href="unsubscribe?cat_id='.$this->category->getCatId().'">UnSubscribe</a>';
        return '<a style="margin-top: -40px" class="btn btn-danger float-end" href="subscribe?cat_id='.$this->category->getCatId().'">Subscribe</a>';

    }

    function getRenderString(): string
    {
        return
            '<div class="card mb-2">
                <div class="card-header">                
                        <a href="?cat_id='.$this->category->getCatId().'" >
                            <h3 class="card-title">'.$this->category->getCatTitle().'</h3>
                        </a>     
                          '.self::renderSubscribeButton().'
                </div>
                <div class="card-body">'.
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