'use strict';

$(window).on('load',function(){
    trans_mode('cash_opt');
    load_gl();
    allow_key("#vouch_amt, #mem_sb_acct");
});
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
function allow_key(p){
    $(p).keypress(function (e) {    
    
        var charCode = (e.which) ? e.which : event.keyCode    
    
        if (String.fromCharCode(charCode).match(/[^0-9.]/g))    
    
            return false;                        
    
    });
}
function enbale_btn(){
    if($("#sb_id").val()!=null){
        $("#save_btn").removeAttr('disabled',true);
    }
    else{
        $("#save_btn").attr('disabled',true);
    }
}
function hide_sb(p){
    if(p=='P'){
        $("#sb_opt").attr('disabled',true);
    }
    if(p=='R'){
        $("#sb_opt").removeAttr('disabled',true);
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
    // if(p=='credit_opt'){
    //     $("#cash_div").attr('style','display:none');
    //     $("#bank_div").attr('style','display:none;');
    //     $("#sb_div").attr('style','display:none;');
    //     $("#save_btn").removeAttr('disabled',true);
    //     $("#bank_Id").empty();
    //     $("#bank_Id").append('<option value="" selected="" disabled="" >Select Bank Account</option>');
    //     $("#sb_id").empty();
    //     $("#sb_id").append('<option value="" selected="" disabled="" >Select S/B Account</option>');
    //     // $("#Cash_Denomination").attr('style','display:none;');
    //     $("#balance_lable").attr('style','display:none;');
    // }
    if(p=='sb_opt'){
        // fetch_sb_account();
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
    var mem_id = $("#mem_sb_acct").val();
    if(mem_id==''){
        simple_alert('Warning','Please Enter Account Number First','warning');  
    }
    else if(mem_id.length!=6){
        simple_alert('Warning','Please Enter Valid Account Number First','warning');  
    }
    else{
        $.ajax({
            type: "POST",
            url: "method/ajax.php",
            data: {pParty_Sb_Vouch:mem_id},
            success: function (response) {
                // console.log(response);
                $("#save_btn").removeAttr('disabled');
                var data = JSON.parse(response);
                data.forEach(function(sb_darta) {
                    $("#pSb_Acct_Id").val(sb_darta.Account_ID);
                    $("#sb_balance").text(Number(sb_darta.Cur_Balance).toFixed(2));
                    $("#balance_lable").removeAttr('style');
                });
            }
        });
    }
    
}

function load_gl(){
    $.ajax({
        type: "POST",
        url: "method/ajax.php",
        data: {pVouch_GL_Get:0},
        success: function (response) {
            var data = JSON.parse(response);
            $("#acct_ledg").empty();
            $("#acct_ledg").append('<option value="" selected="" disabled="" >Select Ledger</option>');
            data.forEach(function(gl_data) {
                $("#acct_ledg").append('<option value="'+ gl_data.Account_ID +'" >'+ gl_data.gl_Name +'</option>');
            });
        }
    });
}

function post_voucher(){
    var pVouch_Date = $("#purchase_Date").val();
    var pRef_Vouch_No = $("#ref_pur_No").val();
    var pVouch_Type = $("#vouch_type").val();
    var pLedg_Id = $("#acct_ledg").val();
    // var pSubGL_Count = $("#sub_count").val();
    var pSubGL_Id = 0;
    var pAmounnt = $("#vouch_amt").val();
    var pNarration = $("#narration").val();
    var pPaid_Mode='';
    var pBank_Id = 'null';
    var pSb_Id='null';
    if($("#cash_opt").prop('checked')==true){
        pPaid_Mode='Cash';
    }
    if($("#bank_opt").prop('checked')==true){
        pPaid_Mode='Bank';
        pBank_Id = $("#bank_Id").val();
    }
    if($("#sb_opt").prop('checked')==true){
        pPaid_Mode='Savings';
        pSb_Id = $("#pSb_Acct_Id").val();
    }
    if(pVouch_Date==''){
        simple_alert('Warning','Please Select Voucher Date','warning');
    }
    else if(pRef_Vouch_No==''){
        simple_alert('Warning','Please Enter Voucher No','warning');
    }
    else if(pVouch_Type==null){
        simple_alert('Warning','Please Select Voucher Type','warning');
    }
    else if(pLedg_Id==null){
        simple_alert('Warning','Please Select Account Ledger','warning');
    }
    else if(pNarration==''){
        simple_alert('Warning','Please Enter Narration','warning'); 
    }
    else if((pAmounnt*1)==0 || pAmounnt==''){
        simple_alert('Warning','Please Enter Amount','warning');
    }
    else if(pPaid_Mode=='Savings' && $("#pSb_Acct_Id").val()==''){
        simple_alert('Warning','Please Enter  Savings Account ','warning');
    }
    else if(pPaid_Mode=='Bank' && $("#bank_Id").val()==null){
        simple_alert('Warning','Please Select  Bank Account ','warning');
    }
    else{
        $("#save_btn").attr('disabled',true);
        $("#save_btn").text('Please Wait..');
        $.ajax({
            type: "POST",
            url: "method/post_vouch.php",
            data: {pVouch_Date:pVouch_Date,pRef_Vouch_No:pRef_Vouch_No,pNarration:pNarration,pVouch_Type:pVouch_Type,pPaid_Mode:pPaid_Mode,pLedg_Id:pLedg_Id,pSubGL_Id:pSubGL_Id,pBank_Id:pBank_Id,pSb_Id:pSb_Id,pAmounnt:pAmounnt},
            success: function (response) {
                console.log(response);
                var data = JSON.parse(response);
                data.forEach(function(vouch_proc) {
                    if(vouch_proc.Errorno<0){
                        simple_alert('Error',vouch_proc.message,'error');
                        $("#save_btn").removeAttr('disabled',true);
                        $("#save_btn").text('Save');
                    }
                    if(vouch_proc.Errorno==0){
                        post_msg('Success',vouch_proc.message,'success');
                    }
                });
            }
        });
    }
}