$(document).ready(function () {
    //check validate form register account
    $("button.btn-register-account").on("click", function () {
        $("#registerAccount .error-register").remove();
    });
    $("#registerAccount button.btn-register-account").on("click", function () {
        $("#registerAccount .error-register").remove();
        $username = $("#inputUserName").val();
        $password = $("#inputPassword").val();
        $rePassword = $("#inputRePassword").val();
        $email = $("#inputEmail").val();
        $fullName = $("#inputFullName").val();
        $birthDay = $("#inputBirthDay").val();
        $address = $("#inputAddress").val();
        if (!$username) {
            $(".username").append(
                '<p class="error-register text-red">Vui lòng không để trống thông tin</p>'
            );
            return false;
        }
        if (!validatePhone($username)) {
            $("#registerAccount .username").append(
                '<p class="error-register text-red">Thông tin chỉ chứa số và có tối đa 10 số</p>'
            );
            return false;
        }
        if (!$password) {
            $(".password").append(
                '<p class="error-register text-red">Vui lòng không để trống thông tin</p>'
            );
            return false;
        }
        if ($rePassword != $password) {
            $(".rePassword").append(
                '<p class="error-register text-red">Mật khẩu không trùng khớp</p>'
            );
            return false;
        }
        if (!validateCheckPassword($password)) {
            $(".password").append(
                '<p class="error-register text-red">Mật khẩu từ 7 đến 15 ký tự trong đó có ít nhất một chữ số và một ký tự đặc biệt</p>'
            );
            return false;
        }
        if (!$email) {
            $(".email").append(
                '<p class="error-register text-red">Vui lòng không để trống thông tin</p>'
            );
            return false;
        }
        if (!validateEmail($email)) {
            $(".email").append(
                '<p class="error-register text-red">Email không hợp lệ</p>'
            );
            return false;
        }
        if (!$fullName) {
            $(".fullName").append(
                '<p class="error-register text-red">Vui lòng không để trống thông tin</p>'
            );
            return false;
        }
        if (!$birthDay) {
            $(".birthDay").append(
                '<p class="error-register text-red">Vui lòng không để trống thông tin</p>'
            );
            return false;
        }
        if (!$address) {
            $(".address").append(
                '<p class="error-register text-red">Vui lòng không để trống thông tin</p>'
            );
            return false;
        }
    });
});
