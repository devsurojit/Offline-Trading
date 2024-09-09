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
						<input type="date" class="form-control" id="purchase_Date" value="<?php echo date('Y-m-d'); ?>" name="purchase_Date" min="<?php echo $_SESSION['fin_frm_dt']  ?>" max="<?php echo date("Y-m-d");  ?>" >
					</div>
				
					
					<div class="form-group col-md-2 mb-2 is-focused bmd-form-group">
					<label class="bmd-label-floating">Reference Sale Bill No</label>
					<input type="text" class="form-control" id="ref_pur_No" required="true" name="ref_pur_No" autocomplete="off">
					</div>
					
					
					<div class="form-group col-md-4 mb-4 bmd-form-group is-focused" id="party_div">
						<label class="bmd-label-floating" id="mem_drop_lbl">Select Member</label>
						<select class="form-control select2-hidden-accessible" data-style="btn btn-link" id="Party_Idd" name="Party_Idd" onchange="fetch_part_dtls(this.value);" tabindex="-1" aria-hidden="true">
						<option value="" selected="" disabled="" >Select Member</option>
                            	
                        </select>

					</div>
					<div class="form-group col-md-4 mb-4 bmd-form-group is-focused" id="wh_div">
						<label class="bmd-label-floating">Select warehouse</label>
						<select class="form-control select2-hidden-accessible" data-style="btn btn-link" id="whare_house" name="whare_house" tabindex="-1" aria-hidden="true">
						<option value="" selected="" disabled="" >Select warehouse</option>
                            	
                        </select>

					</div>
					<div class="form-group col-md-3 mb-2 is-focused bmd-form-group">
					<label class="bmd-label-floating">Member Name</label>
					<input type="text" class="form-control" id="mem_name" required="true" name="mem_name" autocomplete="off">
					</div>
                    <div class="form-group col-md-4 mb-2 is-focused bmd-form-group">
					<label class="bmd-label-floating">Address</label>
					<input type="text" class="form-control" id="address" required="true" name="address" autocomplete="off">
					</div>
					<div class="form-group col-md-2 mb-2 is-focused bmd-form-group">
					<label class="bmd-label-floating">Mobile No</label>
					<input type="text" class="form-control" id="mem_mob" required="true" name="mem_mob" autocomplete="off">
					</div>
                    <div class="form-group col-md-2 mb-2 is-focused bmd-form-group">
					<label class="bmd-label-floating">GSTIN No</label>
					<input type="text" class="form-control" id="gst_in_No" required="true" name="gst_in_No" autocomplete="off">
					</div>
					<div class="form-group col-md-2 mb-2 is-focused bmd-form-group">
					<label class="bmd-label-floating">Nominee Name</label>
					<input type="text" class="form-control" id="nom_name" required="true" name="nom_name" autocomplete="off">
					</div>
					<div class="form-group col-md-2 mb-2 is-focused bmd-form-group">
					<label class="bmd-label-floating">Nominee Relation</label>
					<input type="text" class="form-control" id="nom_rel" required="true" name="nom_rel" autocomplete="off">
					</div>
				</div>									
			
      </form>
    </div>
    </div>
  </div>  
</div>
</div>

<div class="card">
<div class="card-header card-header-tabs card-header-primary">
	<h4 class="mb-0">Add Item</h4>
    <h4 class="mb-2" style="float: right;margin-top: -25px;">Available Stock : <span id="curr_stock_lbl"></span></h4>
</div>
	
