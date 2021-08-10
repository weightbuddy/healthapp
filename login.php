<?php 
require_once('./includes/header.php'); 
include_once("classes/DbFunctions.php");
include_once("classes/Validation.php");

$dbFunctions = new DbFunctions();
$validation = new Validation();

if(isset($_POST['submit'])){
    $email = $dbFunctions->escape_string($_POST['validation-email']);
    $password = $dbFunctions->$_POST['validation-password'];

    $result = $dbFunctions->getData("select * from users where email='$email' and password='$password' ");
}



?>



<body data-theme="default" data-layout="fluid" data-sidebar-position="left" data-sidebar-behavior="sticky">
    <div class="main d-flex justify-content-center w-100">
        <main class="content d-flex p-0">
            <div class="container d-flex flex-column">
                <div class="row h-100">
                    <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
                        <div class="d-table-cell align-middle">

                            <div class="text-center mt-4">
                                <h1 class="h2">Welcome back</h1>
                                <p class="lead">
                                    Sign in to your account to continue
                                </p>
                            </div>

                            <div class="card">
                                <div class="card-body">
                                    <div class="m-sm-4">
                                        <form id="validation-form" method="post">
                                            <div class="mb-3 error-placeholder">
                                                <label class="form-label">Email</label>
                                                <input class="form-control form-control-lg" type="email"
                                                    name="validation-email" placeholder="Enter your email" />
                                            </div>
                                            <div class="mb-3 error-placeholder">
                                                <label class="form-label">Password</label>
                                                <input class="form-control form-control-lg" type="password"
                                                    name="validation-password" placeholder="Enter your password" />
                                            </div>
                                            <small>
                                                <a href="pages-reset-password.html">Forgot password?</a>
                                            </small>
                                            <!-- <div> -->
                                    </div>
                                    <div class="text-center mt-3">
                                        <button type="submit" class="btn btn-lg btn-primary">Sign in</a>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
    </div>
    </main>
    </div>

    <?php 
    require_once('includes/commonjs.php');
    require_once('includes/validation.php'); 
    ?>
</body>

</html>