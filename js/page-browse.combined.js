<!--#include virtual="page.combined.js" --><!--#include virtual="vendor/jquery.tmpl.min.js" --><!--#include virtual="vendor/chosen.jquery.min.js" --><!--#include virtual="vendor/jquery.query.min.js" -->
$(function() {
    // pre init
    var filterSelector = $("#filterSelector");
    var orderBySelector = $("#orderBySelector");
    var resultList = $("#resultList");
    var resultNav = $("#resultNav");

    var browsePatternQuery = {
        'fields' : "id,name,price,url,img",
        'offset' : 0,
        'limit' : 15,
        'orderBy' : orderBySelector.val()
    };
    $.extend(browsePatternQuery, getSelectionsFromMultiselector(filterSelector));
    
    
    
    function addCommas(nStr) {
        nStr += '';
        var x = nStr.split('.');
        var x1 = x[0];
        var x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + ',' + '$2');
        }
        return x1 + x2;
    }

    function refreshResult() {
        var browsePatternTemplate = jQuery.template(null, '<!--#include virtual="templates/BrowsePattern.html" -->');
        var queryString = implodeQueryObject(browsePatternQuery);
        
        if (queryString.length > 0) {
            queryString = "?" + queryString;
        }
        
        resultList.html('<img id="loading" src="img/loading-squares.gif" width="43" height="11"/>');
        
        $.ajax({
            type: "GET",
            dataType: "json",
            url: "http://localhost/lq/api/v1/patterns" + queryString,
            success: function(data) {
                //console.log(JSON.stringify(data));
                var count = parseInt(data.meta.count);
                var limit = parseInt(data.meta.limit);
                var offset = parseInt(data.meta.offset);
                var numPages = Math.ceil(count / limit);
                var currentPage = parseInt(offset / limit);
                
                var pageNumberLinks = "";
                var num = 0;
                var startingPageNum = Math.max(0, currentPage - 5);
                if (startingPageNum + 10 > numPages) {
                    startingPageNum = Math.max(0, startingPageNum - (startingPageNum + 10 - numPages));
                }
                
                pageNumberLinks += '<a class="pageNumberLink'+(startingPageNum > 0 ? "" : " invisible")+'" data-page="0"><|</a>';
                pageNumberLinks += '<a class="pageNumberLink'+(currentPage != 0 ? "" : " invisible")+'" data-page="'+(currentPage-1)+'"><</a>';
                for (var i=startingPageNum; i < numPages && num < 10; i++) {
                    pageNumberLinks += '<a class="pageNumberLink' + (currentPage == i ? " sel" : "") + '" data-page="'+i+'">' + (i+1) + '</a>';
                    num++;
                }
                pageNumberLinks += '<a class="pageNumberLink'+(currentPage != numPages - 1 ? "" : " invisible")+'" data-page="'+(currentPage+1)+'">></a>';
                pageNumberLinks += '<a class="pageNumberLink'+(startingPageNum + 10 < numPages ? "" : " invisible")+'" data-page="'+(numPages-1)+'">|></a>';
                
                resultNav.html(pageNumberLinks);
                
                resultList.html("");
                $.tmpl(browsePatternTemplate, data.response).appendTo(resultList);
            }
        });
        
        console.log(queryString);
        
        var filterString = "";
        $("option:selected", filterSelector).each(function() {
            var name = $(this).html();

            if (filterString.length > 0) {
                filterString += ",";
            }

            filterString += encodeURIComponent(name).replace(/\%20/g, "+");
        });
        
        var orderBy = orderBySelector.find("option:selected").html();
        
        var newURL = "browse?";
        if (filterString.length > 0) {
            newURL += "filters=" + filterString + "&";
        }
        newURL += "order=" + encodeURIComponent(orderBy).replace("%20", "+");
        
        window.history.replaceState(browsePatternQuery, "Browse", newURL);
    }
    
    function getSelectionsFromMultiselector(multiSelector) {
        var object = {};
        $("option:selected", multiSelector).each(function() {
            var field = $(this).parent().data("field");
            var value = $(this).val();
            
            if (object[field] != null) {
                if (!(object[field] instanceof Array)) {
                    var existingVal = object[field];
                    object[field] = [existingVal];
                }
                
                object[field].push(value);
            }
            else {
                object[field] = value;
            }
        });

        return object;
    }
    
    function implodeQueryObject(object) {
        var i = 0;
        var queryString = "";

        for (var field in object) {
            if (object.hasOwnProperty(field)) {
                if (i > 0) {
                    queryString += "&";
                }
                
                if (object[field] instanceof Array) {
                    queryString += field + "=IN(" + object[field].join(",") + ")";
                }
                else {
                    queryString += field + "=" + object[field];
                }
                
                i++;
            }
        }

        return queryString;
    }
    
    filterSelector.chosen({
        allow_single_deselect : true,
        no_results_text : "No filters matching",
        search_contains : true,
        single_backstroke_delete : true
    }).change(function() {
            // reset filters before new ones are merged in
            $("optgroup", filterSelector).each(function() {
                var field = $(this).data("field");
                
                if (browsePatternQuery.hasOwnProperty(field)) {
                    delete browsePatternQuery[field];
                }
            });
            
            $.extend(browsePatternQuery, getSelectionsFromMultiselector($(this)));
            browsePatternQuery.offset = 0;
            
            refreshResult();
        });
    
    orderBySelector.chosen({
        disable_search : true
    }).change(function() {
            browsePatternQuery.orderBy = $(this).val();
            browsePatternQuery.offset = 0;
            
            refreshResult();
        });
    
    resultNav.on("click", ".pageNumberLink", function() {
        browsePatternQuery.offset = parseInt($(this).data("page")) * browsePatternQuery.limit;
        
        refreshResult();
    });
    
    
    // post init
    
    refreshResult();
    
});