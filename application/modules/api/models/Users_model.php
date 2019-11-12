<?php

class Users_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

	private function check_exist_user($input){
		if(array_key_exists("email",$input))
			$this->db->where('email',$input['email']);
		if(array_key_exists("mobile",$input))
			$this->db->where('mobile',$input['mobile']);
		if(array_key_exists("user_type",$input))
			$this->db->where('user_type',$input['user_type']);
		return $this->db->get('users')->row_array();
	}
    function send($otp,$email)
    {
        // Load PHPMailer library
        $this->load->library('phpmailer_lib');

        // PHPMailer object
        $mail = $this->phpmailer_lib->load();

        // SMTP configuration
        $mail->isSMTP();
        $mail->Host     = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'anugrah.agarwal_cs17@gla.ac.in';
        $mail->Password = 'anugrah123@';
        $mail->SMTPSecure = 'tls';
        $mail->Port     = 587;

        $mail->setFrom('anugrah.agarwal_cs17@gla.ac.in', 'Canteen Automation System');
        $mail->addReplyTo('anugrah.agarwal_cs17@gla.ac.in', 'Canteen Automation System');

        // Add a recipient
        $mail->addAddress($email);

        // Add cc or bcc
//        $mail->addCC('cc@example.com');
//        $mail->addBCC('bcc@example.com');

        // Email subject
        $mail->Subject = 'OTP Verification for Canteen Automation System';

        // Set email format to HTML
        $mail->isHTML(FALSE);

        // Email body content
        $mailContent = "Your OTP IS ".$otp;
        $mail->Body = $mailContent;

        // Send email
        if(!$mail->send()){
            return FALSE;
//            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }else{
            return TRUE;
        }
    }

    function login($input)
    {
        $sql="select users.*,year.name as year_name from users join year on users.year_id=year.id where users.user_type=2 and 1 and universityrollno=".$input['universityrollno'];
        $user = $this->db->query($sql)->row_array();
        if ($user) {
            if (md5($input['password']) != $user['password']) {
                return_data(FALSE, "Please enter correct password", json_decode("{}"));
            }

            $this->db->where('id', $user['id']);
            $this->db->update('users', array('device_token' => $input['device_token']));

            return_data(TRUE, "login successfull", $user);
        }
        return_data(FALSE, "Username does not exist", json_decode("{}"));
    }

    function forget_password($input)
    {
        $this->db->where('email', $input['username']);
        $this->db->where('user_type !=', 1);
        $user = $this->db->get('users')->row_array();
        if ($user)
        {
            $email=$user["email"];
            if (!isset($input['otp']) || !$input['otp']) {
                $otp = rand(100000, 999999);
                $this->send($otp,$email);
                return_data(TRUE, "OTP Sent", array('otp' => $otp));
            }
            if (!isset($input['password']) || !$input['password']) {
                return_data(FALSE, "password field required", json_decode("{}"));
            }

            $this->db->where('email', $input['username']);
            $this->db->update('users', array('password' => md5($input['password'])));

            $user['password'] = md5($input['password']);
            return_data(TRUE, "Password Changed", $user);
        }
        return_data(FALSE, "Username does not exist", json_decode("{}"));
    }

    function change_password($input)
    {
        $id=$input["user_id"];
        $this->db->where('id', $input['user_id']);
        $this->db->update('users', array('password' => md5($input['password'])));
        return_data(TRUE, "Password Changed", []);
    }


	function register_customer($input)
	{
		if($this->check_exist_user(array('email'=>$input['email'])))
		{
			return_data(FALSE, "Email Exist", array());
		}
		else
		{
			$email=$input["email"];
			if (!isset($input["otp"]) || !$input["otp"])
			{
				$otp = rand(100000, 999999);
				$this->send($otp,$email);
				return_data(TRUE, "OTP Sent", array('otp'=>$otp));
			}
			if (!isset($input) || !$input)
			{
				$this->Users->validate_register_customer();
			}
			$x=$input["otp"];
			$input["status"] = 1;
			$input["created"] = time();
			$input["user_type"]=2;
			$input['password']=md5($input['password']);
			unset($input["user_id"],$input["otp"]);
			$this->db->insert('users', $input);
			$input["id"]=$this->db->insert_id();
			$input["otp"]=$x;
		}
		if ($input)
			return_data(TRUE,"USER REGISTERED",$input);
		else
			return FALSE;
	}
}
