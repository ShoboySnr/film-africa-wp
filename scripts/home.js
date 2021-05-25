"use strict";

function playSlides() {
  const slides = Array.from(document.querySelectorAll(".slide"));
  let activeIdx = slides.findIndex((slide) => slide.checked === true);
  setInterval(() => {
    if (activeIdx === slides.length - 1) {
      activeIdx = 0;
    } else {
      activeIdx = activeIdx + 1;
    }
    slides[activeIdx].checked = true;
  }, 2000);
}

window.addEventListener("load", playSlides);
