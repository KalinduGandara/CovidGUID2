<?php

namespace app\views\components\guideline;

use app\core\exception\IllegalStateException;

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


    function makeDraft(Guideline $guideline)
    {
        throw new IllegalStateException();
    }

    function delete(Guideline $guideline)
    {
        $guideline->setState(Deleted::getInstance());
    }

    function activate(Guideline $guideline)
    {
        $today = new \DateTime();
        if ($guideline->getActivateDate() < $today && $today < $guideline->getExpiryDate()){
            $guideline->setState(Active::getInstance());
        }
        else throw new IllegalStateException();
    }

    function expire(Guideline $guideline)
    {
        $today = new \DateTime();
        if ( $today > $guideline->getExpiryDate()){
            $guideline->setState(Expired::getInstance());
        }
        else throw new IllegalStateException();
    }

    /**
     * @return string
     */
    public static function getIdentifier(): string
    {
        return self::$identifier;
    }


}
