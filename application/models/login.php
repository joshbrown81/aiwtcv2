<?php 
	class Login extends CI_Model{

		function checkdb($email, $password){

			$this->load->database();
			
			$key = 'sdgwe4tgwgsregase';
			$match = FALSE;
			$encodedemail = $this->encrypt->encode($email, $key);
			$encodedpwd = $this->encrypt->encode($password, $key);
			$query = $this->db->query("SELECT * FROM users");
			foreach($query->result_array() as $row){
				$emailfromdb = $row['email'];
				$pwdfromdb = $row['pwd'];
				$decodedemail = $this->encrypt->decode($emailfromdb, $key);
				$decodedpwd = $this->encrypt->decode($pwdfromdb, $key);

				if($decodedemail === $email && $decodedpwd === $password){
					$query = $this->db->query("SELECT * FROM users WHERE email='$emailfromdb' AND pwd='$pwdfromdb'");
					if($query->num_rows() == 1){
						$_SESSION['userid'] = $row['userid'];
					}else{}
				}
			}
			return $match;
		}

		function namecheck($fname, $sname){
			if($fname == "" || $sname == ""){
				return FALSE;
			}else{
				return TRUE;
			}
		}

		function check_email($email){
			$char = "@";
			$check = strpos($email, $char);
			if($check){
				return TRUE;
			}else{
				return FALSE;
			}
		}

		function pwdlength($pwd){
			if(strlen($pwd) < 5){
				return FALSE;
			}else{
				return TRUE;
			}
		}

		function pwdmatch($pwd, $cpwd){
			if($pwd === $cpwd){
				return TRUE;
			}else{
				return FALSE;
			}
		}

		function dblookupemail($email){

			$key = 'sdgwe4tgwgsregase';
			$match = FALSE;
			$query = $this->db->query("SELECT email FROM users");
			foreach($query->result() as $row){
				$emailfromdb = $row->email;
				$decodedemail = $this->encrypt->decode($emailfromdb, $key);
				if($decodedemail == $email){
					$match = TRUE;
				}
				return $match;
			}	
		}

		function transfer_details($fname, $sname, $email, $pwd, $location){
			$this->load->library('encrypt');
			$fname = strtolower($fname);
			$sname = strtolower($sname);
			$location = strtolower($location);
			//sendemail($email);
			$key = 'sdgwe4tgwgsregase';
			$pwd = $this->encrypt->encode($pwd,$key);
			$email = $this->encrypt->encode($email, $key);
			$query = $this->db->query("INSERT INTO users (fname, sname, email, pwd, location) VALUES ('$fname', '$sname', '$email', '$pwd', '$location')");
		}

		function sendemail($email){
			$this->email->from('no-reply@alliwantthischristmas.co.uk', 'All I Want This Christmas');
			$this->email->to($email); 
			$this->email->subject('Registration successful');
			$this->email->message('Thank you for regsitering with All I Want This Christmas!');	
			$this->email->send();
			if(!$this->email->send()){
				echo "fail";
			}else{
				//$query = $this->db->query("INSERT INTO users (fname, sname, email, pwd, location) VALUES ('$fname', '$sname', '$email', '$pwd', '$location')");
			}
		}

	}
