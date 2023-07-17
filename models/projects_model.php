<?php

class Projects_Model extends Model {

    public function __construct() {
        parent::__construct();
    }

    /** list */
    public function listItems($page_position, $item_per_page) {
        try{
            $selectData = [
                'status'=>2,
                'deleted'=>2,
                'lang'=>MF::$_lang
            ];

            $query = "SELECT P.`id`, DATE_FORMAT(P.`post_date`, '".DB_DATE_FORMAT."') as `post_date`, T.`title`, T.`subtitle`, T.`text`, 
                            (
                                SELECT `thumb` 
                                FROM `cms_projects_photo` 
                                WHERE `p_id` = P.id  
                                ORDER BY `ordering`
                                LIMIT 1) as `photo`
                        FROM `cms_projects` P
                        LEFT JOIN `cms_projects_text` T ON T.`p_id` = P.`id` AND T.`lang` =:lang 
                        WHERE P.`status` = :status and P.`deleted` = :deleted 
                        ORDER BY P.`id` desc
                        LIMIT {$page_position}, {$item_per_page}";
            $result = $this->db->select($query, $selectData);
            Func::dbError($result, __LINE__);

            $mas = [];
            if(!empty($result)){
                foreach ($result as $key=>$value){
                    $mas[$key]['id'] = Func::filter_int($value['id']);
                    $mas[$key]['photo'] = Func::filter_string($value['photo']);
                    $mas[$key]['post_date'] = Func::filter_string($value['post_date']);

                    $mas[$key]['title'] = Func::filter_string($value['title']);
                    $mas[$key]['subtitle'] = Func::filter_string($value['subtitle']);
                }
            }

            return $mas;

        } catch (Exception $e){
            return json_decode($e->getMessage());
        }
    }
    public function countItems() {
        try{
            $selectData = [
                'status'=>2,
                'deleted'=>2
            ];

            $query = "SELECT count(P.`id`) as `count`  
                        FROM `cms_projects` P
                        WHERE P.`status` = :status and P.`deleted` = :deleted";
            $result = $this->db->selectCount($query, $selectData);
            Func::dbError($result, __LINE__);

            if(isset($result) && !empty($result)) {
                return Func::filter_int($result);
            } else {
                return 0;
            }
        } catch (Exception $e) {
            return json_decode($e->getMessage());
        }
    }

    /** One Items */
    public function viewItems($id) {
        try{
            $selectData = [
                'id'=>$id,
                'status'=>2,
                'deleted'=>2,
                'lang'=>MF::$_lang
            ];

            $query = "SELECT P.`id`, DATE_FORMAT(P.`post_date`, '".DB_DATE_FORMAT."') as `post_date`, T.`title`, T.`subtitle`, T.`text` 
                        FROM `cms_projects` P
                        LEFT JOIN `cms_projects_text` T ON T.`p_id` = P.`id` AND T.`lang` =:lang 
                        WHERE P.`id` = :id and P.`status` = :status and P.`deleted` = :deleted 
                        LIMIT 1";
            $result = $this->db->selectOne($query, $selectData);
            Func::dbError($result, __LINE__);

            $mas = [];
            if(!empty($result)){
                $mas['id'] = Func::filter_int($result['id']);
                $mas['post_date'] = Func::filter_string($result['post_date']);

                $mas['title'] = Func::filter_string($result['title']);
                $mas['subtitle'] = Func::filter_string($result['subtitle']);
                $mas['text'] = Func::filter_html($result['text']);


                /**
                 * photos
                 */
                $selectData1 = [
                    'id'=>$mas['id'],
                ];

                $query1 = "SELECT P.`thumb`, P.`photo` 
                            FROM `cms_projects_photo` P
                            WHERE P.`p_id` = :id 
                            ORDER BY P.`ordering`";
                $result1 = $this->db->select($query1, $selectData1);
                Func::dbError($result1, __LINE__);

                if(!empty($result1)){
                    foreach ($result1 as $k=>$v){
                        $mas['photos'][$k]['thumb'] = $v['thumb'];
                        $mas['photos'][$k]['photo'] = $v['photo'];
                    }
                }
            }

            return $mas;

        } catch (Exception $e){
            return json_decode($e->getMessage());
        }
    }
}