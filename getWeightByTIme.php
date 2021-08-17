<?php
session_start();
include_once("classes/DbFunctions.php");

$dbFunctions = new DbFunctions();
$id = $_SESSION['id'];
$week = $_POST['week'];
$year = $_POST['year'];

if ($year) {
    $result = $dbFunctions->getData("select * from weight where userID=$id and ts between date_sub(now(),INTERVAL $year year ) and now()");
} else {
    $result = $dbFunctions->getData("select * from weight where userID=$id and ts between date_sub(now(),INTERVAL $week WEEK ) and now()");
}

if ($result) {
    echo json_encode($result);
}