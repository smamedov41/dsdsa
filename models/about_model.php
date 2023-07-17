<?php

class About_Model extends Model {

    public function __construct() {
        parent::__construct();
    }

    /** Staff list */
    public function listStaff() {
        try{
            $selectData = [
                'status'=>2,
                'deleted'=>2,
                'lang'=>MF::$_lang
            ];

            $query = "SELECT P.`id`, P.`photo`, T.`title`, T.`subtitle`, T.`position` 
                        FROM `cms_staff` P
                        LEFT JOIN `cms_staff_text` T ON T.`p_id` = P.`id` AND T.`lang` =:lang 
                        WHERE P.`status` = :status and P.`deleted` = :deleted 
                        ORDER BY `ordering`
                        LIMIT 0, 20";
            $result = $this->db->select($query, $selectData);
            Func::dbError($result, __LINE__);

            $mas = [];
            if(!empty($result)){
                foreach ($result as $key=>$value) {
                    $mas[$key]['id'] = Func::filter_int($value['id']);
                    $mas[$key]['title'] = Func::filter_string($value['title']);
                    $mas[$key]['position'] = Func::filter_string($value['position']);
                    $mas[$key]['photo'] = Func::filter_string($value['photo']);
                }
            }

            return $mas;

        } catch (Exception $e){
            return json_decode($e->getMessage());
        }
    }
}