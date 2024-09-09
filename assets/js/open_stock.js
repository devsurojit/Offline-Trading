'use strict';
function load_item(){
    $.ajax({
        type: "POST",
        url: "method/ajax.php",
        async:false,
        data: {pLoad_Item:0},
        success: function (response) {
            var data = JSON.parse(response);
            $("#Item_Id").empty();
            $("#Item_Id").append('<option value="" selected="" disabled="" >Select Item</option>');
            data.forEach(function(load_item) {
                $("#Item_Id").append('<option value="'+ load_item.Id +'">'+ load_item.item_Name +'</option>');
            });
        }
    });
}
$(window).on('load',function(){
    load_item();
    load_whare();
    allow_key_qnty("#Itm_Qny");
});
function load_item_unit(){
    var pItem_Id = $("#Item_Id").val();
    $.ajax({
        type: "POST",
        url: "method/ajax.php",
        data: {pItem_Load_Unit:pItem_Id},
        success: function (response) {
            var data = JSON.parse(response);
            $("#Unit_Id").empty();
            $("#Unit_Id").append('<option value="" selected="" disabled="" >Select Unit</option>');
            data.forEach(function(load_unit) {
                $("#Unit_Id").append('<option value="'+ load_unit.Id +'">'+ load_unit.Unit_Name +'</option>');
            });
        }
    });
}
function load_whare(){
    $("#whare_house").empty();
    $.ajax({
        type: "POST",
        url: "method/ajax.php",
        data: {pLoad_Whare_h:0},
        success: function (response) {
            var data = JSON.parse(response);
            $("#whare_house").append('<option value="" selected="" disabled="" >Select warehouse</option>');
            data.forEach(function(whare_data) {
                $("#whare_house").append('<option value="'+ whare_data.Id +'">'+ whare_data.wharehouse_Name +'</option>');  
            });
        }
    });
}
function add_item(){
    var ware_Id = $("#whare_house").val();
    var item_id = $("#Item_Id").val();
    var item_Name = $("#Item_Id option:selected").text();
    var qnty = $("#Itm_Qny").val();
    var unit_id = $("#Unit_Id").val();
    var unit_Name = $("#Unit_Id option:selected").text();
    var rate = $("#item_rate").val();
    

    if(ware_Id==null){
        simple_alert('Warning','Please Select Ware House First','warning');
    }
    else if(item_id==null){
        simple_alert('Warning','Please Select Item','warning');
    }
    else if(qnty==''){
        simple_alert('Warning','Please Enter Quentity','warning');
    }
    else if(unit_id==null){
        simple_alert('Warning','Please Select Unit','warning');
    }
    else if(rate==''){
        simple_alert('Warning','Please Enter Rate','warning');
    }
    else {
        var rowCount = $('#chalan_table tr').length;
        if(rowCount==0){
            $("#chalan_table").empty();
        }
        $("#chalan_table").append('<tr><td class="serial">'+ ((rowCount*1)+1) +'</td>'+
        '<td style="width: 45%;">'+ item_Name +'</td>'+
        '<td style="display:none;">'+ item_id +'</td>'+
        '<td >'+ qnty +'</td>'+
        '<td >'+ unit_Name +'</td>'+
        '<td style="display:none;">'+ unit_id +'</td>'+
        '<td >'+ rate +'</td>'+
        '<td >'+ (Number(rate*qnty).toFixed(2)) +'</td>'+
        '<td> <button type="button" class="btn btn-danger myclass" id="Action" style="padding-top: 8px;padding-bottom: 8px;"name="Action" onclick="revove_row(this);"><i class="fa fa-trash" aria-hidden="true"></i> delete</button></td>'+
        '</tr>');
        load_item();
        $('#chalan_table tr').each(function () {
            var item = $(this); //this should represent one row
           var  tbl_item = (item.find('td:eq(2)').text());
            $("#Item_Id option[value='"+ tbl_item +"']").remove();
            });
        $("#Unit_Id").empty();
        $("#Unit_Id").append('<option value="" selected="" disabled="" >Select Unit</option>');
        $("#Itm_Qny").val('');
        $("#item_rate").val('');
    }
}
function revove_row(p){
    var currentRow=$(p).closest("tr"); 
    currentRow.remove(); 
    load_item();
    $('#chalan_table tr').each(function(index){
        $(this).find('.serial').html(index+1);
        var item = $(this); //this should represent one row
        var  tbl_item = (item.find('td:eq(2)').text());
        $("#Item_Id option[value='"+ tbl_item +"']").remove();
    });
    
}
function allow_key_qnty(p){
    $(p).keypress(function (e) {
        var character = String.fromCharCode(e.keyCode)
        var newValue = this.value + character;
        if (isNaN(newValue) || hasDecimalPlace(newValue, 4)) {
            e.preventDefault();
            return false;
        }
    });
}
$('.decimal').keypress(function (e) {
    var character = String.fromCharCode(e.keyCode)
    var newValue = this.value + character;
    if (isNaN(newValue) || hasDecimalPlace(newValue, 3)) {
        e.preventDefault();
        return false;
    }
});
function hasDecimalPlace(value, x) {
    var pointIndex = value.indexOf('.');
    return  pointIndex >= 0 && pointIndex < value.length - x;
}
function gen_tbl_data(){
	var table = document.getElementById("faqs"), tbl_data = '';

            
            for(var i = 1; i < table.rows.length; i++)
            {
				tbl_data = (tbl_data + (table.rows[i].cells[2].innerHTML) + ','+ (table.rows[i].cells[3].innerHTML) + ','+ (table.rows[i].cells[5].innerHTML)+ ','+ (table.rows[i].cells[6].innerHTML)+',');
                
            }
	$('#tbl_data').val(tbl_data);
}
function post_open(){
    var ware_Id = $("#whare_house").val();
    var rowCount = $('#chalan_table tr').length;
    var pStock_Date = $("#chalan_date").val();
    if(pStock_Date==''){
        simple_alert('Warning','Please Enter Stock Date','warning');
    }
    else if(ware_Id==null){
        simple_alert('Warning','Please Select Ware House','warning');
    }
    else if(rowCount==0){
        simple_alert('Warning','Please Add Data Into Table !!','warning');
    }
    else{
        $("#sav_btn").attr('disabled',true);
        $("#sav_btn").text('Please Wait ....');
        gen_tbl_data();
        $.ajax({
            type: "POST",
            url: "method/push_opn.php",
            data: {pStock_Date_opn:pStock_Date,pStock_ware:ware_Id,pStock_Data:$("#tbl_data").val()},
            success: function (response) {
                var data = JSON.parse(response);
                data.forEach(function(chalan_data) {
                 var err = chalan_data.Errorno;
                 var msg = chalan_data.message;
 
                 if(err<0){
                     simple_alert('Error',msg,'error');
                     chalan_form_clean();
                 }
                 else{
                    post_msg('Success',msg,'success');
                     chalan_form_clean();
                 }
 
                }); 
            }
        });
    }
}
function chalan_form_clean(){
    load_item();
    load_whare();
    $("#Unit_Id").empty();
    $("#Unit_Id").append('<option value="" selected="" disabled="" >Select Unit</option>');
    $("#Itm_Qny").val('');
    $("#item_rate").val('');
    $("#tbl_data").val('');
    $("#chalan_table").empty();
}