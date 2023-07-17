<?php

class Pages extends Controller {

    function __construct() {
        Auth::handleLogin();

        parent::__construct();
        parent::controller_header('pages');
    }

    /** LIST */
    function index() {
        // page title
        $this->view->titleSub = Lang::get('{Siyahı}');

        // page js & css libs
        $this->view->css = [
            'css/bootstrap-toggle.min.css',
            'css/pages/pages.css',
        ];
        $this->view->js = [
            'js/bootstrap-toggle.min.js',
            'js/jquery.nestable.min.js',
            'js/pages/pages.js',
        ];

        // item list
        $result = $this->model->listItemsAll();
        if(isset($result->mysqlError)){
            Session::set('note_error', $result->mysqlError);
            $result = [];
        }
        $this->view->listItems = $result;
       // print '<pre>';
       // print_r($result);
       // exit;

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
    function ordering(){
        if(isset($_POST['ordering']) && !empty($_POST['ordering'])){
            $mas = json_decode($_POST['ordering'], true);
            if (json_last_error() === JSON_ERROR_NONE) {
                Func::checkAdminAction($this->_admin, $this->_menu, 'edit');
                $this->model->orderingItem($mas, 0);
            }
        }
    }

    /** ADD */
    function add() {
        Func::checkAdminAction($this->_admin, $this->_menu, 'add');

        // page title
        $this->view->titleSub = Lang::get('{Yenisini yarat}');

        // page js & css libs
        $this->view->css = [
            'css/bootstrap-select.min.css',
            'css/summernote.css',
        ];
        $this->view->js = [
            'js/bootstrap-select.min.js',
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
                Session::set('note_success', Lang::get('{Səhifə əlavə olundu}'));
                header('Location: ' . URL .$this->_menu.'/add');
                exit;
            }
        }

        // select max num for ordering
        $maxOrder = $this->model->maxOrder();
        if(isset($maxOrder->mysqlError)){
            Session::set('note_error', $maxOrder->mysqlError);
            $maxOrder = 0;
        }
        $this->view->maxOrder = $maxOrder + 1;

        // select pages for parent
        $pagesList = $this->model->listItems(1);
        if(isset($pagesList->mysqlError)){
            Session::set('note_error', $pagesList->mysqlError);
            $pagesList = [];
        }
        $this->view->pagesList = $pagesList;
//        print '<pre>';
//        print_r($pagesList);
//        exit;


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
            'css/bootstrap-select.min.css',
            'css/summernote.css',
        ];
        $this->view->js = [
            'js/bootstrap-select.min.js',
            'js/summernote.js',
        ];

        // select one page
        $item = $this->model->singleItem($id);
        if(isset($item->mysqlError)){
            Session::set('note_error', $item->mysqlError);
            $item = [];
        }
        if(isset($item->headerError)){
            Session::set('note_error', $item->headerError);
            $item = [];
        }
        if(empty($item)){
            header('location: ' . URL . $this->_menu);
            exit;
        }
        $this->view->item = $item;

        // select pages for parent
        $pagesList = $this->model->listItems(1);
        if(isset($pagesList->mysqlError)){
            Session::set('note_error', $pagesList->mysqlError);
            $pagesList = [];
        }
        $this->view->pagesList = $pagesList;
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
    function slug() {
        $lang = Func::filter_string($_POST['lang']);
        $text = Func::filter_string($_POST['slug']);

        require_once VENDOR_DIR . 'autoload.php';
        $slugify = new \Cocur\Slugify\Slugify();
        $text = $slugify->slugify($text);

        echo json_encode(array('text'=>$text));
    }
}