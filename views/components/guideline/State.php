<?php

namespace app\views\components\guideline;

abstract class State
{
    public static string $identifier;  // Need to be initialized in each class inherited
    /**
     * return the render string with matching layout for the state.
     * used <tr> layouts
     * Created  - default
     * Active   - secondary
     * Drafted  - info
     * Expired  - warning
     * Deleted  - dark
     *
     * @param string $render_string
     * @return string
     */
    abstract function setLayout(string $render_string):string;


    /**
     * return the respective state object.
     * State objects use singleton pattern for creating objects
     * @return State
     */
    abstract static function getInstance():State;

    abstract function makeDraft();
    abstract function delete();
    abstract function activate();
    abstract function expire();

}
