<?php

class Cv extends Controller {

    function __construct() {
        Auth::handleLogin();

        parent::__construct();
        parent::controller_header('cv');
    }

    /** LIST */
    function index() {
        // page title
        $this->view->titleSub = Lang::get('{Siyahı}');

        // page js & css libs
        $this->view->css = [
            'css/jquery.dataTables.min.css',
            'css/bootstrap-toggle.min.css',
        ];
        $this->view->js = [
            'js/jquery.dataTables.min.js',
            'js/bootstrap-toggle.min.js',
            'js/datatable.inc.js',
            'js/index.js',
        ];

        // item list
        $result = $this->model->listItems();
        if(isset($result->mysqlError)){
            Session::set('note_error', $result->mysqlError);
            $result = [];
        }
        $this->view->listItems = $result;
//        print '<pre>';
//        print_r($result);
//        exit;

        // template
        $this->view->render('header');
        $this->view->render($this->_menu.'/index');
        $this->view->render('footer');
    }
    function deleteitem($id=0, $token=''){
        Func::checkAdminAction($this->_admin, $this->_menu, 'delete');

        $id = ($id)? Func::filter_int($id):0;
        $token = ($token)?Func::filter_string($token):'';
        if(!$id or !$token or !Func::token_check('token_'.$this->_menu, $token)){
            exit;
        }

        $this->model->deleteItem($id);
    }
}