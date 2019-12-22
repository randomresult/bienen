<?php

class readData
{

    public function __construct()
    {
    }

    private function readFileFromDirectory($unit, $dataDir, $type)
    {

        $data = [];
        $files = glob($dataDir . "/" . $unit . "/" . $type . "/*.json");
        foreach ($files as $file) {
            $data[] = json_decode(file_get_contents($file), 1);
        }


        return $data;

    }

    private function readFoldersFromDirectory($dataDir)
    {
        if (is_dir($dataDir)) {
            return glob($dataDir . '*', GLOB_ONLYDIR);
        }
        return [];
    }

    private function filterUnitNames(array $folders)
    {
        return array_filter($folders, 'is_numeric');
    }

    private function readTempJson($dataDir)
    {
        $datajson = [];
        if (is_dir($dataDir)) {
            if ($handle = opendir($dataDir)) {
                while (($file = readdir($handle)) !== false) {
                    if (!is_dir($file) AND !is_file($file) AND ($file != ".gitkeep")) {
                        array_push($datajson, $file);
                    }
                }
                closedir($handle);
            }
        }
        return $datajson;
    }

    private function displayDataFromDirectory($data)
    {
        foreach ($data as $item) {
            echo "<tr>";
            echo "<td>" . date("d.m.Y - H:i", htmlentities($item['timestamp'])) . "</td>";
            echo "<td>" . htmlentities($item['brood']) . " stk.</td>";
            echo "<td>" . htmlentities($item['food']) . " stk.</td>";
            echo "<td>" . htmlentities($item['emptycombs']) . " stk.</td>";
            echo "<td>" . htmlentities($item['queen']) . "</td>";
            echo "<td>" . htmlentities($item['gentleness']) . "</td>";
            echo "<td>" . htmlentities($item['varroa']) . "</td>";
            echo "<td>" . htmlentities($item['honeyspace']) . " stk.</td>";
            echo "<td>" . htmlentities($item['swarm']) . "</td>";
            echo "<td>" . htmlentities($item['treatment']) . "</td>";
            echo "</tr>";
        }
    }

    private function lastKnownPosition(array $data)
    {
        return array_reduce(
            $data,
            function ($lastKnown, array $item) {
                if ($item['longitude'] !== 'keine Angabe') {
                    return [
                        'long' => $item['longitude'],
                        'lat' => $item['latitude']
                    ];
                }
                return $lastKnown;
            },
            ['long' => '--', 'lat' => '--']
        );
    }

    public function printDataArray($unit, $dataDir, $type)
    {
        $data = $this->readFileFromDirectory($unit, $dataDir, $type);
        $this->displayDataFromDirectory($data);
        return;

    }
    public function printGPSData($unit, $dataDir, $type)
    {
        $data = $this->readFileFromDirectory($unit, $dataDir, $type);
        $pos = ($this->lastKnownPosition($data));
        $long = $pos[long];
        $lat = $pos[lat];
        echo "<img src='https://maps.googleapis.com/maps/api/staticmap?center=". $lat .",". $long ."&markers=" . $lat .",". $long ."&zoom=14&size=600x400&key=AIzaSyCQfzSfgdu7hSjQ5T7Cb2gqHhomoo2gDfE'/>" ;

    }
    public function printFolders($dataDir)
    {
        $dirs = $this->readFoldersFromDirectory($dataDir);
        $maybeUnits = array_map('basename', $dirs);
        foreach ($this->filterUnitNames($maybeUnits) as $unit) {
            echo "<form action='detailView.php' method='POST'>";
            echo "<input id='unit' name='unit' type='hidden' value='" . $unit . "'/>";
            echo "<button class='btn btn-primary'>Beute Nr. " . $unit . " </button>";
            echo "</form>";
        }
    }

    public function printFoldersToJson($dataDir)
    {
        $data[] = $this->readFoldersFromDirectoryJson($dataDir);
        $content = json_encode($data);
        return $content;
    }


}
