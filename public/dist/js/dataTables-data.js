/*DataTable Init*/

"use strict";

$(document).ready(function () {
    $("#datable_1").DataTable({
        responsive: true,
        autoWidth: false,
        language: {
            search: "",
            searchPlaceholder: "Tìm Kiếm",
            sLengthMenu: "_MENU_",
            lengthMenu: "Hiện không có gì ở đây!",
            zeroRecords: "Không tìm thấy thông tin!",
            info: "",
            infoEmpty: "",
            infoFiltered: "",
            paginate: {
                next: "&#8594;", // or '→'
                previous: "&#8592;", // or '←'
            },
        },
    });
    $("#datable_11").DataTable({
        responsive: true,
        autoWidth: false,
        language: {
            search: "",
            searchPlaceholder: "Tìm Kiếm",
            sLengthMenu: "_MENU_",
            lengthMenu: "Hiện không có gì ở đây!",
            zeroRecords: "Không tìm thấy thông tin!",
            info: "",
            infoEmpty: "",
            infoFiltered: "",
            paginate: {
                next: "&#8594;", // or '→'
                previous: "&#8592;", // or '←'
            },
        },
    });
    $("#datable_2").DataTable({
        autoWidth: false,
        lengthChange: false,
        bPaginate: false,
        language: {
            search: "",
            searchPlaceholder: "Search",
        },
    });

    /*Export DataTable*/
    $("#datable_3").DataTable({
        dom: "Bfrtip",
        responsive: true,
        language: {
            search: "",
            searchPlaceholder: "Search",
        },
        bPaginate: false,
        info: false,
        bFilter: false,
        buttons: ["copy", "csv", "excel", "pdf", "print"],
        drawCallback: function () {
            $(".dt-buttons > .btn").addClass("btn-outline-light btn-sm");
        },
    });

    var table = $("#datable_5").DataTable({
        responsive: true,
        language: {
            search: "",
            sLengthMenu: "_MENU_Items",
        },
        bPaginate: false,
        info: false,
        bFilter: false,
    });
    $("#datable_5 tbody").on("click", "tr", function () {
        if ($(this).hasClass("selected")) {
            $(this).removeClass("selected");
        } else {
            table.$("tr.selected").removeClass("selected");
            $(this).addClass("selected");
        }
    });

    $("#button").click(function () {
        table.row(".selected").remove().draw(false);
    });
});
