<?php
$title = "Manuelle Erfassung";
include_once "Partials/Header.php";
require_once "Classes/writeData.php";

//Check if a unit is given from QR-CodeScan

    $unit = $_POST["unit"];


if (isset($_POST["brood"])) {
    $brood = $_POST["brood"];
} else {
    $brood = "keine Angabe";
}

if (isset($_POST["food"])) {
    $food = $_POST["food"];
} else {
    $food = "keine Angabe";
}

if (isset($_POST["emptycombs"])) {
    $emptycombs = $_POST["emptycombs"];
} else {
    $emptycombs = "keine Angabe";
}

if (isset($_POST["queen"])) {
    $queen = $_POST["queen"];
} else {
    $queen = "keine Angabe";
}

if (isset($_POST["gentleness"])) {
    $gentleness = $_POST["gentleness"];
} else {
    $gentleness = "keine Angabe";
}

if (isset($_POST["varroa"])) {
    $varroa = $_POST["varroa"];
} else {
    $varroa = "keine Angabe";
}

if (isset($_POST["honeyspace"])) {
    $honeyspace = $_POST["honeyspace"];
} else {
    $honeyspace = "keine Angabe";
}

if (isset($_POST["swarm"])) {
    $swarm = $_POST["swarm"];
} else {
    $swarm = "keine Angabe";
}
if (isset($_POST["treatment"])) {
    $treatment = $_POST["treatment"];
} else {
    $treatment = "keine Angabe";
}

if (isset($_POST["latitude"])) {
    $latitude = $_POST["latitude"];
} else {
    $latitude = "keine Angabe";
}

if (isset($_POST["longitude"])) {
    $longitude = $_POST["longitude"];
} else {
    $longitude = "keine Angabe";
}

?>



<div class="uk-container">

    <?php
        $writeout = new writeData($unit);
        $writeout->writeLogJson($unit, $brood, $food, $emptycombs, $queen, $gentleness, $varroa, $honeyspace, $swarm,$treatment, $latitude, $longitude);
        echo "
        <div class='uk-container'>
    <div class='uk-alert uk-alert-success'>
        Die Daten wurden gespeichert.
    </div>
    <p uk-margin>
            <form action='detailView.php' method='POST'>
                <input  name='unit' type='hidden' value='$unit'>
                <button class='uk-button uk-button-default'>Detailansicht der Beute</button>
            </form>
            <form action='manualLog.php' method='POST'>
                <button class='uk-button uk-button-default'>Weiteren Logeintrag anlegen</button>
            </form>
            <a class='uk-button uk-button-danger' href='./'>Zur Startseite</a>
    </p>
</div>
        ";

    ?>
</div>
<?php
include_once "Partials/Footer.php";
?>
