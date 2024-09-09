'use strict';
const elToggle  = document.querySelector("#Cash_Denom_btn");
const elContent = document.querySelector("#Cash_Denomination");

// elToggle.addEventListener("click", function() {
// elContent.classList.toggle("is-hidden");
// });
$(window).on('load',function(){
    sale_opt('mem_opt');
    trans_mode('cash_opt');
    allow_key("#misc_Amt");
   
});
function sale_no_load(){
    $.ajax({
        type: "POST",
        url: "method/ajax.php",
        async:false,
        data: {pSales_ref_No:0},
        success: function (response) {
            // console.log(response);
            var data = JSON.parse(response);
            data.forEach(function(sales_no) {
                $("#ref_pur_No").val(sales_no.sales_no);
            });
        }
    });
}
function sale_opt(p){
    if(p=='mem_opt'){
        fetch_mem();
        $("#party_div").removeAttr('style');
        $("#mem_drop_lbl").text('Select Member');
        $("#mem_name").attr('readonly',true);
        $("#address").attr('readonly',true);
        $("#mem_mob").attr('readonly',true);
        $("#mem_name").val('');
        $("#address").val('');
        $("#mem_mob").val('');
        $("#gst_in_No").val(''); 
        $("#sb_opt").removeAttr('disabled');
        $("#credit_opt").attr('disabled',true);  
    }
    if(p=='party_opt'){
        fetch_party();
        $("#party_div").removeAttr('style');
        $("#mem_drop_lbl").text('Select Party');
        $("#mem_name").attr('readonly',true);
        $("#address").attr('readonly',true);
        $("#mem_mob").attr('readonly',true);
        $("#mem_name").val('');
        $("#address").val('');
        $("#mem_mob").val('');
        $("#gst_in_No").val('');
        $("#sb_opt").attr('disabled',true); 
        $("#credit_opt").removeAttr('disabled');  
    }
    if(p=='other_opt'){
        $("#party_div").attr('style','display:none');
        $("#mem_name").removeAttr('readonly',true);
        $("#address").removeAttr('readonly',true);
        $("#mem_mob").removeAttr('readonly',true);  
        $("#mem_name").val('');
        $("#address").val('');
        $("#mem_mob").val('');
        $("#gst_in_No").val('');
        $("#sb_opt").attr('disabled',true);
        $("#credit_opt").attr('disabled',true);
    }
}

function trans_mode(p){
    $("#"+p+"").attr('checked',true);
    if(p=='cash_opt'){
        $("#bank_div").attr('style','display:none;');
        $("#sb_div").attr('style','display:none;');
        $("#cash_div").removeAttr('style');
        $("#save_btn").removeAttr('disabled',true);
        $("#bank_Id").empty();
        $("#bank_Id").append('<option value="" selected="" disabled="" >Select Bank Account</option>');
        $("#sb_id").empty();
        $("#sb_id").append('<option value="" selected="" disabled="" >Select S/B Account</option>');
        // $("#Cash_Denomination").removeAttr('style','display:none;');
        $("#balance_lable").attr('style','display:none;');
    }
    if(p=='bank_opt'){
        fetch_bank_acct();
        $("#cash_div").attr('style','display:none');
        $("#sb_div").attr('style','display:none;');
        $("#save_btn").attr('disabled',true);
        $("#bank_div").removeAttr('style');
        $("#sb_id").empty();
        $("#sb_id").append('<option value="" selected="" disabled="" >Select S/B Account</option>');
        // $("#Cash_Denomination").attr('style','display:none;');
        $("#balance_lable").attr('style','display:none;');
    }
    if(p=='credit_opt'){
        $("#cash_div").attr('style','display:none');
        $("#bank_div").attr('style','display:none;');
        $("#sb_div").attr('style','display:none;');
        $("#save_btn").removeAttr('disabled',true);
        $("#bank_Id").empty();
        $("#bank_Id").append('<option value="" selected="" disabled="" >Select Bank Account</option>');
        $("#sb_id").empty();
        $("#sb_id").append('<option value="" selected="" disabled="" >Select S/B Account</option>');
        // $("#Cash_Denomination").attr('style','display:none;');
        $("#balance_lable").attr('style','display:none;');
    }
    if(p=='sb_opt'){
        fetch_sb_account();
        $("#cash_div").attr('style','display:none');
        $("#bank_div").attr('style','display:none;');
        $("#save_btn").attr('disabled',true);
        $("#bank_Id").empty();
        $("#bank_Id").append('<option value="" selected="" disabled="" >Select Bank Account</option>'); 
        $("#sb_div").removeAttr('style');
        // $("#Cash_Denomination").attr('style','display:none;');
        $("#balance_lable").attr('style','display:none;');
    }
}

