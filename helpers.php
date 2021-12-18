<?php
use Inculcate\View\View;

if (! function_exists('view')) {
    /**
     * @param string , $path, the path of the view of the application
     * @param array | null, $data, the passing data of the view
     * @param bool | null, $render, the view to be rendered (true),
     * @return \Inculcate\View\View
     */
    function view(string $path = null, array $data = [], bool $render=false)
    {   
        //we have a great view of the application
        $view = new View($path,$data,$render);
        // we have handle the render requested 
        if ($render) {
            return $view->invokeRender();
        }
        return $view;

    }
}