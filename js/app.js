"use strict";
import { homePage } from "./modules/homePage.js";
import { forgottenPasswordPage } from "./modules/forgottenPasswordPage.js";
import { resetPasswordPage } from "./modules/resetPassword.js";
import { landingPage } from "./modules/landingPage.js";
import { addPost } from "./modules/addPost.js";
import { deleteAccountPage } from "./modules/deleteAccount.js";
import { showPost } from "./modules/showPost.js";
/**********************************variables****************************** */
let events = ["mousemove", "keypress", "scroll", "resize", "click"];
var time = parseInt(new Date().getTime() / 1000);

/********************************functions********************************** */

function trackTime(event) {
  window.addEventListener(event, () => {
    let date = new Date();
    let timer = parseInt(date.getTime() / 1000);
    time = timer;
  });
}
events.forEach((elt) => {
  trackTime(elt);
});

if (document.title === "Home page") {
  homePage();
}
if (document.title === "forgotten password") {
  forgottenPasswordPage();
}

if (document.title === "reset password") {
  resetPasswordPage();
}

if (document.title === "landing page") {
  landingPage();
}

if (document.title === "daily bee's gratitude") {
  addPost();
}

if (document.title === "delete account") {
  deleteAccountPage();
}
if (document.title.includes("Post number") == true) {
  showPost();
}
/********************************global events************************************ */
if (document.title !== "Home page") {
  setInterval(function () {
    let xhttp = new XMLHttpRequest();
    let timer = JSON.stringify(parseInt(new Date().getTime() / 1000) - time);
    xhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        if (this.responseText == "expired") {
          let error = "session expired";
          window.location.replace("index.php?path=homePage&&message=" + error);
        }
      }
    };
    xhttp.open("POST", "Controllers/session_expired.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("timer=" + timer);
  }, 60000);
}
