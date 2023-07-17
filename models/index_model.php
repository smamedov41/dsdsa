<?php

class Index_Model extends Model {

    public function __construct() {
        parent::__construct();
    }

    /** Slider list */
    public function listSlider() {
        try{
            $selectData = [
                'status'=>2,
                'deleted'=>2,
                'lang'=>MF::$_lang
            ];

            $query = "SELECT P.`id`, P.`photo`, T.`title`, T.`subtitle`, T.`link` 
                        FROM `cms_slider` P
                        LEFT JOIN `cms_slider_text` T ON T.`p_id` = P.`id` AND T.`lang` =:lang 
                        WHERE P.`status` = :status and P.`deleted` = :deleted 
                        ORDER BY `ordering` 
                        LIMIT 0, 5";
            $result = $this->db->select($query, $selectData);
            Func::dbError($result, __LINE__);

            $mas = [];
            if(!empty($result)){
                foreach ($result as $key=>$value) {
                    $mas[$key]['id'] = Func::filter_int($value['id']);
                    $mas[$key]['title'] = Func::filter_string($value['title']);
                    $mas[$key]['subtitle'] = Func::filter_string($value['subtitle']);
                    $mas[$key]['link'] = Func::filter_string($value['link']);
                    $mas[$key]['photo'] = Func::filter_string($value['photo']);
                }
            }

            return $mas;

        } catch (Exception $e){
            return json_decode($e->getMessage());
        }
    }

    /** Projects list */
    public function listProjects() {
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
                        LIMIT 0, 12";
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

    /** News list */
    public function listNews() {
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
                        ORDER BY P.`id` desc
                        LIMIT 0, 3";
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