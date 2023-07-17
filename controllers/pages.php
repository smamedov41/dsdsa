<?php

class Pages extends Controller {
    function __construct() {
        parent::__construct();
        parent::loadHeader('pages');
    }

    function index() {
        header('Location:' .URL.MF::$_lang);
        exit;
    }

    function view($slug = '') {
        $slug = (isset($slug) && !empty($slug)) ? Func::filter_string($slug) : '';
        if(!$slug){
            header('Location: ' . URL . MF::$_lang . '/error');
            exit;
        }

        // page item
        $pages = $this->mainModel->viewPageBySlug($slug);
        if(isset($pages->mysqlError)){
            Session::set('note_error', $pages->mysqlError);
            $pages = [];
        }
        $this->view->pages = $pages;
//        print '<pre>';
//        print_r($pages);
//        exit;

        // js css libs
        $this->view->css = [

        ];
        $this->view->render('header');
        $this->view->render($this->_menu.'/view');
        $this->view->render('footer');
    }
}