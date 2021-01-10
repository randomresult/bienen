<?php
require_once "../Classes/writeData.php";

if (isset($_POST["unit"])) {
    $unit = $_POST["unit"];
} else {
    $unit = "keine Angabe";
}
if (isset($_POST["temp"])) {
    $temp = $_POST["temp"];
} else {
    $temp = "keine Angabe";
}
if (isset($_POST["humidity"])) {
    $humidity = $_POST["humidity"];
} else {
    $humidity = "keine Angabe";
}
if (isset($_POST["weight"])) {
    $weight = $_POST["weight"];
} else {
    $weight = "keine Angabe";
}


if (isset($_POST["unit"])) {
    $writeout = new writeData("$unit");
    $writeout->writeAutoLogItem($unit, $temp,$humidity, $weight);
} else {
    $unit = "Keine Unit angegeben - nichts geschrieben";
}





