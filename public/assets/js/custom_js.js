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
    const marginLeftValue = `calc(${sidebarWidth}px + 1%)`;

    // Set the margin-left of .Main to the width of the sidebar
    main.style.marginLeft = marginLeftValue;
});


// toggle.addEventListener("click", () => {
//     sidebar.classList.toggle("close");

//     // Get the current width of the sidebar dynamically
//     const sidebarWidth = sidebar.offsetWidth;

//     // Calculate the desired margin-left value (width of the sidebar + 1%)
//     const marginLeftValue = `calc(${sidebarWidth}px + 1%)`;

//     // Set the margin-left of .Main based on the sidebar state
//     main.style.marginLeft = sidebar.classList.contains("close")
//         ? marginLeftValue
//         : marginLeftValue;
// });
