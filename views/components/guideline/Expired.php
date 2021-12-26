<?php

namespace app\views\components\guideline;

class Expired extends State
{
    public static string $identifier = '3'; //to identify the state

    private static Expired $instance;
    private function  __construct()
    {
    }

    function setLayout(string $render_string): string
    {
        return '<tr class="table-warning">'.$render_string.'</tr>';
    }

    static function getInstance(): State
    {
        if( ! isset(self::$instance)){
            self::$instance = new Expired();
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
