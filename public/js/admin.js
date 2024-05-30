const sidebarToggle = document.getElementById("sidebar-toggle");
const sidebarToggleIcon = sidebarToggle.querySelector("i");
const sidebar = document.getElementById("sidebar");
const __main = document.getElementById("__main");
document.addEventListener("DOMContentLoaded", () => {
    // console.log(isHide);
    innerWidth <= 576 ? localStorage.setItem("isHide", 1) : null;
    if (localStorage.getItem("isHide") == 1) {
        hide__sidebar();
    } else {
        show__sidebar();
    }
});

function hide__sidebar() {
    sidebarToggleIcon.classList.add("fa-rotate-180");
    sidebar.style.marginLeft = 0 - sidebar.offsetWidth + "px";
    if (innerWidth <= 576) {
        __main.style.marginRight = 0;
    }
    localStorage.setItem("isHide", 1);
}

function show__sidebar() {
    sidebarToggleIcon.classList.remove("fa-rotate-180");
    sidebar.style.marginLeft = 0;
    if (innerWidth <= 576) {
        __main.style.marginRight = 0 - sidebar.offsetWidth + "px";
    }
    localStorage.setItem("isHide", 0);
}

sidebarToggle.addEventListener("click", (e) => {
    console.log(localStorage.getItem("isHide"));
    if (localStorage.getItem("isHide") == 1) {
        show__sidebar();
    } else {
        hide__sidebar();
    }
});
