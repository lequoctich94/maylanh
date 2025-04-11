async function callAjaxReturnJson(
    url,
    type,
    body = null,
    contentType = null,
    headers = null
) {
    var responseData;
    await $.ajax({
        headers: headers,
        type: type,
        url:
            url +
            ($('meta[name="jwt-token"]').attr("content").length > 0
                ? "?token=" + $('meta[name="jwt-token"]').attr("content")
                : ""),
        data: JSON.stringify(body),
        contentType: contentType,
        async: true,
        success: function (data) {
            responseData = data;
        },
        error: function (error) {
            console.log(error);
        },
    });
    if (responseData.status == 401) {
        await logout();
    }
    return responseData;
}

async function callAjaxReturnHtml(url, tagAppend, urlReplace = null) {
    return await $.ajax({
        type: "get",
        url: url,
        success: function (data) {
            tagAppend.find(">").remove();
            tagAppend.append(data);
            if (urlReplace != null) {
                window.history.replaceState(null, null, urlReplace);
            }
        },
        error: function ($error) {
            console.log(error);
        },
    });
}

function getUrlParameter(sParam) {
    var sPageURL = window.location.search.substring(1),
        sURLVariables = sPageURL.split("&"),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split("=");

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined
                ? true
                : decodeURIComponent(sParameterName[1]);
        }
    }
    return false;
}

number_format = function (number, decimals, dec_point, thousands_sep) {
    number = number.toFixed(decimals);

    var nstr = number.toString();
    nstr += "";
    x = nstr.split(".");
    x1 = x[0];
    x2 = x.length > 1 ? dec_point + x[1] : "";
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) x1 = x1.replace(rgx, "$1" + thousands_sep + "$2");
    return x1 + x2;
};

async function logout() {
    let headers = {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    };
    await $.ajax({
        type: "POST",
        url: "/logout",
        headers: headers,
        success: function (data) {
            window.location.href = "/login";
        },
    });
}
