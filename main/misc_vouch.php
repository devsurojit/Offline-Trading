<?php
ob_start();
session_start();
require_once('Include/header.php');
require_once('Include/slider.php');
require_once('Include/topbar.php');
if(isset($_SESSION['user_id'])){
?>
<style>
    .is-hidden {
  display: none;
}
.right-corn{
	float:right;
	margin-top:-25px;
}
</style>
<div class="content" style="padding-bottom: 0;">
<div class="content">
<div class="container-fluid">
<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12">
<div class="card p-3 m-0">
<div>
  <div class="card card-collapse">
    <div class="card-header p-3 card-header-rose" >
    <div class="form-check-inline">
      <label class="form-check-label" for="radio1" style="color: white;font-weight: 600;">
        <input type="radio" class="form-check-input" id="mem_opt" name="sale_mode"  checked  onchange="sale_opt(this.id);">To Member
      </label>
    </div>
    <div class="form-check-inline">
      <label class="form-check-label" for="radio2" style="color: white;font-weight: 600;">
        <input type="radio" class="form-check-input" id="party_opt" name="sale_mode" onchange="sale_opt(this.id);">To Party
      </label>
    </div>
    <div class="form-check-inline">
      <label class="form-check-label" for="radio2" style="color: white;font-weight: 600;">
        <input type="radio" class="form-check-input" id="other_opt" name="sale_mode" onchange="sale_opt(this.id);">To Other
      </label>
    </div>
    </div>

    <div id="add_stock" class="collapse show" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">
        <form >
		<input type="hidden" id="tbl_data" name="tbl_data">
				<div class="form-row">
					<div class="form-group col-md-2 mb-2 is-focused bmd-form-group">
						<label class="bmd-label-floating">Sales Date</label>
						<input type="date" class="form-control" id="purchase_Date" name="purchase_Date" value="<?php echo date('Y-m-d'); ?>" min="<?php echo $_SESSION['fin_frm_dt']  ?>" max="<?php echo date("Y-m-d");  ?>" >
					</div>
				
					
					<div class="form-group col-md-2 mb-2 is-focused bmd-form-group">
					<label class="bmd-label-floating">Reference Sale Bill No</label>
					<input type="text" class="form-control" id="ref_pur_No" required="true" name="ref_pur_No">
					</div>
					
					
					<div class="form-group col-md-4 mb-4 bmd-form-group is-focused" id="party_div">
						<label class="bmd-label-floating" id="mem_drop_lbl">Select Member</label>
						<select class="form-control select2-hidden-accessible" data-style="btn btn-link" id="Party_Idd" name="Party_Idd" onchange="fetch_part_dtls(this.value);" tabindex="-1" aria-hidden="true">
						<option value="" selected="" disabled="" >Select Member</option>
                            	
                        </select>

					</div>
					<!-- <div class="form-group col-md-4 mb-4 bmd-form-group is-focused" id="wh_div">
						<label class="bmd-label-floating">Select warehouse</label>
						<select class="form-control select2-hidden-accessible" data-style="btn btn-link" id="whare_house" name="whare_house" tabindex="-1" aria-hidden="true">
						<option value="" selected="" disabled="" >Select warehouse</option>
                            	
                        </select>
					</div> -->

					<div class="form-group col-md-3 mb-2 is-focused bmd-form-group">
					<label class="bmd-label-floating">Member Name</label>
					<input type="text" class="form-control" id="mem_name" required="true" name="mem_name">
					</div>
                    <div class="form-group col-md-4 mb-2 is-focused bmd-form-group">
					<label class="bmd-label-floating">Address</label>
					<input type="text" class="form-control" id="address" required="true" name="address">
					</div>
					<div class="form-group col-md-2 mb-2 is-focused bmd-form-group">
					<label class="bmd-label-floating">Mobile No</label>
					<input type="text" class="form-control" id="mem_mob" required="true" name="mem_mob">
					</div>
                    <div class="form-group col-md-2 mb-2 is-focused bmd-form-group">
					<label class="bmd-label-floating">Misc. Amount</label>
					<input type="text" class="form-control" id="misc_Amt" required="true" name="misc_Amt">
					</div>
					<!-- <div class="form-group col-md-2 mb-2 is-focused bmd-form-group">
					<label class="bmd-label-floating">Nominee Name</label>
					<input type="text" class="form-control" id="nom_name" required="true" name="nom_name">
					</div>
					<div class="form-group col-md-2 mb-2 is-focused bmd-form-group">
					<label class="bmd-label-floating">Nominee Relation</label>
					<input type="text" class="form-control" id="nom_rel" required="true" name="nom_rel">
					</div> -->
				</div>									
			
      </form>
    </div>
    </div>
  </div>  
</div>
</div>


</div>
<div class="card">
<div class="card-header card-header-tabs card-header-primary">
	<h4 class="mb-0">Voucher Section</h4>
	<h4 id="balance_lable" class=" mb-2 right-corn" style="display:none;">Available Balance : <span id="sb_balance"></span></h4> 
</div>


	
<div class="card-body">	
    <div class="row">				
        <div class="col-md-6 col-12">
        <div class="form-check-inline">
        <label class="form-check-label" for="radio1" style="font-weight: 600;">
            <input type="radio" class="form-check-input" id="cash_opt" name="trans_opt" value="cash" checked="true" onchange="trans_mode(this.id);">Cash
        </label>
        </div>
        <div class="form-check-inline">
        <label class="form-check-label" for="radio2" style="font-weight: 600;">
            <input type="radio" class="form-check-input" id="bank_opt" name="trans_opt" value="bank" onchange="trans_mode(this.id);">Bank/Cheque
        </label>
        </div>
        <div class="form-check-inline">
        <label class="form-check-label" for="radio2" style="font-weight: 600;">
            <input type="radio" class="form-check-input" id="sb_opt" name="trans_opt" value="bank" onchange="trans_mode(this.id);">S/B
        </label>
        </div>
        <div class="form-check-inline">
        <label class="form-check-label" for="radio3" style="font-weight: 600;">
            <input type="radio" class="form-check-input" id="credit_opt" name="trans_opt" value="credit" onchange="trans_mode(this.id);" >Credit
        </label>
        </div>
        </div>

        <div class="form-group col-md-3 mb-3 bmd-form-group is-focused" id="bank_div">
            <label class="bmd-label-floating ">Select Bank Account</label>
            <select class="form-control select2-hidden-accessible" data-style="btn btn-link" id="bank_Id" name="bank_Id" tabindex="-1" aria-hidden="true" onchange="$('#save_btn').removeAttr('disabled');">
            <option value="" selected="" disabled="" >Select Bank Account</option>
            </select>            
        </div>
        <div class="form-group col-md-3 mb-3 bmd-form-group is-focused" id="sb_div">
            <label class="bmd-label-floating ">Select S/B Account</label>
            <select class="form-control select2-hidden-accessible" data-style="btn btn-link" id="sb_id" name="sb_id" tabindex="-1" aria-hidden="true" onchange="check_bal();">
            <option value="" selected="" disabled="" >Select S/B Account</option>
            </select>            
        </div>        
		<input type="hidden" id="mem_bal" name="mem_bal">
        <!-- <div class="form-group col-md-3 mb-3" id="cash_div">
        <button type="button" class="btn btn-info btn-sm btn-block text-white" id="Cash_Denom_btn"><i class="material-icons"></i> Cash Denom</button>
        </div>	 -->
        
    </div>	
    <div class="row justify-content-center">
        <div class="form-group col-md-2 mb-3">
        <!-- <a class="btn btn-info btn-sm btn-block text-white" disabled id="save_btn"><i class="material-icons"></i> Save</a> -->
		<button type="button" class="btn btn-info btn-sm btn-block text-white"  id="save_btn" onclick="post_Sale();">Save</button>
        </div>	
    </div>
</div>



</div>


</div>
</div>
</div>
</div>

</div>
</div>

<div class="modal fade" id="cash_denom_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-weight-normal" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn bg-gradient-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>




<?php
require_once('Include/footer.php');
?>
 <script src="../assets/js/proc_misc.js"></script>

 <?php
}
else{
    header('location:../login');
}
?>