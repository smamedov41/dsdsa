<?php

class Staff_Model extends Model {

    public function __construct() {
        parent::__construct();

        $this->_menu = 'staff';
    }

    /** LIST */
    public function listItems() {
        try{
            $selectData = [
                'deleted'=>'2',
                'lang'=>MFAdmin::$_lang
            ];
            $query = "SELECT P.`id`, P.`ordering`, PT.`title`, PT.`position`, A.`name` as `creater_name`, P.`create_date`, P.`status`  
                        FROM `cms_staff` P
                        LEFT JOIN `cms_staff_text` PT ON PT.`p_id` = P.`id` and PT.lang=:lang  
                        LEFT JOIN `cms_admins` A ON A.`id` = P.`creator_id` 
                        WHERE P.`deleted`=:deleted
                        ORDER BY P.`ordering`, `id`";
            $result = $this->db->select($query, $selectData);
            Func::dbError($result, __LINE__);

            $mas = [];
            if(!empty($result)) {
                foreach ($result as $key=>$value){
                    $mas[$key]['id'] = Func::filter_int($value['id']);
                    $mas[$key]['ordering'] = Func::filter_int($value['ordering']);
                    $mas[$key]['title'] = Func::filter_string($value['title']);
                    $mas[$key]['position'] = Func::filter_string($value['position']);
                    $mas[$key]['creater_name'] = Func::filter_string($value['creater_name']);
                    $mas[$key]['create_date'] = Func::filter_string($value['create_date']);
                    $mas[$key]['status'] = Func::filter_int($value['status']);
                }
            }
            
            return $mas;

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
                $result = $this->db->update('`cms_staff`', $updateData, "`id`={$id}");
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
            $result = $this->db->update('`cms_staff`', $updateData, "`id`={$id}");
            Func::dbError($result, __LINE__);

            return 1;
        } catch (Exception $e){
            return json_decode($e->getMessage());
        }
    }
    public function orderingItem($items) {
        try{
            foreach ($items as $key => $value) {
                $updateData = [
                    'ordering' => (int) $value,
                    'update_date' => date('Y-m-d H:i:s')
                ];
                $result = $this->db->update('`cms_staff`', $updateData, "`id`={$key}");
                Func::dbError($result, __LINE__);
            }
            return 1;
        } catch (Exception $e) {
            return json_decode($e->getMessage());
        }
    }

