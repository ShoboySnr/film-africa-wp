function closeCalendar() {
  const calendar = document.querySelector("#v-cal");
  const calOverlay = document.querySelector(".cal-overlay");
  const calenderLabel = document.querySelector(".calendar");
  calendar.classList.add("hidden");
  calOverlay.classList.add("hidden");
  calenderLabel.classList.remove("text-black");
}

function openCalendar() {
  const calendar = document.querySelector("#v-cal");
  const calOverlay = document.querySelector(".cal-overlay");
  const calenderLabel = document.querySelector(".calendar");
  calendar.classList.remove("hidden");
  calOverlay.classList.remove("hidden");
  calenderLabel.classList.add("text-black");
}

function toggleCalendar() {
  const calendar = document.querySelector("#v-cal");

  if (calendar.classList.contains("hidden")) {
    openCalendar();
  } else {
    closeCalendar();
  }
}

window.addEventListener("load", () => {
  document.querySelector(".calendar").addEventListener("click", toggleCalendar);
  document.querySelector(".cal-overlay").addEventListener("click", () => {
    closeCalendar();
  });
});
