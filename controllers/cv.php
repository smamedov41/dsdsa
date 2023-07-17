<?php

class Cv extends Controller {
    function __construct() {
        parent::__construct();
        parent::loadHeader('cv');
    }

    function index() {
        // page item
        $pages = $this->mainModel->viewPageBySlug($this->_menu);
        if(isset($pages->mysqlError)){
            Session::set('note_error', $pages->mysqlError);
            $pages = [];
        }
        $this->view->pages = $pages;

        // send cv
        if(sizeof($_POST)){
            $email = (isset($this->_def['14']) && !empty($this->_def['14']))?$this->_def['14']:'';
            if($email) {
                $result = $this->model->sendCV($email);
//                print '<pre>';
//                print_r($result);
//                exit;

                if (isset($result->formError) or isset($result->headerError)) {
                    $this->view->postData = $result;
                } else {
                    Session::set('note_success', Lang::get('{Müraciətiniz göndərildi. Təşəkkür edirik!}'));
                    header('Location: ' . URL . MF::$_lang . '/' . $this->_menu);
                    exit;
                }
            }
        }

        $this->view->render('header');
        $this->view->render($this->_menu.'/index');
        $this->view->render('footer');
    }
}