<div class="modal fade" id="form_employee" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Employee Addition Form</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id = "employee_form" onsubmit="return false">
          <div class="form-row">
            <div class="form-group col-md-6">
              <label>Employee Name</label>
              <input type="text" class="form-control" name = "employee_name" id="employee_name" placeholder="Enter Employee Name" required>
            </div>
          </div>
          <div class="form-group">
            <label>D-O-B</label>
            <input type="text" class="form-control" name = "employee_dob" id="employee_dob" placeholder="Enter Employee DOB" required>
          </div>

          <div class="form-group">
            <label>Designation</label>
            <input type="text" class="form-control" name = "employee_designation" id="employee_name" placeholder="Enter Employee Designation" required>
          </div>
          <div class="form-group">
            <label>Employee Salary</label>
            <input type="text" class="form-control" id="employee_salary" name="employee_salary" placeholder="Enter Employee Salary">
          </div>

          <div class="form-group">
            <label>Employee Bank Account</label>
            <input type="text" class="form-control" id="employee_account_number" name="employee_account_number" placeholder="Enter Employee Account Number">
          </div>

          <div class="form-group">
            <label>Employee Bank IFSC</label>
            <input type="text" class="form-control" id="employee_ifsc" name="employee_ifsc" placeholder="Enter Employee Bank IFSC">
          </div>
          
          <button type="submit" class="btn btn-primary">Add Employee</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>