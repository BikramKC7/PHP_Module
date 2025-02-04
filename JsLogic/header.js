function toggleDropdown() {
    let menu = document.getElementById("dropdownMenu");
    menu.style.display = menu.style.display === "block" ? "none" : "block";
}

// Close dropdown when clicking outside
document.addEventListener("click", function (event) {
    let profileContainer = document.querySelector(".profile-container");
    let dropdownMenu = document.getElementById("dropdownMenu");

    if (!profileContainer.contains(event.target)) {
        dropdownMenu.style.display = "none";
    }
});
