// Load google charts
google.charts.load("current", { packages: ["corechart"] });
google.charts.setOnLoadCallback(drawChart);

// Draw the chart and set the chart values
function drawChart() {
    $.ajax({
        type: "GET",
        url:
            "/api/members/get-quantity-member-of-rank" +
            "?token=" +
            $('meta[name="jwt-token"]').attr("content"),
        success: function (data) {
            if (data.status == 401) {
                logout();
                return;
            }
            var statistics = data.data;
            var arr = [];
            j = 1;
            for (var i = 0; i < statistics.length; i++) {
                arr[j] = [
                    statistics[i].rank.rank_name,
                    statistics[i].quantity_member,
                ];
                j++;
            }
            arr[0] = ["rank_name", "quantity_member"];
            var data = google.visualization.arrayToDataTable(arr);
            // Optional; add a title and set the width and height of the chart
            var options = {
                title: "Biểu Đồ Tròn Thống Kê Thành Viên Theo Cấp Bậc",
                width: 750,
                height: 600,
            };
            // Display the chart inside the <div> element with id="piechart"
            var chart = new google.visualization.PieChart(
                document.getElementById("piechart")
            );
            chart.draw(data, options);
        },
        error() {},
    });
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

$("#btn-filter-date").on("click", function () {
    $(".error-filter").remove();
    $date_start = $("#inputDateStart").val();
    $date_end = $("#inputDateEnd").val();
    if ($date_start > $date_end) {
        $("#date_end").append(
            '<p class="error-filter text-red nowrap">Vui lòng chọn khoảng thời gian hợp lệ</p>'
        );
        return false;
    }
    if (!$date_start) {
        $("#date_start").append(
            '<p class="error-filter text-red">Vui lòng không để trống ngày</p>'
        );
        return false;
    }

    $.ajax({
        type: "GET",
        url:
            "/admin/statistics-of-member-buy-the-most-by-date/" +
            $date_start +
            "&" +
            $date_end,
        success: function (data) {
            if (data.status == 401) {
                logout();
                return;
            }
            $("#statistics_of_members_buy_the_most >").remove();
            $("#statistics_of_members_buy_the_most").html(data);
        },
        error: function () {},
    });
});

$("#btn-filter-cycle").on("click", function () {
    $(".error-filter").remove();
    $week = $("#week-selected").val();
    $month = $("#month-selected").val();
    $year = $("#year-selected").val();
    $.ajax({
        type: "GET",
        url:
            "/admin/statistics-of-member-buy-the-most-by-cycle/" +
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
            $("#statistics_of_members_buy_the_most >").remove();
            $("#statistics_of_members_buy_the_most").html(data);
        },
        error: function () {},
    });
});
