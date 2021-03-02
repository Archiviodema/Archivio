/*window.onload = function () {
  document
    .getElementById('login_btn')
    .addEventListener('mousemove', login_btn_clicked)
}*/

var btn = document.getElementById('login_btn')
if (btn) btn.addEventListener('mousemove', login_btn_clicked)

function showPassword() {
  var x = document.getElementById("pwd");
  //if (x.type === "password") {
  //    x.type = "text";
  //} else {
  //    x.type = "password";
  //}
  x.type === "password" ? x.type = "text" : x.type = "password";

}

function login_btn_clicked () {
  if (validate()) {
    var btn = document.getElementById('login_btn')
    // btn.setAttribute("disabled", true);
    btn.innerHTML = 'Carico...<br>'
    var newSpan = document.createElement('span')
    newSpan.classList.add('spinner-border')
    newSpan.classList.add('spinner-border-sm')
    newSpan.setAttribute('role', 'status')
    newSpan.setAttribute('aria-hidden', 'true')
    btn.appendChild(newSpan)
  }
}

function validate () {
  var CF = document.getElementById('CF').value
  var pwd = document.getElementById('pwd').value
  if (CF.length ===16) {
      if(pwd>0){
        return true;
      }
  }
  else{
    if(pwd == null || pwd == ""){
      alert("Codice fiscale incompleto\nPassword non inserita")
      return false
    }
    alert("Codice fiscale incompleto")
    return false
  }
  
}

