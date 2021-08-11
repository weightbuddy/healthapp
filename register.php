<?php
session_start();
$pgtitle = "Register";
require_once('./includes/header.php');
include_once("classes/DbFunctions.php");
include_once("classes/Validation.php");

$dbFunctions = new DbFunctions();
$validation = new Validation();
$error = "";
if (isset($_SESSION['id'])) {
    header('location: index.php');
}
if (isset($_POST['submit'])) {

    $email = $dbFunctions->escape_string($_POST['validation-email']);
    $password = $_POST['validation-password'];

    $result = $dbFunctions->getData("select * from users where email='$email' ");
    if ($result) {
        $error = "Email is already registered";
    } else {
        $hash_password = password_hash($password, PASSWORD_DEFAULT);
        $result = $dbFunctions->execute("INSERT INTO users(email,password,dtejoin, lastlog) VALUES('$email','$hash_password','Y-m-d H:i:s, e','Y-m-d H:i:s, e')");
        if ($result) {
            header('location: index.php');
        }
    }
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
                                <h1 class="h2">Get started</h1>
                                <p class="lead">
                                    Start creating the best possible user experience for you customers.
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
                                                    name="validation-password" placeholder="Enter password" />
                                            </div>
                                            <div class="mb-3 error-placeholder">
                                                <label class="form-label">Password</label>
                                                <input class="form-control form-control-lg" type="password"
                                                    name="validation-password-confirmation"
                                                    placeholder="Confirm password" />
                                            </div>
                                            <div class="mb-3 error-placeholder">
                                                <label class="form-check d-block">
                                                    <input type="checkbox" class="form-check-input"
                                                        name="validation-checkbox">
                                                    <span class="form-check-label">I agree to Weight Buddy's <a
                                                            href="/terms-conditions">Terms & Conditions</a> and <a
                                                            href="/privacy-policy">Privacy Policy</a></span>
                                                </label>
                                            </div>
                                            <div>
                                                <h6 class="text-danger mt-3">
                                                    <?= $error; ?>
                                                </h6>
                                            </div>
                                            <div class="text-center mt-3">
                                                <button type="submit" name="submit" class="btn btn-lg btn-primary">Sign
                                                    up</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="my-3 text-center d-flex justify-content-center align-items-center"
                                        style="height: 10px">
                                        Already have account
                                        <a href="login.php">
                                            <h6 class="text-primary ms-2 m-auto">Login</h6>
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script src="lib/js/app.js"></script>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        // Trigger validation on tagsinput change
        $("input[name=\"validation-bs-tagsinput\"]").on("itemAdded itemRemoved", function() {
            $(this).valid();
        });
        // Initialize validation
        $("#validation-form").validate({
            ignore: ".ignore, .select2-input",
            focusInvalid: false,
            rules: {
                "validation-email": {
                    required: true,
                    email: true
                },
                "validation-password": {
                    required: true,
                    minlength: 6,
                    maxlength: 20,
                },
                "validation-password-confirmation": {
                    required: true,
                    minlength: 6,
                    equalTo: "input[name=\"validation-password\"]"
                },
                "validation-checkbox": {
                    required: true
                },
            },

            // Errors
            errorPlacement: function errorPlacement(error, element) {
                var $parent = $(element).parents(".error-placeholder");
                // Do not duplicate errors
                if ($parent.find(".jquery-validation-error").length) {
                    return;
                }
                $parent.append(
                    error.addClass("jquery-validation-error small form-text invalid-feedback")
                );
            },
            highlight: function(element) {
                var $el = $(element);
                var $parent = $el.parents(".error-placeholder");
                $el.addClass("is-invalid");
                // Select2 and Tagsinput
                if ($el.hasClass("select2-hidden-accessible") || $el.attr("data-role") ===
                    "tagsinput") {
                    $el.parent().addClass("is-invalid");
                }
            },
            unhighlight: function(element) {
                $(element).parents(".error-placeholder").find(".is-invalid").removeClass(
                    "is-invalid");
            }
        });
    });
    </script>
</body>

</html>