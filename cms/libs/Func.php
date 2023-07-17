<?php
/**
 * Created by MF.
 * User: MF
 * Date: 6/12/2017
 * Time: 10:17 AM
 */

class Func extends Database {

    /** TOKEN */
    public static function rund_number(){
        return rand(1000000, 9999999);
    }
    public static function token($name){
        Session::set($name, md5(uniqid(mt_rand(), true)));
        return Session::get($name);
    }
    public static function token_check($name, $token){
        return (Session::get($name) == $token)?1:0;
    }
    public static function csrf_token_check($post){
        if (!isset($post['admin_csrf_name']) or empty($post['admin_csrf_name']) or !isset($post['admin_csrf_token']) or empty($post['admin_csrf_token'])) {
            $error['headerError'] = Lang::get('{CSRF Token dəyəri mövcud deyil}');
            throw new Exception(json_encode($error));
        }

        $name = $post['admin_csrf_name'];
        $token = $post['admin_csrf_token'];
        if (!self::csrf_token_validate($name, $token)) {
            $error['headerError'] = Lang::get('{CSRF Token xətası}');
            throw new Exception(json_encode($error));
        }
    }
    public static function csrf_token_unique_form_name($string=''){
        $string = ($string)?$string:'';
        $page = substr(md5($_SERVER['REQUEST_URI']), 0, 10);
        return "csrf_".$string.'_'. $page;
    }
    public static function csrf_token_generate($unique_form_name){
        $token = bin2hex(random_bytes(32)); // PHP 7
        Session::set($unique_form_name, $token);
        return $token;
    }
    public static function csrf_token_validate($unique_form_name, $token_value){
        $token = Session::get($unique_form_name);
        if (!is_string($token_value) or !is_string($token)) {
            return false;
        }
        $result = hash_equals($token, $token_value);
        return $result;
    }
    public static function dbError($error, $line = 0) {
        if(isset($error['mysqlError'])) {
            //throw new Exception(json_encode(['mysqlError'=>'DB error'.'-'.$line]));
            throw new Exception(json_encode(['mysqlError'=>$error['mysqlError'].'-'.$line]));
        }
    }
    public static function sub_string($str, $length=false){
        $len = strlen($str);
        $length = ($length < 1) ? 80 : $length;
        $str = wordwrap($str, $length, "<br>\n");
        $str = explode("<br>\n", $str);

        if($len>$length) {
            $str[0] .=" ...";
        }
        return $str[0];
    }

    /** ENCRYPT && DECRYPT */
    public static function encrypt_decrypt($action, $string, $encrypt_method, $secret_key, $secret_iv){
        $output = false;

        // hash
        $key = hash('sha256', $secret_key);

        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hash('sha256', $secret_iv), 0, 16);

