<?php

namespace app\views\components\guideline;

class Drafted extends State
{
    private static Drafted $instance;
    private function  __construct()
    {
    }

    function setLayout(string $render_string): string
    {
        return '<tr class="table-secondary">'.$render_string.'</tr>';
    }

    static function getInstance(): State
    {
        if( self::$instance === null){
            self::$instance = new Drafted();
        }
        return self::$instance;
    }
}
