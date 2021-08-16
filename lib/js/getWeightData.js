function getWeightData() {
  // Fire off the request to /form.php
  request = $.ajax({
    url: "getWeight.php",
    type: "get",
  });

  // Callback handler that will be called on success
  request.done(function (response, textStatus, jqXHR) {
    const tb = document.getElementById("tbody");
    const data = JSON.parse(response);
    chartData(data);
    data.sort(function (a, b) {
      return new Date(b.ts) - new Date(a.ts);
    });
    let prevWeight = [];
    data.forEach((d) => {
      prevWeight.push(d.weight);
    });
    data.forEach((d, index) => {
      const date = moment(new Date(d.ts)).format("ddd D MMM YYYY");
      const time = moment(new Date(d.ts)).format("h:mm a");

      if (index === 0) {
        tb.innerHTML = `
                <tr>
                                    <td>${date}</td>
                                    <td class="text-center">${time}</td>
                                    <td class="text-center">${d.weight}</td>
                                    <td class="text-center">${getWeightChanges(
                                      prevWeight,
                                      d,
                                      index,
                                      data
                                    )}</td>
                                    <td>
                                        <button class="btn btn-danger" onclick="deleteFun(${
                                          d.weightID
                                        })">Delete</button>
                                    </td>
                                    </td>
                                </tr>
                `;
      } else {
        tb.innerHTML += `
                    <tr>
                                    <td>${date}</td>
                                    <td class="text-center">${time}</td>
                                    <td class="text-center">${d.weight}</td>
                                    <td class="text-center">${getWeightChanges(
                                      prevWeight,
                                      d,
                                      index,
                                      data
                                    )}</td>
                                    <td>
                                        <button class="btn btn-danger" onclick="deleteFun(${
                                          d.weightID
                                        })">Delete</button>
                                    </td>
                                    </td>
                                </tr>
                `;
      }
    });
  });

  // Callback handler that will be called on failure
  request.fail(function (jqXHR, textStatus, errorThrown) {
    // Log the error to the console
    console.error("The following error occurred: " + textStatus, errorThrown);
  });
}

function getWeightChanges(prevWeight, d, index, data) {
  if (index + 1 == data.length) {
    return "";
  }

  if (calculateChanges(prevWeight[index + 1], d.weight) < 0) {
    return ` 
    
    <div class="text-success"> ${Math.abs(
      calculateChanges(prevWeight[index + 1], d.weight)
    )}<i class="align-middle ms-1 fas fa-fw fa-long-arrow-alt-down"></i></div>`;
  } else {
    return `
    
     <div class="text-danger">${Math.abs(
       calculateChanges(prevWeight[index + 1], d.weight)
     )}<i class="align-middle ms-1 fas fa-fw fa-long-arrow-alt-up"></i></div>`;
  }
}

function calculateChanges(oldWeight, newWeight) {
  return (newWeight - oldWeight).toFixed(1);
}