<div class="card-body">

				<div class="form-row">
					<div class="form-group col-md-3 mb-3 bmd-form-group is-focused" id="item_div">
						<label class="bmd-label-floating">Select Item</label>
						<select class="form-control select2-hidden-accessible" data-style="btn btn-link" id="Item_Id" name="Item_Id" tabindex="-1" aria-hidden="true" onchange="load_item_unit();">
						<option value="" selected="" disabled="" >Select Item</option>						
                </select>
                <input type="hidden" id="hidd_stock" name="hidd_stock">
                <input type="hidden" id="hidd_rate" name="hidd_rate">
					</div>
                    
					
					
					
					<div class="form-group col-md-3 mb-3 bmd-form-group is-focused" id="unit_div">
						<label class="bmd-label-floating ">Select Unit</label>
						<select class="form-control select2-hidden-accessible" data-style="btn btn-link" id="Unit_Id" name="Unit_Id" tabindex="-1" onchange="get_unit_val(this.value);" aria-hidden="true">
						<option value="" selected="" disabled="" >Select Unit</option>
						</select>
                        
					</div>
                    <div class="form-group col-md-3 mb-3 is-focused bmd-form-group" id="qnty_div">
					<label class="bmd-label-floating">Quantity</label>
					<input type="text" class="form-control " id="Itm_Qny" name="Itm_Qny" onkeyup="check_qnty(this.value);" autocomplete="off">
					</div>
					
					
					<div class="form-group col-md-3 mb-3">
					<a class="btn btn-info btn-sm btn-block text-white" onclick="add_item();"><i class="material-icons">add</i> Add Item</a>
					</div>
					
				</div>



</div>


</div>
<div class="card">

	
<div class="card-body">

				<input type="hidden" id="party_Id" name="party_Id" value="">
				<hr>
				<table id="faqs" class="table table-strip">
					<thead>
						<tr>
							<th>SL</th>
							<th style="display:none;">party_ID</th>
							<th style="width: 30%;">Item</th>
                            <th style="display:none;">item_Id</th>
							<th>Qnt.</th>
							<th>Unit</th>
							<th style="display:none;">Unit_id</th>
							<th>Rate</th>
							<th>SGST</th>
                            <th style="display:none;">sgst_rate</th>
							<th>CGST</th>
                            <th style="display:none;">cgst_rate</th>
							<th>IGST</th>
                            <th style="display:none;">igst_rate</th>
							<th>TOTAL</th>
                            <th style="display:none;">gross_val</th>
                            <th style="display:none;">wh_Id</th>
                            <th style="display:none;">sale_gl-id</th>
							<th style="width: 10%;" class="text-center">Action</th>
                            <th style="display:none;">hidd_rate</th>
						</tr>
					</thead>
					<tbody id="pur_table_data">
                        
					</tbody>
				</table>
				<hr>
				<div class="row">
					<div class="col-sm-8">
						<h4>Terms &amp; Conditon</h4>
						<p>     
