<?php

class Admin extends Controller {

    function __construct() {
        parent::__construct();
        Auth::handleLogin();

        $this->controller_header('admin');
    }

    /** LIST */
    function index() {
        // page title
        $this->view->titleSub = Lang::get('{Siyahı}');

        // page js & css libs
        $this->view->css = [
            'css/jquery.dataTables.min.css',
            'css/bootstrap-toggle.min.css',
            'css/pages/admin.css',
        ];
        $this->view->js = [
            'js/jquery.dataTables.min.js',
            'js/bootstrap-toggle.min.js',
            'js/datatable.inc.js',
            'js/index.js',
        ];

        $result = $this->model->listItems();
        if(isset($result->headerError)){
            Session::set('note_error', $result->headerError);
            $result = [];
        }
        $this->view->listItems = $result;
//        print '<pre>';
//        print_r($result);
//        exit;

        $this->view->render('header');
        $this->view->render($this->_menu.'/index');
        $this->view->render('footer');
    }
    function changestatus($id=0, $token=''){
        Func::checkAdminAction($this->_admin, $this->_menu, 'edit');

        $id = ($id)?(int) $id:0;
        $token = ($token)?Func::filter_string($token):'';
        if(!$id or !$token or !Func::token_check('token_'.$this->_menu, $token)){
            exit;
        }

        $result = $this->model->updateStatus($id, $_POST);
        echo json_encode($result);
    }
    function deleteitem($id=0, $token=''){
        Func::checkAdminAction($this->_admin, $this->_menu, 'delete');

        $id = ($id)?(int) $id:0;
        $token = ($token)?Func::filter_string($token):'';
        if(!$id or !$token or !Func::token_check('token_'.$this->_menu, $token)){
            exit;
        }

        $this->model->deleteItem($id);
    }

    /** ADD */
    function add() {
        Func::checkAdminAction($this->_admin, $this->_menu, 'add');

        // page title
        $this->view->titleSub = Lang::get('{Yenisini yarat}');

        // page js & css libs
        $this->view->css = [
            'css/pages/admin.css',
        ];

        // is isset post
        if(sizeof($_POST)){
            $result = $this->model->createItem();
//            print '<pre>';
//            print_r($result);
//            exit;

            if(isset($result->mysqlError)){
                Session::set('note_error', $result->mysqlError);
                header('Location: ' . URL .$this->_menu.'/add');
                exit;
            }

            if(isset($result->formError) or isset($result->headerError)){
                $this->view->postData = $result;
            } else {
                Session::set('note_success', Lang::get('{Admin əlavə olundu}'));
                header('Location: ' . URL .$this->_menu.'/add');
                exit;
            }
        }

        // template
        $this->view->render('header');
        $this->view->render($this->_menu.'/add');
        $this->view->render('footer');
    }

    /** EDIT */
    function edit($id = ''){
        Func::checkAdminAction($this->_admin, $this->_menu, 'edit');

        $id = ($id)?(int) $id:0;
        if(!$id){
            header('location: ' . URL . $this->_menu);
            exit;
        }

        // page title
        $this->view->titleSub = Lang::get('{Redaktə et}');

        // page js & css libs
        $this->view->css = [
            'css/pages/admin.css',
        ];

        // list
        $item = $this->model->singleItem($id);
        if(isset($item->mysqlError)){
            Session::set('note_error', $item->mysqlError);
            $item = [];
        }
        $this->view->item = $item;
//        print '<pre>';
//        print_r($item);
//        exit;

        // template
        $this->view->render('header');
        $this->view->render($this->_menu.'/edit');
        $this->view->render('footer');
    }
    function update($id = ''){
        Func::checkAdminAction($this->_admin, $this->_menu, 'edit');

        $id = ($id)?(int) $id:0;
        if(!$id){
            header('location: ' . URL . $this->_menu);
            exit;
        }

        $result = $this->model->updateItem($id);
//        print '<pre>';
//        print_r($result);
//        exit;

        if(isset($result->mysqlError)){
            Session::set('note_error', $result->mysqlError);
            header('Location: ' . URL .$this->_menu.'/edit/'.$id);
            exit;
        }

        if($result === 1){
            Session::set('note_success', Lang::get('{Məlumat dəyişdi}'));
            header('Location: ' . URL .$this->_menu.'/edit/'.$id);
            exit;
        } else {
            $this->view->postData = $result;
            $this->edit($id);
        }
    }

    /* HELPER */
    function lang($lang='') {
        $lang = Func::filter_string($lang);
        if($lang) {
            Session::set('lang', $lang);
            echo 'ok';
        } else {
            echo 'no'; // for refresh
        }
    }
}