    /** ADD */
    public function maxOrder() {
        // get maxOrder
        try{
            $selectData = [];
            $query = "SELECT MAX(`ordering`) as `ordering` 
                        FROM `cms_staff`";
            $result = $this->db->select($query, $selectData);
            Func::dbError($result, __LINE__);

            if(!empty($result[0]['ordering'])){
                return $result[0]['ordering'];
            } else {
                return 0;
            }
        } catch (Exception $e){
            return json_decode($e->getMessage());
        }
    }
    public function createItem() {
        try{
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
            $this->form
                ->post('data_status')->val('requires')->filter('filter_int')
                ->post('data_ordering')->val('requires')->filter('filter_int')
            ;
            foreach (MFAdmin::$_langs as $key=>$value){
                $this->form->post('data_title_'.$key)->val('maxlength', 250)->filter('filter_string');
                $this->form->post('data_subtitle_'.$key)->val('maxlength', 250)->filter('filter_string');
                $this->form->post('data_position_'.$key)->filter('filter_string');
                //$this->form->post('data_text_'.$key)->filter('filter_html');
            }

            $this->form->submit();
            $data = $this->form->fetch();
//            print '<pre>';
//            print_r($data);
//            exit;
            /**
             * COMMENT END
             ************************************************************************************/

            /***********************************************************************************
             * insert
             */
            if(!empty($data)){
                $insertData = [
                    'status'=>$data['data_status'],
                    'ordering'=>$data['data_ordering'],

                    'creator_id'=>Session::get('adminId'),
                    'create_date' => date('Y-m-d H:i:s'),
                    'update_date' => date('Y-m-d H:i:s')
                ];
                $last_id = $this->db->insert('cms_staff', $insertData);
                Func::dbError($last_id, __LINE__);

                if (ctype_digit($last_id) === true) {

                    // upload photo
                    if(!empty($_FILES['data_photo']['name'])){
                        $uploadPhoto = Func::uploadPhoto($_FILES['data_photo'], $this->_menu, $last_id, Func::rund_number(), staff_width, staff_height, 1);
                        if(isset($uploadPhoto['error']) && !empty($uploadPhoto['error'])){
                            $error['headerError'] = $uploadPhoto['error'];
                            throw new Exception(json_encode($error));
                        } else {
                            $updateData = array(
                                'photo' => $uploadPhoto
                            );
                            $updateResult = $this->db->update('`cms_staff`', $updateData, "`id`={$last_id}");
                            Func::dbError($updateResult, __LINE__);
                        }
                    }

                    // insert into database
                    foreach (MFAdmin::$_langs as $key=>$value){
                        $insertData = [
                            'p_id'=>$last_id,
                            'title'=>$data['data_title_'.$key],
                            'subtitle'=>$data['data_subtitle_'.$key],
                            'position'=>$data['data_position_'.$key],
                            //'text'=>$data['data_text_'.$key],
                            'lang'=>$key
                        ];
                        $insertResult = $this->db->insert('cms_staff_text', $insertData);
                        Func::dbError($insertResult, __LINE__);
                    }
                }

                return 1;
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
                'id' => $id
            ];

            $query = "SELECT S.`id`, S.`ordering`, S.`photo`, S.`status`, T.`title`, T.`subtitle`, T.`position`, T.`lang` 
                            FROM `cms_staff` S 
                            LEFT JOIN `cms_staff_text` T ON T.p_id = S.id   
                            WHERE S.`id`=:id";
            $result = $this->db->select($query, $selectData);
            Func::dbError($result, __LINE__);

            $mas = [];
            if(!empty($result)){
                foreach ($result as $value){
                    $mas['id'] = Func::filter_int($value['id']);
                    $mas['ordering'] = Func::filter_int($value['ordering']);
                    $mas['photo'] = Func::filter_string($value['photo']);
                    $mas['status'] = Func::filter_int($value['status']);
                    $mas['title'][$value['lang']] = Func::filter_string($value['title']);
                    $mas['subtitle'][$value['lang']] = Func::filter_string($value['subtitle']);
                    $mas['position'][$value['lang']] = Func::filter_string($value['position']);
                    //$mas['text'][$value['lang']] = Func::filter_html($value['text']);
                }
                return $mas;
            } else {
                $error['headerError'] = Lang::get('{Nəticə tapılmadı}');
                throw new Exception(json_encode($error));
            }
        } catch (Exception $e){
            return json_decode($e->getMessage());
        }
    }
    public function updateItem($id) {
        try{
            // check post && csrf token
            if (sizeof($_POST)) {
                Func::csrf_token_check($_POST);
            } else {
                header('Location: ' . URL . $this->_menu . '/edit/' . $id);
                exit;
            }
//            print '<pre>';
//            print_r($_POST);
//            exit;

            /***********************************************************************************
             * post
             */
            $this->form
                ->post('data_status')->val('requires')->filter('filter_int')
                ->post('data_ordering')->val('requires')->filter('filter_int')
            ;
            foreach (MFAdmin::$_langs as $key=>$value){
                $this->form->post('data_title_'.$key)->val('maxlength', 250)->filter('filter_string');
                $this->form->post('data_subtitle_'.$key)->val('maxlength', 250)->filter('filter_string');
                $this->form->post('data_position_'.$key)->filter('filter_string');
                //$this->form->post('data_text_'.$key)->filter('filter_html');
            }

            $this->form->submit();
            $data = $this->form->fetch();

            /**
             * COMMENT END
             ************************************************************************************/


            /***********************************************************************************
             * update
             */
            if (!empty($data)){
                $updateData = [
                    'status'=>$data['data_status'],
                    'ordering'=>$data['data_ordering'],

                    'creator_id'=>Session::get('adminId'),
                    'update_date' => date('Y-m-d H:i:s')
                ];
                $result = $this->db->update('`cms_staff`', $updateData, "`id`={$id}");
                Func::dbError($result, __LINE__);

                if($result === 1){
                    // upload photo
                    if(!empty($_FILES['data_photo']['name'])){
                        $uploadPhoto = Func::uploadPhoto($_FILES['data_photo'], $this->_menu, $id, Func::rund_number(), staff_width, staff_height, 1);
                        if(isset($uploadPhoto['error']) && !empty($uploadPhoto['error'])){
                            $error['headerError'] = $uploadPhoto['error'];
                            throw new Exception(json_encode($error));
                        } else {
                            $updateData = array(
                                'photo' => $uploadPhoto
                            );
                            $updateResult = $this->db->update('`cms_staff`', $updateData, "`id`={$id}");
                            Func::dbError($updateResult, __LINE__);
                        }
                    }

                    // delete from database
                    $deleteResult = $this->db->delete('cms_staff_text',"`p_id` ={$id}");
                    Func::dbError($deleteResult, __LINE__);

                    // insert into database
                    foreach (MFAdmin::$_langs as $key=>$value){
                        $insertData = [
                            'p_id'=>$id,
                            'title'=>$data['data_title_'.$key],
                            'subtitle'=>$data['data_subtitle_'.$key],
                            'position'=>$data['data_position_'.$key],
                            //'text'=>$data['data_text_'.$key],
                            'lang'=>$key
                        ];
                        $insertResult = $this->db->insert('cms_staff_text', $insertData);
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

    /** HELPER */
    public function deletePhoto($id) {
        // delete photo
        try{
            $selectData = [
                'id' => $id
            ];
            $query = "SELECT S.`photo` 
                        FROM `cms_staff` S 
                        WHERE S.`id`=:id 
                        LIMIT 1";
            $result = $this->db->selectOne($query, $selectData);
            Func::dbError($result, __LINE__);

            if(isset($result) && !empty($result)){
                $updateData = array(
                    'photo' => ''
                );
                $updateResult = $this->db->update('`cms_staff`', $updateData, "`id` = {$id}");
                Func::dbError($updateResult, __LINE__);

                foreach ($result as $value){
                    @unlink(UPLOAD_DIR.'Image/'.$this->_menu.'/'.$value);
                }

                return 1;
            }
        } catch (Exception $e){
            return json_decode($e->getMessage());
        }
    }
}