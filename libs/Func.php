<?php
/**
 * Date: 6/12/2017
 * Time: 10:17 AM
 */

class Func extends Database {



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
        require_once 'vendor-30kjsnf983kljiasd/ezyang/htmlpurifier/library/HTMLPurifier.auto.php';

        $HTMLAllowed = 'br,a,table,tr,thead,tbody,td,p,ul,ol,li,strong,em,span,img,div,h1,h2,h3,h4,h5,h6';
        $HTMLAllowedAttributes = 'a.href,table.align,table.border,img.src,img.width,img.alt,*.style,*.class';
        $config = HTMLPurifier_Config::createDefault();
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

    /**
     * Token
     */
    public static function rund_number(){
        return rand(1000000, 9999999);
    }
    public static function rund_int_payment(){
        return random_int(100000000000, 999999999999);
    }
    public static function token($name){
        //foreach ($_SESSION as $key=>$value){
        //    if(substr($key, 0,5) == 'temp_'){
        //        unset($_SESSION[$key]);
        //    }
        //}
        Session::set($name, md5(uniqid(mt_rand(), true)));
        return Session::get($name);
    }
    public static function token_check($name, $token_value){
        $token = Session::get($name);
        if (!is_string($token_value) or !is_string($token)) {
            return false;
        }
        $result = hash_equals($token, $token_value);
        return $result;
    }

    public static function csrf_token_check($post){
        if (!isset($post['web_csrf_name']) or empty($post['web_csrf_name']) or !isset($post['web_csrf_token']) or empty($post['web_csrf_token'])) {
            $error = [
                    'headerError'=>Lang::get('{No CSRF values found, probable invalid request.}')
            ];
            throw new Exception(json_encode($error));
        }

        $name = $post['web_csrf_name'];
        $token = $post['web_csrf_token'];
        //echo $name.'/'.$token;
        if (!self::csrf_token_validate($name, $token)) {
            $error = [
                    'headerError'=>Lang::get('{Invalid CSRF token.}')
            ];
            throw new Exception(json_encode($error));
        }
    }
    public static function csrf_token_unique_form_name($string=''){
        $string = ($string)?$string:'';
        $page = substr(md5($_SERVER['REQUEST_URI']), 0, 10);
        return "csrf_web".$string.'_'. $page;
    }
    public static function csrf_token_generate($unique_form_name){
        $token = bin2hex(random_bytes(32)); // PHP 7
        Session::set($unique_form_name, $token);
        return $token;
    }
    public static function csrf_token_validate($unique_form_name, $token_value){
        $token = Session::get($unique_form_name);
        //echo $token.'/'.$token_value;
        if (!is_string($token_value) or !is_string($token)) {
            return false;
        }
        $result = hash_equals($token, $token_value);
        return $result;
    }

