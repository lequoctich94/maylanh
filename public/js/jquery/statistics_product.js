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

$("#best-seller #btn-filter-date").on("click", function () {
    $("#best-seller .error-filter").remove();
    $date_start = $("#best-seller #inputDateStart").val();
    $date_end = $("#best-seller #inputDateEnd").val();
    if ($date_start > $date_end) {
        $("#best-seller #date_end").append(
            '<p class="error-filter text-red nowrap">Vui lòng chọn khoảng thời gian hợp lệ</p>'
        );
        return false;
    }
    if (!$date_start) {
        $("#best-seller #date_start").append(
            '<p class="error-filter text-red">Vui lòng không để trống ngày</p>'
        );
        return false;
    }
    $.ajax({
        type: "GET",
        url:
            "/admin/statistics-of-product-with-the-highest-total-sales-by-date/" +
            $date_start +
            "&" +
            $date_end,
        success: function (data) {
            if (data.status == 401) {
                logout();
                return;
            }
            $("#statistics_product_width_the_highest_total_sales >").remove();
            $("#statistics_product_width_the_highest_total_sales").html(data);
        },
        error: function () {},
    });
});

$("#best-seller #btn-filter-cycle").on("click", function () {
    $week = $("#best-seller #week-selected").val();
    $month = $("#best-seller #month-selected").val();
    $year = $("#best-seller #year-selected").val();
    $.ajax({
        type: "GET",
        url:
            "/admin/statistics-of-product-with-the-highest-total-sales-by-cycle/" +
            $week +
            "&" +
            $month +
            "&" +
            $year,
        success: function (data) {
            if (data.status == 401) {
                logout();
                return;
            }
            $("#statistics_product_width_the_highest_total_sales >").remove();
            $("#statistics_product_width_the_highest_total_sales").html(data);
        },
        error: function () {},
    });
});

$("#hot-rate #btn-filter-date").on("click", function () {
    $("#hot-rate .error-filter").remove();
    $date_start = $("#hot-rate #inputDateStart").val();
    $date_end = $("#hot-rate #inputDateEnd").val();
    if ($date_start > $date_end) {
        $("#hot-rate #date_end").append(
            '<p class="error-filter text-red nowrap">Vui lòng chọn khoảng thời gian hợp lệ</p>'
        );
        return false;
    }
    if (!$date_start) {
        $("#hot-rate #date_start").append(
            '<p class="error-filter text-red">Vui lòng không để trống ngày</p>'
        );
        return false;
    }

    $.ajax({
        type: "GET",
        url:
            "/admin/statistics-of-product-with-the-most-review-by-date/" +
            $date_start +
            "&" +
            $date_end,
        success: function (data) {
            if (data.status == 401) {
                logout();
                return;
            }
            $("#statistics_of_product_with_the_most_review >").remove();
            $("#statistics_of_product_with_the_most_review").html(data);
        },
        error: function () {},
    });
});

$("#hot-rate #btn-filter-cycle").on("click", function () {
    $week = $("#hot-rate #week-selected").val();
    $month = $("#hot-rate #month-selected").val();
    $year = $("#hot-rate #year-selected").val();
    $.ajax({
        type: "GET",
        url:
            "/admin/statistics-of-product-with-the-most-review-by-cycle/" +
            $week +
            "&" +
            $month +
            "&" +
            $year,
        success: function (data) {
            if (data.status == 401) {
                logout();
                return;
            }
            $("#statistics_of_product_with_the_most_review >").remove();
            $("#statistics_of_product_with_the_most_review").html(data);
        },
        error: function () {},
    });
});
