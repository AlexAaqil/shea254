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

    // Choose the appropriate confirmation action based on the presence of a URL
    const confirmAction = url
        ? () => (window.location.href = url)
        : () => {
              const formId = `deleteForm_${itemId}`;
              document.getElementById(formId).submit();
          };

    showConfirmationDialog(message, confirmAction);
}



// Product Details Images Slider
function ProductImageSlider() {
    const mainImage = document.querySelector(".main_product_image");
    const otherImagesContainer = document.querySelector(
        ".other_images"
    );

    otherImagesContainer.querySelectorAll("img").forEach((image) => {
        image.addEventListener("click", (event) => {
            mainImage.src = event.target.src;
        });
    });
}
