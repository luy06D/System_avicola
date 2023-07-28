var view = true;
function vista() {
    var texto = document.getElementById("verPassword");
    if (view == true) {
        texto.className = "fas fa-eye-slash verPassword";
        document.getElementById("password").type="text";
        view= false;
    } else {
        texto.className = "fas fa-eye verPassword";
        document.getElementById("password").type="password";
        view = true;
    }
}