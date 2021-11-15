<?php


namespace app\core\middlewares;


use app\core\App;
use app\core\exception\ForbiddenException;

class AdminMiddleware extends BaseMiddleware
{

    public function execute()
    {
        if (!App::isAdmin()){
            if (empty($this->actions) || in_array(App::$app->controller->action,$this->actions)){
                throw new ForbiddenException();
            }

        }
    }
}