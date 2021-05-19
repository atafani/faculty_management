const leksion_btn = document.getElementById("leksion_btn");
const seminar_btn = document.getElementById("seminar_btn");
const lab_btn = document.getElementById("lab_btn");
const all_btn = document.getElementById("all_btn");

leksion_btn.onclick = function () {
  reset();
  const leksionSalla = document.getElementsByClassName("lecture");
  leksion_btn.classList.add("active_btn");
  for (let i = 0; i < leksionSalla.length; i++) {
    leksionSalla[i].style.removeProperty("display");
  }
};

seminar_btn.onclick = function () {
  reset();
  const seminarSalla = document.getElementsByClassName("seminar");

  for (let i = 0; i < seminarSalla.length; i++) {
    seminarSalla[i].style.removeProperty("display");
  }
};

lab_btn.onclick = function () {
  reset();
  const labSalla = document.getElementsByClassName("laboratory");

  for (let i = 0; i < labSalla.length; i++) {
    labSalla[i].style.removeProperty("display");
  }
};
all_btn.onclick = function () {
  reset();
  const salla = document.getElementsByClassName("salla");

  for (let i = 0; i < salla.length; i++) {
    salla[i].style.removeProperty("display");
  }
};

function reset() {
  const salla = document.getElementsByClassName("salla");

  for (let i = 0; i < salla.length; i++) {
    salla[i].style.display = "none";
  }
}
