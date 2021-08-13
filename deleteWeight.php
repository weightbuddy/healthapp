<?php

include_once("classes/DbFunctions.php");

$dbFunctions = new DbFunctions();
$id = $dbFunctions->escape_string($_POST['weightID']);
$result = $dbFunctions->delete($id, 'weight');
if ($result) {
    echo "success";
} else {
    echo "failed";
}