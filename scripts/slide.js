"use strict";

function playSlides() {
  const slideButtons = Array.from(
    document.querySelectorAll(".hidden-slide-btn")
  );
  let activeIdx = slideButtons.findIndex(
    (slideBtn) => slideBtn.checked === true
  );
  setInterval(() => {
    if (activeIdx === slideButtons.length - 1) {
      activeIdx = 0;
    } else {
      activeIdx = activeIdx + 1;
    }
    slideButtons[activeIdx].checked = true;
  }, 2000);
}

window.addEventListener("load", playSlides);
