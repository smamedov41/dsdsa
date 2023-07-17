<?php

class Cv_Model extends Model {

    public function __construct() {
        parent::__construct();

        $this->_menu = 'cv';
    }

    /** LIST */
    public function listItems() {
        try{
            $selectData = [
                'deleted'=>'2'
            ];
            $query = "SELECT P.`id`, CONCAT(P.`name`, ' ', P.`surname`, ' ', P.`father`) as `fio`, P.`birthday`, P.`mob_phone`, P.`email`, P.`photo`, P.`cv_file`, P.`create_date`  
                        FROM `cms_cv` P
                        WHERE P.`deleted`=:deleted
                        ORDER BY P.`id` desc";
            $result = $this->db->select($query, $selectData);
            Func::dbError($result, __LINE__);

            $mas = [];
            if(!empty($result)) {
                foreach ($result as $key=>$value){
                    $mas[$key]['id'] = Func::filter_int($value['id']);
                    $mas[$key]['fio'] = Func::filter_string($value['fio']);
                    $mas[$key]['birthday'] = Func::filter_string($value['birthday']);
                    $mas[$key]['mob_phone'] = Func::filter_string($value['mob_phone']);
                    $mas[$key]['email'] = Func::filter_string($value['email']);
                    $mas[$key]['photo'] = Func::filter_string($value['photo']);
                    $mas[$key]['cv_file'] = Func::filter_string($value['cv_file']);
                    $mas[$key]['create_date'] = Func::filter_string($value['create_date']);
                }
            }
            
            return $mas;

        } catch (Exception $e){
            return json_decode($e->getMessage());
        }
    }
    public function deleteItem($id) {
        // delete items
        try{
            $this->deletePhoto($id);

            $updateData = array(
                'deleted' => '1'
            );
            $result = $this->db->update('`cms_cv`', $updateData, "`id`={$id}");
            Func::dbError($result, __LINE__);

            return 1;
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
            $query = "SELECT S.`photo`, S.`cv_file`
                        FROM `cms_cv` S 
                        WHERE S.`id`=:id 
                        LIMIT 1";
            $result = $this->db->selectOne($query, $selectData);
            Func::dbError($result, __LINE__);

            if(isset($result) && !empty($result)){
//                $updateData = array(
//                    'photo' => '',
//                    'cv_file' => ''
//                );
//                $updateResult = $this->db->update('`cms_cv`', $updateData, "`id` = {$id}");
//                Func::dbError($updateResult, __LINE__);

                $deleted_img = UPLOAD_DIR.'CV/'.$result['photo'];
                $deleted_cv = UPLOAD_DIR.'CV/'.$result['cv_file'];
                if (file_exists($deleted_img)) {
                    @unlink($deleted_img);
                }
                if (file_exists($deleted_cv)) {
                    @unlink($deleted_cv);
                }

                return 1;
            }
        } catch (Exception $e){
            return json_decode($e->getMessage());
        }
    }
}