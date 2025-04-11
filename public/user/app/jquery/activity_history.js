//Tab search
$("input.tab-search").on("click", function () {
    urlReplace =
        window.location.pathname + getParameterURL("?tab=", "1", null, null);
    window.history.replaceState(null, null, urlReplace);
});

//Tab rate
$("input.tab-rate").on("click", function () {
    urlReplace =
        window.location.pathname + getParameterURL("?tab=", "2", null, null);
    window.history.replaceState(null, null, urlReplace);
});

//Tab cart
$("input.tab-cart").on("click", function () {
    urlReplace =
        window.location.pathname + getParameterURL("?tab=", "3", null, null);
    window.history.replaceState(null, null, urlReplace);
});

//Tab favourite
$("input.tab-favourite").on("click", function () {
    urlReplace =
        window.location.pathname + getParameterURL("?tab=", "4", null, null);
    window.history.replaceState(null, null, urlReplace);
});

//Tab order
$("input.tab-order").on("click", function () {
    urlReplace =
        window.location.pathname + getParameterURL("?tab=", "5", null, null);
    window.history.replaceState(null, null, urlReplace);
});

//Tab session activity
$("input.tab-activity").on("click", function () {
    urlReplace =
        window.location.pathname + getParameterURL("?tab=", "6", null, null);
    window.history.replaceState(null, null, urlReplace);
});
