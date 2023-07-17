<?php

class Model {
    function __construct() {
        $this->db = new Database(DB_TYPE, DB_HOST, DB_NAME, DB_USER, DB_PASS);
        $this->form = new Form();
    }

    /** TOP MENU FIRST */
    public function menuHeader() {
        try{
            $selectData = [
                'parent'=>'1',
                'status'=>'2',
                'deleted'=>'2',
                'lang'=>MF::$_lang
            ];
            $query = "SELECT P.`id`, P.`parent`, P.`static_page`, P.`target`, T.`title`, T.`slug`, T.`link`, T.`lang` 
                            FROM `cms_pages` P
                            LEFT JOIN `cms_pages_text` T ON T.p_id = P.id and T.lang =:lang 
                            WHERE `status`=:status and `deleted`=:deleted and `parent`=:parent
                            ORDER BY P.`ordering`";
            $result = $this->db->select($query, $selectData);

            if(!empty($result)){

                $mas = $result;

                foreach ($result as $key=>$value){
                    $selectData1 = [
                        'parent'=>Func::filter_int($value['id']),
                        'status'=>'2',
                        'deleted'=>'2',
                        'lang'=>MF::$_lang
                    ];
                    $query1 = "SELECT P.`id`, P.`parent`, P.`static_page`, P.`target`, T.`title`, T.`slug`, T.`link`, T.`lang` 
                                FROM `cms_pages` P
                                LEFT JOIN `cms_pages_text` T ON T.p_id = P.id and T.lang =:lang 
                                WHERE `status`=:status and `deleted`=:deleted and `parent`=:parent
                                ORDER BY P.`ordering`";
                    $result1 = $this->db->select($query1, $selectData1);
                    $mas[$key]['sub'] = $result1;
                }

                return Func::filter_array($mas);
            } else {
                return [];
            }

        } catch (Exception $e){
            return json_decode($e->getMessage());
        }
    }
    public function menuFooter() {
        try{
            $selectData = [
                'status'=>'2',
                'deleted'=>'2',
                'lang'=>MF::$_lang
            ];
            $query = "SELECT P.`id`, P.`parent`, P.`static_page`, P.`target`, T.`title`, T.`slug`, T.`link`, T.`lang` 
                            FROM `cms_pages` P
                            LEFT JOIN `cms_pages_text` T ON T.p_id = P.id and T.lang =:lang 
                            WHERE `status`=:status and `deleted`=:deleted and `parent`!='0' and `link`!='#'
                            ORDER BY P.`ordering`";
            $result = $this->db->select($query, $selectData);

            if(!empty($result)){

                $mas = $result;

                return Func::filter_array($mas);
            } else {
                return [];
            }

        } catch (Exception $e){
            return json_decode($e->getMessage());
        }
    }

    /** SETTINGS */
    public function settingsList() {
        try{
            $selectData = [
                'deleted'=>'2',
                'status'=>'2',
                'lang'=>MF::$_lang
            ];
            $query = "SELECT P.`id`, T.`text`  
                            FROM `cms_settings` P
                            INNER JOIN `cms_settings_text` T ON T.p_id = P.id and T.lang = :lang 
                            WHERE P.`deleted`= :deleted and P.`status`= :status
                            ORDER BY `id`";
            $result = $this->db->select($query, $selectData);
            Func::dbError($result, __LINE__);

            if(!empty($result)){
                $mas = [];
                foreach ($result as $value){
                    $mas[$value['id']] = Func::filter_string($value['text']);
                }
                return $mas;
            }
        } catch (Exception $e){
            return json_decode($e->getMessage());
        }
    }

    /** PARTNERS */
    public function partnersList() {
        try{
            $selectData = [
                'deleted'=>'2',
                'status'=>'2',
                'lang'=>MF::$_lang
            ];
            $query = "SELECT P.`id`, P.`photo`, T.`title`, T.`link`  
                            FROM `cms_partners` P
                            INNER JOIN `cms_partners_text` T ON T.p_id = P.id and T.lang = :lang 
                            WHERE P.`deleted`= :deleted and P.`status`= :status
                            ORDER BY `ordering`, `id`";
            $result = $this->db->select($query, $selectData);
            Func::dbError($result, __LINE__);

            if(!empty($result)){
                $mas = [];
                foreach ($result as $key=>$value){
                    $mas[$key]['id'] = Func::filter_string($value['id']);
                    $mas[$key]['photo'] = Func::filter_string($value['photo']);
                    $mas[$key]['title'] = Func::filter_string($value['title']);
                    $mas[$key]['link'] = Func::filter_string($value['link']);
                }
                return $mas;
            }
        } catch (Exception $e){
            return json_decode($e->getMessage());
        }
    }

    /** VIEW PAGE */
    public function viewPageById($id = 0) {
        try{
            $selectData = [
                'id' => $id,
                'deleted' => '2',
                'status' => '2',
                'lang' => MF::$_lang
            ];
            $query = "SELECT P.`id`, P.`parent`, T.`title`, T.`subtitle`, T.`text` 
                        FROM `cms_pages` P
                        LEFT JOIN `cms_pages_text` T ON T.p_id = P.id and T.`lang`= :lang  
                        WHERE P.`id`= :id and P.`deleted`= :deleted and P.`status`= :status 
                        LIMIT 1";
            $result = $this->db->selectOne($query, $selectData);
            Func::dbError($result, __LINE__);

            if(!empty($result)){
                $result['id'] = (int) $result['id'];
                $result['parent'] = (int) $result['parent'];
                $result['title'] = Func::filter_string($result['title']);
                $result['subtitle'] = Func::filter_string($result['subtitle']);
                $result['text'] = Func::filter_html($result['text']);
                return $result;
            } else {
                return [];
            }

        } catch (Exception $e){
            return json_decode($e->getMessage());
        }
    }
    public function viewPageBySlug($slug = '') {
        try{
            $selectData = [
                'slug' => $slug,
                'deleted' => '2',
                'status' => '2',
                'lang' => MF::$_lang
            ];
            $query = "SELECT P.`id`, P.`parent`, T.`title`, T.`subtitle`, T.`text` 
                        FROM `cms_pages` P
                        LEFT JOIN `cms_pages_text` T ON T.p_id = P.id and T.`lang`= :lang  
                        WHERE T.`slug`= :slug and P.`deleted`= :deleted and P.`status`= :status 
                        LIMIT 1";
            $result = $this->db->selectOne($query, $selectData);
            Func::dbError($result, __LINE__);

            $mas = [];
            if(!empty($result)){
                $mas['id'] = Func::filter_int($result['id']);
                $mas['parent'] = Func::filter_int($result['parent']);
                $mas['title'] = Func::filter_string($result['title']);
                $mas['subtitle'] = Func::filter_string($result['subtitle']);
                $mas['text'] = Func::filter_html($result['text']);
            }

            return $mas;

        } catch (Exception $e){
            return json_decode($e->getMessage());
        }
    }
}