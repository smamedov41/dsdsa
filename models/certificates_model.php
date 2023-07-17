<?php

class Certificates_Model extends Model {

    public function __construct() {
        parent::__construct();
    }

    /** Certificates list */
    public function listItems() {
        try{
            $selectData = [
                'status'=>2,
                'deleted'=>2,
                'lang'=>MF::$_lang
            ];

            $query = "SELECT P.`id`, T.`title`, T.`text`  
                        FROM `cms_certificates` P
                        LEFT JOIN `cms_certificates_text` T ON T.`p_id` = P.`id` AND T.`lang` =:lang 
                        WHERE P.`status` = :status and P.`deleted` = :deleted";
            $result = $this->db->select($query, $selectData);
            Func::dbError($result, __LINE__);

            $mas = [];
            if(!empty($result)){
                foreach ($result as $key=>$value){
                    $mas[$key]['id'] = Func::filter_int($value['id']);
                    $mas[$key]['title'] = Func::filter_string($value['title']);
                    $mas[$key]['text'] = Func::filter_html($value['text']);


                    /**
                     * photos
                     */
                    $selectData1 = [
                        'id'=>$value['id'],
                    ];

                    $query1 = "SELECT P.`thumb`, P.`photo` 
                                    FROM `cms_certificates_photo` P
                                    WHERE P.`p_id` = :id 
                                    ORDER BY P.`ordering`";
                    $result1 = $this->db->select($query1, $selectData1);
                    Func::dbError($result1, __LINE__);

                    if(!empty($result1)){
                        foreach ($result1 as $k=>$v){
                            $mas[$key]['photos'][$k]['thumb'] = $v['thumb'];
                            $mas[$key]['photos'][$k]['photo'] = $v['photo'];
                        }
                    }
                }
            }

            return $mas;

        } catch (Exception $e){
            return json_decode($e->getMessage());
        }
    }
}