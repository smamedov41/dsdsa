<?php

class MF {

    private $_url = null;
    private $_controller = null;
    public static $_lang = null;
    public static $_langs = ['az' => 'Azərbaycanca', 'en' => 'English', 'ru' => 'Русский'];

    public static $_menu_list = [
            'error',
            'index',
            'cron',

            'pages',
            'about',
            'news',
            'projects',
            'certificates',
            'cv',
            'contacts',
    ];

    private $_controllerPath = 'controllers/'; // Always include trailing slash
    private $_modelPath = 'models/'; // Always include trailing slash
    private $_errorFile = 'error404.php';
    private $_defaultFile = 'index.php';
    private $_defaultLang = 'az';

    /**
     * Starts the Bootstrap
     *
     * @return boolean
     */
    public function init() {
        // Sets the protected $_url
        Session::init();
        $this->_getUrl();

        // Lang
        if (empty($this->_url[0])) {
            self::$_lang = $this->_defaultLang;
        } else {
            self::$_lang = array_key_exists($this->_url[0], self::$_langs)?htmlspecialchars($this->_url[0]):$this->_defaultLang;
        }

        // Load the default controller if no URL is set
        // eg: Visit http://localhost it loads Default Controller
        if (empty($this->_url[1])) {
            $this->_loadDefaultController();
            return false;
        }

        $this->_loadExistingController();
        $this->_callControllerMethod();
    }

    /**
     * (Optional) Set a custom path to controllers
     * @param string $path
     */
    public function setControllerPath($path) {
        $this->_controllerPath = trim($path, '/') . '/';
    }

    /**
     * (Optional) Set a custom path to models
     * @param string $path
     */
    public function setModelPath($path) {
        $this->_modelPath = trim($path, '/') . '/';
    }

    /**
     * (Optional) Set a custom path to the error file
     * @param string $path Use the file name of your controller, eg: error.php
     */
    public function setErrorFile($path) {
        $this->_errorFile = trim($path, '/');
    }

    /**
     * (Optional) Set a custom path to the error file
     * @param string $path Use the file name of your controller, eg: index.php
     */
    public function setDefaultFile($path) {
        $this->_defaultFile = trim($path, '/');
    }

    /**
     * Fetches the $_GET from 'url'
     */
    private function _getUrl() {
        $url = isset($_GET['pzenyzpgfnauirss']) ? $_GET['pzenyzpgfnauirss'] : null;
        $url = rtrim($url, '/');
        $url = filter_var($url, FILTER_SANITIZE_STRING);
        $this->_url = explode('/', $url);
    }

    /**
     * This loads if there is no GET parameter passed
     */
    private function _loadDefaultController() {
        require $this->_controllerPath . $this->_defaultFile;
        $this->_controller = new Index();
        $this->_controller->loadModel('index', $this->_modelPath);
        $this->_controller->index();
    }

    /**
     * Load an existing controller if there IS a GET parameter passed
     *
     * @return boolean|string
     */
    private function _loadExistingController() {
        $file = $this->_controllerPath . $this->_url[1] . '.php';

        if (file_exists($file) && in_array($this->_url[1], MF::$_menu_list)) {
            require $file;
            $this->_controller = new $this->_url[1];
            $this->_controller->loadModel($this->_url[1], $this->_modelPath);
        } else {
            $this->_error();
            return false;
        }
    }

    /**
     * If a method is passed in the GET url paremter
     *
     *  http://localhost/controller/method/(param)/(param)/(param)
     *  url[0] = Controller
     *  url[1] = Method
     *  url[2] = Param
     *  url[3] = Param
     *  url[4] = Param
     */
    private function _callControllerMethod() {
        $length = count($this->_url);

        // Make sure the method we are calling exists
        if ($length > 2) {
            if (!method_exists($this->_controller, $this->_url[2])) {
                $this->_error();
            }
        }

        // Determine what to load
        switch ($length) {
            case 6:
                //Controller->Method(Param1, Param2, Param3)
                $this->_controller->{$this->_url[2]}($this->_url[3], $this->_url[4], $this->_url[5]);
                break;

            case 5:
                //Controller->Method(Param1, Param2)
                $this->_controller->{$this->_url[2]}($this->_url[3], $this->_url[4]);
                break;

            case 4:
                //Controller->Method(Param1, Param2)
                $this->_controller->{$this->_url[2]}($this->_url[3]);
                break;

            case 3:
                //Controller->Method(Param1, Param2)
                $this->_controller->{$this->_url[2]}();
                break;

            default:
                $this->_controller->index();
                break;
        }
    }

    /**
     * Display an error page if nothing exists
     *
     * @return boolean
     */
    private function _error() {
        require $this->_controllerPath . $this->_errorFile;
        $this->_controller = new Error404();
        $this->_controller->index();
        exit;
    }

}