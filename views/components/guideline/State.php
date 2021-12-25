<?php

namespace app\views\components\guideline;

abstract class State
{

    /**
     * return the render string with matching layout for the state.
     * @param string $render_string
     * @return string
     */
    abstract function setLayout(string $render_string):string;
    abstract static function getInstance():State;

}
