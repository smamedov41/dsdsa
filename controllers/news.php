<?php

class News extends Controller {
    function __construct() {
        parent::__construct();
        parent::loadHeader('news');
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
        $this->view->get_total_rows = $get_total_rows = $this->model->countNews();
        $item_per_page = LIMIT_NEWS; //item to display per page
        $page_url = URL.MF::$_lang.'/news/index';
        $total_pages = ceil($get_total_rows/$item_per_page); // break records into pages
        $page_position = (($page_number-1) * $item_per_page); //get starting position to fetch the records
        $this->view->pagination = Func::paginate($item_per_page, $page_number, $get_total_rows, $total_pages, $page_url);

        // news list
        $listNews = $this->model->listNews($page_position, $item_per_page);
        if(isset($listNews->mysqlError)){
            Session::set('note_error', $listNews->mysqlError);
            $listNews = [];
        }
        $this->view->listNews = $listNews;

        // projects list
        $projects = $this->model->projectsList();
        if(isset($projects->mysqlError)){
            Session::set('note_error', $projects->mysqlError);
            $projects = [];
        }
        $this->view->projectsList = $projects;
//        print '<pre>';
//        print_r($projects);
//        exit;

        // js css libs
        $this->view->css = [
            //'css/pages/page-news.css'
        ];
        $this->view->render('header');
        $this->view->render($this->_menu.'/index');
        $this->view->render('footer');
    }

    function view($id = 0, $slug = '') {
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

        // js css libs
        $this->view->css = [
            //'css/pages/page-news.css'
        ];

        // news item
        $viewNews = $this->model->viewNews($id);
        if(isset($viewNews->mysqlError)){
            Session::set('note_error', $viewNews->mysqlError);
            $viewNews = [];
        }
        $this->view->viewNews = $viewNews;

        // projects list
        $projects = $this->model->projectsList();
        if(isset($projects->mysqlError)){
            Session::set('note_error', $projects->mysqlError);
            $projects = [];
        }
        $this->view->projectsList = $projects;
//        print '<pre>';
//        print_r($viewNews);
//        exit;

        $this->view->render('header');
        $this->view->render($this->_menu.'/view');
        $this->view->render('footer');
    }
}