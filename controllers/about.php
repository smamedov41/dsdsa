<?php

class About extends Controller {
    function __construct() {
        parent::__construct();
        parent::loadHeader('about');
    }

    function index() {

        // page item
        $pages = $this->mainModel->viewPageBySlug($this->_menu);
        if(isset($pages->mysqlError)){
            Session::set('note_error', $pages->mysqlError);
            $pages = [];
        }
        $this->view->pages = $pages;

        // Staff
        $listStaff = $this->model->listStaff();
        if(isset($listStaff->mysqlError)){
            Session::set('note_error', $listStaff->mysqlError);
            $listStaff = [];
        }
        $this->view->listStaff = $listStaff;
//        print '<pre>';
//        print_r($pages);
//        exit;

        // js css libs
        $this->view->css = [

        ];
        $this->view->render('header');
        $this->view->render($this->_menu.'/index');
        $this->view->render('footer');
    }
}