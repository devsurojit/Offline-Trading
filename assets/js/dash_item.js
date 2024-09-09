'use strict';
$(document).ready(function () {
    $.ajax({
        type: "POST",
        url: "method/ajax.php",
        data: {pLoad_dash_Item:0},
        success: function (response) {
            var data = JSON.parse(response);
            data.forEach(function(dash_item) {
                $("#tot_whare_house").text(dash_item.Wherehouse);
                $("#tot_item").text(dash_item.Item);
                $("#tot_unit").text(dash_item.unit);
                $("#tot_cat").text(dash_item.Catag);
                $("#tot_sub_cat").text(dash_item.Sub_Cat);
                $("#tot_user").text(dash_item.user);
            });
        }
    });

});