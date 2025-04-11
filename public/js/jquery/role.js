$(".remove_role").on("click", function () {
    $role_id = $(this).attr("id");
    $(".btn_remove_role").attr("id", $role_id);
});
$(".btn_remove_role").on("click", function () {
    $role_id = $(this).attr("id");
    $.ajax({
        type: "POST",
        url:
            "/api/roles/remove-role" +
            "?token=" +
            $('meta[name="jwt-token"]').attr("content"),
        data: {
            role_id: $role_id,
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

$(".recover_role").on("click", function () {
    $role_id = $(this).attr("id");
    $(".btn_recover_role").attr("id", $role_id);
});
$(".btn_recover_role").on("click", function () {
    $role_id = $(this).attr("id");
    $.ajax({
        type: "POST",
        url:
            "/api/roles/remove-role" +
            "?token=" +
            $('meta[name="jwt-token"]').attr("content"),
        data: {
            role_id: $role_id,
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

$(".btn_update_role").on("click", function () {
    $role_id = $(this).attr("id");
    $.ajax({
        type: "GET",
        url:
            "/api/roles/get-role-by-id/" +
            $role_id +
            "?token=" +
            $('meta[name="jwt-token"]').attr("content"),
        success: function (data) {
            if (data.status == 401) {
                logout();
                return;
            }
            $role = data.data;
            $("#updateRole #inputRoleId").val($role.role_id);
            $("#updateRole #inputRoleNameUpdate").val($role.role_name);
        },
        error: function () {},
    });
});

//check validate form add role - button add role
$("#addRole button.btn_submit_add_role").on("click", function () {
    $(".error-role").remove();
    $role_id = $("#inputRoleId").val();
    $role_name = $("#inputRoleName").val();

    if (!$role_id) {
        $(".role_id").append(
            '<p class="error-role text-red">Vui lòng không để trống thông tin</p>'
        );
        return false;
    }

    if (!validateId($role_id)) {
        $(".role_id").append(
            '<p class="error-role text-red">Thông tin chỉ chứa kí tự chữ (a-zA-Z,chỉ từ 1 đến 10 kí tự)</p>'
        );
        return false;
    }

    if (!$role_name) {
        $(".role_name").append(
            '<p class="error-role text-red">Vui lòng không để trống thông tin</p>'
        );
        return false;
    }

    if (!validateName($role_name)) {
        $(".role_name").append(
            '<p class="error-role text-red">Thông tin chỉ chứa kí tự chữ (a-zA-Z,1 space,kí tự có dấu)</p>'
        );
        return false;
    }
});

//check validate form update role - button update role
$("#updateRole button.btn_submit_update_role").on("click", function () {
    $(".error-role-update").remove();
    $role_name = $("#inputRoleNameUpdate").val();

    if (!$role_name) {
        $(".role_name").append(
            '<p class="error-role-update text-red">Vui lòng không để trống thông tin</p>'
        );
        return false;
    }

    if (!validateName($role_name)) {
        $(".role_name").append(
            '<p class="error-role-update text-red">Thông tin chỉ chứa kí tự chữ (a-zA-Z,1 space,kí tự có dấu)</p>'
        );
        return false;
    }
});
