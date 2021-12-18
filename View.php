<?php
/**
 * @author      Amit Roy <amit@softflies.com>
 * @copyright   Copyright (c), 2021 Amit Roy
 * @license     MIT public license
 */
namespace Inculcate\View;
/**
 * Class View.
 */
class View
{   
	/**
     * @var string , resources path of the views
     * @return \Inculcate\View\View\resources
     */
    private $resources = "/resources/views/";
    /**
     * @var string , path of the views
     * @return \Inculcate\View\View\path
     */
    private $path;

    /**
     * @var string , path of the views
     * @return \Inculcate\View\View\render
     */
    private $render;

    /**
     * @var array | null,  
     * @return \Inculcate\View\View\data
     */
    private $data;

    /**
    * @param string , $path, the path of the view of the application
    * @param array | null, $data, the passing data of the view
    * @param bool | null, $render, the view to be rendered (true),
    */
    public function __construct( string $path=null, array $data=[], bool $render=false){

        $this->path   = $path;
        $this->data   = $data;
        $this->render = $render;
    }
    
    /**
    * @return \Inculcate\View\View\invokeView
    */
    public function invokeView(){
        
        $viewPath=base_path($this->resources.$this->path.".php");
        if (file_exists($viewPath)) {
            ob_start();
            extract($this->data);
            include $viewPath;
            ob_end_flush();
        }
        //view does not exist
        else{
            print("View does not exist: ".$this->path); exit;
        }
    }
    /**
     * @method @invokeRender
     * @return \Inculcate\View\View\invokeRender
     */
    public function invokeRender()
    {   
        $viewPath=base_path($this->resources.$this->path.".php");
        if (file_exists($viewPath)) {
            $outpoot=(function () use($viewPath) : string {
                    ob_start();
                    extract($this->data);
                    include $viewPath;
                    return ob_get_clean() ?? "";
            })();
            return $outpoot;
        }
        //view does not exist
        else{
            print("View does not exist: ".$this->path); exit;
        }
    }

    /**
    * @param null
    * @method is_render
    * @return \Inculcate\View\View\is_render
    */
    public function is_render(){
        return $this->render;
    }

    /**
    * @param null
    * @method render
    * @return \Inculcate\View\View\render
    */
    public function render(){
        $this->render = true;
        return $this->invokeRender();
    }

}