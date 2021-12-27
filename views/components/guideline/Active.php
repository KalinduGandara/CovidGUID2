<?php

namespace app\views\components\guideline;

use app\core\exception\IllegalStateException;

class Active extends State
{
    public static string $identifier = '1'; //to identify the state

    private static Active $instance;
    private function  __construct()
    {
    }

    function setLayout(string $render_string): string
    {
        return '<tr class="table-secondary">'.$render_string.'</tr>';
    }

    static function getInstance(): State
    {
        if( !isset(self::$instance)){
            self::$instance = new Active();
        }
        return self::$instance;
    }

    function makeDraft(Guideline $guideline)
    {
        $guideline->setState(Drafted::getInstance());
    }

    function delete(Guideline $guideline)
    {
        $guideline->setState(Deleted::getInstance());
    }

    /**
     * @throws IllegalStateException
     */
    function activate(Guideline $guideline)
    {
        throw new IllegalStateException();
    }

    function expire(Guideline $guideline)
    {

        $today = new \DateTime();
        if ( $today > $guideline->getExpiryDate()){
            $guideline->setState(Expired::getInstance());
        }
        else throw new IllegalStateException();
    }

    public static function getIdentifier(): string
    {
        return self::$identifier;
    }
}
