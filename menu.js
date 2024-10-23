document.addEventListener("DOMContentLoaded", () => {
  const menu = document.querySelector(".menu");
  const navitems = document.getElementById("nav-items");

  menu.addEventListener("click", () => {
    navitems.classList.toggle("hidden");
  });
});
