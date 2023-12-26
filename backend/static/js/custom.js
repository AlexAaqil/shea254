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
