<?php


/**
 * 
 */
class DBOperation
{

	private $con;
	
	function __construct()
	{
		include_once("../database/db.php");
		$db = new Database();
		$this->con = $db->connect();
	}

	

	public function getAllRecord($table)
	{
		$pre_stmt = $this->con->prepare("SELECT * FROM ".$table);
		$pre_stmt->execute() or die($this->con->error);
		$result = $pre_stmt->get_result();
		$rows = array();

		if ($result->num_rows > 0) 
		{
			while($row = $result->fetch_assoc())
			{
				$rows[] = $row;
			}
			return $rows;
		}
		return "NO_DATA";
	}

	

	public function addEmployee($emp_name, $emp_dob, $emp_des, $emp_sal, $emp_acc, $emp_ifs)
	{
		$pre_stmt = $this->con->prepare("INSERT INTO `employee`
			( `employee_name`, `dob`, `designation`, `salary`, `bank_account_number`, `bank_ifsc`) VALUES 
			(?,?,?,?,?,?)");
		$status = 1;
		$pre_stmt->bind_param("ssssss", $emp_name, $emp_dob, $emp_des, $emp_sal, $emp_acc, $emp_ifs);
		$result = $pre_stmt->execute() or die($this->con->error);
		if($result)
		{
			return "EMPLOYEE_ADDED";
		}
		else
		{
			return 0;
		}
	}

	

	public function searchByProduct($title)
	{
	
		$pre_stmt = $this->con->prepare("SELECT * FROM `products` WHERE `product_name` = ?");
		
		$pre_stmt->execute() or die($this->con->error);
		$result = $pre_stmt->get_result();$pre_stmt->bind_param("s", $title);
		if($result->num_rows > 0)
		{
			while($row1 = $result->fetch_assoc())
			{
				$rows1[] = $row1;
			}
			return $rows1;
		}
		else
		{
			return "No product for this parameter";
		}		
	}

}

// $opr = new DBOperation();
// echo "<pre>";
// print_r($opr->searchByCategory("Vehicles"));
// echo "<pre>";
// print_r($opr->getAllRecord("categories"));

?>