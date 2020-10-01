"use strict";
import { buildList } from "./utilities.js";

// Create a list
function showPost() {
  document.addEventListener("DOMContentLoaded", function () {
    buildList(document.querySelector("#showPost article p:nth-child(2)"));
  });
}

export { showPost };
