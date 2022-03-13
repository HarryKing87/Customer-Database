let sortingWindow = document.getElementById("sorting");
let arrowDown = document.getElementById("arrowDown");

arrowDown.addEventListener("click", function () {
  if (sortingWindow.style.display == "none") {
    sortingWindow.style.display = "block";
  } else {
    sortingWindow.style.display = "none";
  }
});
