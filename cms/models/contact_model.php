<?php

class Contact_Model extends Model {

    public function __construct() {
        parent::__construct();

        $this->_menu = 'contact';
    }

    /** LIST */
    public function listItems() {
        try{
            $selectData = [
                'deleted'=>'2'
            ];
            $query = "SELECT P.`id`, P.`name`, P.`email`, P.`msg`, P.`create_date`  
                        FROM `cms_contact` P
                        WHERE P.`deleted`=:deleted
                        ORDER BY P.`id` desc";
            $result = $this->db->select($query, $selectData);
            Func::dbError($result, __LINE__);

            $mas = [];
            if(!empty($result)) {
                foreach ($result as $key=>$value){
                    $mas[$key]['id'] = Func::filter_int($value['id']);
                    $mas[$key]['name'] = Func::filter_string($value['name']);
                    $mas[$key]['email'] = Func::filter_string($value['email']);
                    $mas[$key]['msg'] = Func::filter_string($value['msg']);
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

            $updateData = array(
                'deleted' => '1'
            );
            $result = $this->db->update('`cms_contact`', $updateData, "`id`={$id}");
            Func::dbError($result, __LINE__);

            return 1;
        } catch (Exception $e){
            return json_decode($e->getMessage());
        }
    }
}