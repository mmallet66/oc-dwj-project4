
// Menu nav animation
const navElt = document.getElementById("nav");
const navCheckElt = document.getElementById("nav-check");

navCheckElt.addEventListener("click", (e) => {
  if (e.target.checked) {
    navElt.style.transform = "translateX(0)";
  }
  else {
    navElt.style.transform = "translateX(-100%)";
  }
  e.stopPropagation();
})

document.body.addEventListener("click", () => {
  if (navCheckElt.checked) {
    navCheckElt.checked = false;
    navElt.style.transform = "translateX(-100%)";
  }
})
// End