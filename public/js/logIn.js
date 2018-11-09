var login= document.getElementById('login');
var logInModal= document.getElementById('logInModal');

// console.log(logInModal);
login.onclick = function(){
  if (logInModal.style.display === "block") {
    logInModal.style.display = "none";
  } else {
    logInModal.style.display = "block";
  }
}



document.getElementById("logInModal").addEventListener("click", function(e) {
  var floatingLogIn= document.getElementById('floatingLogIn');
  // logInModal.contains( floatingLogIn )
if (e.target.contains( floatingLogIn )) {
  logInModal.style.display = "none";
}
});
