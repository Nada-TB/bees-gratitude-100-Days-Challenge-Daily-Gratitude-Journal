"use strict";

export class CheckInput {
  constructor(input, pattern) {
    this.input = input;
    this.pattern = pattern;
  }

  testPattern() {
    return this.pattern.test(this.input.value);
  }

  checkFile(i) {
    let extension = ["png", "jpeg", "gif", "jpg"];
    if (
      extension.includes(this.input.value.split(".").pop().toLowerCase()) ==
      true
    ) {
      if (
        this.input.files[i].size <= 209715200 &&
        this.input.files[i].name.includes(" ") == false
      ) {
        return true;
      } else {
        return false;
      }
    } else {
      return false;
    }
  }

  fetchErrorMessage(errorMessage, input, form) {
    let errorContent = document.createElement("span");
    errorContent.textContent = errorMessage;
    errorContent.setAttribute("id", "data-" + this.input.name);
    form.insertBefore(errorContent, input);
    return errorContent;
  }

  verify(classError, errorMessage, form) {
    if (this.input.value == "" || this.testPattern() == false) {
      this.input.classList.add(classError);
      this.input.classList.remove("valid");
      if (
        form.contains(document.getElementById("data-" + this.input.name)) ==
        false
      ) {
        this.fetchErrorMessage(errorMessage, this.input, form);
      }
    } else {
      this.input.classList.remove(classError);
      this.input.classList.add("valid");
      if (
        form.contains(document.getElementById("data-" + this.input.name)) ==
        true
      ) {
        document.getElementById("data-" + this.input.name).remove();
      }
    }
  }
  verifyFile(classError, errorMessage, form, i) {
    if (this.checkFile(i) == false) {
      this.input.classList.add(classError);
      this.input.classList.remove("valid");
      if (
        form.contains(document.getElementById("data-" + this.input.name)) ==
        false
      ) {
        this.fetchErrorMessage(errorMessage, this.input, form);
      }
    } else {
      this.input.classList.remove(classError);
      this.input.classList.add("valid");
      if (
        form.contains(document.getElementById("data-" + this.input.name)) ==
        true
      ) {
        document.getElementById("data-" + this.input.name).remove();
      }
    }
  }
}
