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
                                    <div class="row">
                                        <div class="col-md-3 col-sm-6 col-xl-2">
                                            <button class="btn btn-primary me-2" style="width:100%"
                                                onclick="getWeightByTime(1,null)">Last
                                                7
                                                days</button>
                                        </div>
                                        <div class="col-md-3 col-xl-2 col-sm-6 mt-sm-0 mt-md-0 mt-2">
                                            <button class="btn btn-primary me-2" style="width:100%"
                                                onclick="getWeightByTime(4,null)">Last
                                                4
                                                weeks</button>
                                        </div>
                                        <div class="col-md-2 col-sm-6 mt-sm-2 mt-md-0 mt-2">
                                            <button class="btn btn-primary me-2" style="width:100%"
                                                onclick="getWeightByTime(null,1)">1
                                                year
                                            </button>
                                        </div>
                                        <div class="col-md-3 col-sm-6 col-xl-2 mt-sm-2 mt-md-0 mt-2">
                                            <button class="btn btn-primary me-2" style="width:100%">Set your
                                                own</button>
                                        </div>
                                        <div class="col-md-2 col-sm-6 mt-sm-2 mt-xl-0 mt-2">
                                            <button class="btn btn-primary me-2" style="width:100%"
                                                onclick="getWeightData()">All</button>
                                        </div>


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

                    <div class="col-12">
                        <div class="card flex-fill">
                            <div class="table-responsive">
                                <table id="datatables-dashboard-traffic" class="table table-striped my-0">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th class="text-center">Time</th>
                                            <th class="text-center">Weight (kg)</th>
                                            <th class="text-center">Change (kg)</th>
                                            <th class="text-center"></th>

                                        </tr>
                                    </thead>
                                    <tbody id="tbody">
                                    </tbody>
                                </table>
                            </div>
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
    <script src="lib/js/getWeightByTime.js"></script>
    <script src="lib/js/deleteWeight.js"></script>
    <script src="lib/js/getWeightData.js"></script>
    <script src="lib/js/timePicker.js"></script>
    <script src="lib/js/charts.js"></script>
    <script src="lib/js/addWeight.js"></script>

    <script>
    getWeightData();
    </script>

</body>

</html>