<?php


namespace app\core\middlewares;


use app\core\App;

class VerifyMiddleware extends BaseMiddleware
{
    public array $actions;

    /**
     * VerifyMiddleware constructor.
     * @param array $actions
     */
    public function __construct(array $actions = [])
    {
        $this->actions = $actions;
    }


    public function execute()
    {
        if (!in_array(App::$app->controller->action,$this->actions))
            App::$app->session->unset_key('fail');
    }
}