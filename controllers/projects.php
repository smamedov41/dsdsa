<?php

class Projects extends Controller {
    function __construct() {
        parent::__construct();
        parent::loadHeader('projects');
    }

    function index($page = 1) {
        // page item
        $pages = $this->mainModel->viewPageBySlug($this->_menu);
        if(isset($pages->mysqlError)){
            Session::set('note_error', $pages->mysqlError);
            $pages = [];
        }
        $this->view->pages = $pages;

        /** Pagination */
        $page_number = $page = (isset($page) && !empty($page) && ($page>0)) ? Func::filter_int($page) : 1;
        $this->view->get_total_rows = $get_total_rows = $this->model->countItems();
        $item_per_page = LIMIT_PROJECTS; //item to display per page
        $page_url = URL.MF::$_lang.'/'.$this->_menu.'/index';
        $total_pages = ceil($get_total_rows/$item_per_page); // break records into pages
        $page_position = (($page_number-1) * $item_per_page); //get starting position to fetch the records
        $this->view->pagination = Func::paginate($item_per_page, $page_number, $get_total_rows, $total_pages, $page_url);

        // list
        $listItems = $this->model->listItems($page_position, $item_per_page);
        if(isset($listItems->mysqlError)){
            Session::set('note_error', $listItems->mysqlError);
            $listItems = [];
        }
        $this->view->listItems = $listItems;
//        print '<pre>';
//        print_r($listItems);
//        exit;

        // js css libs
        $this->view->css = [

        ];
        $this->view->render('header');
        $this->view->render($this->_menu.'/index');
        $this->view->render('footer');
    }

    function view($id = 0) {
        $id = ($id) ? Func::filter_int($id) : 0;
        if(!$id){
            header('Location: ' . URL . MF::$_lang . '/error');
            exit;
        }

        // page item
        $pages = $this->mainModel->viewPageBySlug($this->_menu);
        if(isset($pages->mysqlError)){
            Session::set('note_error', $pages->mysqlError);
            $pages = [];
        }
        $this->view->pages = $pages;

        // item
        $viewItems = $this->model->viewItems($id);
        if(isset($viewItems->mysqlError)){
            Session::set('note_error', $viewItems->mysqlError);
            $viewItems = [];
        }
        $this->view->viewItems = $viewItems;
//        print '<pre>';
//        print_r($viewItems);
//        exit;

        $this->view->render('header');
        $this->view->render($this->_menu.'/view');
        $this->view->render('footer');
    }
}