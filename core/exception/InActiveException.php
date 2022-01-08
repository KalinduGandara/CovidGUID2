<?php


namespace app\core\exception;


class InActiveException extends \Exception
{
    protected $message = 'Your Account is Deactivated please contact administrator';
    protected $code = 403;
}