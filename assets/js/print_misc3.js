function print_bill(){
    //  var org_id =getCookie('org_id');
     var sales_Id = getCookie('misc_id');
     var bill_no = getCookie('misc_no');
     var sales_date = date_format(getCookie('misc_date'));
     $.ajax({
         type: "POST",
         url: "method/ajax.php",
         async:false,
         data: {pPrint_org_ID:0},
         success: function (response) {
             console.log(response);
           var data = JSON.parse(response);
           $("#org_name").empty();
           $("#org_add").empty();
           data.forEach(function(header) {
                 $("#org_name").text(header.Org_Name);
                 var add = header.Address+'<br>'+'Misc. Rreceipt '+sales_date+'<br> '+bill_no;
                 $("#org_add").html(add);
               //   $("#org_gstin").html('GSTIN : '+header.GSTIN);
             });
             
         }
     });
     $.ajax({
         type: "POST",
         url: "method/ajax.php",
         data: {pMis_bill_id:sales_Id},
         async:false,
         success: function (response) {
             var data = JSON.parse(response);
             $("#bill_tbl").empty();
             $("#tot_tbl").empty();
             data.forEach(function(bill_print) {
                 $("#bill_tbl").append('<tr>'+
                '<td colspan="2" style="border: 1px solid #273306;font-size: 12px;">Party Details</td>'+
              '</tr>'+
              '<tr>'+
                 '<td style="border: 1px solid #273306;font-size: 12px;">Name</td>'+
                 '<td style="border: 1px solid #273306;font-size: 12px;">'+ bill_print.Party_Name +'</td>'+
              '</tr>'+
              '<tr>'+
                 '<td style="border: 1px solid #273306;font-size: 12px;">Address</td>'+
                 '<td style="word-wrap: break-word;border: 1px solid #273306;font-size: 12px;width: 100%;">'+ bill_print.Party_Address +'</td>'+
              '</tr>'+
              '<tr>'+
                 '<td style="border: 1px solid #273306;font-size: 12px;">State</td>'+
                 '<td style="border: 1px solid #273306;font-size: 12px;">WEST BENGAL</td>'+
              '</tr>');
              $("#tot_tbl").append('<tr>'+
              '<td style="border: 1px solid #273306;font-size: 12px;width: 50%">Total Amount</td>'+
              '<td style="border: 1px solid #273306;font-size: 12px;width: 50%;text-align: right;">'+ bill_print.Mis_Amt +'</td>'+
           '</tr>'+
           '<tr>'+
              '<td style="border: 1px solid #273306;font-size: 12px;width: 50%">Net Payable</td>'+
              '<td style="border: 1px solid #273306;font-size: 12px;width: 50%;text-align: right;">'+ bill_print.Mis_Amt +'</td>'+
           '</tr>'+
           '<tr>'+
              '<td style="border: 1px solid #273306;font-size: 12px;word-wrap: break-word;width: 50%;text-align: right;">Net Payble(In Word)</td>'+
              '<td style="border: 1px solid #273306;font-size: 12px;word-wrap: break-word;width: 50%;text-align: right;">'+ rs_billcurr(bill_print.Mis_Amt) +'</td>'+
           '</tr>'+
           '<tr>'+
              '<td style="border: 1px solid #273306;font-size: 12px;width: 50%">Payment Mode</td>'+
              '<td style="border: 1px solid #273306;font-size: 12px;word-wrap: break-word;width: 50%;text-align: right;">'+ bill_print.Paymen_Mode +'</td>'+
           '</tr>');
           $("#item_table").empty();
           $("#item_table").append('<td style="border: 1px solid #273306;font-size: 12px;text-align: center;width: 28%;">Misc. Received </td>'+
                          '<td style="border: 1px solid #273306;font-size: 12px;text-align: right;width: 50%;">'+ bill_print.Mis_Amt +'</td>'+
                      '</tr>');
             });
         }
     });
     
   //   $.ajax({
   //       type: "POST",
   //       url: "method/ajax.php",
   //       data: {pSales_bill_id:sales_Id,pPrint_Mode:2},
   //       async:false,
   //       success: function (response) {
   //           var data = JSON.parse(response);
   //           $("#item_table").empty();
   //           data.forEach(function(bill_print) {
   //               $("#item_table").append('<tr>'+
   //               '<td style="border: 1px solid #273306;font-size: 12px;word-wrap: break-word;">'+ bill_print.item_name +'</td>'+
   //               '<td style="border: 1px solid #273306;font-size: 12px;word-wrap: break-word;">'+ bill_print.qnty +'</td>'+
   //               '<td style="border: 1px solid #273306;font-size: 12px;text-align: right;">'+ bill_print.gst +'</td>'+
   //               '<td style="border: 1px solid #273306;font-size: 12px;text-align: right;">'+ bill_print.taxable_Value +'</td>'+
   //            '</tr>');
   //           });
   //       }
   //   });
     window.print();
     window.onafterprint = window.close;	
      
 }
 function rs_billcurr(n){
     var validamt= n;  
     var op='';
    var  nums = n.toString().split('.')
     var whole = Rs(nums[0])
     if(nums[1]==null)nums[1]=0;
     if(nums[1].length == 1 )nums[1]=nums[1]+'0';
     if(nums[1].length> 2){nums[1]=nums[1].substring(2,length - 1)}
     if(nums.length == 2){
     if(nums[0]<=9){nums[0]=nums[0]*10} else {nums[0]=nums[0]};
     var fraction = Rs(nums[1])
     if(whole=='' && fraction==''){op= 'Rupees Zero Only';}
     if(whole=='' && fraction!=''){op= fraction + 'Paise Only';}
     if(whole!='' && fraction==''){op='Rupees ' + whole + ' Only';} 
     if(whole!='' && fraction!=''){op='Rupees ' + whole + 'And ' + fraction + 'Paise Only';}
     if(validamt > 999999999.99){op='The Amount Is Too Big To Convert'; }
     if(validamt < 0){op='Amount Can Not Be Less Than Zero';}
     if(isNaN(validamt) == true ){op='Amount In Number Appears To Be Incorrect. Please Check.';}
     return op;
     
     }
     }
 function getCookie(cname) {
     let name = cname + "=";
     let decodedCookie = decodeURIComponent(document.cookie);
     let ca = decodedCookie.split(';');
     for(let i = 0; i <ca.length; i++) {
       let c = ca[i];
       while (c.charAt(0) == ' ') {
         c = c.substring(1);
       }
       if (c.indexOf(name) == 0) {
         return c.substring(name.length, c.length);
       }
     }
     return "";
   }
   function date_format(pdate){
     var today = new Date(pdate);
     var dd = String(today.getDate()).padStart(2, '0');
     var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
     var yyyy = today.getFullYear();
 
     today = dd + '-' + mm + '-' + yyyy; 
 
     return today;
 }