<?php

class BaseController
{
    public $db;
    public function __construct()
    {
        $this->db=conn::db();
    }
    
    
    
    //This functions mails via your gmail//
    public function mail_by_gmail($sender_gmail,$sender_password,$reciever_email,$email_body,$email_subject="",$alt_body=""){
        include("Base Methods/Imports/Mail/gmail.php");
    $return_value=php_mailer::mail_to($sender_gmail,$sender_password,$reciever_email,$email_body,$email_subject="",$alt_body="");
        return $return_value;
    }
    //end of mail_by_gmail function
    
    
    public function session_start()
    {
       
    }
    
    
    
}
?>