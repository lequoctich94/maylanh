function validateName($data) {
    $regEx =
        /^[^-~!@#$%^&*()_+=\|\}\{'";:?\/>\.<,\\\s0-9]([\s]?[^-~!@#$%^&*()_+=\|\}\{'";:?\/>\.<\\,0-9\s])*$/;
    if ($regEx.test($data) == false) return false;
    return true;
}

function validateSize($data) {
    $regEx =
        /^[^-~!@#$%^&*()_+=\|\}\{'";:?\/>\.<,\\\s]([\s]?[^-~!@#$%^&*()_+=\|\}\{'";:?\/>\.<\\,\s])*$/;
    if ($regEx.test($data) == false) return false;
    return true;
}

function validateCode($data) {
    $regEx =
        /^[^-~!@#$%^&*()_+=\|\}\{'";:?\/>\.<,\\\s]([\s]?[^-~!@#$%^&*()_+=\|\}\{'";:?\/>\.<\\,\s])*$/;
    if ($regEx.test($data) == false) return false;
    return true;
}

function validateEmail($data) {
    $regEx =
        /^[a-zA-Z]([\_\.]?[a-zA-Z0-9]){5,}@{1}([a-z]{4,10}([\.]{1})[a-z]{2,4}(([\.]{1})[a-z]{2,4})?)$/;
    if ($regEx.test($data) == false) return false;
    return true;
}

function validatePriceData($data) {
    $regEx = /^[1-9][0-9]{3,}$/;
    if ($regEx.test($data) == false) return false;
    return true;
}

function validateQuantity($data) {
    $regEx = /^[1-9]{2,}$/;
    if ($regEx.test($data) == false) return false;
    return true;
}

function validateSelected($data) {
    if ($data == "none") return false;
    return true;
}

function validatePhone($data) {
    $regEx = /(03|05|07|08|09|01[2|6|8|9])+([0-9]{8})\b/;
    if ($regEx.test($data) == false) return false;
    return true;
}

// function validateAddress($data) {
//     // $regEx = /^[a-ZA-Z0-9]([-\./\\,\s][a-ZA-Z0-9])*$/;
//     $regEx = /^[^-~!@#$%^&*()_+=\|\}\{'";:?\/>\.<,\\\s][^-_,~!@#$%^&*()+=\|\}\{'";:?\/>\.<\\,\s]*$/;
//     if ($regEx.test($data) == false)
//         return false;
//     return true;
// }

function validateCategory($data) {
    $regEx =
        /^[^-~!@#$%^&*()_+=\|\}\{'";:?\/>\.<,\\\s0-9]([\s]?[^-~!@#$%^&*()_+=\|\}\{'";:?\/>\.<\\,0-9\s])*$/;
    if ($regEx.test($data) == false) return false;
    return true;
}

function validateId($data) {
    $regEx = /^[a-zA-Z]{1,10}$/;
    if ($regEx.test($data) == false) return false;
    return true;
}

function validatePercentPrice($data) {
    $regEx = /^([0-9]|[0-9][.]{1}[0-9]+)$/;
    if ($regEx.test($data) == false) return false;
    return true;
}
function validateCheckPassword($data) {
    $regEx = /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{7,15}$/;
    if ($regEx.test($data) == false) return false;
    return true;
}

function validateImage($data) {
    if (!$data) {
        return false;
    }
    return true;
}
