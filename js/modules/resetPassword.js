"use strict";
import {
  verifyInput,
  checkingBeforeSubmit,
  invalidFormMessage,
  getURLparms,
} from "./utilities.js";

export function resetPasswordPage() {
  document.querySelectorAll("input").forEach((elt) => {
    addEventListener("input", function (e) {
      verifyInput(e, document.forms[0]);
    });
  });

  document.forms[0].addEventListener("submit", (e) => {
    e.preventDefault();
    let validation = checkingBeforeSubmit(document.querySelectorAll("input"));
    if (validation == true) {
      let data = {
        key: getURLparms()["key"],
        email: e.target["email"].value,
        password: e.target["password"].value,
      };
      data = JSON.stringify(data);
      let xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function () {
        let response = this.responseText;
        if (this.readyState == 4 && this.status == 200) {
          invalidFormMessage(response, document.getElementById("message"));
        }
      };

      xhttp.open("POST", "Controllers/reset_password.php", true);
      xhttp.setRequestHeader(
        "Content-type",
        "application/x-www-form-urlencoded"
      );
      xhttp.send("data=" + data);
    } else {
      invalidFormMessage("access forbiden", document.getElementById("message"));
    }
  });
}
