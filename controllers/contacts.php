<?php

class Contacts extends Controller {
    function __construct() {
        parent::__construct();
        parent::loadHeader('contacts');
    }

    function index() {
        // page item
        $pages = $this->mainModel->viewPageBySlug($this->_menu);
        if(isset($pages->mysqlError)){
            Session::set('note_error', $pages->mysqlError);
            $pages = [];
        }
        $this->view->pages = $pages;

        // is isset post
        if(sizeof($_POST)) {
            $email = (isset($this->_def['13']) && !empty($this->_def['13'])) ? $this->_def['13'] : '';
            if ($email) {
                $result = $this->model->sendMail($email);
                print '<pre>';
                print_r($result);
                exit;

                if (isset($result->formError) or isset($result->headerError)) {
                    $this->view->postData = $result;
                } else {
                    Session::set('note_success', Lang::get('{Müraciətiniz göndərildi. Təşəkkür edirik!}'));
                    header('Location: ' . URL . MF::$_lang . '/' . $this->_menu);
                    exit;
                }
            }
        }

        // js css libs
        $this->view->css = [
            //'css/pages/page-contacts.css'
        ];
        $this->view->render('header');
        $this->view->render($this->_menu.'/index');
        $this->view->render('footer');
    }
}