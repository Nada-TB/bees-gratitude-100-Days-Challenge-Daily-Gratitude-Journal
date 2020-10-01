import { CheckInput } from "./ClassCheckInput.js";
import {
  pattern,
  verifyInput,
  checkingBeforeSubmit,
  invalidFormMessage,
  createFormObject,
} from "./utilities.js";

function homePage() {
  var formSignUp = document.getElementById("signUp");
  var formLogin = document.getElementById("login");
  var date = new Date();
  /***********************************events****************************************************************** */
  //add an bee's image when the form is selected
  document.querySelectorAll("form").forEach((elt, index) => {
    elt.addEventListener("mouseenter", (e) => {
      elt.style.position = "relative";
      if (document.querySelectorAll(".homePage img").length > 0) {
        document.querySelector(".homePage img").remove();
      }
      if (elt.contains(document.getElementById("data-" + elt.id)) == false) {
        let img = document.createElement("img");
        img.setAttribute("id", "data-" + elt.id);
        img.setAttribute("src", "css/images/avatar.png");
        img.setAttribute("alt", "bee");
        elt.appendChild(img);
      }
    });
    // remove the bee's image when the form is unselected
    elt.addEventListener("mouseleave", () => {
      if (elt.contains(document.getElementById("data-" + elt.id)) == true) {
        document.getElementById("data-" + elt.id).remove();
        document.querySelector("#about img").style.display = "block";
      }
    });
  });

  document
    .querySelector("#about p:nth-child(2)")
    .addEventListener("click", (e) => {
      if (e.target.textContent === "learn about us") {
        e.target.textContent = "hide text";
      } else {
        e.target.textContent = "learn about us";
      }
      document.querySelector("#about article").classList.toggle("block");
    });

  // verify input while typing
  document.querySelectorAll("#signUp input").forEach((elt) => {
    elt.addEventListener("input", (e) => {
      verifyInput(e, formSignUp);
    });
  });

  document.querySelector("#login input").addEventListener("input", (e) => {
    verifyInput(e, formLogin);
  });

  // submitting  sign up form
  formSignUp.addEventListener("submit", (e) => {
    e.preventDefault();
    let validation = checkingBeforeSubmit(
      document.querySelectorAll("#signUp input")
    );
    if (validation == true) {
      e.target.submit();
    }
  });

  // submitting login form with ajax;
  formLogin.addEventListener("submit", (e) => {
    e.preventDefault();
    let validation = new CheckInput(
      document.querySelector("#login input"),
      pattern[document.querySelector("#login input").name]
    );
    if (e.target["password"].value !== "" && validation.testPattern() == true) {
      let formData = createFormObject(["name", "email", "password"], formLogin);
      formData = JSON.stringify(formData);
      let xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function () {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
          let response = this.responseText;
          if (response !== "connected") {
            invalidFormMessage(response, document.getElementById("message"));
          } else {
            window.location.assign("landing_page");
          }
        }
      };
      xhttp.open("POST", "Controllers/login.php", true);
      xhttp.setRequestHeader(
        "Content-type",
        "application/x-www-form-urlencoded"
      );
      xhttp.send("data=" + formData);
    } else if (e.target["password"].value == "") {
      invalidFormMessage(
        "You have forgotten your password",
        document.getElementById("message")
      );
    }
  });
}

export { homePage };
