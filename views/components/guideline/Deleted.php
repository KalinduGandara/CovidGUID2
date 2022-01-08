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

    function makeDraft(Guideline $guideline)
    {
        throw new IllegalStateException();
    }

    function delete(Guideline $guideline)
    {
        return;
    }

    function activate(Guideline $guideline)
    {
        throw new IllegalStateException();
    }

    function expire(Guideline $guideline)
    {
        throw new IllegalStateException();
    }

    /**
     * @return string
     */
    public static function getIdentifier(): string
    {
        return self::$identifier;
    }




}