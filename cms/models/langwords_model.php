<?php

class Langwords_Model extends Model {

    public function __construct() {
        parent::__construct();

        $this->_menu = 'langwords';
    }

    /* LIST */
    public function listItems() {
        try{
            $selectData = [];
            $query = "SELECT *
                        FROM `cms_langwords` P
                        WHERE 1  
                        ORDER BY `id` desc";
            $result = $this->db->select($query, $selectData);
            Func::dbError($result, __LINE__);

            if($result) {
                return Func::filter_array($result);
            } else {
                return [];
            }

        } catch (Exception $e){
            return json_decode($e->getMessage());
        }
    }
    public function listAction(){
        try {
            // check post && csrf token
            if (sizeof($_POST)) {
                Func::csrf_token_check($_POST);

                if (empty($_POST['action'])) {
                    $error['headerError'] = Lang::get('{Seçim edin!}');
                    throw new Exception(json_encode($error));
                } else{
                    switch ($_POST['action']) {
                        // SAVE
                        case 'save':
                            $ids = $this->check_save();
                            return $this->saveItem($ids);
                            break;
                    }
                }
            } else {
                header('Location: ' . URL . $this->_menu);
                exit;
            }

        } catch (Exception $e){
            return json_decode($e->getMessage());
        }
    }
    function check_save(){
        // create array from checked checkbox
        if (isset($_POST['id']) && sizeof($_POST['id'])) {
            foreach ($_POST['id'] as $key=>$item) {
                $k = (int) $key;
                $ids[$k] = (int) $item;
            }
            return $ids;
        } else {
            $error['headerError'] = Lang::get('{Dəyişiklik edin!}');
            throw new Exception(json_encode($error));
        }
    }

    /* SAVE */
    public function saveItem($items) {
        try{
            foreach ($items as $key => $id) {
                $updateData = [
                        'update_date' => date('Y-m-d H:i:s')
                ];
                foreach(MFAdmin::$_langs as $key=>$value){
                    $updateData[$key] = htmlspecialchars($_POST[$key][$id]);
                }

                // update words
                $updateResult = $this->db->update('`cms_langwords`', $updateData,"`id`={$id}");
                Func::dbError($updateResult, __LINE__);
            }

            foreach(MFAdmin::$_langs as $key=>$value){
                // Select words FROM table
                $selectData = [];
                $query = "SELECT `id`,  `key`,  `".$key."` 
                                FROM `cms_langwords` P
                                WHERE 1
                                ORDER BY `id` desc";
                $result = $this->db->select($query, $selectData);

                if(!empty($result)){
                    // create file [language file]
                    $text = '<?php $keys = [';
                    foreach ($result as $m){
                        if($m[$key]!=''){
                            $text .= "'".$m["key"]."'=>'".str_replace("'","\'", $m[$key])."', \n";
                        }
                    }
                    $text .= ']; ?>';

                    // file location
                    $filename = BASE_DIR.'/langs/'.$key.".php";
                    $file = fopen($filename, "w");
                    if (!file_exists($filename)) {
                        @mkdir($filename, 0777);
                    }
                    if (file_exists($filename)) {
                        fwrite($file, $text);
                        fclose($file);
                    }
                }
            }
        } catch (Exception $e){
            return json_decode($e->getMessage());
        }
    }

    /* ADD */
    public function addWords(){
        try{
            $folders = ['views', 'controllers', 'models', 'libs'];
            foreach ($folders as $value){
                $path = realpath(BASE_DIR.$value.'/');
                //print_r($value);
                $objects = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path), RecursiveIteratorIterator::SELF_FIRST);


                foreach($objects as $name => $object){
                    if(!is_dir($name)){
                        $content = file($name);
                        foreach($content as $key=>$value){

                            $say = substr_count($value, 'Lang::get');
//                        echo $value.'/'.$say.'<hr>';
//                        echo "say = $say <br>";

                            for($z=1; $z<=$say; $z++){
                                if($z==1){
                                    $first  = strpos($value, "Lang::get('{");
                                    $second = strpos($value, "}'", $first );
                                } else {
                                    $first  = strpos($value, "Lang::get('{", ($first + strlen("Lang::get('{")) );
                                    $second = strpos($value, "}'", $first );
                                }

//                            echo "first = $first";
//                            echo '<br>';
//                            echo "second = $second";
//                            echo '<br />';

                                if ($first !== false) {
                                    $first1 = $first+12;
                                    $second1 = $second - $first1;

                                    $word = trim(substr($value, $first1, $second1));

                                    if($word!=''){

                                        $selectData = [
                                                'key'=>$word
                                        ];
                                        $query = "SELECT count(`id`) as `count`
                                                    FROM `cms_langwords` P
                                                    WHERE `key`=:key";
                                        $result = $this->db->select($query, $selectData);
                                        Func::dbError($result, __LINE__);

                                        if(!empty($result)){
                                            $count = $result[0]['count'];
                                            if($count == 0){
                                                // insert

                                                $name = str_ireplace('\\', '/', $name);
                                                $insertData = [
                                                        'key'=>$word,
                                                        'az'=>$word,
                                                        'file'=>str_ireplace(BASE_DIR, '/', $name),

                                                        'creator_id'=>Session::get('adminId'),
                                                        'create_date' => date('Y-m-d H:i:s'),
                                                        'update_date' => date('Y-m-d H:i:s')
                                                ];
                                                $insertResult = $this->db->insert('cms_langwords', $insertData);
                                                Func::dbError($insertResult, __LINE__);
                                                //echo '<hr>';
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        } catch (Exception $e){
            return json_decode($e->getMessage());
        }


    }
}