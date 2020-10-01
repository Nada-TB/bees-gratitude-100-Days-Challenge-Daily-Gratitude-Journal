"use strict";
import {
  verifyInput,
  checkingBeforeSubmit,
  invalidFormMessage,
} from "./utilities.js";

export function forgottenPasswordPage() {
  document.querySelector("form input").addEventListener("input", (e) => {
    verifyInput(e, document.querySelector("form"));
  });

  // submitting  sign up form
  document
    .getElementById("forgottenPassword")
    .addEventListener("submit", (e) => {
      e.preventDefault();
      let validation = checkingBeforeSubmit(
        document.querySelector("input[type=email]")
      );
      if (validation == true) {
        let xhttp = new XMLHttpRequest();
        let email = e.target["email"].value;
        email = JSON.stringify(email);
        xhttp.onreadystatechange = function () {
          if (this.readyState == 4 && this.status == 200) {
            if (this.responseText == "exist") {
              invalidFormMessage(
                "check your inbox, you'll find all instruction to reset your password",
                document.getElementById("message")
              );
            } else if (this.responseText == "inexistent") {
              invalidFormMessage(
                "this email hasn't an account",
                document.getElementById("message")
              );
            } else {
              invalidFormMessage(
                "invalid email",
                document.getElementById("message")
              );
            }
          }
        };
        xhttp.open("POST", "Controllers/forgotten_password.php", true);
        xhttp.setRequestHeader(
          "Content-type",
          "application/x-www-form-urlencoded"
        );
        xhttp.send("email=" + email);
      } else {
        invalidFormMessage(
          "Your form is invalid ",
          document.getElementById("message")
        );
      }
    });
}
