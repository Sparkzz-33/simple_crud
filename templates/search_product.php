<?php
  include_once("./database/constants.php");
  if(!isset($_SESSION["userid"]))
  {
    header("location:".DOMAIN."/");
  }
?>
<div class="modal fade" id="s_product" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Search Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="search_product_form" onsubmit="return false">
            <div class="form-group">
              <label>Title</label>
              <input type="hidden" name="bid" id="bid" value=""/>
              <input type="text" class="form-control" name="search_title" id="search_title">
              <small id="search_error" class="form-text text-muted"></small>
            </div>

            <div class="form-group">
            <label for="search_parameter">Search Parameter</label>
            <select name="search_parameter" class="form-control" id="search_parameter">
              <option value="1">Category</option>
              <option value="2">Brand</option>
              <option value="3">Product</option>
            </select>
          </div>
            
            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>  Search</button>
          </form>
          
         <div class="container">
    <table class="table table-hover table">
        <thead>
          <tr>
        
            <th>Product Name</th>
        <th>Price</th>
            <th>Stock</th>
            <th>Added Date</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody id="product_result">
          <!-- <tr>
            <td>1</td>
            <td>Electronics</td>
            <td>Root</td>
            <td>
              <a href="#" class="btn btn-success btn-sm">Active</a>
            </td>
            <td>
              <a href="#" class="btn btn-danger btn-sm">Delete</a>
              <a href="#" class="btn btn-primary btn-sm">Edit</a>
            </td>
          </tr> -->
          
        </tbody>
     </table>
    <!--  <div id = "product_result">
      
     </div> -->
  </div> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>