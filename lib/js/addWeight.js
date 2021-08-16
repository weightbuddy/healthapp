let isWeightBox = false;
document.getElementById("add-weight").style.display = "none";

function addWeight() {
  isWeightBox = !isWeightBox;
  if (isWeightBox == false) {
    document.getElementById("add-weight").style.display = "none";
  } else {
    document.getElementById("add-weight").style.display = "block";
  }
}

$("#weightForm").submit(function (event) {
  // Prevent default posting of form - put here to work in case of errors
  event.preventDefault();

  var $form = $(this);
  // Let's select and cache all the fields
  var $inputs = $form.find("input, select, button, textarea");

  var time = document.getElementById("time").value;
  var date = document.getElementById("date").value;
  var weight = document.getElementById("weight").value;

  $inputs.prop("disabled", true);
  if (!time || !date || !weight) {
    alert("Please must fill all fields");
    $inputs.prop("disabled", false);
    return;
  }
  var dateSet = date.split("/");
  dateSet = `${dateSet[2]}-${dateSet[0]}-${dateSet[1]}`;
  var datetime = `${dateSet} ${time}`;

  var ts = datetime;
  var unix = new Date(datetime).getTime();
  console.log(ts, weight);

  request = $.ajax({
    url: "addWeight.php",
    type: "post",
    data: {
      ts,
      unix,
      weight,
    },
  });

  // Callback handler that will be called on success
  request.done(function (response, textStatus, jqXHR) {
    // Log a message to the console
    $inputs.prop("value", "");
    getWeightData();
  });

  // Callback handler that will be called on failure
  request.fail(function (jqXHR, textStatus, errorThrown) {
    // Log the error to the console
    console.error("The following error occurred: " + textStatus, errorThrown);
  });

  // Callback handler that will be called regardless
  // if the request failed or succeeded
  request.always(function () {
    // Reenable the inputs
    $inputs.prop("disabled", false);
  });
});
