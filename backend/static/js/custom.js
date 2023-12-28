// Products Filter function
$(document).ready(function () {
    // Filter Products
    $(".filter_checkbox").on("click", function () {
        let filter_object = {};

        $(".filter_checkbox").each(function () {
            let filter_value = $(this).val();
            let filter_key = $(this).data("filter");

            filter_object[filter_key] = Array.from(
                document.querySelectorAll(
                    "input[data-filter=" + filter_key + "]:checked"
                )
            ).map(function (element) {
                return element.value;
            });
        });

        $.ajax({
            url: "/filter_products",
            data: filter_object,
            dataType: "json",
            beforeSend: function () {
                console.log("Fetching Products...");
            },
            success: function (response) {
                $("#filtered_products").html(response.data);
            },
        });
    });

    // Add to cart functionality
    $(".add_to_cart_btn").on("click", function () {
        let this_val = $(this);
        // Get the product ID
        let data_index = this_val.attr("data-index");

        let quantity = $(".product_quantity_" + data_index).val();
        let product_id = $(".product_id_" + data_index).val();
        let product_pid = $(".product_pid_" + data_index).val();
        let product_title = $(".product_title_" + data_index).val();
        let product_image = $(".product_image_" + data_index).val();
        let product_price = $(".product_price_" + data_index).text();

        $.ajax({
            url: "/cart/add/",
            data: {
                "id": product_id,
                "pid": product_pid,
                "quantity": quantity,
                "title": product_title,
                "image": product_image,
                "price": product_price,
            },

            dataType: "json",
            beforeSend: function () {
                console.log("Adding Product to Cart...");
            },

            success: function (response) {
                this_val.html("&#10004;");
                console.log("Added Product to Cart!");
                $(".total_cart_items").text(response.total_cart_items);
            },
        });
    });

    // Use event delegation for dynamically added elements
    $("#async_cart_list").on("click", ".delete_product", function () {
        let product_id = $(this).attr("data-product");

        $.ajax({
            url: "/cart/delete/",
            data: {
                "id": product_id,
            },
            dataType: "json",
            beforeSend: function () {
                console.log("Deleting the item...");
            },
            success: function (response) {
                $("#async_cart_list").html(response.data);
                $(".total_cart_items").text(response.total_cart_items);

                // Reattach event handlers to newly added buttons (ensures functionality after content replacement)
                $("#async_cart_list").on(
                    "click",
                    ".delete_product",
                    function () {
                        // ... your deletion logic (already defined above)
                    }
                );

                console.log("Item Deleted!");
            },
        });
    });
});

// Product Details Images Slider
function ProductImageSlider() {
    const mainImage = document.querySelector(".main_product_image");
    const otherImagesContainer = document.querySelector(
        ".other_product_images"
    );

    otherImagesContainer.querySelectorAll("img").forEach((image) => {
        image.addEventListener("click", (event) => {
            mainImage.src = event.target.src;
        });
    });
}
