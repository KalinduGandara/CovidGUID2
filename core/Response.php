<?php


namespace app\core;


class Response
{

    public function setStatusCode( $code)
    {
        http_response_code($code);
    }

    public function redirect(string $url)
    {
        header('Location: '.$url);
    }

    public function temporaryRedirect(string $url)
    {
        header('HTTP/1.1 307 Temporary Redirect');
        header('Location: '.$url);
    }
}