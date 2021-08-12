<?php
session_start();
include_once("classes/DbFunctions.php");

$dbFunctions = new DbFunctions();
$id = $_SESSION['id'];
$result = $dbFunctions->getData("select * from weight where userID=$id ORDER BY ts DESC");
if ($result) {
    echo json_encode($result);
}