<?php

class Model {
    function __construct() {
        $this->db = new Database(DB_TYPE, DB_HOST, DB_NAME, DB_USER, DB_PASS);
        $this->form = new Form();
    }

    /** Load User */
    public function loadAdmin(){
        try{
            $admin = isset($_SESSION['adminId'])?Session::get('adminId'):'';

            if(isset($admin) && !empty($admin)){

                $selectData = [
                    'admin_id' => $admin,
                    'status'=>'2',
                    'deleted'=>'2'
                ];
                $query = "SELECT U.`id`, U.`role`, `name` as `userName`  
                                FROM `cms_admins` U
                                WHERE U.`id` =:admin_id AND U.`status` =:status AND U.`deleted` =:deleted 
                                LIMIT 1";
                $result = $this->db->selectOne($query, $selectData);
                Func::dbError($result, __LINE__);

                if($result) {

                    return [
                        'id'=>(int) $result['id'],
                        'name'=>Func::filter_string($result['userName']),
                        'role'=>$result['role'],
                    ];
                } else {
                    return [];
                }

            } else {
                return [];
            }
        } catch (Exception $e){
            return json_decode($e->getMessage());
        }
    }
}