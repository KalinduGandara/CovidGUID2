<?php


namespace app\core;


class View
{
    public string $title = '';

    public function renderView($view,$params =[])
    {
        $viewContent = $this->renderOnlyView($view,$params);
        $layoutContent = $this->layoutContent($params);
        return str_replace('{{content}}', $viewContent, $layoutContent);

    }

    protected function layoutContent($params)
    {
        $layout = App::$app->controller->layout ?? 'main2';
        ob_start();
        foreach ($params as $key => $value) {
            $$key = $value;
        }
        include_once App::$ROOT_DIR . "/views/layouts/$layout.php";
        return ob_get_clean();
    }

    protected function renderOnlyView($view,$params)
    {
        ob_start();
        foreach ($params as $key => $value) {
            $$key = $value;
        }
        include_once App::$ROOT_DIR . "/views/$view.php";
        return ob_get_clean();
    }
    public function renderErrorPage($params)
    {
        ob_start();
        foreach ($params as $key => $value) {
            $$key = $value;
        }
        include_once App::$ROOT_DIR . "/views/_error.php";
        return ob_get_clean();
    }
}