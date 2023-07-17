<?php

class Index_Model extends Model {

    public function __construct() {
        parent::__construct();
    }

    /* LIST */
    public function listItems() {
        try{
            $selectData = [
                'deleted'=>'2'
            ];

            $table = [
                'pages' => 'cms_pages',
                'news' => 'cms_posts',
                'projects' => 'cms_projects',
                'slider' => 'cms_slider',
                'certificates' => 'cms_certificates',
                'partners' => 'cms_partners',
                'staff' => 'cms_staff',

                'langwords' => 'cms_langwords',
                'cv' => 'cms_cv',
                'contact' => 'cms_contact',

                'admin' => 'cms_admins',
            ];
            foreach ($table as $key=>$value){
                $query = "SELECT COUNT(`id`) as `count`  FROM `".$value."` WHERE `deleted`=:deleted";
                $result = $this->db->selectCount($query, $selectData);
                Func::dbError($result, __LINE__);

                $count[$key] = $result;

            }

            if($result) {
                return $count;
            } else {
                return [];
            }

        } catch (Exception $e){
            return json_decode($e->getMessage());
        }
    }
}