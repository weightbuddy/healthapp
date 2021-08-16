function getWeightByTime(week, year) {
  request = $.ajax({
    url: "getWeightByTime.php",
    type: "post",
    data: {
      week,
      year,
    },
  });

  // Callback handler that will be called on success
  request.done(function (response, textStatus, jqXHR) {
    // Log a message to the console

    chartData(JSON.parse(response));
  });

  // Callback handler that will be called on failure
  request.fail(function (jqXHR, textStatus, errorThrown) {
    // Log the error to the console
    console.error("The following error occurred: " + textStatus, errorThrown);
  });
}
