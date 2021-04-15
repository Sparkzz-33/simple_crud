<div class="modal fade" id="up_employee" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Update Employee</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="update_employee_form" onsubmit="return false">
            <div class="form-group">
              <label>Employee Name</label>
              <input type="hidden" name="id" id="id" value=""/>
              <input type="text" class="form-control" name="update_employee" id="update_employee">
              <small id="employee_error" class="form-text text-muted"></small>
            </div>
           
            <div class="form-group">
              <label>Employee DOB</label>
              <input type="text" class="form-control" id="update_employee_dob" name="update_employee_dob" >
            </div>

            <div class="form-group">
              <label>Employee Designation</label>
              <input type="text" class="form-control" id="update_employee_des" name="update_employee_des" placeholder="Enter Employee Designation">
            </div>
            <div class="form-group">
              <label>Employee Salary</label>
              <input type="text" class="form-control" id="update_employee_sal" name="update_employee_sal" placeholder="Enter Employee Salary">
            </div>
            <div class="form-group">
              <label>Employee Account Number</label>
              <input type="text" class="form-control" id="update_employee_acc" name="update_employee_acc" placeholder="Enter Employee Bank Acc. No">
            </div>
            <div class="form-group">
              <label>Employee Bank IFSC</label>
              <input type="text" class="form-control" id="update_employee_ifs" name="update_employee_ifs" placeholder="Enter Employee Bank IFSC">
            </div>
            
            <button type="submit" class="btn btn-primary">Update</button>
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>