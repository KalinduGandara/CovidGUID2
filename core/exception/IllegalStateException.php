<?php

namespace app\core\exception;

class IllegalStateException extends \Exception
{
    protected $message = 'Not allowed operation on current state';
    protected $code = 500;
}