        if ( $action == 'encrypt' ) {
            $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
            $output = base64_encode($output);
        } else if( $action == 'decrypt' ) {
            $output = base64_decode($string);
            $output = openssl_decrypt($output, $encrypt_method, $key, 0, $iv);
        }
        return $output;
    }

    /** HELPER */
    public static function headerAlert($note, $type='error') {
        //$note = self::check($note);
        if (isset($note) && !empty($note)) {
            if($type === 'success'){
                echo  '<div class="alert alert-success">'.$note.'</div>';
            } else {
                echo  '<div class="alert alert-danger">'.$note.'</div>';
            }
        }
    }
    public static function showError($name, $error = array()){
        if(!empty($error)){
            if(isset($error->$name)){
                return '<div class="help-block with-errors">'.$error->$name.'</div>';
            }
        }
    }
    public static function paginate($item_per_page, $current_page, $total_records, $total_pages, $page_url, $page_var = false){
        $page_var = isset($page_var)?'?'.$page_var:NULL;
        $pagination = '';
        if($total_pages > 0 && $total_pages != 1 && $current_page <= $total_pages){ //verify total pages and current page number
            $pagination .= '<ul class="pagination notable pull-right">';

            $right_links    = $current_page + 3;
            $previous       = $current_page - 3; //previous link
            $next           = $current_page + 1; //next link
            $first_link     = true; //boolean var to decide our first link

            if($current_page > 1){
                $previous_link = $current_page-1;
                $pagination .= '<li class="page-item"><a class="page-link" href="'.$page_url.'/1'.$page_var.'">&laquo;</a></li>'; //first link
                $pagination .= '<li class="page-item"><a class="page-link" href="'.$page_url.'/'.$previous_link.$page_var.'">&lsaquo;</a></li>'; //previous link
                for($i = ($current_page-2); $i < $current_page; $i++){ //Create left-hand side links
                    if($i > 0){
                        $pagination .= '<li class="page-item"><a class="page-link" href="'.$page_url.'/'.$i.$page_var.'">'.$i.'</a></li>';
                    }
                }
                $first_link = false; //set first link to false
            }

            if($first_link){ //if current active page is first link
                $pagination .= '<li class="page-item active"><a class="page-link">'.$current_page.'</a></li>';
            }elseif($current_page == $total_pages){ //if it's the last active link
                $pagination .= '<li class="page-item active"><a class="page-link">'.$current_page.'</a></li>';
            }else{ //regular current link
                $pagination .= '<li class="page-item active"><span class="page-link">'.$current_page.'</span></li>';
            }

            for($i = $current_page+1; $i < $right_links ; $i++){ //create right-hand side links
                if($i<=$total_pages){
                    $pagination .= '<li class="page-item"><a class="page-link" href="'.$page_url.'/'.$i.$page_var.'">'.$i.'</a></li>';
                }
            }
            if($current_page < $total_pages){
                $next_link = $current_page + 1;
                $pagination .= '<li class="page-item"><a class="page-link" href="'.$page_url.'/'.$next_link.$page_var.'">&rsaquo;</a></li>'; //next link
                $pagination .= '<li class="page-item"><a class="page-link" href="'.$page_url.'/'.$total_pages.$page_var.'">&raquo;</a>'; //last link
            }

            $pagination .= '</ul>';
        }
        return $pagination; //return pagination links
    }

    /** FILTER */
    public static function filter_int($str = 0) {
        $str = (int) $str;
        if($str>0){
            return $str;
        } else {
            return 0;
        }
    }
    public static function filter_string($str='') {
        $str = str_replace('&quot;', '"', $str);
        $str = strip_tags($str);
        $str = stripslashes($str);
        $str = htmlspecialchars($str, ENT_QUOTES);
        $str = trim($str);
        return $str;
    }
    public static function filter_text($str='') {
        $str = htmlspecialchars($str);
        return $str;
    }
    public static function filter_html($html) {
        require_once VENDOR_DIR . 'ezyang/htmlpurifier/library/HTMLPurifier.auto.php';

        $HTMLAllowed = 'br,a,table,tr,thead,tbody,td,p,ul,ol,li,strong,em,span,img,div,h1,h2,h3,h4,h5,h6';
        $HTMLAllowedAttributes = 'a.href,table.align,table.border,img.src,img.width,img.alt,*.style,*.class';
        $config = HTMLPurifier_Config::createDefault();
        //$config->set('Cache.DefinitionImpl', null);
        $config->set('Core.Encoding', 'UTF-8');
        $config->set('HTML.MaxImgLength', null);
        $config->set('CSS.MaxImgLength', null);
        $config->set('HTML.Allowed', $HTMLAllowed);
        $config->set('HTML.AllowedAttributes', $HTMLAllowedAttributes);
        $config->set('URI.AllowedSchemes', array('data' => true, 'https' => true, 'http' => true));
        //$config->set('CSS.AllowedProperties', 'text-decoration');

        $purifier = new HTMLPurifier($config);
        $pure_html = $purifier->purify($html);
        //echo '<pre>' . htmlspecialchars($pure_html) . '</pre>';

        return $pure_html;
    }
    public static function filter_float($str='') {
        $str = trim($str);
        $str = filter_var($str, FILTER_VALIDATE_FLOAT);
        return $str;
    }
    public static function filter_email($str='') {
        $str = filter_var($str, FILTER_VALIDATE_EMAIL);
        return $str;
    }
    public static function filter_ip($str='') {
        $str = trim($str);
        $str = filter_var($str, FILTER_VALIDATE_IP);
        return $str;
    }
    public static function filter_url($str='') {
        $str = trim($str);
        $str = filter_var($str, FILTER_VALIDATE_URL);
        return $str;
    }
    public static function filter_array($array=[]) {
        array_walk_recursive($array, "self::filter");
        return $array;
    }
    public static function filter(&$value) {
        $value = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    }
    public static function arrayFlatten($array=[]) {
        if (!is_array($array)) {
            return false;
        }
        $result = array();
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $result = array_merge($result, self::arrayFlatten($value));
            } else {
                $result[$key] = $value;
            }
        }
        return $result;
    }

    /** FILEUPLOAD */
    public static function filter_file($file, $error = []){
        $allowedExtensions = ['pdf', 'doc', 'docx'];
        $allowedContentType = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];

        $file_ext = pathinfo(strtolower($file['name']), PATHINFO_EXTENSION);

        // check size
        if($file['size'] > 5242880) {
            $error['formError'] = ['data_file'=>Lang::get('{Faylın cəkisi 5 MB çox olmalı deyil}')];
            throw new Exception(json_encode($error));
        }
        // check extensions
        if(in_array($file_ext, $allowedExtensions) === false){
            $error['formError'] = ['data_file'=>Lang::get('{Fayl yalnız .doc, .docx və .pdf ola bilər}')];
            throw new Exception(json_encode($error));
        }
        // check type
        if(in_array($file['type'], $allowedContentType) === false){
            $error['formError'] = ['data_file'=>Lang::get('{Fayl yalnız .doc, .docx və .pdf olmalıdır}')];
            throw new Exception(json_encode($error));
        }
        // if error exists
        if ($file['error'] != 0){
            $error['formError'] = ['data_file'=>Lang::get('{Fayl yüklənməsində xəta baş verdi}')];
            throw new Exception(json_encode($error));
        }
        // check id file was uploaded via HTTP POST
        if (!is_uploaded_file($file['tmp_name'])) {
            $error['formError'] = ['data_file'=>Lang::get('{Fayl yüklənmədi}')];
            throw new Exception(json_encode($error));
        }

        return $file_ext;
    }
    public static function file_upload($file, $folder = "uploads/Files/", $filename = "test", $error = []){
        if (!file_exists($folder)) {
            mkdir($folder, 0777);
        } else {
            chmod($folder, 0777);
        }

        if(move_uploaded_file($file['tmp_name'], $folder . $filename)){
            chmod($folder, 0755);
            return 1;
        } else {
            chmod($folder, 0755);
            $error['formError'] = ['data_file'=>Lang::get('{Sistem xətası səbəbindən fayl yüklənmədi}')];
            throw new Exception(json_encode($error));
        }
    }
    public static function ext($file) {
        $ext = explode('.', $file);
        $ext = strtolower('.' . $ext[count($ext) - 1]);
        $result = array();
        if ($ext == '.gif' || $ext == '.jpg' || $ext == '.jpeg' || $ext == '.png' || $ext == '.bmp') {
            $result['ext'] = $ext;
            $result['type'] = 'Image';
        } elseif ($ext == '.swf') {
            $result['ext'] = $ext;
            $result['type'] = 'Flash';
        } elseif ($ext == '.flv' || $ext == '.mp4' || $ext == '.avi' || $ext == '.mp3') {
            $result['ext'] = $ext;
            $result['type'] = 'Media';
        } elseif ($ext == '.ppt' || $ext == '.pptx' || $ext == '.rar' || $ext == '.zip' || $ext == '.doc' || $ext == '.docx' || $ext == '.xls' || $ext == '.xlsx' || $ext == '.txt' || $ext == '.pdf') {
            $result['ext'] = $ext;
            $result['type'] = 'File';
        }
        return $result;
    }
    public static function uploadPhoto($files='', $menu='menu', $id=1, $rund_number='', $width=false, $height=false, $crop=false){
        if(!empty($files['name'])){
            $file = self::ext($files['name']);

            if ($file['type'] == 'Image') {
                $photo_upload_name = $menu.'-' . $id .'-'.$rund_number;
                $photo_db_name = $photo_upload_name.$file['ext'];

                require 'helper/class.upload.php';
                $handle = new upload($files);
                if ($handle->uploaded) {
                    $handle->file_new_name_body   = $photo_upload_name;
                    $handle->file_overwrite       = true;
                    $handle->allowed              = array('image/*');
                    if($crop && $width && $height){
                        $handle->image_resize     = true;
                        $handle->image_ratio_crop = true;
                        $handle->image_x          = $width;
                        $handle->image_y          = $height;
                    }
                    elseif ($width && $height) {
                        $handle->image_resize     = true;
                        $handle->image_x          = $width;
                        $handle->image_ratio_y    = $height;
                    }
                    $handle->dir_chmod            = 0777;
                    $handle->process(UPLOAD_DIR.'Image/'.$menu.'/');
                    if ($handle->processed) {
                        $handle->clean();

                        $msg = $photo_db_name;
                    } else {
                        $msg = ['error'=>$handle->error];
                    }
                }
            } else {
                $msg = 'No image type';
            }
        } else {
            $msg = 'No image';
        }

        return $msg;
    }

    /** ADMIN ACTION */
    public static function checkAdminAction($admin=[], $menu='index', $action='add'){
        if(!empty($admin)){
            if(!isset($admin['role'][$menu]) or !in_array($action, $admin['role'][$menu])){
                header('location: ' . URL .$menu);
                exit;
            }
        }
    }
    public static function checkAdminActionButton($admin=[], $menu ='', $action=''){
        if(!empty($admin)){
            return (!isset($admin['role'][$menu]) or !in_array($action, $admin['role'][$menu]))?0:1;
        }
    }

    /** Pages menu */
    public static function create_link($value = []){
        if(($value['link']) && ($value['link']!='#')){
            $link = $value['link'];
        } else {
            if ($value['link'] == '#') {
                $link = '#';
            } elseif($value['slug']==''){
                $link = URL.MFAdmin::$_lang;
            } else{
                $link = ($value['static_page'] == 0) ?
                    SITE_URL . MFAdmin::$_lang . '/pages/view/' . $value['slug'] :
                    SITE_URL . MFAdmin::$_lang . '/' . $value['slug'];
            }
        }
        return $link;
    }

    /** Folder Size */
    public static function folderSize($dir){
        $count_size = 0;
        $count = 0;
        $dir_array = scandir($dir);
        foreach ($dir_array as $key => $filename) {
            if ($filename != ".." && $filename != ".") {
                if (is_dir($dir . "/" . $filename)) {
                    $new_foldersize = self::foldersize($dir . "/" . $filename);
                    $count_size = $count_size + $new_foldersize;
                } else if (is_file($dir . "/" . $filename)) {
                    $count_size = $count_size + filesize($dir . "/" . $filename);
                    $count++;
                }
            }
        }
        return $count_size;
    }
    public static function sizeFormat($sizeInBytes){
        if($sizeInBytes < 1024) {
            $size =  (number_format($sizeInBytes, 2, '.', ' ')). " bytes";
        } else if($sizeInBytes < 1024*1024) {
            $size =  (number_format($sizeInBytes/1024, 2, '.', ' ')). " KB";
        } else if($sizeInBytes < 1024*1024*1024) {
            $size =  (number_format($sizeInBytes/(1024*1024), 2, '.', ' ')) . " MB";
        } else if($sizeInBytes < 1024*1024*1024*1024) {
            $size =  (number_format($sizeInBytes/(1024*1024*1024), 2, '.', ' ')) . " GB";
        } else if($sizeInBytes < 1024*1024*1024*1024*1024) {
            $size =  (number_format($sizeInBytes/(1024*1024*1024*1024), 2, '.', ' ')) . " TB";
        } else {
            $size = "Greater than 1024 TB";
        }
        return $size;
    }
}