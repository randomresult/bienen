<?php
$title = "Manuelle Erfassung";
include_once "Partials/Header.php";

//Check if a unit is given from QR-CodeScan
if (isset($_POST["unit"])) {
    $unit = $_POST["unit"];
} else {
    $unit = "";
}
?>

<script>
    var options = {
        enableHighAccuracy: true,
        timeout: 5000,
        maximumAge: 0
    };

    function success(pos) {
        var crd = pos.coords;
        document.getElementById("latitudeForm").value = crd.latitude;
        document.getElementById("longitudeForm").value = crd.longitude;
    }

    function error(err) {
        console.warn(`ERROR(${err.code}): ${err.message}`);
    }

    navigator.geolocation.getCurrentPosition(success, error, options);

</script>

<div class="container">
    <form class="uk-form-horizontal uk-margin-large" action="writeManualLog.php" method="POST">
        <div class="uk-margin">
            <label class="uk-form-label" for="unit">Nummer der Beute</label>
            <?php if($unit) { ?>
                <input class="form-control" id="unit" type="number" name="unit" placeholder="unit"
                       value="<?php echo $unit ?>">

            <?php }else{ ?>

            <div class="uk-form-controls">
                <input class="form-control" id="unit" type="number" name="unit" placeholder="unit"
                       value="">
            </div>
            <?php } ?>
        </div>
        <div class="form-group">
            <label for="brood">Anzahl Brutwaben:</label>
                <select class="form-control" name="brood">
                    <option value="keine"> Keine Angabe</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                    <option value="14">14</option>
                    <option value="15">15</option>
                    <option value="16">16</option>
                    <option value="17">17</option>
                    <option value="18">18</option>
                    <option value="19">19</option>
                    <option value="20">20</option>
                </select>
        </div>
        <div class="form-group">
            <label for="food">Anzahl Futterwaben:</label>

                <select class="form-control" name="food">
                    <option value="keine"> Keine Angabe</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                    <option value="14">14</option>
                    <option value="15">15</option>
                    <option value="16">16</option>
                    <option value="17">17</option>
                    <option value="18">18</option>
                    <option value="19">19</option>
                    <option value="20">20</option>
                </select>

        </div>
        <div class="form-group">
            <label for="weight">Anzahl Mittelwände:</label>

                <select class="form-control" name="emptycombs">
                    <option value="keine"> Keine Angabe</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                    <option value="14">14</option>
                    <option value="15">15</option>
                    <option value="16">16</option>
                    <option value="17">17</option>
                    <option value="18">18</option>
                    <option value="19">19</option>
                    <option value="20">20</option>
                </select>

        </div>
        <div class="form-group">
            <label  for="queen">Königin gesehen:</label>

                <select class="form-control" name="queen">
                    <option value="keine"> Keine Angabe</option>
                    <option value="nein"> Nein</option>
                    <option value="ja">Ja</option>
                </select>

        </div>
        <div class="form-group">
            <label for="gentleness">Sanftmut  (1 = sanft / 10 = aggresiv):</label>

                <select class="form-control" name="gentleness">
                    <option value="keine"> Keine Angabe</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                </select>

        </div>
        <div class="form-group">
            <label for="carroa">Varroa (1 = keine / 10 = sehr viel):</label>
                <select class="form-control" name="varroa">
                    <option value="keine"> Keine Angabe</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                </select>
        </div>
        <div class="form-group">
            <label for="honeyspace">Anzahl Honigräume:</label>
                <select class="form-control" name="honeyspace">
                    <option value="keine"> Keine Angabe</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                </select>
        </div>
        <div class="form-group">
            <label for="swarm">Schwarmzellen:</label>

                <select class="form-control" name="swarm">
                    <option value="keine"> Keine Angabe</option>
                    <option value="nein"> Nein</option>
                    <option value="ja">ja</option>
                </select>

        </div>
        <div class="form-group">
            <label  for="treatment">Behandelt:</label>
                <select class="form-control" name="treatment">
                    <option value="keine"> Keine Angabe</option>
                    <option value="nein"> Nein</option>
                    <option value="ja">ja</option>
                </select>
        </div>
        <div>
            <input class="uk-input uk-form-width-small" id="latitudeForm" name="latitude" type="hidden" value="">
            <input class="uk-input uk-form-width-small" id="longitudeForm" name="longitude" type="hidden" value="">
            <button class="btn btn-primary">Eintrag schreiben</button>
        </div>
    </form>


</div>
<?php
include_once "Partials/Footer.php";
?>
