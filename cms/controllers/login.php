<?php

class Login extends Controller {

    function __construct() {
        parent::__construct();
        //Session::init();
        $this->view->title = 'Login';
        $this->view->description = API_TITLE;
    }

    function index() {
        // page js & css libs
        $this->view->css = [
            'css/login.css'
        ];
        $count = $this->model->anyibrutCount();
        if($count>3){
            $this->view->recaptca = 1;
        } else {
            $this->view->recaptca = 0;
        }
        $this->view->render('login/index');
    }

    function run() {
        $result = $this->model->run();
        if(isset($result->headerError)){
            Session::set('note_error', $result);
            header('location: ' . URL . 'login');
            exit;
        } else {
            header('location: ' . URL);
            exit;
        }
    }

    function logout() {
        Session::destroy();
        header('location: ' . URL . 'login');
        exit;
    }


}