// Products Filter function
$(document).ready(function() {
  $(".filter_checkbox").on("click", function() {
    let filter_object = {};

    $(".filter_checkbox").each(function() {
      let filter_value = $(this).val();
      let filter_key = $(this).data("filter");

      filter_object[filter_key] = Array.from(
        document.querySelectorAll(
          "input[data-filter=" + filter_key + "]:checked"
        )
      ).map(function(element) {
        return element.value;
      });
    });

    $.ajax({
      url: '/filter_products',
      data: filter_object,
      dataType: "json",
      beforeSend: function() {
        console.log("Fetching Products...");
      },
      success: function(response) {
        $("#filtered_products").html(response.data)
      },
    });
  });
});



// Add to cart functionality
$("#add_to_cart_btn").on("click", function() {
    let quantity = $("#product_quantity").val();
    let product_id = $(".product_id").val();
    let product_title = $(".product_title").val();
    let product_price = $(".product_price").text()
    let this_val = $(this)

    // console.log("Quantity: ", quantity);
    // console.log("ID: ", product_id);
    // console.log("Title: ", product_title);
    // console.log("Price: ", product_price);
    // console.log("Element: ", this_val);

    $.ajax({
        url : '/add_to_cart',
        data : {
            'id' : product_id,
            'quantity' : quantity,
            'title' : product_title,
            'price' : product_price,
        },
        dataType : 'json',
        beforeSend : function() {
            console.log("Adding Products to Cart...");
        },
        success : function(response) {
            this_val.html("Product Added to Cart!");
            console.log("Added Products to Cart!");
            $(".total_cart_items").text(response.total_cart_items);
            this_val.attr('disabled', false);
        }
    });
});



// Product Details Images Slider
const mainImage = document.querySelector(".main_product_image");
const otherImagesContainer = document.querySelector(".other_product_images");

otherImagesContainer.querySelectorAll("img").forEach((image) => {
  image.addEventListener("click", (event) => {
    mainImage.src = event.target.src;
  });
});
