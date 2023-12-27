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



// Product Details Images Slider
const mainImage = document.querySelector(".main_product_image");
const otherImagesContainer = document.querySelector(".other_product_images");

otherImagesContainer.querySelectorAll("img").forEach((image) => {
  image.addEventListener("click", (event) => {
    mainImage.src = event.target.src;
  });
});
