function readMore() {
  const snippet = document.querySelector(".snippet");
  const readAllBtn = document.querySelector(".expand-snippet-btn");
  snippet.classList.toggle("expand-snippet");

  if (!snippet.classList.contains("expand-snippet")) {
    readAllBtn.innerHTML = `
      <span class='mx-2 text-xl font-bold'>&minus;</span>
      Read Less`;
  } else {
    readAllBtn.innerHTML = `
          <span class='mx-2 text-xl font-bold'>&plus;</span>
          Read All`;
  }
}

function addReadMore() {
  const readAllBtn = document.querySelector(".expand-snippet-btn");
  if (readAllBtn) {
    readAllBtn.addEventListener("click", readMore);
    readAllBtn.addEventListener("keydown", readMore);
  } else console.warn("No read all button was found");
}

window.addEventListener("load", function () {
  addReadMore();
});
