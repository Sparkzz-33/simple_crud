$(document).ready(function(){

	var DOMAIN = "http://localhost/simple_crud/public_html";

	
	

	//******************Products***************
	manageEmployee(1);
	function manageEmployee(pn){
		$.ajax({
			url : DOMAIN + "/includes/process.php",
				method : "POST",
				data  : {manageEmployee:1, pageno:pn}, 
				success : function(data)
				{
					$("#get_employee").html(data);
				}
		})
	}
	

	$("body").delegate(".del_employee", "click", function(){
		console.log("Hello");
		var did = $(this).attr("did");
		if (confirm("Are you sure? You want to delete")) 
		{
			$.ajax({
			url : DOMAIN + "/includes/process.php",
				method : "POST",
				data  : {deleteEmployee:1, id:did}, 
				success : function(data)
				{
					var j;
					var res;
					for(j=0;j<String(data).length;j++)
					{
						if(String(data).charCodeAt(j) >= 65)
						{
							res = String(data).substring(j);
							break;
						}
					}
					data = res;
					
					if(data == "DELETED")
					{
						alert("Deletion Successful");
						manageEmployee(1);
					}
					else
					{
						alert(data);
					}
				}
		})
		}
		else
		{
		}
	})



	$("body").delegate(".edit_employee", "click", function(){
		var eid = $(this).attr("eid");
		$.ajax({
			url : DOMAIN + "/includes/process.php",
			method : "POST",
			dataType : "json",
			data : {updateEmployee:1, id:eid},
			
			success : function(data)
			{
				console.log(data);
				$("#id").val(data["id"]);
				$("#update_employee").val(data["employee_name"]);
				$("#update_employee_dob").val(data["dob"]);
				$("#update_employee_des").val(data["designation"]);
				$("#update_employee_sal").val(data["salary"]);
				$("#update_employee_acc").val(data["bank_account_number"]);
				$("#update_employee_ifs").val(data["bank_ifsc"]);
			}
		})
	})

	$("#update_employee_form").on("submit", function(){
		if($("#update_employee").val() == "")
		{
			$("#update_employee").addClass("border-danger");
			$("#employee_error").html("<span class='text-danger'>Please enter employee name</span>");
		}
		else
		{
			$.ajax({
				url : DOMAIN + "/includes/process.php",
				method : "POST",
				data  :$("#update_employee_form").serialize(),
				success : function(data)
				{
					var j;
					var res;
					for(j=0;j<String(data).length;j++)
					{
						if(String(data).charCodeAt(j) >= 65)
						{
							res = String(data).substring(j);
							break;
						}
					}
					data = res;
					if(data == "EMPLOYEE_UPDATED")
					{
						alert("Employee Updated Successfully");
						window.location.href="";
						
					}
					else
					{
						alert(data);
					}
					
				}
			})
		} 
	})


	//Search Product

	$("#search_product_form").on("submit", function(){

		//alert("Hi");
		if($("#search_title").val() == "")
		{
			$("#search_title").addClass("border-danger");
			$("#search_error").html("<span class='text-danger'>Please enter title</span>");
		}
		else
		{
			$.ajax({
				url : DOMAIN + "/includes/process.php",
				method : "POST",
				data  :$("#search_product_form").serialize(),
				success : function(data)
				{
					
						$("#product_result").html(data);
			
					
				}
			})
		} 
	})
})