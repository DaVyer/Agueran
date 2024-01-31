const hamburger = document.querySelector(".hamburger");
const year = document.querySelector("#current-year");
const navMenu = document.querySelectorAll(".links");

var isOpen = false;

// trigger the slide in
hamburger.addEventListener("click", () => {
    if (!isOpen) {
        document.body.classList.add('noscroll')
    } else {
        document.body.classList.remove('noscroll')
    }
    isOpen = !isOpen;
    hamburger.classList.toggle("active");
    navMenu.forEach((item) => {
        item.classList.toggle("active");
    });
});

// checks to see if a link has been clicked to hide the nav
document.querySelectorAll(".links > *").forEach((n) =>
    n.addEventListener("click", () => {
        document.body.classList.remove('noscroll')
        isOpen = false;
        hamburger.classList.remove("active");
        navMenu.forEach((item) => {
            item.classList.remove("active");
        });
    })
);

// runs all of the modules once the page has loaded
window.addEventListener("load", () => {
    year.innerText = new Date().getFullYear();
});
