<?php
ob_start();

session_start();
require_once('Include/header.php');
require_once('Include/slider.php');
require_once('Include/topbar.php');
if(isset($_SESSION['user_id'])){
?>
<div class="modal hide fade" id="war_modal" tabindex="-1"  role="dialog" data-bs-backdrop='static' data-bs-keyboard="false">
    <div class="modal-dialog modal-login" role="document">
        <div class="modal-content">
            <div class="card card-signup card-plain">
                <div class="modal-header">
                  <div class="card-header card-header-primary text-center">
                    <h4 class="card-title">Financial Year Change Detected</h4>                    
                    </div>
                  </div>
                </div>
                <div class="modal-body">
                    <form class="form" >
                        <input type="hidden" id="fin_strt_dt" name="fin_strt_dt" value="<?php echo $_SESSION['fin_frm_dt']; ?>">
                        <input type="hidden" id="fin_end_dt" name="fin_end_dt" value="<?php echo $_SESSION['fin_tdt_dt']; ?>">
                        
                        <div class="card-body">
							<div class="form-group bmd-form-group is-focused">
                            <label for="product_subcategory" class="bmd-label-floating">From Date</label>
                            <input type="date" class="form-control" id="fin_frm_Date" required="true" name="fin_frm_Date" readonly>  
							</div>                           
                        </div>
                        <div class="card-body">
							<div class="form-group bmd-form-group is-focused">
                            <label for="product_subcategory" class="bmd-label-floating">To Date</label>
                            <input type="date" class="form-control" id="fin_to_date" required="true" name="fin_to_date" readonly>  
							</div>                           
                        </div>
                    
                </form></div>
                <div class="modal-footer justify-content-center">
                    <!-- <a href="javascript:;" class="btn btn-primary btn-link btn-wd btn-lg" id="st_wr_btn" style="pointer-events: none; cursor: default;">Set Warehouse</a> -->
                    <button type="submit" id="set_war_h" class="btn btn-primary btn-link btn-wd btn-lg" style="cursor: default;" name="set_war_h" onclick="post_finyear();">Save</button>
                </div>
                
            </div>
        </div>
    </div>
<div class="content" style="padding-bottom: 0;">
<div class="content">
<div class="container-fluid">
<div class="row">
<div class="col-lg-3 col-md-6 col-sm-6">
<div class="card card-stats">
<div class="card-header card-header-info card-header-icon">
<div class="card-icon">
<i class="material-icons">home</i>
</div>
<p class="card-category">WareHouse</p>
<h3 class="card-title" id="tot_whare_house">     
</h3>
</div>
<div class="card-footer">
</div>
</div>
</div>
	
<div class="col-lg-3 col-md-6 col-sm-6">
<div class="card card-stats">
<div class="card-header card-header-warning card-header-icon">
<div class="card-icon" style="margin-right: 0;">
<i class="material-icons">dns</i>
</div>
<p class="card-category">Items</p>
<h3 class="card-title" id="tot_item">     
</h3>
</div>
<div class="card-footer">
</div>
</div>
</div>
	
<div class="col-lg-3 col-md-6 col-sm-6">
<div class="card card-stats">
<div class="card-header card-header-primary card-header-icon">
<div class="card-icon">
<i class="material-icons">ad_units</i>
</div>
 <p class="card-category">Units</p>
<h3 class="card-title" id="tot_unit">     
</h3>
</div>
<div class="card-footer"></div>
</div>
</div>
	
<div class="col-lg-3 col-md-6 col-sm-6">
<div class="card card-stats">
<div class="card-header card-header-rose card-header-icon">
<div class="card-icon">
<i class="material-icons">category</i>
</div>
<p class="card-category">Catagory</p>
<h3 class="card-title" id="tot_cat">     
</h3>
</div>
<div class="card-footer"></div>
</div>
</div>
</div>
<div class="row">
<div class="col-lg-3 col-md-6 col-sm-6">
<div class="card card-stats">
<div class="card-header card-header-icon">
<div class="card-icon bg-navy">
<i class="material-icons">lightbulb_circle</i>
</div>
<p class="card-category">SUB CATEGORY</p>
<h3 class="card-title" id="tot_sub_cat">     
</h3>
</div>
<div class="card-footer">
</div>
</div>
</div>
<div class="col-lg-3 col-md-6 col-sm-6">
<div class="card card-stats">
<div class="card-header card-header-danger card-header-icon">
<div class="card-icon" style="margin-right: 0;">
<i class="material-icons">real_estate_agent</i>
</div>
<p class="card-category">Suppliers</p>
<h3 class="card-title" id="tot_sup">     
</h3>
</div>
<div class="card-footer">
</div>
</div>
</div>
	
<div class="col-lg-3 col-md-6 col-sm-6">
<div class="card card-stats">
<div class="card-header card-header-success card-header-icon">
<div class="card-icon">
<i class="material-icons">post_add</i>
</div>
 <p class="card-category">Customer</p>
<h3 class="card-title" id="tot_cust">     
</h3>
</div>
<div class="card-footer"></div>
</div>
</div>
	
<div class="col-lg-3 col-md-6 col-sm-6">
<div class="card card-stats">
<div class="card-header card-header-default card-header-icon">
<div class="card-icon">
<i class="material-icons">group</i>
</div>
<p class="card-category">Users</p>
<h3 class="card-title" id="tot_user">     
</h3>
</div>
<div class="card-footer"></div>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
</div>

<?php
require_once('Include/footer.php');
?>
<script src="../assets/js/dash_item.js"></script>
<script>
    $(document).ready(function () {   
        
        var fin_fdt = $("#fin_strt_dt").val();
        var fin_tdt = $("#fin_end_dt").val();
        $('.modal').modal({
            dismissible: true
            });
            $.ajax({
                type: "POST",
                url: "method/ajax.php",
                data: {pCheck_fin_fd:fin_fdt,pCheck_fin_td:fin_tdt},
                success: function (response) {
                    // console.log(response);
                    var data = JSON.parse(response);
                    data.forEach(function(fin_data) {
                        var err = fin_data.ErrorNo;
                        var msg = fin_data.Message;
                        var frm_date = fin_data.From_date;
                        var to_date = fin_data.To_date;

                        if(err<0){
                            $("#fin_frm_Date").val(frm_date);
                            $("#fin_to_date").val(to_date);
                            $("#war_modal").modal("open");
                        }
                        else{
                            $("#war_modal").modal("close");
                        }

                    });
                }
            });           
        
            if($("#war_modal").modal("open")){
                $(document).on('keyup', function(e){
                    if (e.keyCode == 27) {
                        $("#war_modal").modal("open");
                    }
                });
            }
    });
   function post_finyear(){
 
    var fin_fdt = $("#fin_frm_Date").val();
    var fin_tdate = $("#fin_to_date").val();

    $.ajax({
        type: "POST",
        url: "method/ajax.php",
        data: {pPost_fin_fd:fin_fdt,pPost_fin_td:fin_tdate},
        success: function (response) {
            var data = JSON.parse(response);
            data.forEach(function(post_fin) {
                var error = post_fin.ErrorNo;
                var msg = post_fin.Message;
                
                if(error<0){
                    simple_alert('Error',msg,'error');
                }
                else{
                    simple_alert('Success',msg,'success');
                    $("#war_modal").modal("close");
                }
            });
        }
    });

   }
 
</script>
<?php
}
else{
    header('location:../login');
}
?>