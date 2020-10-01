import { CheckInput } from "./ClassCheckInput.js";

var pattern = {
  name: /^[a-zA-Z]{3,8}$/,
  email: /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/,
  password: /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{8,15}$/,
  oldPassword: /^[a-zA-Z0-9!@#$%^&*.]+$/,
};
var errorMessage = {
  name: "we just accept letters, name length between 3 and 8",
  email: "this email isn't valid ",
  password:
    "password between 8 to 15 characters which contain at least one numeric digit and a special character",
  oldPassword: "required field",
};

//verify input
function verifyInput(e, form) {
  let check = new CheckInput(e.target, pattern[e.target.name]);
  check.verify("error", errorMessage[e.target.name], form);
}

// create an object to store data before to send them
function createFormObject(tableDataName, form) {
  var obj = {};
  for (var i = 0; i < tableDataName.length; i++) {
    obj[tableDataName[i]] = form[tableDataName[i]].value;
  }
  return obj;
}

// verify all inputs before submitting form
function checkingBeforeSubmit(inputs) {
  let inputsArray = Array.prototype.slice.call(inputs);
  let check = inputsArray.every((elt) => {
    let check = new CheckInput(elt, pattern[elt.name]);
    return check.testPattern() == true;
  });

  return check;
}

function invalidFormMessage(message, target) {
  target.innerHTML = message;
}

function getURLparms() {
  let url = window.location.search.replace(/[?]/g, "");
  let obj = {};
  url.split("&&").forEach((elt) => {
    elt = elt.split("=");
    obj[elt[0]] = elt[1];
  });
  return obj;
}

function buildList(target) {
  let text = target.textContent.split(",");
  text = text.map((elt) => {
    return "<li>" + elt + "</li>";
  });
  target.innerHTML = "<ul>" + text.join(" ") + "</ul>";
}

export {
  pattern,
  errorMessage,
  verifyInput,
  checkingBeforeSubmit,
  invalidFormMessage,
  createFormObject,
  getURLparms,
  buildList,
};