function fetch_sb_account(){
    var mem_id = $("#Party_Idd").val();
    if(mem_id==null){
        simple_alert('Warning','Please Select Member First','warning');  
    }
    else{
        $.ajax({
            type: "POST",
            url: "method/ajax.php",
            data: {pFetch_mem_sbAcct:mem_id},
            success: function (response) {
                // console.log(response);
                var data = JSON.parse(response);
                $("#sb_id").empty();
                $("#sb_id").append('<option value="" selected="" disabled="" >Select S/B Account</option>');
                data.forEach(function(sb_darta) {
                    $("#sb_id").append('<option value="'+ sb_darta.Account_ID +'" >'+ sb_darta.Account_No +' - '+ sb_darta.Ref_AcNo +'</option>')
                });
            }
        });
    }
    
}
function check_bal(){
    var sb_Id = $("#sb_id").val();
    var sale_Date = $("#purchase_Date").val();
    var tot_Amount = $("#misc_Amt").val();
    if(sb_Id==null){
        simple_alert('Warning','Please Select Account First','warning');  
    }
    else if(sale_Date==''){
        simple_alert('Warning','Please Select Sale Date','warning'); 
    }
    else if(tot_Amount==''||tot_Amount==0){
        simple_alert('Warning','Total Amount Cannot Be Zero','warning'); 
    }
    else{
        $.ajax({
            type: "POST",
            url: "method/ajax.php",
            data: {pMemsb_Id:sb_Id,pSale_Date:sale_Date},
            success: function (response) {
                var data = JSON.parse(response);
                $("#balance_lable").removeAttr('style','display:none;');
                // console.log(tot_Amount);
                data.forEach(function(get_bal) {
                    $("#sb_balance").text(Number(get_bal.Balance).toFixed(2));
                    $("#mem_bal").val(Number(get_bal.Balance).toFixed(2));
                    var sb_Bal = Number(get_bal.Balance).toFixed(2)
                    if((tot_Amount*1)<(sb_Bal*1)){
                        $("#save_btn").removeAttr('disabled',true);
                    }
                    else{
                        simple_alert('Warning','Not Sufficient Balance In Savings Account','warning');
                        $("#save_btn").attr('disabled',true);
                    }

                });
            }
        });
    }
}
function fetch_bank_acct(){
    $.ajax({
        type: "POST",
        url: "method/ajax.php",
        data: {pFetch_Bank_Acct:0},
        success: function (response) {
            var data = JSON.parse(response);
            $("#bank_Id").empty();
            $("#bank_Id").append('<option value="" selected="" disabled="" >Select Bank Account</option>');
            data.forEach(function(bank_data) {
                $("#bank_Id").append('<option value="'+ bank_data.BankLedgr_ID +'" >'+ bank_data.BankLedgr_Desc +'</option>')
            });
        }
    });
}
function fetch_mem(){
    $.ajax({
        type: "POST",
        url: "method/ajax.php",
        data: {pFetch_mem:0},
        success: function (response) {
           var data = JSON.parse(response);
           $("#Party_Idd").empty();
           $("#Party_Idd").append('<option value="" selected="" disabled="" >Select Member</option>');
           data.forEach(function(mem_data) {
           $("#Party_Idd").append('<option value="'+ mem_data.Member_ID +'" >'+ mem_data.Member_Code +' - '+ mem_data.Member_Name +' - '+ mem_data.Relation_Name+'</option>');
            
           }); 
        }
    });
}
function fetch_party(){
    $.ajax({
        type: "POST",
        url: "method/ajax.php",
        data: {pFetch_Party_sale:0},
        success: function (response) {
           var data = JSON.parse(response);
           $("#Party_Idd").empty();
           $("#Party_Idd").append('<option value="" selected="" disabled="" >Select Member</option>');
           data.forEach(function(mem_data) {
           $("#Party_Idd").append('<option value="'+ mem_data.Id +'" >'+ mem_data.Party_Name +'</option>');
            
           }); 
        }
    });
}
function fetch_part_dtls(p){
    if($("#mem_opt").prop('checked')==true){
        $.ajax({
            type: "POST",
            url: "method/ajax.php",
            data: {pFetch_cust_data:p},
            success: function (response) {
                var data = JSON.parse(response);
                data.forEach(function(fetch_mem) {
                    $("#mem_name").val(fetch_mem.Member_Name);
                    if(fetch_mem.Address==''){
                        $("#address").val(''); 
                        $("#address").removeAttr('readonly');
                    }
                    else{
                        $("#address").val(fetch_mem.Address);
                    }
                    $("#mem_mob").val(fetch_mem.Phone_No);
                    $("#gst_in_No").val('');
                });
            }
        });
    }
    else if($("#party_opt").prop('checked')==true){
        $.ajax({
            type: "POST",
            url: "method/ajax.php",
            data: {pFetch_Party_Data:p},
            success: function (response) {
                var data = JSON.parse(response);
                data.forEach(function(fetch_mem) {
                    $("#mem_name").val(fetch_mem.Party_Name);
                    if(fetch_mem.Address==''){
                        $("#address").val(''); 
                        $("#address").removeAttr('readonly');
                    }
                    else{
                        $("#address").val(fetch_mem.Party_Address);
                    }
                    
                    $("#mem_mob").removeAttr('readonly');
                    $("#mem_mob").val(fetch_mem.Party_Mobile);
                    $("#gst_in_No").val(fetch_mem.Party_GSTIN);
                });
            }
        });
    }
    
}




