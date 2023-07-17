<?php

class Certificates extends Controller {
    function __construct() {
        parent::__construct();
        parent::loadHeader('certificates');
    }

    function index() {
        // page item
        $pages = $this->mainModel->viewPageBySlug($this->_menu);
        if(isset($pages->mysqlError)){
            Session::set('note_error', $pages->mysqlError);
            $pages = [];
        }
        $this->view->pages = $pages;

        // certificates list
        $listItems = $this->model->listItems();
        if(isset($listItems->mysqlError)){
            Session::set('note_error', $listItems->mysqlError);
            $listItems = [];
        }
        $this->view->listItems = $listItems;
//        print '<pre>';
//        print_r($listItems);
//        exit;

        // js css libs
        $this->view->js = [
            'assets/js/plugins/lg-hash.js'

        ];
        $this->view->render('header');
        $this->view->render($this->_menu.'/index');
        $this->view->render('footer');
    }
}