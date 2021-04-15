<?php


include_once("../database/constants.php");
include_once("user.php");
include_once("DBOperation.php");
include_once("manage.php");
if (isset($_POST["username"]) AND isset($_POST["email"])) 
{
	$user = new User();
	$result = $user->createUserAccount($_POST["username"], $_POST["email"], $_POST["password1"]);
	echo $result;
	exit();
}

//Login part
if (isset($_POST["log_email"]) AND isset($_POST["log_password"]))
{
	$user = new User();
	$result = $user->userLogin($_POST["log_email"], $_POST["log_password"]);
	echo $result;
	exit();
}





//Add Employee

if (isset($_POST["employee_name"]) AND isset($_POST["employee_dob"])) {
	$obj = new DBOperation();
	$result = $obj->addEmployee($_POST["employee_name"], $_POST["employee_dob"], $_POST["employee_designation"], $_POST["employee_salary"], $_POST["employee_account_number"], $_POST["employee_ifsc"]);
	echo $result;
	exit();
}




//*******Product*********

if (isset($_POST["manageEmployee"])) {
	$m = new Manage();
	$result = $m->manageRecordWithPagination("employee", $_POST["pageno"]);
	$rows = $result["rows"];
	$pagination = $result["pagination"];
	if (count($rows) > 0) {
		$n = ($_POST["pageno"] - 1) * 5 + 1;
		foreach ($rows as $row) {
			?>

				<tr>
			        <td><?php echo $n ?></td>
			        <td><?php echo $row["employee_name"] ?></td>
			        <td><?php echo $row["dob"] ?></td>
			        <td><?php echo $row["designation"] ?></td>
			        <td><?php echo $row["salary"] ?></td>
			        <td><?php echo $row["bank_account_number"] ?></td>
			        <td><?php echo $row["bank_ifsc"] ?></td>

			        <td>
			        	<a href="#" class="btn btn-success btn-sm">Active</a>
			        </td>
			        <td>
			        	<a href="#" did="<?php echo $row['id']; ?>" class="btn btn-danger btn-sm del_employee">Delete</a>
			        	<a href="#"  eid="<?php echo $row['id']; ?>" class="btn btn-primary btn-sm edit_employee" data-toggle="modal" data-target="#up_employee">Edit</a>
			        </td>
			     </tr>

			<?php
			$n++;
		}
		?>
			<tr><td colspan = "5"><?php echo $pagination; ?></td></tr>
		<?php
		exit();
	}
}

if (isset($_POST["deleteEmployee"])) {
	$m = new Manage();
	$result = $m->deleteRecord("employee","id", $_POST["id"]);
	echo $result;
	exit();
}
if (isset($_POST["updateEmployee"])) {
	$m = new Manage();
	$result = $m->getSingleRecord("employee", "id", $_POST["id"]);
	echo json_encode($result);
	exit();
}

if (isset($_POST["update_employee"])) {
	$m = new Manage();
	$id = $_POST["id"];
	$emp_nam = $_POST["update_employee"];
	$emp_dob = $_POST["update_employee_dob"];
	$emp_des = $_POST["update_employee_des"];
	$emp_sal = $_POST["update_employee_sal"];
	$emp_acc = $_POST["update_employee_acc"];
	$emp_ifs = $_POST["update_employee_ifs"];
	$result = $m->updateEmployee($id, $emp_nam, $emp_dob, $emp_des, $emp_sal, $emp_acc, $emp_ifs);
	echo $result;
	exit();
}

if (isset($_POST["search_title"])) {
	$db = new DBOperation();
	$title = $_POST["search_title"];
	$parameter = $_POST["search_parameter"];
	if ($parameter == 1){
		$result = $db->searchByCategory($title);
		$rows = $result;
	}
	else if($parameter == 2)
	{
		$result = $db->searchByBrand($title);
		$rows = $result;
	}
	else
	{
		$result = $db->searchByProduct($title);
		$rows = $result;
	}
	if($result[0] == 'I' || $result[0] == 'N')
		{
			echo $result;
			exit();
		}
		else if (count($rows) > 0) {
		//$n = ($_POST["pageno"] - 1) * 5 + 1;


		foreach ($rows as $row) {
			?>

				 <tr>
			        <td><?php echo $row["product_name"] ?></td>
			        <td><?php echo $row["product_price"] ?></td>
			        <td><?php echo $row["product_stock"] ?></td>
			        <td><?php echo $row["added_date"] ?></td>

			        <td>
			        	<a href="#" class="btn btn-success btn-sm">Active</a>
			        </td>
			        <td>
			        	<a href="#" did="<?php echo $row['pid']; ?>" class="btn btn-danger btn-sm del_product">Delete</a>
			        	<a href="#"  eid="<?php echo $row['pid']; ?>" class="btn btn-primary btn-sm edit_product" data-toggle="modal" data-target="#up_product">Edit</a>
			        </td>
			     </tr>

			     <!-- <h1> Hello World </h1> -->

			<?php
		}
		exit();
	}
}

?>