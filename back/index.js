//Dayna Caroline Domiciano do Prado
//Criação: 18/08
//Última alteração: 21/08

var btnCad = document.querySelector("#cadastro");
var btnLogin = document.querySelector("#login");

var body = document.querySelector("body");


btnCad.addEventListener("click", function () {
   body.className = "cad-js"; 
});

btnLogin.addEventListener("click", function () {
    body.className = "login-js";
})