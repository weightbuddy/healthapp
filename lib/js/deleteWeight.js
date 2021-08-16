function deleteFun(id) {
  console.log(id);
  const con = confirm("Do you want to delete?");
  if (con) {
    // Fire off the request to /form.php
    request = $.ajax({
      url: "deleteWeight.php",
      type: "post",
      data: {
        weightID: id,
      },
    });

    // Callback handler that will be called on success
    request.done(function (response, textStatus, jqXHR) {
      // Log a message to the console
      console.log("res", response);

      getWeightData();
    });

    // Callback handler that will be called on failure
    request.fail(function (jqXHR, textStatus, errorThrown) {
      // Log the error to the console
      console.error("The following error occurred: " + textStatus, errorThrown);
    });
  }
}
