'use strict';
function load_party(){
    $.ajax({
        type: "POST",
        url: "method/ajax.php",
        data: {pLoad_Party_purchase:0},
        success: function (response) {
            // console.log(response);
            var data = JSON.parse(response);
            $("#Party_Idd").empty();
            $("#Party_Idd").append('<option value="" selected="" disabled="" >Select Party</option>');
            data.forEach(function(party_data) {
                $("#Party_Idd").append('<option value="'+ party_data.Id +'">'+ party_data.Party_Name +'</option>')
            });
        }
    });
}
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
    load_party();
    load_item();
    load_whare();
    allow_key_qnty("#Itm_Qny");
});
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
function hasDecimalPlace(value, x) {
    var pointIndex = value.indexOf('.');
    return  pointIndex >= 0 && pointIndex < value.length - x;
}
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
function add_item(){
    var item_Id = $("#Item_Id").val();
    var item_unit = $("#Unit_Id").val();
    var item_Name = $("#Item_Id option:selected").text();
    var unit_Name = $("#Unit_Id option:selected").text();
    var item_Qty = $("#Itm_Qny").val();
    if(item_Id==null){
        simple_alert('Warning','Please Select Item','warning');
    }
    else if(item_Qty=='' || item_Qty==0){
        simple_alert('Warning','Please Enter Item Qty','warning'); 
    }
    else if(item_unit==null){
        simple_alert('Warning','Please Select Unit','warning');
    }
    
    else {
        var rowCount = $('#chalan_table tr').length;
        
        if(rowCount==0){
            $("#chalan_table").empty();
        }
        $("#chalan_table").append('<tr><td class="serial">'+ ((rowCount*1)+1) +'</td>'+
        '<td style="width: 45%;">'+ item_Name +'</td>'+
        '<td style="display:none;">'+ item_Id +'</td>'+
        '<td >'+ item_Qty +'</td>'+
        '<td >'+ unit_Name +'</td>'+
        '<td style="display:none;">'+ item_unit +'</td>'+
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
    }
}

$('#Itm_Qny').keypress(function (e) {    
    
    var charCode = (e.which) ? e.which : event.keyCode    

    if (String.fromCharCode(charCode).match(/[^0-9.]/g))    

        return false;                        

});

function revove_row(p){
    var currentRow=$(p).closest("tr"); 
    currentRow.remove(); 
    $('#chalan_table tr').each(function(index){
        $(this).find('.serial').html(index+1);
    });
    load_item();
        $('#chalan_table tr').each(function () {
            var item = $(this); //this should represent one row
           var  tbl_item = (item.find('td:eq(2)').text());
            $("#Item_Id option[value='"+ tbl_item +"']").remove();
            });
    
}
function add_chalan(){
    var pChalan_Date = $("#chalan_date").val();
    var pChalan_ref = $("#ref_cln_no").val();
    var pChalan_Party = $("#Party_Idd").val();
    var pParty_Name = $("#Party_Idd option:selected").text();
    var pWhare_House  = $("#whare_house").val();
    var rowCount = $('#chalan_table tr').length;
    if(pChalan_Date==''){
        simple_alert('Warning','Please Enter Chalan Date','warning');  
    }
    else if(pChalan_ref==''){
        simple_alert('Warning','Please Enter Chalan Referance No','warning');  
    }
    else if(pChalan_Party==null){
        simple_alert('Warning','Please Select Party','warning');  
    }
    else if(pWhare_House==null){
        simple_alert('Warning','Please Select Whare House','warning');  
    }
    else if(rowCount==0){
        simple_alert('Warning','Please Add Item First','warning');
    }
    
    else{
        gen_tbl_data();
        $.ajax({
            type: "POST",
            url: "method/chalan_add.php",
            data: {pChalan_Date:pChalan_Date,pChalan_ref_no:pChalan_ref,pChalan_Party_Id:pChalan_Party,pChalan_whareh:pWhare_House,pChalan_item_dtls:$('#tbl_data').val(),pParty_Name:pParty_Name},
            success: function (response) {
                console.log(response);
               var data = JSON.parse(response);
               data.forEach(function(chalan_data) {
                var err = chalan_data.Errorno;
                var msg = chalan_data.message;

                if(err<0){
                    simple_alert('Error',msg,'error');
                    // chalan_form_clean();
                }
                else{
                    simple_alert('Success',msg,'success');
                    chalan_form_clean();
                }

               }); 
            }
        });
    }
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
function gen_tbl_data(){
	var table = document.getElementById("faqs"), tbl_data = '';

            
            for(var i = 1; i < table.rows.length; i++)
            {
				tbl_data = (tbl_data + (table.rows[i].cells[2].innerHTML) + ','+ (table.rows[i].cells[3].innerHTML) + ','+ (table.rows[i].cells[5].innerHTML)+ ',');
                
            }
	$('#tbl_data').val(tbl_data);
}
function chalan_form_clean(){
    $('#tbl_data').val('');
    $("#chalan_date").val('');
    $("#ref_cln_no").val('');
    $("#chalan_table").empty();
    load_party();
    load_item();
    load_whare();
    $("#Unit_Id").empty();
    $("#Unit_Id").append('<option value="" selected="" disabled="" >Select Unit</option>');
    
}