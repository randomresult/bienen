<?php

class writeData
{
    public function __construct($unit)
    {
    }

    private function checkAndCreateDirectory($unit)
    {
        $path = "Data/" . $unit;
        if (!file_exists($path)) {
            mkdir($path, 0755, true);
            mkdir($path . "/weight", 0755, true);
            mkdir($path . "/log", 0755, true);
            mkdir($path . "/temp", 0755, true);
        }
    }

    private function buildLogItem($unit, $brood, $food, $emptycombs, $queen, $gentleness, $varroa, $honeyspace, $swarm, $treatment, $latitude, $longitude)
    {
        return [
            "timestamp" => time(),
            "brood" => $brood,
            "food" => $food,
            "emptycombs" => $emptycombs,
            "queen" => $queen,
            "gentleness" => $gentleness,
            "varroa" => $varroa,
            "honeyspace" => $honeyspace,
            "swarm" => $swarm,
            "treatment" => $treatment,
            "latitude" => $latitude,
            "longitude" => $longitude
        ];

    }



    private function buildTempLogItem($temp, $humidity)
    {
        return[
            "timestamp" => time(),
            "temp" => $temp,
            "humidity" => $humidity
        ];
    }


    private function buildWeightLogItem($weight)
    {
        $item = [
            "timestamp" => time(),
            "weight" => $weight
        ];
        $newdata[1][] = $item;
        return $newdata;

    }



    public function writeLogJson($unit, $brood, $food, $emptycombs, $queen, $gentleness, $varroa, $honeyspace, $swarm,  $treatment,$latitude, $longitude)
    {
        $this->checkAndCreateDirectory($unit);
        $data = [];
        $data = $this->buildLogItem($unit, $brood, $food, $emptycombs, $queen, $gentleness, $varroa, $honeyspace, $swarm,  $treatment, $latitude, $longitude);
        $newJson = json_encode($data);
        $file = "Data/" . $unit . "/log/" .date('d-m-Y-h-i-s') .".json";
        file_put_contents($file, $newJson);

    }

    public function writeLogTempJson($temp, $humidity)
    {
        $data = [];
        $data = $this->buildTempLogItem($temp, $humidity);
        $newJson = json_encode($data);
        $file = "../Data/temp/" .date('d-m-Y-h-i-s') .".json";
        file_put_contents($file, $newJson);

    }
    public function writeLogWeightJson($weight)
    {
        $data = [];
        $data = $this->buildWeightLogItem($weight);
        $newJson = json_encode($data);
        $file = "../Data/weight/" .date('d-m-Y-h-i-s') .".json";
        file_put_contents($file, $newJson);

    }


    private function checkAndCreateArchiv()
    {
        if (!file_exists("Archive")) {
            mkdir("Archive", 0755, true);
        }
    }
    private function moveDirToArchive($directoryToMove)
    {
        if (!file_exists("Archive/". $directoryToMove)) {
            rename("Data/" . $directoryToMove . "/", "Archive/" . $directoryToMove . "/");
        }else{
            echo "Ein Ordner mit dem Namen" . $directoryToMove ." existiert schon";
        }
    }

    public function renameDirectory($unit, $newunit){

        if (!file_exists($newunit)) {
            rename( "Data/" .$unit ,"Data/" . $newunit);
            $unit = $newunit;
            return $unit;
        }else{
            $error = "Ein Ordner mit dem Namen" . $newunit ." existiert schon";
            return $error;
        }

    }

    public function directory($unit)
    {
        $this->checkAndCreateDirectory($unit);
    }
    public function toArchive($directoryToMove)
    {
        $this->checkAndCreateArchiv();
        $this->moveDirToArchive($directoryToMove);
    }

}
