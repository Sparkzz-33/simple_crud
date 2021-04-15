<?php

/**
 * User Class for login and regiatration purpose
 */
class User 
{
	private $con;
	
	function __construct()
	{
		 include_once("../database/db.php");
		 $db = new Database();
		 $this->con = $db->connect();
	}

	private function emailExists($email)
	{
		$pre_stmt = $this->con->prepare("SELECT id FROM user WHERE email=?");
		$pre_stmt->bind_param("s", $email);
		$pre_stmt->execute() or die($this->con->error);
		$result = $pre_stmt->get_result();
		if($result->num_rows > 0)
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}


	public function createUserAccount($username, $email, $password){
			//To protect from sql attck use prepared statement
		if ($this->emailExists($email) == 1) {

			return "Present";
		}
		else
		{
			$pass_hash = password_hash($password, PASSWORD_BCRYPT,["cost"=>8]);
			$date = date("Y-m-d h:m:s");
			$notes = "";

			$pre_stmt = $this->con->prepare("INSERT INTO `user`(`username`, `email`, `password`, `register_date`, `last_login`, `notes`) VALUES (?,?,?,?,?,?)");
			$pre_stmt->bind_param("ssssss",$username,$email,$pass_hash,$date,$date,$notes);
			//echo $username;
			$result = $pre_stmt->execute() or die($this->con->error);
			if ($result) {
				return $this->con->insert_id;
			}
			else
			{
				return "Some_Error";
			}
		} 
	}

	public function userLogin($email, $password)
	{
		$pre_stmt = $this->con->prepare("SELECT id, username, password, last_login FROM user WHERE email = ?");
		$pre_stmt->bind_param("s", $email);
		$pre_stmt->execute() or die($this->con->error);
		$result = $pre_stmt->get_result();

		if ($result->num_rows < 1) {
			return "Not_Registered";
		}
		else
		{
			$row = $result->fetch_assoc();
			if(password_verify($password, $row["password"]))
			{
				$_SESSION["userid"] = $row["id"];
				$_SESSION["username"] = $row["username"];
				$_SESSION["last_login"] = $row["last_login"];
				//updating lasgt login
				$last_login = date("Y-m-d h:m:s");
				$pre_stmt = $this->con->prepare("UPDATE user SET last_login = ? WHERE email = ?");
				$pre_stmt->bind_param("ss", $last_login, $email);
				$result = $pre_stmt->execute() or die($this->con->error);
				if ($result) 
				{
					return 1;
				}
				else
				{
					return 0;
				}
			}
			else
			{
				return "PASSWORD_NOT_MATCHED";
			}
		}
	}
}

// $user = new User();
// $user->createUserAccount("Ashutosh","rajput.ashutosh33@gmail.com", "123456789", "Admin");
// echo $user->userLogin("rajput.ashutosh33@gmail.com", "123456789");
?>

