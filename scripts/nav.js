"use strict";

function openNav(e) {
  const menuContent = document.getElementById("nav-content");
  const closeNavButton = document.getElementById("close-btn");

  menuContent?.classList.add("open-menu");
  if (e) {
    closeNavButton?.focus();
    document
      .querySelector(".nav-item  a")
      ?.classList.add("focus:outline-white");
  }
}

function closeNav() {
  const menuContent = document.getElementById("nav-content");
  menuContent?.classList.remove("open-menu");
}

function connectNav() {
  const openNavButton = document.getElementById("open-btn");
  const closeNavButton = document.getElementById("close-btn");

  openNavButton?.addEventListener("click", openNav);
  openNavButton?.addEventListener("keydown", (e) => {
    if (e.key === "Enter") {
      return openNav(e);
    }
  });

  closeNavButton?.addEventListener("click", closeNav);
  closeNavButton?.addEventListener("keydown", (e) => {
    if (e.key === "Enter") {
      return closeNav();
    }
  });
}

window.addEventListener("DOMContentLoaded", connectNav);
