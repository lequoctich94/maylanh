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

//Get All Bill Between Date To Date And Status
$("#btn-filter-date").on("click", function () {
    $date_start = $(".form-filter #inputDateStart").val();
    $date_end = $(".form-filter #inputDateEnd").val();
    $.ajax({
        type: "get",
        url:
            "/api/bills/get-all-bill-between-date-to-date-and-status/" +
            $date_start +
            "&" +
            $date_end +
            "&1" +
            "?token=" +
            $('meta[name="jwt-token"]').attr("content"),
        success: function (data) {
            if (data.status == 401) {
                logout();
                return;
            }
            $("tbody.body-bill").remove();
            var bills = data.data;
            html = '<tbody class="body-bill">';
            if (bills == null) {
                html +=
                    '<tr class="odd"><td valign="top" colspan="8" class="text-center dataTables_empty">Danh sách trống</td></tr>';
                $(
                    "#all-bill-pay-in-month #head-input-total #inputTotal"
                ).remove();
                $("#all-bill-pay-in-month #head-input-total").append(
                    '<span id="inputTotal">0đ</span>'
                );
            } else {
                var total1 = 0;
                for (var i = 0; i < bills.length; i++) {
                    total1 += bills[i].total_price;
                    html +=
                        "<tr>\
                                <td>" +
                        (i + 1) +
                        "</td>\
                                <td>" +
                        bills[i].bill_id +
                        "</td>\
                                <td>" +
                        bills[i].member.user.full_name +
                        "</td>\
                                <td>" +
                        bills[i].date_order +
                        "</td>\
                                <td>" +
                        bills[i].member.user.phone +
                        "</td>\
                                <td>" +
                        number_format(bills[i].total_price, 0, ",", ".") +
                        "đ</td>\
                                <td>" +
                        bills[i].total_quantity +
                        "</td>";
                    html +=
                        '<td>\
                                    <a href="bill-pay-detail-management/' +
                        bills[i].bill_id +
                        '"\
                                        data-toggle="tooltip" data-original-title="Xem Chi Tiết"><i\
                                            class="icon-eye text-green"></i>\
                                    </a>\
                                </td>';
                    html += "</tr>";
                }
                $(
                    "#all-bill-pay-in-month #head-input-total #inputTotal"
                ).remove();
                $("#all-bill-pay-in-month #head-input-total").append(
                    '<span id="inputTotal">' +
                        number_format(total1, 0, ",", ".") +
                        "đ</span>"
                );
            }
            html += "</tbody>";
            $("thead.title-bill").after(html);
        },
    });
});

//Get All Bill When Choose Value Week, Month, Year
$("#btn-filter-cycle").on("click", function () {
    $bill_week = $(".form-filter #billWeek").val();
    $bill_month = $(".form-filter #billMonth").val();
    $bill_year = $(".form-filter #billYear").val();
    $.ajax({
        type: "get",
        url:
            "/api/bills/get-all-bill-when-choose-by-status/" +
            $bill_week +
            "&" +
            $bill_month +
            "&" +
            $bill_year +
            "&1" +
            "?token=" +
            $('meta[name="jwt-token"]').attr("content"),
        success: function (data) {
            if (data.status == 401) {
                logout();
                return;
            }
            $("tbody.body-bill").remove();
            var bills = data.data;
            html = '<tbody class="body-bill">';
            if (bills == null) {
                html +=
                    '<tr class="odd"><td valign="top" colspan="8" class="text-center dataTables_empty">Danh sách trống</td></tr>';
                $(
                    "#all-bill-pay-in-month #head-input-total #inputTotal"
                ).remove();
                $("#all-bill-pay-in-month #head-input-total").append(
                    '<span id="inputTotal">0đ</span>'
                );
            } else {
                var total2 = 0;
                for (var i = 0; i < bills.length; i++) {
                    total2 += bills[i].total_price;
                    html +=
                        "<tr>\
                                <td>" +
                        (i + 1) +
                        "</td>\
                                <td>" +
                        bills[i].bill_id +
                        "</td>\
                                <td>" +
                        bills[i].member.user.full_name +
                        "</td>\
                                <td>" +
                        bills[i].date_order +
                        "</td>\
                                <td>" +
                        bills[i].member.user.phone +
                        "</td>\
                                <td>" +
                        number_format(bills[i].total_price, 0, ",", ".") +
                        "đ</td>\
                                <td>" +
                        bills[i].total_quantity +
                        "</td>";
                    html +=
                        '<td>\
                                    <a href="bill-pay-detail-management/' +
                        bills[i].bill_id +
                        '"\
                                        data-toggle="tooltip" data-original-title="Xem Chi Tiết"><i\
                                            class="icon-eye text-green"></i>\
                                    </a>\
                                </td>';
                    html += "</tr>";
                }
                $(
                    "#all-bill-pay-in-month #head-input-total #inputTotal"
                ).remove();
                $("#all-bill-pay-in-month #head-input-total").append(
                    '<span id="inputTotal">' +
                        number_format(total2, 0, ",", ".") +
                        "đ</span>"
                );
            }
            html += "</tbody>";
            $("thead.title-bill").after(html);
        },
    });
});

