<?php


namespace app\core;


class Request
{
    private string $request_uri;
    private string $path;
    private string $method;
    private array $body;

    public function __construct()
    {
        $this->request_uri = $_SERVER['REQUEST_URI'];
        $this->path = $this->fetchPath();
        $this->method = strtolower($_SERVER['REQUEST_METHOD']);
        $this->body = $this->fetchBody();
    }


    public function getRequestURI():string
    {
        return $this->request_uri;
    }

    public function getPath():string
    {
        return $this->path;
    }

    public function method():string
    {
        return $this->method;
    }

    public function getBody():array
    {
        return $this->body;
    }

    private function fetchPath():string{
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $position = strpos($path,'?');
        if ($position === false){
            return $path;
        }
        return substr($path,0,$position);
    }

    private function fetchBody():array{
        $body = [];
        if ($this->method()==='get'){
            foreach ($_GET as $key => $value) {
                $body[$key] = filter_input(INPUT_GET,$key,FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        if ($this->method()==='post'){
            foreach ($_POST as $key => $value) {
                $body[$key] = filter_input(INPUT_POST,$key,FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }

        return $body;
    }
}