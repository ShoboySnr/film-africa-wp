function toggleControls() {
  const trailerLabel = document.querySelector(".watch-trailer");
  const playVideoBtn = document.querySelector("#play-btn");

  trailerLabel.classList.toggle("opacity-0");
  playVideoBtn.classList.toggle("hidden");
}

function playVideo() {
  const trailer = document.querySelector("#trailer");
  // @ts-ignore
  trailer.classList.remove("hide-trailer");
  trailer.classList.add("show-trailer");
  toggleControls();
}

function stopVideo() {
  const trailer = document.querySelector("#trailer");
  // @ts-ignore
  trailer.classList.remove("show-trailer");
  trailer.classList.add("hide-trailer");
  toggleControls();
}

function addPlayVideo() {
  const playVideoBtn = document.querySelector("#play-btn");
  if (playVideoBtn) {
    playVideoBtn.addEventListener("click", playVideo);
    playVideoBtn.addEventListener("keydown", playVideo);
  }
}
function addStopVideo() {
  const stopVideoBtn = document.querySelector("#stop-btn");
  if (stopVideoBtn) {
    stopVideoBtn.addEventListener("click", stopVideo);
    stopVideoBtn.addEventListener("keydown", stopVideo);
  }
}

window.addEventListener("load", function () {
  addPlayVideo();
  addStopVideo();
});
