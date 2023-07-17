<?php

class Settings_Model extends Model {

    public function __construct() {
        parent::__construct();

        $this->_menu = 'settings';
    }

    /** LIST */
    public function listItems() {
        try{
            $selectData = [
                'deleted'=>'2',
                'lang'=>MFAdmin::$_lang
            ];
            $query = "SELECT P.`id`, T.`title`, T.`text`, P.`update_date`, P.`status`, A.`name` as `creater_name` 
                        FROM `cms_settings` P
                        LEFT JOIN `cms_settings_text` T ON T.p_id = P.id and T.lang =:lang
                        LEFT JOIN `cms_admins` A ON A.`id` = P.`creator_id`
                        WHERE P.`deleted`=:deleted 
                        ORDER BY P.`id`";
            $result = $this->db->select($query, $selectData);
            Func::dbError($result, __LINE__);

            if($result) {
                return Func::filter_array($result);
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
                $result = $this->db->update('`cms_settings`', $updateData, "`id`={$id}");
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
            $result = $this->db->update('`cms_settings`', $updateData, "`id`={$id}");
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

            /***********************************************************************************
             * post
             */
            $this->form->post('data_status')->val('requires')->filter('filter_int');
            foreach (MFAdmin::$_langs as $key=>$value){
                $this->form
                    ->post('data_title_'.$key)->val('maxlength', 250)->val('requires')->filter('filter_string')
                    ->post('data_text_'.$key, 'text')->val('requires')->filter('filter_string')
                ;
            }

            $this->form->submit();
            $data = $this->form->fetch();

            //print '<pre>';
            //print_r($data);
            //exit;
            /**
             * COMMENT END
             ************************************************************************************/

            /***********************************************************************************
             * insert
             */
            if(!empty($data)){
                $insertData = [
                        'status'=>($data['data_status'])?$data['data_status']:1,

                        'creator_id'=>Session::get('adminId'),
                        'create_date' => date('Y-m-d H:i:s'),
                        'update_date' => date('Y-m-d H:i:s')
                ];
                $last_id = $this->db->insert('cms_settings', $insertData);
                Func::dbError($last_id, __LINE__);

                if (ctype_digit($last_id) === true) {
                    // insert text
                    foreach (MFAdmin::$_langs as $key=>$value){
                        $insertData = [
                            'p_id'=>$last_id,
                            'title'=>$data['data_title_'.$key],
                            'text'=>$data['data_text_'.$key],
                            'lang'=>$key
                        ];
                        $insertResult = $this->db->insert('cms_settings_text', $insertData);
                        Func::dbError($insertResult, __LINE__);
                    }
                    return 1;
                }
            }
            /**
             * COMMENT END
             ************************************************************************************/

        } catch (Exception $e){
            return json_decode($e->getMessage());
        }
    }

    /** EDIT */
    public function singleItem($id) {
        try{
            $selectData = [
                'id' => $id,
                'deleted' => '2',
            ];

            $query = "SELECT S.`id`, T.`title`, T.`text`, T.`lang`, S.`status` 
                        FROM `cms_settings` S 
                        LEFT JOIN `cms_settings_text` T ON T.p_id = S.id   
                        WHERE S.`id`=:id and S.`deleted` = :deleted";
            $result = $this->db->select($query, $selectData);
            Func::dbError($result, __LINE__);

            $mas = [];
            if(!empty($result)){
                foreach ($result as $value){
                    $mas['id'] = Func::filter_int($value['id']);
                    $mas['status'] = Func::filter_int($value['status']);
                    $mas['title'][$value['lang']] = Func::filter_string($value['title']);
                    $mas['text'][$value['lang']] = Func::filter_html($value['text']);
                }
            }
            return $mas;
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

            /***********************************************************************************
             * post
             */
            $this->form->post('data_status')->val('requires')->filter('filter_int');
            foreach (MFAdmin::$_langs as $key=>$value){
                $this->form
                    ->post('data_title_'.$key)->val('maxlength', 250)->val('requires')->filter('filter_string')
                    ->post('data_text_'.$key, 'text')->val('requires')->filter('filter_string');
            }

            $this->form->submit();
            $data = $this->form->fetch();

            //print '<pre>';
            //print_r($data);
            //exit;
            /**
             * COMMENT END
             ************************************************************************************/

            /***********************************************************************************
             * update
             */
            if(!empty($data)){
                // update from database
                $updateData = [
                        'status'=>$data['data_status'],

                        'creator_id'=>Session::get('adminId'),
                        'update_date' => date('Y-m-d H:i:s')
                ];
                $result = $this->db->update('`cms_settings`', $updateData, "`id`={$id}");
                Func::dbError($result, __LINE__);

                if($result === 1) {
                    // delete from database
                    $deleteResult = $this->db->delete('cms_settings_text', "`p_id` ={$id}");
                    Func::dbError($deleteResult, __LINE__);

                    // insert into database
                    foreach (MFAdmin::$_langs as $key => $value) {
                        $insertData = [
                            'p_id' => $id,
                            'title' => $data['data_title_' . $key],
                            'text' => $data['data_text_' . $key],
                            'lang' => $key
                        ];
                        $insertResult = $this->db->insert('cms_settings_text', $insertData);
                        Func::dbError($insertResult, __LINE__);
                    }
                    return 1;
                }
            }
            /**
             * COMMENT END
             ************************************************************************************/

        } catch (Exception $e){
            return json_decode($e->getMessage());
        }
    }
}