<?php

class Cv_Model extends Model {

    public function __construct() {
        parent::__construct();
    }

    /** CV */
    public function sendCV($email) {
        try {
            // check post && csrf token
            if (sizeof($_POST)) {
                Func::csrf_token_check($_POST);
            } else {
                header('Location: ' . URL . MF::$_lang . '/' . $this->_menu);
                exit;
            }

            // check post
            $this->form
                ->post('data_name')->val('maxlength', '50')->val('letter')->val('requires')->filter('filter_string')
                ->post('data_surname')->val('maxlength', '50')->val('letter')->val('requires')->filter('filter_string')
                ->post('data_father')->val('maxlength', '50')->val('letter')->val('requires')->filter('filter_string')
                ->post('data_birthday')->val('maxlength', '50')->val('requires')->filter('filter_string')
                ->post('data_mob_phone')->val('maxlength', '20')->val('requires')->filter('filter_string')
                ->post('data_email')->val('maxlength', '80')->val('email')->val('requires')->filter('filter_email')
            ;
            $this->form->submit();
            $data = $this->form->fetch();

            if (isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])) {
                $secret = RECAPTCHA_SECRET;
                $google_link = 'https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $_POST['g-recaptcha-response'];
                $verifyResponse = file_get_contents($google_link);
                $responseData = json_decode($verifyResponse);
                if (!$responseData->success) {
                    $error = [
                        'formError'=>['data_recaptcha'=>Lang::get('{Robot olmadığınızı təsdiqləyin}')],
                        'data'=>$data
                    ];
                    throw new Exception(json_encode($error));
                }
            } else {
                $error = [
                    'formError'=>['data_recaptcha'=>Lang::get('{Robot olmadığınızı təsdiqləyin}')],
                    'data'=>$data
                ];
                throw new Exception(json_encode($error));
            }

            /**
             * Image check
             */
            $uploadImageResult = '';
            if (!empty($_FILES['data_photo']['name']) && !empty($_FILES['data_photo']['type']) && !empty($_FILES['data_photo']['tmp_name']) && ($_FILES['data_photo']['size'] > 0)) {
                $ext = Func::filter_image($_FILES['data_photo'], $data);
                if(!isset($ext->formError)){
                    $folder = UPLOAD_DIR.'CV/';
                    $filenameImage = time() . sha1(time() . mt_rand()) . '.' . $ext;
                    while (file_exists($folder . $filenameImage)) {
                        $filenameImage = time() .'-'. sha1(time() . mt_rand()) . '.' . $ext;
                    }
                    $uploadImageResult = Func::image_upload($_FILES['data_photo'], $folder, $filenameImage);
                } else {
                    $error = $ext->data = $data;
                    throw new Exception(json_encode($error));
                }
            } else {
                $error = [
                    'formError'=>['data_photo'=>Lang::get('{Şəkil seçilməyib}')],
                    'data'=>$data
                ];
                throw new Exception(json_encode($error));
            }

            /**
             * File check
             */
            $uploadFileResult = '';
            if (!empty($_FILES['data_file']['name']) && !empty($_FILES['data_file']['type']) && !empty($_FILES['data_file']['tmp_name']) && ($_FILES['data_file']['size'] > 0)) {
                $ext = Func::filter_file($_FILES['data_file'], $data);
                if(!isset($ext->formError)){
                    $folder = UPLOAD_DIR.'CV/';
                    $filenameFile = time() . sha1(time() . mt_rand()) . '.' . $ext;
                    while (file_exists($folder . $filenameFile)) {
                        $filenameFile = time() .'-'. sha1(time() . mt_rand()) . '.' . $ext;
                    }
                    $uploadFileResult = Func::file_upload($_FILES['data_file'], $folder, $filenameFile);
                } else {
                    $error = $ext->data = $data;
                    throw new Exception(json_encode($error));
                }
            } else {
                if($uploadImageResult){
                    $deleted_img = UPLOAD_DIR.'CV/'.$filenameImage;
                    if (file_exists($deleted_img)) {
                        @unlink($deleted_img);
                    }
                }
                $error = [
                    'formError'=>['data_file'=>Lang::get('{CV faylı seçilməyib}')],
                    'data'=>$data
                ];
                throw new Exception(json_encode($error));
            }

            // insert into database
            if(!empty($data)){
                $insertData = [
                    'name'=>$data['data_name'],
                    'surname'=>$data['data_surname'],
                    'father'=>$data['data_father'],
                    'birthday'=>$data['data_birthday'],
                    'mob_phone'=>$data['data_mob_phone'],
                    'email'=>$data['data_email'],

                    'photo'=>($uploadImageResult == 1)?$filenameImage:'',
                    'cv_file'=>($uploadFileResult == 1)?$filenameFile:'',

                    'create_date' => date('Y-m-d H:i:s'),
                    'deleted'=>'2',
                ];
                $last_id =  $this->db->insert('cms_cv', $insertData);
                Func::dbError($last_id, __LINE__);


                /*****************************************************************
                 * send mail
                 */
                $from       = MAIL_USERNAME;
                $from_name  = MAIL_FROM_NAME;
                $to         = $email;
                $to_name    = 'WEB SITE ADMIN';
                $subject    = 'CV Form';

                $ip = filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP);
                $image = ($uploadImageResult == 1)?SITE_URL.'upload/CV/'.$filenameImage:'';
                $cv = ($uploadImageResult == 1)?SITE_URL.'upload/CV/'.$filenameFile:'';

                $body       = '<table border="1" cellpadding="5">
                                    <tr><td width="150">Ad Soyad Ata:</td><td>'.$data['data_name'].' '.$data['data_surname'].' '.$data['data_father'].'</td></tr>    
                                    <tr><td>Ad günü:</td><td>'.$data['data_birthday'].'</td></tr>    
                                    <tr><td>Mobile:</td><td>'.$data['data_mob_phone'].'</td></tr>    
                                    <tr><td>E-mail:</td><td>'.$data['data_email'].'</td></tr>    
                                    <tr><td>Şəkil:</td><td>'.$image.'</td></tr>    
                                    <tr><td>CV:</td><td>'.$cv.'</td></tr>    
                                    <tr><td>IP:</td><td>'.$ip.'</td></tr>    
                                </table>';

                //sending mail
                $mail = new Sendmail(true, $body);
                $mail->setFrom($from, $from_name);
                $mail->addAddress($to, $to_name);
                $mail->Subject = $subject;
                $sendMailResult = $mail->send();
                if(isset($sendMailResult) && ($sendMailResult==1)){
                    $msg =  'Mail sended - '. $to_name .' ('. $to.')';
                    $type = 'success';
                } else {
                    $msg =  $sendMailResult. ' - '. $to_name .' ('. $to.')';
                    $type = 'error';
                }

                /**
                 * send mail
                 *****************************************************************/

                return $last_id;
            }


        } catch (Exception $e){
            return json_decode($e->getMessage());
        }
    }

}