(function () {
  "use strict";

  var forms = document.querySelectorAll(".needs-validation");

  Array.prototype.slice.call(forms).forEach(function (form) {
    form.addEventListener(
      "submit",
      function (event) {
        if (!form.checkValidity()) {
          event.preventDefault();
          event.stopPropagation();
        }

        form.classList.add("was-validated");
      },
      false
    );
  });
})();

const password = document.getElementById("Pass");
const pass = document.getElementById("password");
const confirmImg = document.getElementById("confirmImg");
const confirmPassword = document.getElementById("confirm");
const loginImg = document.getElementById("loginImg");
const loginPassword = document.getElementById("loginPassword");

loginImg?.addEventListener("click", () => {
  if (loginPassword.type === "password") {
    console.log("clcik");
    loginPassword.type = "text";
  } else {
    loginPassword.type = "password";
  }
});

password?.addEventListener("click", () => {
  if (pass.type === "password") {
    pass.type = "text";
  } else {
    pass.type = "password";
  }
});

confirmImg?.addEventListener("click", () => {
  if (confirmPassword.type === "password") {
    confirmPassword.type = "text";
  } else {
    confirmPassword.type = "password";
  }
});

//  otp

$(".otp-inputbar").keypress(function (e) {
  if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
    $("#errmsg").html("Digits Only").show().fadeOut("slow");
    return false;
  }
});
$(".otp-inputbar").on("keyup", function (e) {
  if ($(this).val()) {
    $(this).next().focus();
  }
  var KeyID = e.keyCode;
  switch (KeyID) {
    case 8:
      $(this).val("");
      $(this).prev().focus();
      break;
    case 46:
      $(this).val("");
      $(this).prev().focus();
      break;
    default:
      break;
  }
  console.log($(this).val());
});
