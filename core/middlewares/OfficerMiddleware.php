<?php

namespace app\core\middlewares;

use app\core\App;
use app\core\exception\ForbiddenException;

class OfficerMiddleware extends BaseMiddleware
{

    public function execute()
    {
        if (!App::isOfficer()){
            if (empty($this->actions) || in_array(App::$app->controller->action,$this->actions)){
                throw new ForbiddenException();
            }

        }
    }
}
