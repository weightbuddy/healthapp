<?php
session_start();
include_once("classes/DbFunctions.php");

$dbFunctions = new DbFunctions();
$id = $_SESSION['id'];
$to_date = $_POST['to_date'];
$from_date = $_POST['from_date'];
$result = $dbFunctions->getData("SELECT * FROM weight WHERE userID=$id and ts >= '$from_date' AND ts <= '$to_date' ");
if ($result) {
    echo json_encode($result);
}