<?php

class Admin_Model extends Model {
    public $_menu;

    public function __construct() {
        parent::__construct();

        $this->_menu = 'admin';
    }

    /* LIST */
    public function listItems() {
        try{
            $selectData = [
                    'deleted'=>'2'
            ];
            $query = "SELECT `id`, `name`, `role`, `update_date`, `status` 
                        FROM `cms_admins`
                        WHERE `deleted`=:deleted 
                        ORDER BY `id`";
            $result = $this->db->select($query, $selectData);
            Func::dbError($result, __LINE__);

            if($result) {
                return $result;
            } else {
                return [];
            }

        } catch (Exception $e){
            return json_decode($e->getMessage());
        }
    }
    public function updateStatus($id, $post=[]) {
        // change status items
        try{
            $status = (isset($post['status']) && !empty($post['status']))?(int) $post['status']:'';
            if($status) {
                $updateData = array(
                    'status' => $status,
                    'update_date' => date('Y-m-d H:i:s')
                );
                $result = $this->db->update('`cms_admins`', $updateData, "`id`={$id}");
                Func::dbError($result, __LINE__);

                return 1;
            } else {
                return 0;
            }
        } catch (Exception $e){
            return json_decode($e->getMessage());
        }
    }
    public function deleteItem($id) {
        // delete items
        try{
            $updateData = array(
                'deleted' => '1',
                'update_date' => date('Y-m-d H:i:s')
            );
            $result = $this->db->update('`cms_admins`', $updateData, "`id`={$id}");
            Func::dbError($result, __LINE__);

            return 1;
        } catch (Exception $e){
            return json_decode($e->getMessage());
        }
    }

    /** ADD */
    public function createItem() {
        try {
            // check post && csrf token
            if (sizeof($_POST)) {
                Func::csrf_token_check($_POST);
            } else {
                header('Location: ' . URL . $this->_menu . '/add');
                exit;
            }

            // check post
            $this->form
                ->post('data_name')->val('requires')
                ->post('data_login')->val('requires')
                ->post('data_password', 'password')->val('requires')
                ->post('data_role', 'array')->val('requires')
                ->post('data_status');

            $this->form->submit();
            $data = $this->form->fetch();

            // insert into database
            if(!empty($data)){
                $insertData = [
                    'name' => $data['data_name'],
                    'login' => $data['data_login'],
                    'password' => Hash::createPassword($data['data_password'].HASH_PASSWORD_KEY),
                    'role' => json_encode($data['data_role']),
                    'status'=>($data['data_status'])?$data['data_status']:1,

                    'creator_id'=>Session::get('adminId'),
                    'create_date' => date('Y-m-d H:i:s'),
                    'update_date' => date('Y-m-d H:i:s')
                ];
                return $this->db->insert('cms_admins', $insertData);
            }


        } catch (Exception $e){
            return json_decode($e->getMessage());
        }
    }

    /** EDIT */
    public function singleItem($id) {
        try{
            $selectData = [
                'id' => $id
            ];

            $query = "SELECT * 
                            FROM `cms_admins`
                            WHERE `id`=:id 
                            LIMIT 1";
            $result = $this->db->select($query, $selectData);
            if(!empty($result)){
                return $result[0];
            } else {
                $error['headerError'] = Lang::get('{Not fount items}');
                throw new Exception(json_encode($error['headerError']));
            }
        } catch (Exception $e){
            return json_decode($e->getMessage());
        }
    }
    public function updateItem($id) {
        try {
            // check post && csrf token
            if (sizeof($_POST)) {
                Func::csrf_token_check($_POST);
            } else {
                header('Location: ' . URL . $this->_menu.'/edit/'.$id);
                exit;
            }

            // check post
            $this->form
                ->post('data_name')->val('requires')
                ->post('data_login')->val('requires')
                ->post('data_password', 'password')
                ->post('data_role', 'array')->val('requires')
                ->post('data_status')->val('requires');

            $this->form->submit();
            $data = $this->form->fetch();

            // update database
            if(!empty($data)){
                $updateData = [
                    'name' => $data['data_name'],
                    'login' => $data['data_login'],
                    'role' => json_encode($data['data_role']),
                    'status'=>$data['data_status'],

                    'creator_id'=>Session::get('adminId'),
                    'update_date' => date('Y-m-d H:i:s')
                ];
                if (!empty($data['data_password'])) {
                    $updateData['password'] = Hash::createPassword($data['data_password'].HASH_PASSWORD_KEY);
                }

                return $this->db->update('`cms_admins`', $updateData, "`id`={$id}");
            }

        } catch (Exception $e){
            return json_decode($e->getMessage());
        }
    }
}