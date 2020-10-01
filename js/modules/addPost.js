"use strict";

function addPost() {
  document.querySelector("textarea").addEventListener("input", (e) => {
    if (document.querySelector("span").textContent !== "") {
      document.querySelector("span").textContent = "";
    }
    if (e.target.value.length === 250) {
      alert("250 characters allowed");
    }
  });

  document.forms[0].addEventListener("submit", (e) => {
    e.preventDefault();
    if (document.forms[0]["post"].value === "") {
      document.querySelector("span").textContent = "your post is empty";
    } else {
      let xhttp = new XMLHttpRequest();
      let content = JSON.stringify(document.forms[0]["post"].value);
      xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          if (this.responseText === "added") {
            window.location = "landing_page";
          } else {
            document.querySelector("span").textContent = this.responseText;
          }
        }
      };
      xhttp.open("POST", "Controllers/add_post.php", true);
      xhttp.setRequestHeader(
        "Content-type",
        "application/x-www-form-urlencoded"
      );
      xhttp.send("content=" + content);
    }
  });
}

export { addPost };
