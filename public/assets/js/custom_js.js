const body = document.querySelector("body"),
    main = document.querySelector(".Main"),
    sidebar = document.querySelector(".admin_sidebar"),
    toggle = document.querySelector(".toggle"),
    modeSwitch = document.querySelector(".toggle-switch");

// modeSwitch.addEventListener("click", () => {
//     body.classList.toggle("dark");
//     //   document.querySelector(".mode-text").innertext=""

//     if (body.classList.contains("dark")) {
//         modeText.innerText = " Light Mode ";
//     } else modeText.innerText = " Dark Mode ";
// });

toggle.addEventListener("click", () => {
    sidebar.classList.toggle("close");

    // Get the current width of the sidebar dynamically
    const sidebarWidth = sidebar.offsetWidth;

    // Calculate the desired margin-left value (width of the sidebar + 1%)
    const marginLeftValue = `1%`;

    if (sidebar.classList.contains("close")) {
        // Set the margin-left of .Main to the width of the sidebar
        main.style.marginLeft = marginLeftValue;
    }
    main.style.marginLeft = marginLeftValue;
});