    /**
     * HELPER
     */
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
    public static function paginate($item_per_page, $current_page, $total_records, $total_pages, $page_url, $page_var = false){
        $page_var = isset($page_var)?$page_var:NULL;
        $pagination = '';
        if($total_pages > 0 && $total_pages != 1 && $current_page <= $total_pages){ //verify total pages and current page number
            $pagination .= '<ul class="page-pagination">';

            $right_links    = $current_page + 3;
            $previous       = $current_page - 3; //previous link
            $next           = $current_page + 1; //next link
            $first_link     = true; //boolean var to decide our first link

            if($current_page > 1){
                $previous_link = $current_page-1;
                //$pagination .= '<li class="first"><a class="prev" href="'.$page_url.'/1'.$page_var.'"><span aria-hidden="true">&laquo;</span></a></li>'; //first link
                $pagination .= '<li><a href="'.$page_url.'/'.$previous_link.$page_var.'"><span class="fa fa-angle-left"></span></a></li>'; //previous link
                for($i = ($current_page-2); $i < $current_page; $i++){ //Create left-hand side links
                    if($i > 0){
                        $pagination .= '<li><a href="'.$page_url.'/'.$i.$page_var.'">'.$i.'</a></li>';
                    }
                }
                $first_link = false; //set first link to false
            }

            if($first_link){ //if current active page is first link
                $pagination .= '<li class="active"><a href="javascript:">'.$current_page.'</a></li>';
            }elseif($current_page == $total_pages){ //if it's the last active link
                $pagination .= '<li class="active"><a href="javascript:">'.$current_page.'</a></li>';
            }else{ //regular current link
                $pagination .= '<li class="active"><a href="javascript:">'.$current_page.'</a></li>';
            }

            for($i = $current_page+1; $i < $right_links ; $i++){ //create right-hand side links
                if($i<=$total_pages){
                    $pagination .= '<li><a href="'.$page_url.'/'.$i.$page_var.'">'.$i.'</a></li>';
                }
            }
            if($current_page < $total_pages){
                $next_link = $current_page + 1;
                $pagination .= '<li><a  href="'.$page_url.'/'.$next_link.$page_var.'"><span class="fa fa-angle-right"></span></a></li>'; //next link
                //$pagination .= '<li class="last"><a class="next" href="'.$page_url.'/'.$total_pages.$page_var.'"><span aria-hidden="true">&raquo;</span></a></li>'; //last link
            }

            $pagination .= '</ul>';
        }
        return $pagination; //return pagination links
    }
    public static function headerAlert($note, $type='error') {
        $note = self::filter_string($note);
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
                return '<span class="form-validation">'.$error->$name.'</span>';
            }
        }
    }
    public static function showHasError($name, $error = array()){
        if(!empty($error)){
            if(isset($error->$name)){
                return ' has-error';
            }
        }
    }

    /**
     * FILE UPLOAD
     */
    public static function filter_image($file = '', $data = ''){
        $allowedImageExtensions = ['jpg', 'jpeg', 'png'];
        $allowedContentTypeImage = ['image/jpeg', 'image/png'];

        $allowedExtensions = ['jpg', 'jpeg', 'png'];
        $allowedContentType = ['image/jpeg', 'image/png'];

        $file_ext = pathinfo(strtolower($file['name']), PATHINFO_EXTENSION);

        // check size
        if($file['size'] > 5000000) {
            $error = [
                'formError'=>['data_photo'=>Lang::get('{Şəkilin cəkisi 5 MB çox olmalı deyil}')]
            ];
        }
        // check extensions
        if(in_array($file_ext, $allowedExtensions) === false){
            $error = [
                'formError'=>['data_photo'=>Lang::get('{Şəkil yalnız .jpg, .jpeg, .png formatda ola bilər}')]
            ];
        }
        // check type
        if(in_array($file['type'], $allowedContentType) === false){
            $error = [
                'formError'=>['data_photo'=>Lang::get('{Şəkil yalnız .jpg, .jpeg, .png formatda ola bilər}')]
            ];
        }
        // if error exists
        if ($file['error'] != 0){
            $error = [
                'formError'=>['data_photo'=>Lang::get('{Şəkilin yüklənməsində xəta baş verdi}')]
            ];
        }
        // check id file was uploaded via HTTP POST
        if (!is_uploaded_file($file['tmp_name'])) {
            $error = [
                'formError'=>['data_photo'=>Lang::get('{Şəkil yüklənmədi}')]
            ];
        }
        // if image
        if(in_array($file_ext, $allowedImageExtensions)){
            $imagesize = @getimagesize($file['tmp_name']); // mime-type
            if (!isset($imagesize['mime']) or (in_array($imagesize['mime'], $allowedContentTypeImage) === false)) {
                $error = [
                    'formError'=>['data_photo'=>Lang::get('{Səkilin formatı düzgün deyil}')]
                ];
            }
        }

        if(!empty($error)){
            $error['data'] = $data;
            throw new Exception(json_encode($error));
        }

        return $file_ext;
    }
    public static function image_upload($file, $folder = "CV/", $filename = "test"){
        if(move_uploaded_file($file['tmp_name'], $folder . $filename)){
            return 1;
        } else {
            $error = [
                'formError'=>['data_photo'=>Lang::get('{Sistem xətası səbəbindən fayl yüklənmədi}')]
            ];
            throw new Exception(json_encode($error));
        }
    }

    public static function filter_file($file = '', $data = ''){
        $allowedImageExtensions = ['jpg', 'jpeg', 'png'];
        $allowedContentTypeImage = ['image/jpeg', 'image/png'];

        $allowedExtensions = ['pdf', 'doc', 'docx', 'jpg', 'jpeg', 'png'];
        $allowedContentType = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'image/jpeg', 'image/png'];

        $file_ext = pathinfo(strtolower($file['name']), PATHINFO_EXTENSION);

        // check size
        if($file['size'] > 5000000) {
            $error = [
                'formError'=>['data_file'=>Lang::get('{Faylın cəkisi 5 MB çox olmalı deyil}')]
            ];
        }
        // check extensions
        if(in_array($file_ext, $allowedExtensions) === false){
            $error = [
                'formError'=>['data_file'=>Lang::get('{Fayl yalnız .jpg, .jpeg, .png, .doc, .docx və .pdf formatda ola bilər}')]
            ];
        }
        // check type
        if(in_array($file['type'], $allowedContentType) === false){
            $error = [
                'formError'=>['data_file'=>Lang::get('{Fayl yalnız .jpg, .jpeg, .png, .doc, .docx və .pdf formatda ola bilər}')]
            ];
        }
        // if error exists
        if ($file['error'] != 0){
            $error = [
                'formError'=>['data_file'=>Lang::get('{Fayl yüklənməsində xəta baş verdi}')]
            ];
        }
        // check id file was uploaded via HTTP POST
        if (!is_uploaded_file($file['tmp_name'])) {
            $error = [
                'formError'=>['data_file'=>Lang::get('{Fayl yüklənmədi}')]
            ];
        }
        // if image
        if(in_array($file_ext, $allowedImageExtensions)){
            $imagesize = @getimagesize($file['tmp_name']); // mime-type
            if (!isset($imagesize['mime']) or (in_array($imagesize['mime'], $allowedContentTypeImage) === false)) {
                $error = [
                    'formError'=>['data_file'=>Lang::get('{Faylın formatı düzgün deyil}')]
                ];
            }
        }

        if(!empty($error)){
            $error['data'] = $data;
            throw new Exception(json_encode($error));
        }

        return $file_ext;
    }
    public static function file_upload($file, $folder = "CV/", $filename = "test"){
        if(move_uploaded_file($file['tmp_name'], $folder . $filename)){
            return 1;
        } else {
            $error = [
                'formError'=>['data_file'=>Lang::get('{Sistem xətası səbəbindən fayl yüklənmədi}')]
            ];
            throw new Exception(json_encode($error));
        }
    }

    /**
        Sub Menus
     */
    public static function create_link($value = []){
        if(($value['link']) && ($value['link']!='#')){
            $link = $value['link'];
        } else {
            if ($value['link'] == '#') {
                $link = 'javascript:';
            } elseif($value['slug']==''){
                $link = URL.MF::$_lang;
            } else{
                $link = ($value['static_page'] == 0) ?
                    SITE_URL . MF::$_lang . '/pages/view/' . $value['slug'] :
                    SITE_URL . MF::$_lang . '/' . $value['slug'];
            }
        }
        return $link;
    }
    public static function slug($text = '') {
        $text = Func::filter_string($text);
        require_once VENDOR_DIR . 'autoload.php';
        $slugify = new \Cocur\Slugify\Slugify();
        $text = $slugify->slugify($text);
        if($text){
            return $text;
        }
    }
}