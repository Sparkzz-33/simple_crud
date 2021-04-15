<?php



/**
 * 
 */
class Manage
{
	
	private $con;
	
	function __construct()
	{
		include_once("../database/db.php");
		$db = new Database();
		$this->con = $db->connect();
	}

	public function manageRecordWithPagination($table, $pno)
	{
		$a=$this->pagination($this->con,$table,$pno,5);
		if($table=="categories"){
			$sql="SELECT p.category_name AS category, c.category_name AS parent, p.cid, p.status FROM categories p LEFT JOIN categories c ON p.parent_cat=c.cid ".$a["limit"];
		}
		else if($table == "products")
		{
			$sql = "SELECT p.pid, p.product_name, c.category_name, b.brand_name, p.product_price, p.product_stock, p.added_date, p.p_status FROM products p, brands b, categories c WHERE p.bid = b.bid AND p.cid = c.cid ".$a["limit"];
		}
		else{
			$sql="SELECT * FROM ".$table." ".$a["limit"];
		}
		$result=$this->con->query($sql) or die($this->con->error);
		$rows=array();
		if($result->num_rows>0){
			while ($row=$result->fetch_assoc()) {
				$rows[]=$row;
			}
		}
		return ["rows"=>$rows,"pagination"=>$a["pagination"]];
	}

	private function pagination($con, $table, $pno, $n)
	{
			$query = $con->query("SELECT COUNT(*) as rows1 FROM ".$table);
			$row = mysqli_fetch_assoc($query);
			//$totalRecords = 100000;
			$pageno = $pno;
			$numberOfRecordsPerPage = $n;
			$last = ceil($row["rows1"]/$numberOfRecordsPerPage);
			$pagination = "<ul class='pagination' style='align-self:center'>";
			if ($last != 1) {
				if ($pageno > 1) {
					$previous = "";
					$previous = $pageno - 1;
					$pagination .= "<li class='page-item'><a class='page-link' pn='".$previous."' href='#' style='color:#0000FF;'> Previous </a></li>";
				}
				for($i=$pageno - 5;$i< $pageno ;$i++){
					if ($i > 0) {
						$pagination .= "<li class='page-item'><a class='page-link' pn='".$i."' href='#' style='color:#0000FF'> ".$i." </a></li>";
					}	
				}
				$pagination .= "<li class='page-item'><a class='page-link' pn='".$pageno."' href='#' style='color:#FF0000;'> $pageno </a></li>";
				for ($i=$pageno + 1; $i <= $last; $i++) { 
					$pagination .= "<li class='page-item'><a class='page-link' pn='".$i."' href='#' style='color:#0000FF;'> ".$i." </a></li>";
					if ($i > $pageno + 4) {
						break;
					}
				}
				if ($last > $pageno) {
					$next = $pageno + 1;
					$pagination .= "<li class='page-item'><a class='page-link' pn='".$next."' href='#' style='color:#0000FF;'> Next </a></li></ul>";
				}
			}
			//LIMIT 0,10
			//LIMIT 20,10
			$limit = "LIMIT ".($pageno - 1) * $numberOfRecordsPerPage.",".$numberOfRecordsPerPage;
			return ["pagination"=>$pagination,"limit"=>$limit];
	}

	public function deleteRecord($table, $pk, $id)
	{
		
		$pre_stmt = $this->con->prepare("DELETE FROM ".$table." WHERE ".$pk." = ?");
		$pre_stmt->bind_param("i", $id);
		$result = $pre_stmt->execute() or die($this->con->error);
		if ($result) 
		{
			return "DELETED";
		}
		
	}

	public function getSingleRecord($table, $pk, $id)
	{
		$pre_stmt = $this->con->prepare("SELECT * FROM ".$table." WHERE ".$pk." = ? LIMIT 1");
		$pre_stmt->bind_param("i", $id);
		$pre_stmt->execute() or die($this->con->error);
		$result = $pre_stmt->get_result();
		if ($result->num_rows == 1) {
			$row = $result->fetch_assoc();
		}
		return $row;
	}

	//update employee details
	public function updateEmployee($id, $emp_nam, $emp_dob, $emp_des, $emp_sal, $emp_acc, $emp_ifs){
		$pre_stmt=$this->con->prepare("UPDATE `employee` SET `employee_name`= ?, `dob` = ?, `designation`= ?, `salary` = ?, `bank_account_number` = ?, `bank_ifsc` = ? WHERE `id` = ?");
		$status=1;
		$pre_stmt->bind_param("ssssssi",$emp_nam,$emp_dob, $emp_des,$emp_sal, $emp_acc, $emp_ifs, $id);
		$result=$pre_stmt->execute() or die($this->con->error);
		if($result){
			return "EMPLOYEE_UPDATED";
		}
		else{
			return 0;
		}
	}

}

// $opr = new Manage();
// echo "<pre>";
// print_r($opr->getSingleRecord("employee", "id", 1));


?>