<?php

class Pages_Model extends Model {

    public function __construct() {
        parent::__construct();

        $this->_menu = 'pages';
    }

    /** LIST */
    public function listItems($select = false) {
        try{
            $where = "";
            $selectData = [
                'deleted'=>2,
                'lang'=>MFAdmin::$_lang
            ];
            if($select){
                $selectData['status'] = 2;
                $where .= " and P.`status`=:status";
            }

            $query = "SELECT P.`id`, P.`parent`, P.`static_page`, PT.`title`, PT.`text`, P.`ordering`, A.`name` as `creater_name`, P.`create_date`, P.`status` 
                        FROM `cms_pages` P
                        LEFT JOIN `cms_pages_text` PT ON PT.`p_id` = P.`id` and PT.lang=:lang 
                        LEFT JOIN `cms_admins` A ON A.`id` = P.`creator_id` 
                        WHERE P.`deleted`=:deleted {$where}
                        ORDER BY `ordering`";
            $result = $this->db->select($query, $selectData);
            Func::dbError($result, __LINE__);

            $menuData = array(
                'items' => array(),
                'parents' => array()
            );
            if(!empty($result)) {
                foreach ($result as $key=>$value){
                    $mas[$key]['id'] = Func::filter_int($value['id']);
                    $mas[$key]['parent'] = Func::filter_int($value['parent']);
                    $mas[$key]['static_page'] = Func::filter_int($value['static_page']);
                    $mas[$key]['title'] = Func::filter_string($value['title']);
                    $mas[$key]['text'] = Func::filter_html($value['text']);
                    $mas[$key]['ordering'] = Func::filter_int($value['ordering']);
                    $mas[$key]['creater_name'] = Func::filter_string($value['creater_name']);
                    $mas[$key]['create_date'] = Func::filter_string($value['create_date']);
                    $mas[$key]['status'] = Func::filter_int($value['status']);
                }

                foreach ($mas as $value) {
                    $menuData['items'][$value['id']] = $value;
                    $menuData['parents'][$value['parent']][] = $value['id'];
                }
            }
            return $menuData;

        } catch (Exception $e){
            return json_decode($e->getMessage());
        }
    }
    public function listItemsAll($select = false) {
        try{
            $where = "";
            $selectData = [
                'deleted'=>2,
                'lang'=>MFAdmin::$_lang
            ];
            if($select){
                $selectData['status'] = 2;
                $where .= " and P.`status`=:status";
            }

            $query = "SELECT 
                            P.`id`, P.`parent`, P.`static_page`, P.`ordering`, P.`create_date`, P.`status`, 
                            PT.`title`, PT.`slug`, PT.`link`,  
                            A.`name` as `creater_name` 
                        FROM `cms_pages` P
                        LEFT JOIN `cms_pages_text` PT ON PT.`p_id` = P.`id` and PT.lang=:lang  
                        LEFT JOIN `cms_admins` A ON A.`id` = P.`creator_id` 
                        WHERE P.`deleted`=:deleted {$where}
                        ORDER BY `ordering`, `parent`";
            $result = $this->db->select($query, $selectData);
            Func::dbError($result, __LINE__);

            $mas = [];
            if(!empty($result)) {
                foreach ($result as $key=>$value){
                    $mas[$key]['id'] = Func::filter_int($value['id']);
                    $mas[$key]['parent'] = Func::filter_int($value['parent']);
                    $mas[$key]['static_page'] = Func::filter_int($value['static_page']);
                    $mas[$key]['ordering'] = Func::filter_int($value['ordering']);
                    $mas[$key]['status'] = Func::filter_int($value['status']);
                    $mas[$key]['create_date'] = Func::filter_string($value['create_date']);

                    $mas[$key]['title'] = Func::filter_string($value['title']);
                    $mas[$key]['slug'] = Func::filter_string($value['slug']);
                    $mas[$key]['link'] = Func::filter_string($value['link']);

                    $mas[$key]['creater_name'] = Func::filter_string($value['creater_name']);
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
                $result = $this->db->update('`cms_pages`', $updateData, "`id`={$id}");
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
            $result = $this->db->update('`cms_pages`', $updateData, "`id`={$id}");
            Func::dbError($result, __LINE__);

            return 1;
        } catch (Exception $e){
            return json_decode($e->getMessage());
        }
    }
    public function orderingItem($mas = [], $parent = 0) {
        // update ordering
        try{

            if(isset($mas) && !empty($mas)){
                $x=1;
                foreach ($mas as $value){
                    $id = ($value['id'])?Func::filter_int($value['id']):0;
                    if($id) {
                        $updateData = [
                            'parent' => $parent,
                            'ordering' => $x
                        ];
                        $result = $this->db->update('`cms_pages`', $updateData, "`id`={$id}");
                        Func::dbError($result, __LINE__);

                        if(isset($value['children'])){
                            self::orderingItem($value['children'], $id);
                        }
                        $x++;
                    }
                }
            }

        } catch (Exception $e){
            return json_decode($e->getMessage());
        }
    }

    /** ADD */
    public function maxOrder() {
        // get maxOrder
        try{
            $selectData = [
                'deleted'=>'2'
            ];
            $query = "SELECT MAX(`ordering`) as `ordering` FROM `cms_pages` WHERE `deleted`= :deleted";
            $result = $this->db->selectOne($query, $selectData);
            Func::dbError($result, __LINE__);

            if(!empty($result['ordering'])){
                return $result['ordering'];
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
                ->post('data_parent')->filter('filter_int')
                ->post('data_ordering')->val('requires')->filter('filter_int')
                ->post('data_static_page')->filter('filter_int')
                ->post('data_target')->filter('filter_int')
                ->post('data_status')->val('requires')->filter('filter_int')
            ;
            foreach (MFAdmin::$_langs as $key=>$value){
                $this->form
                    ->post('data_title_'.$key)->val('maxlength', 250)->val('requires')->filter('filter_string')
                    ->post('data_slug_'.$key)->val('maxlength', 250)->val('requires')->filter('filter_string')
                    ->post('data_link_'.$key)->val('maxlength', 250)->filter('filter_string')
                    ->post('data_subtitle_'.$key)->val('maxlength', 250)->filter('filter_string')
                    ->post('data_text_'.$key)->filter('filter_html')
                ;
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
                    'parent'=>$data['data_parent'],
                    'ordering'=>$data['data_ordering'],
                    'static_page'=>$data['data_static_page'], // 1-static, 0-dynamic
                    'target'=>$data['data_target'], // 1-_blank, 0
                    'status'=>$data['data_status'],

                    'creator_id'=>Session::get('adminId'),
                    'create_date' => date('Y-m-d H:i:s'),
                    'update_date' => date('Y-m-d H:i:s')
                ];
                $last_id = $this->db->insert('cms_pages', $insertData);
                Func::dbError($last_id, __LINE__);

                if (ctype_digit($last_id) === true) {

                    // insert into database
                    foreach (MFAdmin::$_langs as $key=>$value){
                        $insertData = [
                            'p_id'=>$last_id,
                            'title'=>$data['data_title_'.$key],
                            'subtitle'=>$data['data_subtitle_'.$key],
                            'slug'=>$data['data_slug_'.$key],
                            'link'=>$data['data_link_'.$key],
                            'text'=>$data['data_text_'.$key],
                            'lang'=>$key
                        ];
                        $insertResult = $this->db->insert('cms_pages_text', $insertData);
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

            $query = "SELECT P.`id`, P.`parent`, P.`ordering`, P.`static_page`, P.`target`, P.`status`, T.`title`, T.`slug`, T.`subtitle`, T.`link`, T.`text`, T.`lang` 
                            FROM `cms_pages` P 
                            LEFT JOIN `cms_pages_text` T ON T.p_id = P.id   
                            WHERE P.`id`=:id";
            $result = $this->db->select($query, $selectData);
            Func::dbError($result, __LINE__);

            $mas = [];
            if(!empty($result)){
                foreach ($result as $value){
                    $mas['id'] = Func::filter_int($value['id']);
                    $mas['parent'] = Func::filter_int($value['parent']);
                    $mas['ordering'] = Func::filter_int($value['ordering']);
                    $mas['static_page'] = Func::filter_int($value['static_page']);
                    $mas['target'] = Func::filter_int($value['target']);
                    $mas['status'] = Func::filter_int($value['status']);

                    $mas['title'][$value['lang']] = Func::filter_string($value['title']);
                    $mas['slug'][$value['lang']] = Func::filter_string($value['slug']);
                    $mas['subtitle'][$value['lang']] = Func::filter_string($value['subtitle']);
                    $mas['link'][$value['lang']] = Func::filter_string($value['link']);
                    $mas['text'][$value['lang']] = Func::filter_html($value['text']);
                }
            }

            return $mas;
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

            /***********************************************************************************
             * post
             */
            $this->form
                ->post('data_parent')->filter('filter_int')
                ->post('data_ordering')->val('requires')->filter('filter_int')
                ->post('data_static_page')->filter('filter_int')
                ->post('data_target')->filter('filter_int')
                ->post('data_status')->val('requires')->filter('filter_int')
            ;
            foreach (MFAdmin::$_langs as $key=>$value){
                $this->form
                    ->post('data_title_'.$key)->val('maxlength', 250)->val('requires')->filter('filter_string')
                    ->post('data_slug_'.$key)->val('maxlength', 250)->val('requires')->filter('filter_string')
                    ->post('data_link_'.$key)->val('maxlength', 250)->filter('filter_string')
                    ->post('data_subtitle_'.$key)->val('maxlength', 250)->filter('filter_string')
                    ->post('data_text_'.$key)->filter('filter_html')
                ;
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
             * update
             */
            if (!empty($data)){
                $updateData = [
                    'parent'=>$data['data_parent'],
                    'ordering'=>$data['data_ordering'],
                    'static_page'=>$data['data_static_page'], // 1-static, 0-dynamic
                    'target'=>$data['data_target'], // 1-_blank, 0
                    'status'=>$data['data_status'],

                    'creator_id'=>Session::get('adminId'),
                    'update_date' => date('Y-m-d H:i:s')
                ];
                $result = $this->db->update('`cms_pages`', $updateData, "`id`={$id}");
                Func::dbError($result, __LINE__);

                if($result === 1){
                    // delete from database
                    $deleteResult = $this->db->delete('cms_pages_text',"`p_id` ={$id}");
                    Func::dbError($deleteResult, __LINE__);

                    // insert into database
                    foreach (MFAdmin::$_langs as $key=>$value){
                        $insertData = [
                            'p_id'=>$id,
                            'title'=>$data['data_title_'.$key],
                            'subtitle'=>$data['data_subtitle_'.$key],
                            'slug'=>$data['data_slug_'.$key],
                            'link'=>$data['data_link_'.$key],
                            'text'=>$data['data_text_'.$key],
                            'lang'=>$key
                        ];
                        $insertResult = $this->db->insert('cms_pages_text', $insertData);
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
}