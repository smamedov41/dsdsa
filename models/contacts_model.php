<?php

class Contacts_Model extends Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * @return SEND MAIL
     */
    public function sendMail($email) {
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
                ->post('data_name')->val('requires')->filter('filter_string')
                ->post('data_email')->val('email')->val('requires')->filter('filter_email')
                ->post('data_msg')->val('maxlength', 250)->val('requires')->filter('filter_string')
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

            // insert into database
            if(!empty($data)){
                $insertData = [
                    'name'=>$data['data_name'],
                    'email'=>$data['data_email'],
                    'msg'=>$data['data_msg'],

                    'create_date' => date('Y-m-d H:i:s'),
                    'deleted'=>'2',
                ];
                $last_id =  $this->db->insert('cms_contact', $insertData);
                Func::dbError($last_id, __LINE__);

                /*****************************************************************
                 * send mail
                 */
                $from       = MAIL_USERNAME;
                $from_name  = MAIL_FROM_NAME;
                $to         = $email;
                $to_name    = 'WEB SITE ADMIN';
                $subject    = 'Contact Form';

                $ip = filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP);
                $body       = '<table border="1" cellpadding="5">
                                    <tr><td width="150">Ad Soyad:</td><td>'.$data['data_name'].'</td></tr>    
                                    <tr><td>E-mail:</td><td>'.$data['data_email'].'</td></tr>    
                                    <tr><td>Message:</td><td>'.$data['data_msg'].'</td></tr>    
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

                return 1;
            }


        } catch (Exception $e){
            return json_decode($e->getMessage());
        }
    }
}