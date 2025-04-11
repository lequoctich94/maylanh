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