function allow_key(p){
    $(p).keypress(function (e) {    
        var character = String.fromCharCode(e.keyCode)
    var newValue = this.value + character;
    if (isNaN(newValue) || hasDecimalPlace(newValue, 3)) {
        e.preventDefault();
        return false;
    }
    
                                 
    
    });
}
function hasDecimalPlace(value, x) {
    var pointIndex = value.indexOf('.');
    return  pointIndex >= 0 && pointIndex < value.length - x;
}

    function post_Sale(){
        var ref_sale_No = $("#ref_pur_No").val();
        var party_ID = $("#Party_Idd").val();
        var mem_name = $("#mem_name").val();
        var mem_add = $("#address").val();
        var mem_mob_no = $("#mem_mob").val();
        var party_Type = '';
        var pBank_Id = $("#bank_Id").val();
        var sb_Id = $("#sb_id").val();
        var sale_Date = $("#purchase_Date").val();
        var tot_amount = $("#misc_Amt").val();
        var sav_Bal = $("#mem_bal").val();
        var pPaid_Mode='';
        if($("#mem_opt").prop('checked')==true){
            party_Type='M';
        }
        if($("#party_opt").prop('checked')==true){
            party_Type='P';
        }
        if($("#other_opt").prop('checked')==true){
            party_Type='C';
        }
        if($("#cash_opt").prop('checked')==true){
            pPaid_Mode='Cash';
        }
        if($("#bank_opt").prop('checked')==true){
            pPaid_Mode='Bank';
        }
        if($("#sb_opt").prop('checked')==true){
            pPaid_Mode='Savings';
        }
        if($("#credit_opt").prop('checked')==true){
            pPaid_Mode='Credit';
        }
        if(sale_Date==''){
            simple_alert('Warning','Please Select Sale Date','warning');
        }
        else if(ref_sale_No==''){
            simple_alert('Warning','Please Enter Ref Sale No','warning');
        }
        else if(mem_name==''){
            simple_alert('Warning','Please Entter Member Name','warning');
        }
        else if(mem_add==''){
            simple_alert('Warning','Please Entter Member Address','warning');
        }
        else if(mem_mob_no==''){
            simple_alert('Warning','Please Entter Member Mobile No','warning');
        }
        else if(tot_amount==''||tot_amount==0){
            simple_alert('Warning','Sale Amount Cannot Be Zero','warning');
        }
        else if($("#sb_opt").prop('checked')==true && (tot_amount*1)>(sav_Bal*1)){
            simple_alert('Warning','Not Sufficient Balance In Savings Account','warning');
        }
        else{
            $("#save_btn").attr('disabled',true);
            $("#save_btn").text('Please Wait..');

            $.ajax({
                type: "POST",
                url: "method/misc_vouch.php",
                data: {sale_Date:sale_Date,ref_sale_No:ref_sale_No,pPaid_Mode:pPaid_Mode,party_ID:party_ID,pBank_Id:pBank_Id,sb_Id:sb_Id,tot_amount:tot_amount,pMem_Name:mem_name,pMem_Add:mem_add,pMem_Mob:mem_mob_no,party_Type:party_Type},
                success: function (response) {
                    // console.log(response);
                    var data = JSON.parse(response);
                    data.forEach(function(misc_post) {
                        var error_no = misc_post.Errorno;
                        var error_msg = misc_post.message;
                        var sale_id = misc_post.misc_id;

                        if(error_no<0){
                            post_msg('Error',error_msg,'error');
                        }
                        else{
                            post_msg('Success',error_msg+'No Is '+misc_post.misc_no,'success');
                            setCookie('misc_id',sale_id,'1');
                            setCookie('misc_date',sale_Date,'1');
                            setCookie('misc_no',misc_post.misc_no,'1');
                            window.open("print_misc3.php", "popupWindow", "width=600,height=600,scrollbars=yes");
                        }
                    });
                }
            });
         
        }
    }
    function setCookie(cname, cvalue, exdays) {
        const d = new Date();
        d.setTime(d.getTime() + (exdays*24*60*60*1000));
        let expires = "expires="+ d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
      }
    function pur_form_clean(){
        sale_opt('mem_opt');
        trans_mode('cash_opt');
        $("#igst_lbl_tot").text('0.00');
        $("#ref_pur_No").val('');
        $("#mem_name").val('');
        $("#address").val('');
        $("#mem_mob").val('');
    }