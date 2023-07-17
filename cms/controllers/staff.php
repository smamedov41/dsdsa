<?php

class Staff extends Controller {

    function __construct() {
        Auth::handleLogin();

        parent::__construct();
        parent::controller_header('staff');
    }

    /** LIST */
    function index() {
        // page title
        $this->view->titleSub = Lang::get('{Siyahı}');

        // page js & css libs
        $this->view->css = [
            'css/jquery.dataTables.min.css',
            'css/bootstrap-toggle.min.css',
            'css/rowReorder.dataTables.min.css'
        ];
        $this->view->js = [
            'js/jquery.dataTables.min.js',
            'js/bootstrap-toggle.min.js',
            'js/dataTables.rowReorder.min.js',
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
    function ordering($token=''){
        Func::checkAdminAction($this->_admin, $this->_menu, 'edit');

        $token = ($token)?Func::filter_string($token):'';
        if(!$token or !Func::token_check('token_'.$this->_menu, $token)){
            exit;
        }

        if (!empty($_POST)) {
            foreach ($_POST['arr'] as $key=>$item) {
                $k = (int) $key;
                if($item){
                    $ids[$k] = (int) $item;
                }
            }

            $result = $this->model->orderingItem($ids);
            echo json_encode($result);
        }
    }

    /** ADD */
    function add() {
        Func::checkAdminAction($this->_admin, $this->_menu, 'add');

        // page title
        $this->view->titleSub = Lang::get('{Yenisini yarat}');

        // page js & css libs
        $this->view->css = [
            'css/bootstrap-datepicker.min.css',
        ];
        $this->view->js = [
            'js/bootstrap-datepicker.min.js',
            'js/bootstrap-datepicker.az.min.js',
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

        /**
         * ordering
         */
        $result = $this->model->maxOrder();
        if(isset($result->mysqlError)){
            Session::set('note_error', $result->mysqlError);
            $result = 0;
        }
        $this->view->maxOrder = $result + 1;

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
        ];
        $this->view->js = [
            'js/bootstrap-datepicker.min.js',
            'js/bootstrap-datepicker.az.min.js',
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
    function deletephoto($id='', $token = '') {
        $id = ($id)? Func::filter_int($id):0;
        $token = ($token)?Func::filter_string($token):'';
        if(!$id or !$token or !Func::token_check('token_photo_delete', $token)){
            header('Location: ' . URL . $this->_menu);
            exit;
        }

        $result = $this->model->deletePhoto($id);
        if($result){
            Session::set('note_success', Lang::get('{Şəkil silinmişdir!}'));
            header('Location: ' . URL .$this->_menu.'/edit/'.$id);
            exit;
        } else {
            Session::set('note_success', Lang::get('{Şəkil silinmədi!}'));
            header('Location: ' . URL .$this->_menu.'/edit/'.$id);
            exit;
        }
    }

}