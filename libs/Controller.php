<?php

class Controller {

    function __construct() {
        $this->mainModel = new Model();
        $this->view = new View();
    }

    public function loadHeader($menu){
        $this->view->menu = $this->_menu = $menu;

        /** @var  def - admin settings table
         * @var  menuheader
         * @var  menupersons
         * @var  menufooter
         */
        $this->view->def = $this->_def = $this->mainModel->settingsList();
        $this->view->menuHeader = $this->mainModel->menuHeader();
        $this->view->menuFooter = $this->mainModel->menuFooter();
        $this->view->partnersList = $this->mainModel->partnersList();
//        print '<pre>';
//        print_r($this->view->menuFooter);
//        exit;
    }
    /**
     *
     * @param string $name Name of the model
     * @param string $path Location of the models
     */
    public function loadModel($name, $modelPath = 'models/') {
        $path = $modelPath . $name . '_model.php';
        //echo $path.'<br>';

        if (file_exists($path)) {
            require_once $modelPath . $name . '_model.php';

            $modelName = $name . '_Model';
            $this->model = new $modelName();
        }
    }
}