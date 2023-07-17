<?php

class Controller {
    protected $_menu;
    protected $_admin;

    function __construct() {
        $this->mainModel = new Model();
        $this->view = new View();
    }

    /**
     *
     * @param string $name Name of the model
     * @param string $path Location of the models
     */
    public function loadModel($name, $modelPath = 'models/') {
        $path = $modelPath . $name . '_model.php';

        if (file_exists($path)) {
            require $modelPath . $name . '_model.php';

            $modelName = $name . '_Model';
            $this->model = new $modelName();
        }
    }

    public function controller_header($menu) {
        $this->view->menu = $this->_menu = $menu;
        $this->view->title = Lang::get($this->_menu);
        $this->view->admin = $this->_admin = $this->loadAdmin();

        /**
         * check admin roles
         */
        if(!in_array($this->_menu, array_keys($this->_admin['role']))){
            /**
             *  get first menu from role
             */
            $admin_permission= array_keys($this->_admin['role']);
            header('Location: '.URL.$admin_permission[0]);
            exit;
        }

//        print '<pre>';
//        echo $menu;
//        print_r($this->_admin['role']);
//        print_r(array_keys($this->_admin['role']));
//        exit;
    }

    /**
     * @function loadUser
     */
    public function loadAdmin(){
        $result = $this->mainModel->loadAdmin();
//        print '<pre>';
//        print_r($result);
//        exit;

        /** @var  $role admin roles */
        $role = isset($result['role'])?json_decode($result['role'], true):[];

        if(!isset($result->mysqlError) && !empty($result) && !empty($result['id']) && !empty($role)){

            return [
                'id'=>$result['id'],
                'name'=>$result['name'],
                'role'=>$role,
            ];

        } else {
            Session::destroy();
            header('Location: ' . URL . 'login');
            exit;
        }
    }
}