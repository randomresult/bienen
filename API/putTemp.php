<?php
require_once "../Classes/writeData.php";

if (isset($_POST["temp"])) {
    $temp = $_POST["temp"];
} else {
    $temp = "keine Angabe";
}
echo $temp;

if (isset($_POST["humidity"])) {
    $humidity = $_POST["humidity"];
} else {
    $humidity = "keine Angabe";
}
echo $humidity;

$writeout = new writeData("1");
$writeout->writeLogTempJson($temp, $humidity);



