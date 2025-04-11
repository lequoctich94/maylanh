//Remove Producer
$(".block_member").on("click", function () {
    $member_id = $(this).attr("id");
    $(".btn-block-member").attr("id", $member_id);
});

$(".btn-block-member").on("click", function () {
    $member_id = $(this).attr("id");
    $.ajax({
        type: "POST",
        url:
            "/api/members/update-status-by-member-id" +
            "?token=" +
            $('meta[name="jwt-token"]').attr("content"),
        data: {
            member_id: $member_id,
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

//Recover Producer
$(".unlock_member").on("click", function () {
    $member_id = $(this).attr("id");
    $(".btn-unlock-member").attr("id", $member_id);
});

$(".btn-unlock-member").on("click", function () {
    $member_id = $(this).attr("id");
    $.ajax({
        type: "POST",
        url:
            "/api/members/update-status-by-member-id" +
            "?token=" +
            $('meta[name="jwt-token"]').attr("content"),
        data: {
            member_id: $member_id,
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
