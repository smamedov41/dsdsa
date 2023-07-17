<?php

class Error404 extends Controller {

    function __construct() {
        parent::__construct();
        parent::loadHeader('error');
    }
    
    function index() {
        $this->view->render('header');
        $this->view->render($this->_menu.'/index');
        $this->view->render('footer');
    }

}