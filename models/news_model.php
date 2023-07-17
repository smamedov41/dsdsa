<?php

class News_Model extends Model {

    public function __construct() {
        parent::__construct();
    }

    /** News list */
    public function listNews($page_position, $item_per_page) {
        try{
            $selectData = [
                'status'=>2,
                'deleted'=>2,
                'lang'=>MF::$_lang
            ];

            $query = "SELECT P.`id`, P.`photo`, DATE_FORMAT(P.`post_date`, '".DB_DATE_FORMAT."') as `post_date`, T.`title`, T.`subtitle`  
                        FROM `cms_posts` P
                        LEFT JOIN `cms_posts_text` T ON T.`p_id` = P.`id` AND T.`lang` =:lang 
                        WHERE P.`status` = :status and P.`deleted` = :deleted 
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
    public function countNews() {
        try{
            $selectData = [
                'status'=>2,
                'deleted'=>2
            ];

            $query = "SELECT count(P.`id`) as `count`  
                        FROM `cms_posts` P
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

    /** One News */
    public function viewNews($id) {
        try{
            $selectData = [
                'id'=>$id,
                'status'=>2,
                'deleted'=>2,
                'lang'=>MF::$_lang
            ];

            $query = "SELECT P.`id`, P.`photo`, DATE_FORMAT(P.`post_date`, '".DB_DATE_FORMAT."') as `post_date`, T.`title`, T.`subtitle`, T.`text` 
                        FROM `cms_posts` P
                        LEFT JOIN `cms_posts_text` T ON T.`p_id` = P.`id` AND T.`lang` =:lang 
                        WHERE P.`id` = :id and P.`status` = :status and P.`deleted` = :deleted 
                        LIMIT 1";
            $result = $this->db->selectOne($query, $selectData);
            Func::dbError($result, __LINE__);

            $mas = [];
            if(!empty($result)){
                $mas['id'] = Func::filter_int($result['id']);
                $mas['photo'] = Func::filter_string($result['photo']);
                $mas['post_date'] = Func::filter_string($result['post_date']);

                $mas['title'] = Func::filter_string($result['title']);
                $mas['subtitle'] = Func::filter_string($result['subtitle']);
                $mas['text'] = Func::filter_html($result['text']);
            }

            return $mas;

        } catch (Exception $e){
            return json_decode($e->getMessage());
        }
    }

    /** Project list */
    public function projectsList() {
        try{
            $selectData = [
                'status'=>2,
                'deleted'=>2,
                'lang'=>MF::$_lang
            ];

            $query = "SELECT P.`id`, T.`title`, T.`subtitle`,  
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
                        LIMIT 0,5";
            $result = $this->db->select($query, $selectData);
            Func::dbError($result, __LINE__);

            $mas = [];
            if(!empty($result)){
                foreach ($result as $key=>$value){
                    $mas[$key]['id'] = Func::filter_int($value['id']);
                    $mas[$key]['photo'] = Func::filter_string($value['photo']);
                    $mas[$key]['title'] = Func::filter_string($value['title']);
                }
            }

            return $mas;

        } catch (Exception $e){
            return json_decode($e->getMessage());
        }
    }
}