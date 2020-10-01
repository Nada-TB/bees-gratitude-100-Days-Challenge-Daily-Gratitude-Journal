"use strict";
import {
  verifyInput,
  checkingBeforeSubmit,
  createFormObject,
  invalidFormMessage,
} from "./utilities.js";

function deleteAccountPage() {
  document
    .querySelector("#questions button:nth-child(2)")
    .addEventListener("click", () => {
      document.forms[0].style.display = "grid";
    });

  document.querySelector("input[type=email]").addEventListener("input", (e) => {
    verifyInput(e, document.forms[0]);
  });

  document.forms[0].addEventListener("submit", (e) => {
    e.preventDefault();
    if (
      e.target["password"].value !== "" &&
      checkingBeforeSubmit(e.target["email"]) == true
    ) {
      let data = createFormObject(["email", "password"], document.forms[0]);
      data = JSON.stringify(data);
      let xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          if (this.responseText === "done") {
            window.location.assign("index.php");
          } else {
            invalidFormMessage(
              this.responseText,
              document.getElementById("message")
            );
          }
        }
      };
      xhttp.open("POST", "index.php?path=delete_account", true);
      xhttp.setRequestHeader(
        "Content-type",
        "application/x-www-form-urlencoded"
      );
      xhttp.send("data=" + data);
    } else {
      invalidFormMessage(
        "please fill the form before submitting",
        document.getElementById("message")
      );
    }
  });
}

export { deleteAccountPage };
