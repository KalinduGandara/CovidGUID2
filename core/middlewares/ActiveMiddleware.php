<?php


namespace app\core\middlewares;


use app\core\App;
use app\core\exception\InActiveException;

class ActiveMiddleware extends BaseMiddleware
{
    public array $actions;

    /**
     * ActiveMiddleware constructor.
     * @param array $actions
     */
    public function __construct(array $actions = [])
    {
        $this->actions = $actions;
    }

    public function execute()
    {
        if (!App::isActive()){
            if (empty($this->actions) || in_array(App::$app->controller->action,$this->actions)){
                throw new InActiveException();
            }

        }
    }
}