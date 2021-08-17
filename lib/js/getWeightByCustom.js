function getWeightByCustom(from_date, to_date) {
  console.log(from_date, to_date);
  request = $.ajax({
    url: "getWeightByCustom.php",
    type: "post",
    data: {
      to_date,
      from_date,
    },
  });

  // Callback handler that will be called on success
  request.done(function (response, textStatus, jqXHR) {
    // Log a message to the console
    console.log(response);
    chartData(JSON.parse(response));
  });

  // Callback handler that will be called on failure
  request.fail(function (jqXHR, textStatus, errorThrown) {
    // Log the error to the console
    console.error("The following error occurred: " + textStatus, errorThrown);
  });
}
