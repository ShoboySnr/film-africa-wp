window.addEventListener("load", () => {
  const modalCloseButtons = document.querySelectorAll(".modal-close-btn");
  modalCloseButtons.forEach((btn) =>
    btn.addEventListener("click", function (e) {
      document.querySelector(`#${e.target.name}`).removeAttribute("open");
    })
  );
});
