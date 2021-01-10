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
    <h1>Logeinträge für Beute Nr. <?php echo $unit ?></h1>
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
                <td colspan="10">Legende: BW = Brutwabe / FW = Futterwabe / MW = Mittelwand / KÖ = Königin geshen / SM =
                    Sanftmut / VA = Varroa / HR = Anzahl Honigräume / Schwarm = Schwarmstimmung
                </td>
            </tr>
            </tfoot>
            <tbody>
            <?php
            $content = new readData($unit, $dataDir, 'log');
            $content->printDataArray($unit, $dataDir, 'log');
            ?>
            </tbody>
        </table>
    </div>
    <h3 class="uk-heading-medium uk-heading-divider uk-text-center">Letztes erfasstes Gewicht:
        kg.</h3>

    <canvas id="myChart" width="400" height="100"></canvas>
    <script>
        var ctx = document.getElementById('myChart');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['01.01', '02.01', '03.01', '04.01', '05.01', '06.01', '07.01', '08.01', '09.01', '10.01', '11.01', '12.01', '13.01', '14.01', '15.01'],
                datasets: [{
                    label: 'Gewicht',
                    data: [14.5, 15.0, 16.3, 16.4, 2, 3, 3, 5, 6, 7, 8, 6, 3, 5, 7],
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>
</div>
<?php
include_once "Partials/Footer.php";
?>