//Check Validate Filter Date
$("#btn-filter-date").on("click", function () {
    $(".error-filter").remove();
    $date_start = $(".form-filter #inputDateStart").val();
    $date_end = $(".form-filter #inputDateEnd").val();
    if ($date_start > $date_end) {
        $(".form-filter #date_end").append(
            '<p class="error-filter text-red nowrap">Vui lòng chọn khoảng thời gian hợp lệ</p>'
        );
        return false;
    }
    if (!$date_start) {
        $(".form-filter #date_start").append(
            '<p class="error-filter text-red">Vui lòng không để trống ngày</p>'
        );
        return false;
    }
});

//Get Quantity All Bill Chart Belong Status By Month And Year
// $('#btn-filter-bill-chart').on('click', function () {
//     $bill_month =  $('.form-filter-chart #billChartMonth').val();
//     $bill_year =  $('.form-filter-chart #billChartYear').val();
//     alert($bill_month + $bill_year);
//     $.ajax({
//         type: 'GET',
//         url: '/api/bills/get-quantity-all-bill-chart-belong-status-by-month-and-year/' + $bill_month + "&" + $bill_year,
//         success: function (data) {
//             $('#statistics_bill_pays').remove();
//             var statistics_bill = data.data;
//             var arr = [];
//             var status = ["Đã giao", "Đã huỷ", "Đã từ chối", "Đã đánh giá", "Chưa đánh giá"];
//             //1,-2,-4,2,-3
//             var arr_status = [];

//             for (var i = 0; i < statistics_bill.length; i++) {
//                 arr[i] = statistics_bill[i].quantity_bill;
//                 if (statistics_bill[i].status == 1) {
//                     arr_status[0] = arr[i];
//                 } else if (statistics_bill[i].status == -2) {
//                     arr_status[1] = arr[i];
//                 } else if (statistics_bill[i].status == -4) {
//                     arr_status[2] = arr[i];
//                 } else if (statistics_bill[i].status == 2) {
//                     arr_status[3] = arr[i];
//                 } else if (statistics_bill[i].status == -3) {
//                     arr_status[4] = arr[i];
//                 } else {
//                     alert("False");
//                 }
//             }
//             var option = {
//                 color: ['#00acf0'],
//                 tooltip: {
//                     show: true,
//                     trigger: 'axis',
//                     backgroundColor: '#fff',
//                     borderRadius: 6,
//                     padding: 6,
//                     axisPointer: {
//                         lineStyle: {
//                             width: 0,
//                         }
//                     },
//                     textStyle: {
//                         color: '#324148',
//                         fontFamily: '-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji"',
//                         fontSize: 15
//                     }
//                 },

//                 xAxis: [{
//                     type: 'category',
//                     data: status,
//                     axisLine: {
//                         show: false
//                     },
//                     axisTick: {
//                         show: false
//                     },
//                     axisLabel: {
//                         textStyle: {
//                             color: '#5e7d8a'
//                         }
//                     }
//                 }],
//                 yAxis: {
//                     type: 'value',
//                     axisLine: {
//                         show: false
//                     },
//                     axisTick: {
//                         show: false
//                     },
//                     axisLabel: {
//                         textStyle: {
//                             color: '#5e7d8a'
//                         }
//                     },
//                     splitLine: {
//                         lineStyle: {
//                             color: '#eaecec',
//                         }
//                     }
//                 },
//                 grid: {
//                     top: '3%',
//                     left: '3%',
//                     right: '3%',
//                     bottom: '3%',
//                     containLabel: true
//                 },
//                 series: [{
//                     data: arr_status,
//                     type: 'bar',
//                     barMaxWidth: 70,
//                     itemStyle: {
//                         normal: {
//                             barBorderRadius: [6, 6, 0, 0],
//                         }
//                     },
//                 }]
//             };
//             $('#statistics-bill-pays').after('.add-statistics-bill-pays');
//             bill_pays.setOption(option);
//             bill_pays.resize();
//         },
//         error: function () {

//         }

//     });
// });
