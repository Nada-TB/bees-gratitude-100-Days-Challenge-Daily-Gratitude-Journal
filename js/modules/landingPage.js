"use strict";
import {
  checkingBeforeSubmit,
  verifyInput,
  createFormObject,
  invalidFormMessage,
  buildList,
} from "./utilities.js";
import { CheckInput } from "./ClassCheckInput.js";

function landingPage() {
  //get random quote
  document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".posts").forEach((elt) => {
      buildList(elt);
    });

    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
      if (this.status == 200 && this.readyState == 4) {
        let data = JSON.parse(this.responseText);
        let regex = /^[a-zA-z/\s.-_',;]+$/;
        if (
          regex.test(data.content) == true &&
          regex.test(data.autor) == true
        ) {
          document.getElementById("quote").innerHTML =
            "<q>" + data.content + "</q> " + data.author;
        }
      }
    };
    xhttp.open("GET", " https://api.quotable.io/random");
    xhttp.send();
  });

  //show the update profil form
  document.querySelector("#profil a").addEventListener("click", (e) => {
    e.preventDefault();
    document.getElementById("updateProfil").classList.toggle("block");
    document.documentElement.scrollTop = 0;
  });

  // checking the input file
  document.querySelector("input[type=file]").addEventListener("change", (e) => {
    let input = new CheckInput(e.target, null);
    input.verifyFile(
      "error",
      "We just accept images that have max size <= 200MB, and name without spaces ",
      document.querySelector("#updateProfil form"),
      0
    );
  });

  // checking inputs

  document.querySelectorAll("#updateProfil form input").forEach((elt) => {
    if (elt.name !== "avatar") {
      elt.addEventListener("input", (e) => {
        verifyInput(e, document.querySelector("#updateProfil form"));
      });
    }
  });

  // checking form before submitting
  document
    .querySelector("#updateProfil form")
    .addEventListener("submit", (e) => {
      e.preventDefault();
      let inputs = [
        e.target["name"],
        e.target["email"],
        e.target["password"],
        e.target["oldPassword"],
      ];
      let validation;
      if (e.target["avatar"].value == "") {
        validation = true;
      } else {
        let input = new CheckInput(e.target["avatar"], null);
        validation = input.checkFile(0);
      }
      if (validation == true && checkingBeforeSubmit(inputs) == true) {
        let xhttp = new XMLHttpRequest();
        let data = createFormObject(
          ["name", "email", "oldPassword", "password"],
          e.target
        );
        data = JSON.stringify(data);
        let file = new FormData();
        if (e.target["avatar"].files[0]) {
          file.append(
            "file",
            e.target["avatar"].files[0],
            e.target["avatar"].files[0].name
          );
        }
        file.append("data", data);
        xhttp.onreadystatechange = function () {
          if (this.readyState == 4 && this.status == 200) {
            if (this.responseText === "account updated") {
              location.reload();
            } else {
              invalidFormMessage(
                this.responseText,
                document.querySelector("#updateProfil form legend")
              );
            }
          }
        };

        xhttp.open("POST", "Controllers/update_profil.php", true);
        xhttp.send(file);
      } else {
        invalidFormMessage(
          "You haven't filled this form correctly!",
          document.querySelector("#updateProfil form legend")
        );
      }
    });
}

export { landingPage };
