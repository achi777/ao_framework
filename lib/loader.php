<?php
/**
 * Created by PhpStorm.
 * User: archil
 * Date: 25.11.2015
 * Time: 10:31
 */

class loader extends start {
    private $controllerName;
    private $action;

    public function __construct() {
        parent::__construct();
        $this->action = $this->url->segment(1);
        if (empty($this->action)) {
            $this->controllerName = "Home";
        } else {
            $this->controllerName = $this->action;
        }

    }

    public function createController() {
        if (file_exists("Controllers/".$this->controllerName.".php")) {
            include("Controllers/".$this->controllerName.".php");
            /************************/
            $controller = new Controller();
            if (isset($this->controllerName)) $controller->{$this->controllerName}();
            /**********************/
        } else {
            require("Views/error.php");
        }

    }

}