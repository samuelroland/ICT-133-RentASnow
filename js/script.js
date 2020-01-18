document.addEventListener("DOMContentLoaded", init)

function init() {
    password.addEventListener("keyup", checkform)
    password2.addEventListener("keyup", checkform)
    birthdate.addEventListener("keyup", checkform)
    chk2.addEventListener("change", checkform)
}

function checkform() {
    if (birthdate.value > "1900-01-01" && birthdate.value < "2020-01-01" && document.getElementById('password').value === document.getElementById('password2').value && document.getElementById('chk2').checked == true) {
        btnsubmit.disabled = false
        return true
    } else {
        btnsubmit.disabled = true
        return false
    }
}