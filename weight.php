<?php
$pgtitle = "Weight";
include_once('includes/header.php');
?>


<body data-theme="default" data-layout="fluid" data-sidebar-position="left" data-sidebar-behavior="sticky">
    <div class="wrapper">
        <?php include_once('includes/nav.php'); ?>
        <div class="main">
            <main class="content">
                <div class="container-fluid p-0">

                    <h1 class="mb-5 text-center display-6">Your Weight journey</h1>
                    <div class="row">
                        <div class="col-12 col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Weight Chart</h5>
                                    <div class="d-flex">
                                        <button class="btn btn-primary me-2">Last 7 days</button>
                                        <button class="btn btn-primary me-2">Last 4 weeks</button>
                                        <button class="btn btn-primary me-2">1 year </button>
                                        <button class="btn btn-primary me-2">Set your own</button>
                                        <button class="btn btn-primary me-2">All</button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="chart w-100">
                                        <div id="apexcharts-area"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="row">
                    <div class="d-flex mt-3 mb-4">
                        <button class="btn btn-primary" onclick="addWeight()">Add Weight</button>
                    </div>
                    <div class="col-md-12" id="add-weight">
                        <div class="card">
                            <div class="card-body">
                                <form method="POST" id="weightForm">
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label" for="inputEmail4">Enter Date</label>
                                            <input class="form-control" id="date" type="text" name="datesingle" />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label" for="inputPassword4">Enter Time</label>
                                            <input type="time" name="time" id="time" class="form-control">
                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <label class="form-label" for="inputAddress">Enter Weight</label>
                                            <div class="input-group mb-3">
                                                <input type="text" name="weight" id="weight" placeholder="Enter Weight"
                                                    class="form-control">
                                                <span class="input-group-text">kg</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="d-flex align-items-center" style="height:100%">
                                                <button type="submit" name="submit" class="btn btn-warning">Add</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-12 col-xl-12 d-flex">
                        <div class="card flex-fill">
                            <table id="datatables-dashboard-traffic" class="table table-striped my-0">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th class="text-end">Time</th>
                                        <th class="d-none d-xl-table-cell text-end">Timestamp</th>
                                        <th class="d-none d-xl-table-cell text-end">Unix</th>
                                        <th class="d-none d-xl-table-cell text-end">Weight (kg)</th>
                                        <th class="d-none d-xl-table-cell text-end">Change</th>
                                        <th class="d-none d-xl-table-cell text-end"></th>

                                    </tr>
                                </thead>
                                <tbody id="tbody">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row text-muted">
                        <div class="col-6 text-start">
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <a class="text-muted" href="#">Support</a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="text-muted" href="#">Help Center</a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="text-muted" href="#">Privacy</a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="text-muted" href="#">Terms of Service</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-6 text-end">
                            <p class="mb-0">
                                &copy; 2021 - <a href="index.html" class="text-muted">AppStack</a>
                            </p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="lib/js/app.js"></script>

    <script>
    let isWeightBox = false;
    let weightData = []
    document.getElementById('add-weight').style.display = "none";

    function addWeight() {

        isWeightBox = !isWeightBox
        console.log(isWeightBox)
        if (isWeightBox == false) {
            document.getElementById('add-weight').style.display = "none";
        } else {
            document.getElementById('add-weight').style.display = "block";
        }

    }

    $("#weightForm").submit(function(event) {

        // Prevent default posting of form - put here to work in case of errors
        event.preventDefault();

        var $form = $(this);


        // Let's select and cache all the fields
        var $inputs = $form.find("input, select, button, textarea");

        var time = document.getElementById('time').value;
        var date = document.getElementById('date').value;
        var weight = document.getElementById('weight').value;

        $inputs.prop("disabled", true);
        if (!time || !date || !weight) {
            alert("Please must fill all fields");
            $inputs.prop("disabled", false);
            return;
        }
        var dateSet = date.split('/')
        dateSet = `${dateSet[2]}-${dateSet[0]}-${dateSet[1]}`
        var datetime = `${dateSet} ${time}`;


        var ts = datetime
        var unix = new Date(datetime).getTime()
        console.log(ts, weight)

        request = $.ajax({
            url: "addWeight.php",
            type: "post",
            data: {
                ts,
                unix,
                weight
            }
        });

        // Callback handler that will be called on success
        request.done(function(response, textStatus, jqXHR) {
            // Log a message to the console
            $inputs.prop("value", "");
            console.log("Hooray, it worked!", response);

            getWeightData();
        });

        // Callback handler that will be called on failure
        request.fail(function(jqXHR, textStatus, errorThrown) {
            // Log the error to the console
            console.error(
                "The following error occurred: " +
                textStatus, errorThrown
            );
        });

        // Callback handler that will be called regardless
        // if the request failed or succeeded
        request.always(function() {
            // Reenable the inputs
            $inputs.prop("disabled", false);
        });

    })
    getWeightData();

    function getWeightData() {
        // Fire off the request to /form.php
        request = $.ajax({
            url: "getWeight.php",
            type: "get",
        });

        // Callback handler that will be called on success
        request.done(function(response, textStatus, jqXHR) {
            // Log a message to the console
            console.log("res", JSON.parse(response));
            const tb = document.getElementById('tbody');
            const data = JSON.parse(response);
            weightData = data;
            chartData()
            data.forEach((d, index) => {
                const date = moment(new Date(d.ts)).format("ddd D MMM YYYY")
                const time = moment(new Date(d.ts)).format("h:mm a")
                if (index === 0) {
                    tb.innerHTML = `
                    <tr>
                                        <td>${date}</td>
                                        <td class="text-end">${time}</td>
                                        <td class="d-none d-xl-table-cell text-end">${d.ts}</td>
                                        <td class="d-none d-xl-table-cell text-end">${d.unix}</td>
                                        <td class="d-none d-xl-table-cell text-end">${d.weight}</td>
                                        <td class="d-none d-xl-table-cell text-end text-success">1.8%</td>
                                        <td class="d-none d-xl-table-cell text-end">
                                            <button class="btn btn-danger" onclick="deleteFun(${d.weightID})">Delete</button>
                                        </td>
                                        </td>
                                    </tr>
                    `
                } else {
                    tb.innerHTML += `
                    <tr>
                                        <td>${date}</td>
                                        <td class="text-end">${time}</td>
                                        <td class="d-none d-xl-table-cell text-end">${d.ts}</td>
                                        <td class="d-none d-xl-table-cell text-end">${d.unix}</td>
                                        <td class="d-none d-xl-table-cell text-end">${d.weight}</td>
                                        <td class="d-none d-xl-table-cell text-end text-success">1.8%</td>
                                        <td class="d-none d-xl-table-cell text-end">
                                            <button class="btn btn-danger" onclick="deleteFun(${d.weightID})">Delete</button>
                                        </td>
                                    </tr>
                    `
                }
            })


        });

        // Callback handler that will be called on failure
        request.fail(function(jqXHR, textStatus, errorThrown) {
            // Log the error to the console
            console.error(
                "The following error occurred: " +
                textStatus, errorThrown
            );
        });


    }


    function deleteFun(id) {
        console.log(id)
        const con = confirm("Do you want to delete?");
        if (con) {
            // Fire off the request to /form.php
            request = $.ajax({
                url: "deleteWeight.php",
                type: "post",
                data: {
                    weightID: id
                }
            });

            // Callback handler that will be called on success
            request.done(function(response, textStatus, jqXHR) {
                // Log a message to the console
                console.log("res", response);

                getWeightData()
            });

            // Callback handler that will be called on failure
            request.fail(function(jqXHR, textStatus, errorThrown) {
                // Log the error to the console
                console.error(
                    "The following error occurred: " +
                    textStatus, errorThrown
                );
            });

        }
    }




    //date

    document.addEventListener("DOMContentLoaded", function() {

        // Daterangepicker

        $("input[name=\"datesingle\"]").daterangepicker({
            singleDatePicker: true,
            showDropdowns: true
        });


        // Datetimepicker
        $('#datetimepicker-minimum').datetimepicker();
        $('#datetimepicker-view-mode').datetimepicker({
            viewMode: 'years'
        });
        $('#datetimepicker-time').datetimepicker({
            format: 'LT'
        });
        $('#datetimepicker-date').datetimepicker({
            format: 'L'
        });
    });
    </script>
    <script>
    //chartData()

    function chartData() {

        let serData = [],
            categories = []
        weightData.forEach(w => {
            serData.push(Number(w.weight))
            categories.push(w.ts)
        })

        // Area chart
        var options = {
            chart: {
                height: 350,
                type: "area",
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: "smooth"
            },
            series: [{
                name: "weight",
                data: serData
            }],
            xaxis: {
                type: "datetime",
                categories: categories,
            },
            tooltip: {
                x: {
                    format: "dd/MM/yy HH:mm"
                },
            }
        }
        var chart = new ApexCharts(
            document.querySelector("#apexcharts-area"),
            options
        );
        console.log(chart)
        chart.render();
    }
    </script>


</body>

</html>