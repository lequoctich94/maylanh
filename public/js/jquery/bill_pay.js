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

function loadData(status) {
    $.ajax({
        type: "get",
        url:
            "/api/bills/get-all-bill-by-status/" +
            status +
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
                    '<tr class="odd"><td valign="top" colspan="13" class="text-center dataTables_empty">Danh sách trống</td></tr>';
            } else {
                var date_confirm = "Chờ Duyệt";
                var date_delivery = "Chưa Lấy Hàng";
                var date_receipt = "Chờ Nhận";
                var date_cancel = "Chưa Huỷ";
                for (var i = 0; i < bills.length; i++) {
                    //Duyệt đơn
                    if (bills[0].status == 2) {
                        date_confirm = String(bills[i].date_confirm);
                    }
                    //Đang giao
                    else if (bills[0].status == 0) {
                        date_confirm = String(bills[i].date_confirm);
                        date_delivery = String(bills[i].date_delivery);
                    }
                    //Đã giao
                    else if (bills[0].status == 1) {
                        date_confirm = String(bills[i].date_confirm);
                        date_delivery = String(bills[i].date_delivery);
                        date_receipt = String(bills[i].date_receipt);
                    }
                    //Đã huỷ
                    else if (bills[0].status == 0 || bills[0].status == 1) {
                        date_cancel = String(bills[i].date_cancel);
                    }
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
                        date_confirm +
                        "</td>\
                              <td>" +
                        date_delivery +
                        "</td>\
                              <td>" +
                        date_receipt +
                        "</td>\
                              <td>" +
                        date_cancel +
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
                    if (bills[i].status == 0)
                        html +=
                            '<td><span class="badge badge-info">Đang Giao</span></td>';
                    else if (bills[i].status == 2)
                        html +=
                            '<td><span class="badge badge-info">Đang C.Bị Đơn</span></td>';
                    else if (bills[i].status == 1)
                        html +=
                            '<td><span class="badge badge-info">Đã Giao</span></td>';
                    else if (bills[i].status == -1)
                        html +=
                            '<td><span class="badge badge-info">Chờ Duyệt</span></td>';
                    else if (bills[i].status == -2) {
                        html +=
                            '<td><span class="badge badge-danger">Đã Huỷ</span></td>' +
                            '<td><span class="">' +
                            bills[i].message +
                            "</span></td>";
                    } else if (bills[i].status == -4) {
                        html +=
                            '<td><span class="badge badge-danger">Từ Chối</span></td>' +
                            '<td><span class="">' +
                            bills[i].message +
                            "</span></td>";
                    }

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
            }
            html += "</tbody>";
            $("thead.title-bill").after(html);
        },
        error: function () {},
    });
}

$(".waiting_confirm").on("click", function () {
    $("#waiting").addClass("active");
    $("#pending").removeClass("active");
    $("#ready").removeClass("active");
    $("#cancelled").removeClass("active");
    $("#delivered").removeClass("active");
    $("#refused").removeClass("active");
    $(".reasons").addClass("d-none");
    loadData(-1);
});

$(".ready_delivery").on("click", function () {
    $("#waiting").removeClass("active");
    $("#pending").removeClass("active");
    $("#ready").addClass("active");
    $("#cancelled").removeClass("active");
    $("#delivered").removeClass("active");
    $("#refused").removeClass("active");
    $(".reasons").addClass("d-none");
    loadData(2);
});

$(".pending_delivery").on("click", function () {
    $("#waiting").removeClass("active");
    $("#pending").addClass("active");
    $("#ready").removeClass("active");
    $("#cancelled").removeClass("active");
    $("#delivered").removeClass("active");
    $("#refused").removeClass("active");
    $(".reasons").addClass("d-none");
    loadData(0);
});

$(".delivered").on("click", function () {
    $("#waiting").removeClass("active");
    $("#pending").removeClass("active");
    $("#ready").removeClass("active");
    $("#cancelled").removeClass("active");
    $("#delivered").addClass("active");
    $("#refused").removeClass("active");
    $(".reasons").addClass("d-none");
    loadData(1);
});

$(".cancelled").on("click", function () {
    $("#waiting").removeClass("active");
    $("#pending").removeClass("active");
    $("#ready").removeClass("active");
    $("#cancelled").addClass("active");
    $("#delivered").removeClass("active");
    $("#refused").removeClass("active");
    $(".reasons").removeClass("d-none");
    loadData(-2);
});

$(".refused").on("click", function () {
    $("#waiting").removeClass("active");
    $("#pending").removeClass("active");
    $("#ready").removeClass("active");
    $("#cancelled").removeClass("active");
    $("#delivered").removeClass("active");
    $("#refused").addClass("active");
    $(".reasons").removeClass("d-none");
    loadData(-4);
});
