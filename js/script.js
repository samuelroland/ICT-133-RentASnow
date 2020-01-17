document.addEventListener("DOMContentLoaded", init)

function init() {
    firstname.addEventListener("keyup", checkform)
    password.addEventListener("keyup", checkform)
    password2.addEventListener("keyup", checkform)
    birthdate.addEventListener("keyup", checkform)
}

function checkform() {
    if (birthdate.value > "1999-01-01" && birthdate.value < "2020-01-01" && password.value === password2.value) {
        btnsubmit.disabled = false
        return true
    } else {
        btnsubmit.disabled = true
        alert(password.value)
    return false
    }
}