<?php
$title = "Detailansicht";
include_once "Partials/Header.php";
include_once "env.php";
require_once "Classes/readData.php";
require_once "Classes/writeData.php";



if (isset($_POST["unit"])) {
    $unit = $_POST["unit"];
} else {
    $unit = "";
}

if (isset($_POST["newunit"])) {
    $newunit = $_POST["newunit"];
    $rename = new writeData($unit);
    $rename->renameDirectory($unit, $newunit);
    $unit = $newunit;

}
?>

<div class="container">
    <h1 >Logeinträge für Beute Nr. <?php echo $unit ?></h1>
    <form action="manualLog.php" method="POST">
        <input id="unit" name="unit" type="hidden" value="<?php echo $unit ?>"/>
        <button class="btn btn-primary">Neuer Eintrag</button>
    </form>
    <form action="detailView.php" method="POST">
        <input id="unit" name="unit" type="hidden" value="<?php echo $unit ?>"/>
        <input id="newunit" name="newunit" type="number" value=""/>
        <button class="uk-button uk-button-default">Beute umbenennen</button>
    </form>
    <div class="uk-overflow-auto">
    <table class="table ">
        <thead>
        <tr>
            <th>Date</th>
            <th>BW</th>
            <th>FW</th>
            <th>MW</th>
            <th>KÖ</th>
            <th>SM</th>
            <th>VA</th>
            <th>HR</th>
            <th>SCHWARM</th>
            <th>Behandelt</th>
        </tr>
        </thead>
        <tfoot>
        <tr>
            <td colspan="10">Legende: BW = Brutwabe / FW = Futterwabe / MW = Mittelwand / KÖ = Königin geshen / SM = Sanftmut / VA = Varroa / HR = Anzahl Honigräume / Schwarm = Schwarmstimmung</td>
        </tr>
        </tfoot>
        <tbody>
        <?php
            $content = new readData($unit,$dataDir,'log');
            $content->printDataArray($unit  ,$dataDir, 'log');
        ?>
        </tbody>
    </table>
    </div>
    <h3 class="uk-heading-medium uk-heading-divider uk-text-center">Letztes erfasstes Gewicht: <?php echo $lastWeight ?> kg.</h3>


    <canvas id="myChart"></canvas>
    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'bar',

            // The data for our dataset
            data: {
                labels: [
                    <?php
                    foreach ($data[$unit] AS $itemsdate) {
                    echo "'" ;
                    echo date("d.m", htmlentities($itemsdate['timestamp'])) ;
                    echo "',";
                    }
                    ?>
                ],
                datasets: [{
                    label: 'Gewicht',
                    backgroundColor: 'rgb(255, 99, 132)',
                    borderColor: 'rgb(255, 99, 132)',
                    data: [
                        <?php
                        foreach ($data[$unit] AS $itemsweight) {
                            echo "'" ;
                            echo htmlentities($itemsweight['weight']) ;
                            echo "',";
                        }
                        ?>
                    ]
                }]
            },

            // Configuration options go here
            options: {}
        });
    </script>
    <div id="mapholder">
        <h1 class="uk-heading-medium uk-heading-divider uk-text-center">Last Known GPS</h1>
        <?php
            $gps = new readData($unit,$dataDir,'log');
            echo  $gps->printGPSData($unit  ,$dataDir, 'log');
        ?>
    </div>
</div>
<?php
include_once "Partials/Footer.php";
?>
