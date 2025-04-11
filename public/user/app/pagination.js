function getParameterURL(type, keyword, currentPage, recordOnPage) {
    parameterUrl =
        keyword != null && keyword.length > 0 && keyword != undefined
            ? type + keyword
            : "?";

    if (currentPage != null && recordOnPage != null) {
        if (parameterUrl == "?") {
            parameterUrl +=
                "currentPage=" + currentPage + "&take=" + recordOnPage;
        } else {
            parameterUrl +=
                "&currentPage=" + currentPage + "&take=" + recordOnPage;
        }
    } else if (parameterUrl == "?") {
        parameterUrl = "";
    }

    return parameterUrl;
}

function handleCallURLForPagination(currentPage, recordOnPage, tagValue) {
    searchID = tagValue.length > 0 ? tagValue.attr("searchID") : "";
    keywordShow = tagValue.length > 0 ? tagValue.attr("keyword") : "";

    if (searchID != null && searchID.length > 0 && searchID != undefined) {
        parameterUrlSearch = getParameterURL(
            "?searchID=",
            searchID,
            currentPage,
            recordOnPage
        );
        keywordShow += "&searchID=" + searchID;
    } else {
        parameterUrlSearch = getParameterURL(
            "?keyword=",
            keywordShow,
            currentPage,
            recordOnPage
        );
    }

    paramterUrlShow = getParameterURL(
        "?keyword=",
        keywordShow,
        currentPage,
        recordOnPage
    );

    urlCall = "/product-render" + parameterUrlSearch;
    tagAppend = $("#pagination-response");
    urlReplace = window.location.pathname + paramterUrlShow;
    callAjaxReturnHtml(urlCall, tagAppend, urlReplace);
}

//Next page
$(".pagination .pagination_next #next").on("click", function () {
    currentPage = $(".pagination").find("li.active").val() + 1;
    recordOnPage = $("select#record-on-page option:selected").val();
    var spanShowName = $("span#showName");
    handleCallURLForPagination(currentPage, recordOnPage, spanShowName);
});

//Previous page
$(".pagination .pagination_previous #previous").on("click", function () {
    currentPage = $(".pagination").find("li.active").val() - 1;
    recordOnPage = $("select#record-on-page option:selected").val();
    var spanShowName = $("span#showName");
    handleCallURLForPagination(currentPage, recordOnPage, spanShowName);
});

//Number page
$(".pagination a#numberPage").on("click", function () {
    currentPage = $(this).attr("value");
    recordOnPage = $("select#record-on-page option:selected").val();
    var spanShowName = $("span#showName");
    handleCallURLForPagination(currentPage, recordOnPage, spanShowName);
});

$("select#record-on-page").on("change", function () {
    recordOnPage = $(this).val();
    currentPage = 1;
    var spanShowName = $("span#showName");
    handleCallURLForPagination(currentPage, recordOnPage, spanShowName);
});
