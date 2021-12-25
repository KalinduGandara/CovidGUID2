<?php

namespace app\views\components\guideline;

class Expired extends State
{
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
}
