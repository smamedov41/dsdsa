<?php

class Certificates_Model extends Model {

    public function __construct() {
        parent::__construct();

        $this->_menu = 'certificates';
    }

    /** LIST */
    public function listItems() {
        try{
            $selectData = [
                'deleted'=>'2',
                'lang'=>MFAdmin::$_lang
            ];
            $query = "SELECT P.`id`, PT.`title`, A.`name` as `creater_name`, P.`create_date`, P.`status`  
                        FROM `cms_certificates` P
                        LEFT JOIN `cms_certificates_text` PT ON PT.`p_id` = P.`id` and PT.lang=:lang  
                        LEFT JOIN `cms_admins` A ON A.`id` = P.`creator_id` 
                        WHERE P.`deleted`=:deleted
                        ORDER BY P.`id` desc";
            $result = $this->db->select($query, $selectData);
            Func::dbError($result, __LINE__);

            $mas = [];
            if(!empty($result)) {
                foreach ($result as $key=>$value){
                    $mas[$key]['id'] = Func::filter_int($value['id']);
                    $mas[$key]['title'] = Func::filter_string($value['title']);
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
                $result = $this->db->update('`cms_certificates`', $updateData, "`id`={$id}");
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
            $result = $this->db->update('`cms_certificates`', $updateData, "`id`={$id}");
            Func::dbError($result, __LINE__);

            return 1;
        } catch (Exception $e){
            return json_decode($e->getMessage());
        }
    }

    /** ADD */
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
                ->post('sid')->val('requires')->filter('filter_string')
                ->post('data_status')->val('requires')->filter('filter_int')
            ;
            foreach (MFAdmin::$_langs as $key=>$value){
                $this->form->post('data_title_'.$key)->val('maxlength', 250)->filter('filter_string');
                $this->form->post('data_text_'.$key)->filter('filter_html');
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
                    'secret_id'=>$data['sid'],
                    'status'=>$data['data_status'],

                    'creator_id'=>Session::get('adminId'),
                    'create_date' => date('Y-m-d H:i:s'),
                    'update_date' => date('Y-m-d H:i:s')
                ];
                $last_id = $this->db->insert('cms_certificates', $insertData);
                Func::dbError($last_id, __LINE__);

                if (ctype_digit($last_id) === true) {

                    $updateData = array(
                        'p_id' => $last_id
                    );
                    $updateResult = $this->db->update('`cms_certificates_photo`', $updateData, "`secret_id`='{$data['sid']}'");
                    Func::dbError($updateResult, __LINE__);

                    // insert into database
                    foreach (MFAdmin::$_langs as $key=>$value){
                        $insertData = [
                            'p_id'=>$last_id,
                            'title'=>$data['data_title_'.$key],
                            'text'=>$data['data_text_'.$key],
                            'lang'=>$key
                        ];
                        $insertResult = $this->db->insert('cms_certificates_text', $insertData);
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

            $query = "SELECT S.`id`, S.`secret_id`, S.`status`, T.`title`, T.`text`, T.`lang` 
                            FROM `cms_certificates` S 
                            LEFT JOIN `cms_certificates_text` T ON T.p_id = S.id   
                            WHERE S.`id`=:id";
            $result = $this->db->select($query, $selectData);
            Func::dbError($result, __LINE__);

            $mas = [];
            if(!empty($result)){
                foreach ($result as $value){
                    $mas['id'] = Func::filter_int($value['id']);
                    $mas['secret_id'] = Func::filter_string($value['secret_id']);
                    $mas['status'] = Func::filter_int($value['status']);
                    $mas['title'][$value['lang']] = Func::filter_string($value['title']);
                    $mas['text'][$value['lang']] = Func::filter_html($value['text']);
                }

                $selectData1 = [
                    'p_id' => $mas['id']
                ];
                $query1 = "SELECT `id`,  `thumb`,  `secret_id` FROM `cms_certificates_photo` S WHERE S.`p_id`=:p_id ORDER BY `ordering`";
                $result1 = $this->db->select($query1, $selectData1);
                Func::dbError($result1, __LINE__);

                foreach ($result1 as $key => $value) {
                    $mas['photo'][$key]['id'] = Func::filter_int($value['id']);
                    $mas['photo'][$key]['thumb'] = Func::filter_string($value['thumb']);
                    $mas['photo'][$key]['secret_id'] = Func::filter_string($value['secret_id']);
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
                ->post('sid')->val('requires')->filter('filter_string')
                ->post('data_status')->val('requires')->filter('filter_int')
            ;
            foreach (MFAdmin::$_langs as $key=>$value){
                $this->form->post('data_title_'.$key)->val('maxlength', 250)->filter('filter_string');
                $this->form->post('data_text_'.$key)->filter('filter_html');
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

                    'creator_id'=>Session::get('adminId'),
                    'update_date' => date('Y-m-d H:i:s')
                ];
                $result = $this->db->update('`cms_certificates`', $updateData, "`id`={$id}");
                Func::dbError($result, __LINE__);

                if($result === 1){
                    // update photo gallery p_id
                    $updateData = array(
                        'p_id' => $id
                    );
                    $updateResult = $this->db->update('`cms_certificates_photo`', $updateData, "`secret_id`='{$data['sid']}'");
                    Func::dbError($updateResult, __LINE__);

                    // delete from database
                    $deleteResult = $this->db->delete('cms_certificates_text',"`p_id` ={$id}");
                    Func::dbError($deleteResult, __LINE__);

                    // insert into database
                    foreach (MFAdmin::$_langs as $key=>$value){
                        $insertData = [
                            'p_id'=>$id,
                            'title'=>$data['data_title_'.$key],
                            'text'=>$data['data_text_'.$key],
                            'lang'=>$key
                        ];
                        $insertResult = $this->db->insert('cms_certificates_text', $insertData);
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
    public function uploadPhoto(){
        try{
            if(!empty($_FILES['file']) && isset($_POST['sid']) && $_POST['sid']!='undefined'){

                /***********************************
                 * DELETE NOT UPLAODED TRUE
                 ***********************************/
                $selectData = [
                    'p_id' => '0'
                ];
                $query = "SELECT `thumb`, `photo` FROM `cms_certificates_photo` WHERE `p_id`= :p_id and date(`create_date`) < CURDATE()";
                $result = $this->db->select($query, $selectData);
                Func::dbError($result, __LINE__);

                if(!empty($result)){
                    foreach ($result as $value){
                        @unlink(UPLOAD_DIR . 'Image/'.$this->_menu.'/' . $value['thumb']);
                        @unlink(UPLOAD_DIR . 'Image/'.$this->_menu.'/' . $value['photo']);
                    }

                    $resultDelete = $this->db->delete("`cms_certificates_photo`", "`p_id`='0' and date(`create_date`) < CURDATE()");
                    Func::dbError($resultDelete, __LINE__);
                }
                /***********************************
                 * DELETE NOT UPLAODED TRUE (END)
                 ***********************************/

                $sid = isset($_POST['sid'])?Func::filter_string($_POST['sid']):'';
                if(!$sid){
                    throw new Exception(json_encode(['uploadError'=>'Not found sid']));
                }

                /***********************************
                 * ORDERING
                 ***********************************/
                $x=1; // $x for ordering
                $selectData = [
                    'secret_id' => $sid
                ];
                $query = "SELECT `ordering` FROM `cms_certificates_photo` WHERE `secret_id`= :secret_id ORDER BY `ordering` desc LIMIT 1";
                $result = $this->db->selectOne($query, $selectData);
                Func::dbError($result, __LINE__);
                if(isset($result['ordering'])){
                    $x = $result['ordering'] + 1;
                }
                /***********************************
                 * ORDERING (END)
                 ***********************************/

                $files = array();
                foreach ($_FILES['file'] as $k => $l) {
                    foreach ($l as $i => $v) {
                        if (!array_key_exists($i, $files))
                            $files[$i] = array();
                        $files[$i][$k] = $v;
                    }
                }

                $uploaded = array();
                $allowed = array('jpg', 'png', 'jpeg', 'gif');
                $allowedContentType = array('image/jpeg', 'image/gif', 'image/png');

                $succeeded = array();
                $failed = array();
                @include(__DIR__.'../../helper/class.upload.php');

                foreach ($files as $file) {

                    if($file['error'] === 0){
                        // check file
                        $temp = $file['tmp_name'];
                        $imageinfo = getimagesize($temp); // mime-type
                        $ext = explode('.', $file['name']);
                        $ext = strtolower(end($ext));


                        if (in_array($ext, $allowed)) {
                            if ($file['size']<=4194304) {
                                if (in_array($file['type'], $allowedContentType)) {
                                    if (in_array($imageinfo['mime'], $allowedContentType)) {

                                        $fileName = md5_file($temp). time();
                                        $thumb = $fileName. '-thumb.'.$ext;
                                        $thumb1 = $fileName . '-thumb';
                                        $photo = $fileName . '-photo.'.$ext;
                                        $photo1 = $fileName . '-photo';

                                        // upload image
                                        $handle = new upload($file);
                                        if ($handle->uploaded) {
                                            // photo
                                            $handle->file_new_name_body = $photo1;
                                            $handle->file_overwrite     = true;
                                            $handle->allowed            = array('image/*');
                                            $handle->image_resize       = true;
                                            //$handle->image_watermark    = _imgdir_.'logo1.png';
                                            //$handle->image_watermark_x  = 20;
                                            //$handle->image_watermark_y  = 20;
                                            $handle->image_x            = certificates_width;
                                            $handle->image_ratio_y      = certificates_height;
                                            $handle->dir_chmod          = 0777;
                                            $handle->process(UPLOAD_DIR . 'Image/'.$this->_menu.'/');

                                            // thummb
                                            $handle->file_new_name_body = $thumb1;
                                            $handle->file_overwrite     = true;
                                            $handle->allowed            = array('image/*');
                                            $handle->image_resize       = true;
                                            $handle->image_ratio_crop   = true;
                                            $handle->image_x            = certificates_thumb_width;
                                            $handle->image_y            = certificates_thumb_height;
                                            $handle->dir_chmod          = 0777;
                                            $handle->process(UPLOAD_DIR . 'Image/'.$this->_menu.'/');
                                            if ($handle->processed) {
                                                $handle->clean();
                                            }
                                        }

                                        $insertData = [
                                            'secret_id'=> $sid,
                                            'ordering'=> $x,
                                            'thumb'=> $thumb,
                                            'photo' => $photo,
                                            'create_date' => date('Y-m-d H:i:s')
                                        ];
                                        $last_id = $this->db->insert('cms_certificates_photo', $insertData);
                                        Func::dbError($last_id, __LINE__);

                                        if(isset($last_id) && $last_id>0){
                                            $succeeded[] = array(
                                                'id'=>$last_id,
                                                'name'=>$file['name'],
                                                'file'=>$thumb
                                            );
                                        }
                                    }
                                }
                            } else {
                                $failed[] = array(
                                    'name'=>$file['name'].' '.Lang::get('{şəkilin çəkisi böyükdür}')
                                );
                            }
                        } else {
                            $failed[] = array(
                                'name'=>$file['name'].' '.Lang::get('{fayl şəkil formatında deyil}')
                            );
                        }

                    }
                    $x++;
                    unset($handle);
                }

                if(!empty($_POST['ajax'])){
                    echo json_encode(array(
                        'succeeded'=>$succeeded,
                        'failed'=>$failed
                    ));
                }
            }

        } catch (Exception $e){
            return json_decode($e->getMessage());
        }
    }
    public function photoDelete($id, $sec_id) {
        // delete photo
        try{
            $selectData = [
                'id' => $id,
                'secret_id' => $sec_id
            ];
            $query = "SELECT S.`photo`,S.`thumb`  
                        FROM `cms_certificates_photo` S 
                        WHERE S.`id`=:id and S.`secret_id`= :secret_id
                        LIMIT 1";
            $result = $this->db->selectOne($query, $selectData);
            Func::dbError($result, __LINE__);

            if(isset($result) && !empty($result)){
                $updateResult = $this->db->delete('`cms_certificates_photo`', "`id` = '{$id}' and `secret_id`='{$sec_id}'");
                Func::dbError($updateResult, __LINE__);

                if(file_exists(UPLOAD_DIR.'Image/'.$this->_menu.'/'.$result['photo'])){
                    @unlink(UPLOAD_DIR.'Image/'.$this->_menu.'/'.$result['photo']);
                    @unlink(UPLOAD_DIR.'Image/'.$this->_menu.'/'.$result['thumb']);
                }

                return 1;
            }
        } catch (Exception $e){
            return json_decode($e->getMessage());
        }
    }
    public function orderPhoto() {
        // delete photo
        try{
            if(isset($_POST['action']) && $_POST['action'] = 'updateRecordsListings'){
                $ordering = 1;

                foreach ($_POST['recordsArray'] as $recordIDValue) {
                    $recordIDValue = ($recordIDValue)?Func::filter_int($recordIDValue):0;

                    $updateData = [
                        'ordering'=>$ordering,
                    ];
                    $result = $this->db->update('`cms_certificates_photo`', $updateData, "`id`={$recordIDValue}");
                    Func::dbError($result, __LINE__);
                    $ordering++;
                }
            }
        } catch (Exception $e){
            return json_decode($e->getMessage());
        }
    }
}