The GST Act has defined time limit to issue GST tax invoice, revised GST bill, debit note, and credit note.  <br> Following are the due dates for issuing an invoice to customers</p>
					</div>
					<div class="col-sm-4">
						<div class="row">					
						<label class="col-sm-3 col-form-label">SGST :</label>
						<div class="col-sm-9">
							<div class="form-group bmd-form-group">
							<label class="col-sm-10 col-form-label pt-0" style="color:#aab1c7;font-size:16px; padding-top: 12px !important;" id="sgst_lbl_tot">0.00</label>
							
							
							<span class="bmd-help"></span>
							</div>
						</div>
					</div>
					<div class="row">
						<label class="col-sm-3 col-form-label">CGST :</label>
						<div class="col-sm-9">
							<div class="form-group bmd-form-group">
							<label class="col-sm-10 col-form-label pt-0" style="color:#aab1c7;font-size:16px; padding-top: 12px !important;" id="cgst_lbl_tot">0.00</label>
							
							<span class="bmd-help"></span>
							</div>
						</div>
					</div>
					<div class="row">
						<label class="col-sm-3 col-form-label">IGST :</label>
						<div class="col-sm-9">
							<div class="form-group bmd-form-group">
							<label class="col-sm-10 col-form-label pt-0" style="color:#aab1c7;font-size:16px; padding-top: 12px !important;" id="igst_lbl_tot">0.00</label>
							
							<span class="bmd-help"></span>
							</div>
						</div>
					</div>
					<div class="row">
						<label class="col-sm-3 col-form-label">Discount:</label>
						<div class="col-sm-9" style="padding-right: 15.5%;">
							<div class="form-group bmd-form-group is-filled">
							<input type="text" class="form-control decimal text-right" style="font-size: 16px;" autocomplete="off" id="disc_value" name="disc_value" onkeyup="cal_tot_amt();" placeholder="0.00">
							<span class="bmd-help"></span>
							</div>
						</div>
					</div>
					<div class="row">
						<label class="col-sm-3 col-form-label">Carriage (+) :</label>
						<div class="col-sm-9" style="padding-right: 15.5%;">
							<div class="form-group bmd-form-group is-filled">
							<input type="text" class="form-control decimal text-right" style="font-size: 16px;" id="carr_val" autocomplete="off" name="carr_val" onkeyup="cal_tot_amt();" placeholder="0.00">
							<span class="bmd-help"></span>
							</div>
						</div>
					</div>
					<div class="row">
						<label class="col-sm-3 col-form-label">Service Charge (+) :</label>
						<div class="col-sm-9" style="padding-right: 15.5%;">
							<div class="form-group bmd-form-group is-filled">
							<input type="text" class="form-control decimal text-right" style="font-size: 16px;" id="serv_val" name="serv_val" autocomplete="off" onkeyup="cal_tot_amt();" placeholder="0.00">
							<span class="bmd-help"></span>
							</div>
						</div>
					</div>
					<div class="row">
						<label class="col-sm-3 col-form-label">Round Off:</label>
						<div class="col-sm-9">
							<div class="form-group bmd-form-group">
							<label class="col-sm-10 col-form-label pt-0" style="color:#aab1c7;font-size:16px; padding-top: 12px !important;" id="round_val_show">0.00</label>
							<input type="hidden" id="round_value" name="round_value" value="0">
							<span class="bmd-help"></span>
							</div>
						</div>
					</div>
					</div>
				</div>
				<hr>
				<div class="row" style="font-weight:400; font-size:16px; color:#000;">
					<div class="col-sm-8">
						<p class="text-rignt">Inword: <span id="in_word">Zero Only</span></p>
					</div>
					<div class="col-sm-4">
					<div class="row">
						<label class="col-sm-3 col-form-label pt-0" style="color:#000;">Total</label>
						<div class="col-sm-9">
							<div class="form-group bmd-form-group mt-0">
							<label class="col-sm-10 col-form-label pt-0" id="tot_ord_val" style="color:#000;font-size:16px;">0.00</label>
							<input type="hidden" id="org_tot" name="org_tot">
							<input type="hidden" id="finaltotal" name="finaltotal">
							<span class="bmd-help"></span>
							</div>
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

