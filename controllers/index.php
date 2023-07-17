<?php

class Index extends Controller {

    function __construct() {
        parent::__construct();
        parent::loadHeader('index');
    }

    function index() {
        // js css libs
        $this->view->css = [
        ];

        // Slider
        $listSlider = $this->model->listSlider();
        if(isset($listSlider->mysqlError)){
            Session::set('note_error', $listSlider->mysqlError);
            $listSlider = [];
        }
        $this->view->listSlider = $listSlider;

        // Projects
        $listProjects = $this->model->listProjects();
        if(isset($listProjects->mysqlError)){
            Session::set('note_error', $listProjects->mysqlError);
            $listProjects = [];
        }
        $this->view->listProjects = $listProjects;

        // News
        $listNews = $this->model->listNews();
        if(isset($listNews->mysqlError)){
            Session::set('note_error', $listNews->mysqlError);
            $listNews = [];
        }
        $this->view->listNews = $listNews;

        // Staff
        $listStaff = $this->model->listStaff();
        if(isset($listStaff->mysqlError)){
            Session::set('note_error', $listStaff->mysqlError);
            $listStaff = [];
        }
        $this->view->listStaff = $listStaff;
//        print '<pre>';
//        print_r($listStaff);
//        exit;


        $this->view->render('header');
        $this->view->render($this->_menu.'/index');
        $this->view->render('footer');
    }
}