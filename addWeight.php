<?php
session_start();
include_once("classes/DbFunctions.php");

$dbFunctions = new DbFunctions();
$userId = $_SESSION['id'];
if (isset($_POST['ts']) && isset($_POST['weight']) && isset($_POST['unix']) && $userId) {

    $ts = $_POST['ts'];
    $weight = $_POST['weight'];
    $unix = $_POST['unix'];


    $result = $dbFunctions->execute("INSERT INTO weight(userID,ts,unix,weight) VALUES('$userId','$ts','$unix','$weight')");

    if ($result) {
        echo "success";
    } else {
        echo "Query failed";
    }
} else {
    echo "Something is missing";
}