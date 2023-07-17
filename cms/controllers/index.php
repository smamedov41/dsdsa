<?php

class Index extends Controller {

    function __construct() {
        Auth::handleLogin();
        
        parent::__construct();
        parent::controller_header('index');
    }

    function index() {

        $result = $this->model->listItems();
        if(isset($result->headerError)){
            Session::set('note_error', $result->headerError);
            $result = [];
        }
        $this->view->listItems = $result;

        $folder_name = __DIR__.'/../../upload/';
        $this->view->uploadFolderSize = Func::sizeFormat(Func::folderSize($folder_name));
//        print '<pre>';
//        print_r($result);
//        exit;

        $this->view->render('header');
        $this->view->render('index/index');
        $this->view->render('footer');
    }
}