<?php

class Login_Model extends Model {
    public function __construct() {
        parent::__construct();
    }

    public function run() {
        try {
            // check post && csrf token
            if (sizeof($_POST)) {
                Func::csrf_token_check($_POST);
            } else {
                $error['headerError'] = Lang::get('{Post not isset}');
                throw new Exception(json_encode($error));
            }

            $data['data_login'] = isset($_POST['data_login']) ? Func::filter_string($_POST['data_login']) : '';
            $data['data_password'] = isset($_POST['data_password']) ? $_POST['data_password'] : '';

            if (!$data['data_login'] or !$data['data_password']) {
                $error['headerError'] = Lang::get('{Please enter username and password}');
                throw new Exception(json_encode($error));
            }

            /*
             * @CHECK  - if anyibrut count > 5 run recaptcha
             */
            $count = $this->anyibrutCount();
            if($count>3 && empty($error)){
                if (isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])) {
                    $secret = RECAPTCHA_SECRET;
                    $google_link = 'https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $_POST['g-recaptcha-response'];
                    $verifyResponse = file_get_contents($google_link);
                    $responseData = json_decode($verifyResponse);
                    if (!$responseData->success) {
                        $error['headerError'] = Lang::get('{Please enter the correct reCaptcha!}');
                    }
                } else {
                    $error['headerError'] = Lang::get('{Please enter the correct reCaptcha!}');
                }
            }

            if (empty($error)) {
//                echo Hash::createPassword($data['data_password'].HASH_PASSWORD_KEY);
//                exit;

                $query = "SELECT `id`, `name`, `role`, `password` 
                            FROM `cms_admins` 
                            WHERE `login` = :login AND `status` = '2' and `deleted`=2";
                $sth = $this->db->prepare($query);
                $sth->execute(array(
                        ':login' => $data['data_login'],
                ));
                $m = $sth->fetch();
                $count = $sth->rowCount();

                if ($count > 0) {
                    if(!Hash::verifyPassword($data['data_password'].HASH_PASSWORD_KEY, $m['password'])){
                        // insert to anyibrut table
                        $this->anyibrutInsert($data);
                        $error['headerError'] = Lang::get('{Not right username or password. Please try again!}');
                        throw new Exception(json_encode($error));
                    } else {
                        // login
                        Session::set('adminLoggedIn', true);
                        Session::set('adminId', $m['id']);
                        Session::set('adminName', $m['name']);

                        return 1;
                    }
                } else {
                    // insert to anyibrut table
                    $this->anyibrutInsert($data);
                    $error['headerError'] = Lang::get('{Not right username or password. Please try again!}');
                    throw new Exception(json_encode($error));
                }

            } else {
                throw new Exception(json_encode($error));
            }

        } catch (Exception $e){
            return json_decode($e->getMessage());
        }
    }

    public function anyibrutCount() {
        $ip = filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP);
        $selectData = [
                'ip' => $ip,
                'time'=>strtotime('-30 minute')
        ];
        $query = "SELECT count(`id`) as `count` 
                    FROM `cms_admin_antibrut` 
                    WHERE `ip` =:ip and `time` >= :time";
        return $this->db->selectCount($query, $selectData);
    }

    public function anyibrutInsert($data) {
        $ip = filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP);
        $input = json_encode($data);
        $insertData = [
                'input'=> $input,
                'ip'=>$ip,
                'time'=>time()
        ];
        $this->db->insert('`cms_admin_antibrut`', $insertData);
    }
}