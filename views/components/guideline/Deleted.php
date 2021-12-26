<?php

namespace app\views\components\guideline;

use app\core\exception\IllegalStateException;

class Deleted extends State
{
    public static string $identifier = '4'; //to identify the state

    private static Deleted $instance;

    private function __construct()
    {
    }


    function setLayout(string $render_string): string
    {
        return '<tr class="table-dark">'.$render_string.'</tr>';
    }

    static function getInstance(): State
    {
        if( !isset(self::$instance)){
            self::$instance = new Deleted();
        }
        return self::$instance;
    }

    function makeDraft()
    {
        // TODO: Implement makeDraft() method.
    }

    function delete()
    {
        // TODO: Implement delete() method.
    }

    function activate()
    {
        // TODO: Implement activate() method.
    }

    function expire()
    {
        // TODO: Implement expire() method.
    }
}