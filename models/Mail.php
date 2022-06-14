<?php

class Mail extends Model
{
    public function sendMail($data)
    {
        // send mail from M.ibnahman@student.youcode.ma to user
        $to ="mohamedibnahmad.98@gmail.com";
        $subject = "Welcome to youcode";
        $message = "Welcome to youcode, your password is :cqncqs " ;
        ini_set('SMTP', 'smtp.gmail.com');
        ini_set('smtp_port', '587');
        ini_set('auth_username','ibnahmadmohamed8@gmail.com');
        ini_set('auth_password', 'rjzplqwzfpcszbpu');
        ini_set('from','ibnahmadmohamed8@gmail.com');
        

        $headers = "From:ibnahmadmohamed8@gmail.com";
       if( mail($to, $subject, $message, $headers))
        return true;
        else 
        return false;




    }
}