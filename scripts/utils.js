function readMore() {
  const snippet = document.querySelector(".snippet");
  const readAllBtn = document.querySelector(".read-all-btn");
  snippet.classList.toggle("expand-snippet");

  if (!snippet.classList.contains("expand-snippet")) {
    readAllBtn.innerHTML = `
      <span class='mx-2 text-xl'>&minus;</span>
      Read Less`;
  } else {
    readAllBtn.innerHTML = `
          <span class='mx-2 text-xl'>&plus;</span>
          Read All`;
  }
}

function toggleControls() {
  const trailerLabel = document.querySelector(".watch-trailer");
  const playVideoBtn = document.querySelector(".play-btn");
  const pauseVideoBtn = document.querySelector(".pause-btn");

  trailerLabel.classList.toggle("opacity-0");
  playVideoBtn.classList.toggle("hidden");
  pauseVideoBtn.classList.toggle("hidden");
}

function playVideo() {
  const trailer = document.querySelector(".trailer");
  // @ts-ignore
  trailer.play();
  toggleControls();
}

function pauseVideo() {
  const trailer = document.querySelector(".trailer");
  // @ts-ignore
  trailer.pause();
  toggleControls();
}

function addReadMore() {
  const readAllBtn = document.querySelector(".read-all-btn");
  if (readAllBtn) {
    readAllBtn.addEventListener("click", readMore);
    readAllBtn.addEventListener("keydown", readMore);
  } else console.warn("No read all button was found");
}

function addPlayVideo() {
  const playVideoBtn = document.querySelector(".play-btn");
  console.log("playVideoBtn", playVideoBtn);
  if (playVideo) {
    playVideoBtn.addEventListener("click", playVideo);
    playVideoBtn.addEventListener("keydown", playVideo);
  }
}
function addPauseVideo() {
  const pauseVideoBtn = document.querySelector(".pause-btn");
  if (pauseVideo) {
    pauseVideoBtn.addEventListener("click", pauseVideo);
    pauseVideoBtn.addEventListener("keydown", pauseVideo);
  }
}

window.addEventListener("load", function () {
  addReadMore();
  addPlayVideo();
  addPauseVideo();
});
