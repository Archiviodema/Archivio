/*window.onload = function () {
  document
    .getElementById('login_btn')
    .addEventListener('mousemove', login_btn_clicked)
}*/

var btn = document.getElementById('login_btn')
if (btn) btn.addEventListener('mousemove', login_btn_clicked)

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
  if (CF.length > 0) {
    if (pwd.length > 0) {
      return true
    }
  }
  return false
}

$(document).ready(function() {
  $("#show_hide_password a").on('click', function(event) {
      event.preventDefault();
      if($('#show_hide_password input').attr("type") == "text"){
          $('#show_hide_password input').attr('type', 'password');
          $('#show_hide_password i').addClass( "fa-eye-slash" );
          $('#show_hide_password i').removeClass( "fa-eye" );
      }else if($('#show_hide_password input').attr("type") == "password"){
          $('#show_hide_password input').attr('type', 'text');
          $('#show_hide_password i').removeClass( "fa-eye-slash" );
          $('#show_hide_password i').addClass( "fa-eye" );
      }
  });
});