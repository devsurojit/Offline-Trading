<?php
ob_start();
session_start();
require_once('Include/header.php');
require_once('Include/slider.php');
require_once('Include/topbar.php');
if(isset($_SESSION['user_id'])){
?>

<div class="content" style="padding-bottom: 0;">
<div class="content">
<div class="container-fluid">
<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12">
<div class="card p-3 m-0">
<div id="accordion" role="tablist">
  <div class="card card-collapse">
    <div class="card-header p-3 card-header-rose" role="tab" id="headingOne">
      <h5 class="mb-0">
        <a data-toggle="collapse" href="#add_stock" aria-expanded="true" aria-controls="add_stock" class="text-white">
          User Profile
        </a>
      </h5>	  
    </div>

    <div id="add_stock" class="collapse show" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">
        <form >
				<div class="form-row">
					
                    
					<div class="form-group col-md-3 mb-3 is-focused bmd-form-group">
						<label class="bmd-label-floating">User Name</label>
						<input type="text" class="form-control" readonly id="user_name" name="user_name" value="<?php echo $_SESSION['user_Name'];  ?>">
					</div>
                    <div class="form-group col-md-3 mb-3 is-focused bmd-form-group">
						<label class="bmd-label-floating">New Password</label>
						<input type="password" class="form-control" id="user_pass" name="user_pass">
					</div>
                    <div class="form-group col-md-3 mb-3 is-focused bmd-form-group">
						<label class="bmd-label-floating">Confirm Password</label>
						<input type="password" class="form-control" id="user_con_pass" name="user_con_pass">
					</div>
					<div class="form-group col-md-2 mb-2">
					<a class="btn btn-info btn-sm btn-block text-white" onclick="edit_pass();"><i class="material-icons">add</i> Add User</a>
					</div>
				</div>									
			
      </form>
    </div>
    </div>
  </div>  
</div>
</div>



<?php
require_once('Include/footer.php');
?>
 <script src="../assets/js/user_prof.js"></script>
<?php
}
else{
    header('location:../login');
}
?>