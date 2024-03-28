// modeSwitch.addEventListener("click", () => {
//     body.classList.toggle("dark");
//     //   document.querySelector(".mode-text").innertext=""

//     if (body.classList.contains("dark")) {
//         modeText.innerText = " Light Mode ";
//     } else modeText.innerText = " Dark Mode ";
// });

// Main navbar and admin sidenav toggle
$(document).ready(function () {
    $("#burgerIcon, #toggle").click(function () {
        $("#navLinks").toggleClass("show");
        $("#burgerIcon").toggleClass(
            "active_burger",
            $("#navLinks").hasClass("show")
        );
    });

    // Toggle the sidebar
    $(".admin_sidebar .toggle").click(function () {
        $(".admin_sidebar").toggleClass("close");
        // Get the current width of the sidebar dynamically
        const sidebarWidth = $(".admin_sidebar").width();
        // Calculate the desired margin-left value (width of the sidebar + 1%)
        const marginLeftValue = `${sidebarWidth + 0.01 * window.innerWidth}px`;
        // Set the margin-left of .Main based on sidebar state
        $("#main").css(
            "margin-left",
            $(".admin_sidebar").hasClass("close") ? marginLeftValue : "1%"
        );
    });
});

(function () {
    const alertElements = document.getElementsByClassName("alert");

    for (let alertIndex = 0; alertIndex < alertElements.length; alertIndex++) {
        const currentAlert = alertElements[alertIndex];
        const duration = parseInt(currentAlert.dataset.duration);

        setTimeout(function () {
            currentAlert.style.opacity = "0";
            currentAlert.style.display = "none";
        }, duration);
    }
})();

function searchFunction() {
    // Get the input value
    var input = document.getElementById("myInput");
    var filter = input.value.toUpperCase();

    // Get all elements with the class name "item"
    var items = document.getElementsByClassName("searchable");

    // Loop through all items and hide those that don't match the search query
    for (var i = 0; i < items.length; i++) {
        var item = items[i];
        var text = item.textContent || item.innerText;

        if (text.toUpperCase().indexOf(filter) > -1) {
            item.style.display = "";
        } else {
            item.style.display = "none";
        }
    }
}

function showConfirmationDialog(message, onConfirm) {
    Swal.fire({
        title: "Are you sure?",
        text: message,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete!",
    }).then((result) => {
        if (result.isConfirmed) {
            onConfirm();
        }
    });
}

// For forms: deleteItem(itemId, itemName);
// For links: deleteItem(itemId, itemName, url);

function deleteItem(itemId, itemName, url = null) {
    const message = `This ${itemName} will be deleted permanently!`;

    // Show a confirmation dialog
    showConfirmationDialog(message, () => {
        const formId = `deleteForm_${itemId}`;
        const form = document.getElementById(formId);

        if (form) {
            form.submit();
        }
    });
}
