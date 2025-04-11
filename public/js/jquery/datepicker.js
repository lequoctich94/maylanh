$(function () {
    var dtToday = new Date();

    var month = dtToday.getMonth() + 1;
    var day = dtToday.getDate();
    var year = dtToday.getFullYear();
    if (month < 10) month = "0" + month.toString();
    if (day < 10) day = "0" + day.toString();

    var maxDate = year + "-" + month + "-" + day;
    var maxDate1 = year + "-" + month + "-" + (day + 1);
    $(".datepicker").attr("min", maxDate);
    $(".datepicker1").attr("min", maxDate1);
});