<div class="card is-hidden" id="Cash_Denomination">
	<div class="card-header card-header-tabs card-header-primary">
		<h4 class="mb-0">Cash Denomination</h4>
		<!-- <button onclick="addfaqs();" class="btn btn-sm mb-0" style="float: right;margin-top: -28px;background: #0002046b;border: 0;border-radius: 0;"><i class="material-icons">add </i> ADD NEW</button> -->
	</div>
		
	<div class="card-body">
		<div class="container">
			<div class="row section_block">
				<div class="col-md-12">
				<div class="row" style="padding: 0px 15px 0 15px;">
					<div class='col-sm-6 col-xs-12'>
						<h3>Input Cash</h3>
						<div class="table-responsive">
							<table class="table table-striped jambo_table bulk_action"
								style="margin-bottom: 0 !important">
								<thead>
									<tr class="headings">
										<th>Type</th>
										<th>Unit</th>
										<th>Qty</th>
										<th>Total</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Notes</td>
										<td>2000</td>
										<td><input id="input_2000_curren" name="input_2000_curren"
												class="noteinputClass" placeholder="0"
												oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength); CurrencyCal();"
												type="text" maxlength="7" autocomplete="off" /></td>
										<td><Strong>
												<p class="text-right" id="inp2000tot">0</p>
											</Strong></td>
									</tr>

									<tr>
										<td>Notes</td>
										<td>500</td>
										<td><input id="input_500_curren" name="input_500_curren"
												class="noteinputClass" placeholder="0"
												oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);CurrencyCal();"
												type="text" maxlength="7" autocomplete="off" /></td>
										<td><Strong>
												<p class="text-right" id="inp500tot">0</p>
											</Strong></td>
									</tr>
									<tr>
										<td>Notes</td>
										<td>200</td>
										<td><input id="input_200_curren" name="input_200_curren"
												class="noteinputClass" placeholder="0"
												oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);CurrencyCal()"
												type="text" maxlength="7" autocomplete="off" /></td>
										<td><Strong>
												<p class="text-right" id="inp200tot">0</p>
											</Strong></td>
									</tr>
									<tr>
										<td>Notes</td>
										<td>100</td>
										<td><input id="input_100_curren" name="input_100_curren"
												class="noteinputClass" placeholder="0"
												oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);CurrencyCal()"
												type="text" maxlength="7" autocomplete="off" /></td>
										<td><Strong>
												<p class="text-right" id="inp100tot">0</p>
											</Strong></td>
									</tr>
									<tr>
										<td>Notes</td>
										<td>50</td>
										<td><input id="input_50_curren" name="input_50_curren"
												class="noteinputClass" placeholder="0"
												oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);CurrencyCal()"
												type="text" maxlength="7" autocomplete="off" /></td>
										<td><Strong>
												<p class="text-right" id="inp50tot">0</p>
											</Strong></td>
									</tr>
									<tr>
										<td>Notes</td>
										<td>20</td>
										<td><input id="input_20_curren" name="input_20_curren"
												class="noteinputClass" placeholder="0"
												oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);CurrencyCal()"
												type="text" maxlength="7" autocomplete="off" /></td>
										<td><Strong>
												<p class="text-right" id="inp20tot">0</p>
											</Strong></td>
									</tr>
									<tr>
										<td>Notes</td>
										<td>10</td>
										<td><input id="input_10_curren" name="input_10_curren"
												class="noteinputClass" placeholder="0"
												oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);CurrencyCal()"
												type="text" maxlength="7" autocomplete="off" /></td>
										<td><Strong>
												<p class="text-right" id="inp10tot">0</p>
											</Strong></td>
									</tr>
									<tr>
										<td>Notes</td>
										<td>5</td>
										<td><input id="input_5_curren" name="input_5_curren"
												class="noteinputClass" placeholder="0"
												oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);CurrencyCal()"
												type="text" maxlength="7" autocomplete="off" /></td>
										<td><Strong>
												<p class="text-right" id="inp5tot">0</p>
											</Strong></td>
									</tr>

									<tr>
										<td>Coins</td>
										<td>1</td>
										<td><input id="input_1con_curren" name="input_1con_curren"
												class="noteinputClass" placeholder="0"
												oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);CurrencyCal()"
												type="text" maxlength="7" autocomplete="off" /></td>
										<td><Strong>
												<p class="text-right" id="inp1contot">0</p>
											</Strong></td>
									</tr>
									<tr>
										<td colspan="3"><Strong>Total Cash</Strong></td>
										<td><Strong>
												<p class="text-right" id="inpcastot">0</p>
											</Strong></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<div class='col-sm-6 col-xs-12'>
						<h3>Output Cash</h3>
						<div class="table-responsive">
							<table class="table table-striped jambo_table bulk_action"
								style="margin-bottom: 0 !important">
								<thead>
									<tr class="headings">
										<th>Type</th>
										<th>Unit</th>
										<th>Qty</th>
										<th>Total</th>
									</tr>
								<tbody>
									<tr>
										<td>Notes</td>
										<td>2000</td>
										<td><input id="output_2000_curren" name="output_2000_curren"
												class="noteinputClass" placeholder="0"
												oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength); CurrencyCal();"
												type="text" maxlength="7" /></td>
										<td><strong>
												<p class="text-right" id="opt2000tot">0</p>
											</strong></td>
									</tr>
									<tr>
										<td>Notes</td>
										<td>500</td>
										<td><input id="output_500_curren" name="output_500_curren"
												class="noteinputClass" placeholder="0"
												oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);CurrencyCal();"
												type="text" maxlength="7" autocomplete="off" /></td>
										<td><strong>
												<p class="text-right" id="opt500tot">0</p>
											</strong></td>
									</tr>
									<tr>
										<td>Notes</td>
										<td>200</td>
										<td><input id="output_200_curren" name="output_200_curren"
												class="noteinputClass" placeholder="0"
												oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);CurrencyCal()"
												type="text" maxlength="7" autocomplete="off" /></td>
										<td><strong>
												<p class="text-right" id="opt200tot">0</p>
											</strong></td>
									</tr>
									<tr>
										<td>Notes</td>
										<td>100</td>
										<td><input id="output_100_curren" name="output_100_curren"
												class="noteinputClass" placeholder="0"
												oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);CurrencyCal()"
												type="text" maxlength="7" autocomplete="off" /></td>
										<td><strong>
												<p class="text-right" id="opt100tot">0</p>
											</strong></td>
									</tr>
									<tr>
										<td>Notes</td>
										<td>50</td>
										<td><input id="output_50_curren" name="output_50_curren"
												class="noteinputClass" placeholder="0"
												oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);CurrencyCal()"
												type="text" maxlength="7" autocomplete="off" /></td>
										<td><strong>
												<p class="text-right" id="opt50tot">0</p>
											</strong></td>
									</tr>
									<tr>
										<td>Notes</td>
										<td>20</td>
										<td><input id="output_20_curren" name="output_20_curren"
												class="noteinputClass" placeholder="0"
												oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);CurrencyCal()"
												type="text" maxlength="7" autocomplete="off" /></td>
										<td><strong>
												<p class="text-right" id="opt20tot">0</p>
											</strong></td>
									</tr>
									<tr>
										<td>Notes</td>
										<td>10</td>
										<td><input id="output_10_curren" name="output_10_curren"
												class="noteinputClass" placeholder="0"
												oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);CurrencyCal()"
												type="text" maxlength="7" autocomplete="off" /></td>
										<td><strong>
												<p class="text-right" id="opt10tot">0</p>
											</strong></td>
									</tr>
									<tr>
										<td>Notes</td>
										<td>5</td>
										<td><input id="output_5_curren" name="output_5_curren"
												class="noteinputClass" placeholder="0"
												oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);CurrencyCal()"
												type="text" maxlength="7" autocomplete="off" /></td>
										<td><strong>
												<p class="text-right" id="opt5tot">0</p>
											</strong></td>
									</tr>

									<tr>
										<td>Coins</td>
										<td>1</td>
										<td><input id="output_1con_curren" name="output_1con_curren"
												class="noteinputClass" placeholder="0"
												oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);CurrencyCal()"
												type="text" maxlength="7" autocomplete="off" /></td>
										<td><strong>
												<p class="text-right" id="opt1contot">0</p>
											</strong></td>
									</tr>
									<tr>
										<td colspan="3"><Strong>Total Cash</Strong></td>
										<td><strong>
												<p class="text-right" id="optcastot">0</p>
											</strong></td>
									</tr>


								</tbody>
							</table>
						</div>
					</div>
				</div>
				</div>

				<div class="col-md-12">
				<div class="row" style="padding: 15px 15px 0 15px;">
					<div class="form-group col-md-12 col-xs-12">
						<div class="capsule">

							<label
								class="col-form-label col-md-2 col-sm-2 col-xs-3 label-align left left-lebel"
								for="ApplicationDate" style="padding:6px 6px 6px 15px">
								<h4>Grand Total</h4>
							</label>
							<label class="col-form-label col-md-2 col-sm-2 col-xs-3 label-align"
								for="ApplicationDate" style="padding:6px 6px 6px 15px">
								<h4 id="gandtot"></h4>
							</label>
							<label class="col-form-label col-md-8 col-sm-4 col-xs-6 label-align"
								for="ApplicationDate" style="padding:6px 6px 6px 15px">
								<h4 id="op"></h4>
							</label>
						</div>
					</div>
				</div>
				</div>

			</div>
			<div class="row" style="margin-top: 15px">
				<div class='col-sm-2 col-xs-12 col-lg-offset-4' style="margin-bottom: 15px">
				<input type="button" class="btn btn-warning btn-block" style="margin: 0 auto;display: block;"
						 value="Reset"
						onclick="reset_cash_fild(); javascript: document.getElementById('okbut').setAttribute('disabled', true); "/>
				</div>
				<div class='col-sm-2 col-xs-12'>
					<button type="button" id="okbut" name="okbut" class="btn btn-primary btn-block m-0"
						data-dismiss="modal" aria-label="Close" disabled
						onclick="isblanc()">Done</button>

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
 <script src="../assets/js/sale_process.js"></script>
 <script src="../assets/js/print_bill.js"></script>
 <script src="../assets/js/cur_inward.js"></script>
 <?php
}
else{
    header('location:../login');
}
?>