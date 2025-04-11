$(".remove_rank").on("click", function () {
    $rank_id = $(this).attr("id");
    $(".btn_remove_rank").attr("id", $rank_id);
});
$(".btn_remove_rank").on("click", function () {
    $rank_id = $(this).attr("id");
    $.ajax({
        type: "POST",
        url:
            "/api/ranks/remove-rank" +
            "?token=" +
            $('meta[name="jwt-token"]').attr("content"),
        data: {
            rank_id: $rank_id,
            status: 0,
        },
        success: function (data) {
            if (data.status == 401) {
                logout();
                return;
            }
            location.reload(false);
        },
        error: function () {},
    });
});

$(".recover_rank").on("click", function () {
    $rank_id = $(this).attr("id");
    $(".btn_recover_rank").attr("id", $rank_id);
});
$(".btn_recover_rank").on("click", function () {
    $rank_id = $(this).attr("id");
    $.ajax({
        type: "POST",
        url:
            "/api/ranks/remove-rank" +
            "?token=" +
            $('meta[name="jwt-token"]').attr("content"),
        data: {
            rank_id: $rank_id,
            status: 1,
        },
        success: function (data) {
            if (data.status == 401) {
                logout();
                return;
            }
            location.reload(false);
        },
        error: function () {},
    });
});

$(".btn_add_rank").on("click", function () {
    $(".error-rank").remove();
});

$(".btn_update_rank").on("click", function () {
    $rank_id = $(this).attr("id");
    $(".error-rank-update").remove();
    $.ajax({
        type: "GET",
        url:
            "/api/ranks/get-rank-by-id/" +
            $rank_id +
            "?token=" +
            $('meta[name="jwt-token"]').attr("content"),
        success: function (data) {
            if (data.status == 401) {
                logout();
                return;
            }
            $rank = data.data;
            $("#updateRank #inputRankID").val($rank.rank_id);
            $("#updateRank #inputRankNameUpdate").val($rank.rank_name);
            $("#updateRank #inputPoint").val($rank.point);
        },
        error: function () {},
    });
});

//check validate form add rank - button add rank
$("#addRank button.btn_submit_add_rank").on("click", function () {
    $(".error-rank").remove();
    $rank_id = $("#addRank #inputRankID").val();
    $rank_name = $("#addRank #inputRankNameAdd").val();
    $point = $("#addRank #inputPoint").val();

    if (!$rank_id) {
        $("#addRank .rank_id").append(
            '<p class="error-rank text-red">Vui lòng không để trống thông tin</p>'
        );
        return false;
    }

    if (!$rank_name) {
        $("#addRank #rank_name_add").append(
            '<p class="error-rank text-red">Vui lòng không để trống thông tin</p>'
        );
        return false;
    }

    if (!$point) {
        $("#addRank .point").append(
            '<p class="error-rank text-red">Vui lòng không để trống thông tin</p>'
        );
        return false;
    }
    // if (!validateId($rank_id)) {
    //     $('#addRank .rank_id').append(
    //         '<p class="error-rank text-red">Thông tin chỉ chứa kí tự chữ (a-zA-Z, chỉ từ 1 đến 10 kí tự)</p>'
    //     );
    //     return false;
    // }

    if (!validateName($rank_name)) {
        $("#addRank #rank_name_add").append(
            '<p class="error-rank text-red">Thông tin chỉ chứa kí tự chữ (a-zA-Z,1 space,kí tự có dấu)</p>'
        );
        return false;
    }
});
//check validate form update rank - button update rank
$("#updateRank button.btn_submit_update_rank").on("click", function () {
    $("#updateRank .error-rank-update").remove();
    $rank_name = $("#inputRankNameUpdate").val();
    $point = $("#inputPoint").val();
    if (!$rank_name) {
        $("#updateRank .rank_name_update").append(
            '<p class="error-rank-update text-red">Vui lòng không để trống thông tin</p>'
        );
        return false;
    }

    if (!$point) {
        $("#updateRank .point_update").append(
            '<p class="error-rank-update text-red">Vui lòng không để trống thông tin</p>'
        );
        return false;
    }

    if (!validateName($rank_name)) {
        $("#updateRank .rank_name_update").append(
            '<p class="error-rank-update text-red">Thông tin chỉ chứa kí tự chữ (a-zA-Z,1 space,kí tự có dấu)</p>'
        );
        return false;
    }
});
