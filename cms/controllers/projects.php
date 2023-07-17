<?php

class Projects extends Controller {

    function __construct() {
        Auth::handleLogin();

        parent::__construct();
        parent::controller_header('projects');
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
    function changestatus($id=0, $token=''){
        Func::checkAdminAction($this->_admin, $this->_menu, 'edit');

        $id = ($id)? Func::filter_int($id):0;
        $token = ($token)?Func::filter_string($token):'';
        if(!$id or !$token or !Func::token_check('token_'.$this->_menu, $token)){
            exit;
        }

        $result = $this->model->updateStatus($id, $_POST);
        echo json_encode($result);
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

    /** ADD */
    function add() {
        Func::checkAdminAction($this->_admin, $this->_menu, 'add');

        // page title
        $this->view->titleSub = Lang::get('{Yenisini yarat}');

        // page js & css libs
        $this->view->css = [
            'css/bootstrap-datepicker.min.css',
            'css/summernote.css',
        ];
        $this->view->js = [
            'js/jquery-ui.min.js',
            'js/upload.js',
            'js/pages/projects.js',

            'js/bootstrap-datepicker.min.js',
            'js/bootstrap-datepicker.az.min.js',
            'js/summernote.js',
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
                Session::set('note_success', Lang::get('{Xəbər əlavə olundu}'));
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

        $id = ($id)? Func::filter_int($id):0;
        if(!$id){
            header('location: ' . URL . $this->_menu);
            exit;
        }

        // page title
        $this->view->titleSub = Lang::get('{Redaktə et}');

        // page js & css libs
        $this->view->css = [
            'css/bootstrap-datepicker.min.css',
            'css/summernote.css',
        ];
        $this->view->js = [
            'js/jquery-ui.min.js',
            'js/upload.js',
            'js/pages/projects.js',

            'js/bootstrap-datepicker.min.js',
            'js/bootstrap-datepicker.az.min.js',
            'js/summernote.js',
        ];

        // list
        $item = $this->model->singleItem($id);
        if(isset($item->mysqlError)){
            Session::set('note_error', $item->mysqlError);
            $item = [];
        }
        if(isset($item->headerError)){
            Session::set('note_error', $item->headerError);
            $item = [];
        }
        $this->view->item = $item;
//        print '<pre>';
//        print_r($item);
//        exit;

        if(empty($item)){
            header('location: ' . URL . $this->_menu);
            exit;
        }

        // template
        $this->view->render('header');
        $this->view->render($this->_menu.'/edit');
        $this->view->render('footer');
    }
    function update($id = ''){
        Func::checkAdminAction($this->_admin, $this->_menu, 'edit');

        $id = ($id)? Func::filter_int($id):0;
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

    /** HELPER */
    function photodelete($id='', $sec_id='') {
        $id = ($id)? Func::filter_int($id):0;
        $sec_id = ($sec_id)?Func::filter_string($sec_id):'';
        if(!$id or !$sec_id){
            exit;
        }

        $result = $this->model->photoDelete($id, $sec_id);
    }
    function uploadphoto(){
        header('Content-Type: application/json');
        $result = $this->model->uploadPhoto();
    }
    function orderphoto(){
        $result = $this->model->orderPhoto();
    }

}