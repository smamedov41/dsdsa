<?php

class Langwords extends Controller {

    function __construct() {
        Auth::handleLogin();

        parent::__construct();
        parent::controller_header('langwords');
    }

    /* LIST */
    function index() {
        // page title
        $this->view->titleSub = Lang::get('{Siyahı}');

        // page js & css libs
        $this->view->css = [
            'css/jquery.dataTables.min.css',
            'css/bootstrap-toggle.min.css'
        ];
        $this->view->js = [
            'js/jquery.dataTables.min.js',
            'js/bootstrap-toggle.min.js',
            'js/datatable.inc.js',
            'js/index.js'
        ];

        // if post isset
        if (isset($_POST) && sizeof($_POST)) {
            $result = $this->model->listAction();

            if(isset($result->headerError)){
                Session::set('note_error', $result->headerError);
                header('Location: ' . URL . $this->_menu);
                exit;
            } else {
                Session::set('note_success', Lang::get('{Məlumat dəyişdi}'));
                header('Location: ' . URL . $this->_menu);
                exit;
            }
        }

        // item list
        $result = $this->model->listItems();
        if(isset($result->mysqlError)){
            Session::set('note_error', $result->mysqlError);
            $result = [];
        }
        $this->view->listItems = $result;

        // template
        $this->view->render('header');
        $this->view->render($this->_menu.'/index');
        $this->view->render('footer');
    }

    /* ADD */
    function add() {
        $this->model->addWords();
        header('Location: ' . URL .$this->_menu);
        exit;
    }
}