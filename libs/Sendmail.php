<?php
/**
 * Created by MF.
 * User: MF
 * Date: 6/12/2017
 * Time: 10:17 AM
 */
require 'helper/mail/class.phpmailer.php';
require 'helper/mail/class.smtp.php';
class Sendmail extends PHPMailer {
    /**
    * myPHPMailer constructor.
    *
    * @param bool|null $exceptions
    * @param string    $body A default HTML message body
    */
    public function __construct($exceptions, $body=''){
        //Don't forget to do this or other things may not be set correctly!
        parent::__construct($exceptions);

        //Send via SMTP
        $this->isSMTP();
        $this->XMailer = 'PHP X-Mailer';
        $this->Host = MAIL_HOST;                      // Specify main and backup SMTP servers
        $this->SMTPAuth = true;                       // Enable SMTP authentication
        $this->Username = MAIL_USERNAME;              // SMTP username
        $this->Password = MAIL_PASSWORD;              // SMTP password
        $this->SMTPSecure = 'tls';                    // Enable TLS encryption, `ssl` also accepted
        $this->Encoding = 'base64';                   // Set encoding
        $this->CharSet = 'UTF-8';                     // Set charset
        $this->Port = 587;                            // Port
        $this->AuthType = 'CRAM-MD5';

        //Read an HTML message body from an external file, convert referenced images to embedded,
        //convert HTML into a basic plain-text alternative body
        $this->isHTML(true);
        $this->Body = $body;
        $this->AltBody = 'This is the body in plain text for non-HTML mail clients';

        //Show debug output

        $this->SMTPDebug = SMTP::DEBUG_SERVER;
        //Inject a new debug output handler
        $this->Debugoutput = function ($str, $level) {
            print '<pre>';
            echo "Debug level $level; message: $str\n";
        };
    }

    //Extend the send function
    public function send(){
        try{
            $r = parent::send();
            return $r;
        } catch (Exception $e){
            return $e->getMessage();
        }
    }
}