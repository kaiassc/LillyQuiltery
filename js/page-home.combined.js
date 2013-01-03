<!--#include virtual="page.combined.js" -->

$(function() {

    $.ajax({
        type: "PUT",
        dataType: "json",
        url: "http://localhost/mcc/api/v1/packs?limit=1",
        success: function(data){
            console.log(JSON.stringify(data));
        }
    });
    
});