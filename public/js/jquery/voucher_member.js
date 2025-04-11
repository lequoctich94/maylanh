$("#isAll").click(function () {
    if ($(this).prop("checked") == true) {
        $(".custom_check").each(function () {
            $(this).prop("checked", true);
        });
    } else {
        $(".custom_check").each(function () {
            $(this).prop("checked", false);
        });
    }
});
