/*Dashboard3 Init*/

"use strict";

/*****E-Charts function start*****/
var echartsConfig = function () {
    if ($("#statistics_bill_pays").length > 0) {
        var bill_pays = echarts.init(
            document.getElementById("statistics_bill_pays")
        );

        $.ajax({
            type: "GET",
            url:
                "/api/bills/get-quantity-all-bill-in-this-month-belong-status" +
                "?token=" +
                $('meta[name="jwt-token"]').attr("content"),
            success: function (data) {
                var statistics_bill = data.data;
                var arr = [];
                var status = [
                    "Đã giao",
                    "Đã huỷ",
                    "Đã từ chối",
                    "Đã đánh giá",
                    "Chưa đánh giá",
                ];
                //1,-2,-4,2,-3

                var arr_status = [0, 0, 0, 0, 0];

                for (var i = 0; i < statistics_bill.length; i++) {
                    arr[i] = statistics_bill[i].quantity_bill;

                    if (statistics_bill[i].status == 1) {
                        arr_status[0] = arr[i];
                    } else if (statistics_bill[i].status == -2) {
                        arr_status[1] = arr[i];
                    } else if (statistics_bill[i].status == -4) {
                        arr_status[2] = arr[i];
                    } else if (statistics_bill[i].status == 2) {
                        arr_status[3] = arr[i];
                    } else if (statistics_bill[i].status == -3) {
                        arr_status[4] = arr[i];
                    }
                }
                // console.log(arr);

                var option = {
                    color: ["#00acf0"],
                    tooltip: {
                        show: true,
                        trigger: "axis",
                        backgroundColor: "#fff",
                        borderRadius: 6,
                        padding: 6,
                        axisPointer: {
                            lineStyle: {
                                width: 0,
                            },
                        },
                        textStyle: {
                            color: "#324148",
                            fontFamily:
                                '-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji"',
                            fontSize: 15,
                        },
                    },

                    xAxis: [
                        {
                            type: "category",
                            data: status,
                            axisLine: {
                                show: false,
                            },
                            axisTick: {
                                show: false,
                            },
                            axisLabel: {
                                textStyle: {
                                    color: "#5e7d8a",
                                },
                            },
                        },
                    ],
                    yAxis: {
                        type: "value",
                        axisLine: {
                            show: false,
                        },
                        axisTick: {
                            show: false,
                        },
                        axisLabel: {
                            textStyle: {
                                color: "#5e7d8a",
                            },
                        },
                        splitLine: {
                            lineStyle: {
                                color: "#eaecec",
                            },
                        },
                    },
                    grid: {
                        top: "3%",
                        left: "3%",
                        right: "3%",
                        bottom: "3%",
                        containLabel: true,
                    },
                    series: [
                        {
                            data: arr_status,
                            type: "bar",
                            barMaxWidth: 70,
                            itemStyle: {
                                normal: {
                                    barBorderRadius: [6, 6, 0, 0],
                                },
                            },
                        },
                    ],
                };
                bill_pays.setOption(option);
                bill_pays.resize();
            },
            error: function () {},
        });
        bill_pays.setOption(option);
        bill_pays.resize();
    }
    if ($("#e_chart_54").length > 0) {
        var eChart_54 = echarts.init(document.getElementById("e_chart_54"));
        let currentYear = new Date().getFullYear();
        let sixYearAgo = currentYear - 6;
        var arrYear = [];
        var arrQuantitySells = [0, 0, 0, 0, 0, 0, 0];
        var arrInStocks = [0, 0, 0, 0, 0, 0, 0];
        var j = 0;
        for (var i = sixYearAgo; i <= currentYear; i++) {
            arrYear[j] = i;
            j++;
        }
        $.ajax({
            type: "GET",
            url:
                "/api/products/get-all-statistics-of-product" +
                "?token=" +
                $('meta[name="jwt-token"]').attr("content"),
            success: function (data) {
                j = 0;
                data[0].forEach((quantitySells) => {
                    arrQuantitySells[j] = parseInt(quantitySells);
                    j++;
                });
                j = 0;
                data[1].forEach((inStocks) => {
                    arrInStocks[j] = parseInt(inStocks);
                    j++;
                });
                var option4 = {
                    color: ["#22af47", "#ffbf36", "#f83f37"],
                    tooltip: {
                        show: true,
                        trigger: "axis",
                        backgroundColor: "#fff",
                        borderRadius: 6,
                        padding: 6,
                        axisPointer: {
                            lineStyle: {
                                width: 0,
                            },
                        },
                        textStyle: {
                            color: "#324148",
                            fontFamily:
                                '-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol","Noto Color Emoji"',
                            fontSize: 12,
                        },
                    },

                    grid: {
                        top: "3%",
                        left: "3%",
                        right: "3%",
                        bottom: "3%",
                        containLabel: true,
                    },
                    xAxis: [
                        {
                            type: "category",
                            data: arrYear,
                            axisLine: {
                                show: false,
                            },
                            axisTick: {
                                show: false,
                            },
                            axisLabel: {
                                textStyle: {
                                    color: "#5e7d8a",
                                },
                            },
                        },
                    ],
                    yAxis: [
                        {
                            type: "value",
                            axisLine: {
                                show: false,
                            },
                            axisTick: {
                                show: false,
                            },
                            axisLabel: {
                                textStyle: {
                                    color: "#5e7d8a",
                                },
                            },
                            splitLine: {
                                lineStyle: {
                                    color: "#eaecec",
                                },
                            },
                        },
                    ],
                    series: [
                        {
                            name: "Đã Bán",
                            type: "bar",
                            barMaxWidth: 30,
                            data: arrQuantitySells,
                            itemStyle: {
                                normal: {
                                    barBorderRadius: [6, 6, 0, 0],
                                },
                            },
                        },
                        {
                            name: "Đã Nhập",
                            type: "bar",
                            barMaxWidth: 30,
                            data: arrInStocks,
                            itemStyle: {
                                normal: {
                                    barBorderRadius: [6, 6, 0, 0],
                                },
                            },
                        },
                    ],
                };
                eChart_54.setOption(option4);
                eChart_54.resize();
            },
            error: function () {},
        });
    }
};
/*****E-Charts function end*****/

/*****Resize function start*****/
var echartResize;
$(window)
    .on("resize", function () {
        /*E-Chart Resize*/
        clearTimeout(echartResize);
        echartResize = setTimeout(echartsConfig, 200);
    })
    .resize();
/*****Resize function end*****/

/*****Function Call start*****/
echartsConfig();
/*****Function Call end*****/
