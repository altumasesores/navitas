<?php
abstract class ControllerBase {
    
    protected $view;
	protected $Model;
    
    function __construct()
    {
        $this->view = new View();
    }
}
?>