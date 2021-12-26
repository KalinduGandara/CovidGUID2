<?php

namespace app\views\components\guideline;

class Drafted extends State
{
    public static string $identifier = '2'; //to identify the state

    private static Drafted $instance;
    private function  __construct()
    {
    }

    function setLayout(string $render_string): string
    {
        return '<tr class="table-info">'.$render_string.'</tr>';
    }

    static function getInstance(): State
    {
        if( ! isset(self::$instance)){
            self::$instance = new Drafted();
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
