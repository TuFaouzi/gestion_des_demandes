const toggleButton = document.getElementById("AppLayout__main__toggleNavBar");
const navbar = document.getElementById("AppLayout__nav");

toggleButton.addEventListener("click", () => {
    navbar.classList.toggle("AppLayout__nav__reduced");
});