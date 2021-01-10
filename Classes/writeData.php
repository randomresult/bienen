<?php

class writeData
{
    public function __construct($unit)
    {
    }

    private function checkAndCreateDirectory($unit, $givenpath)
    {
        $path = "$givenpath" . $unit;
        if (!file_exists($path)) {
            mkdir($path, 0755, true);
            mkdir($path . "/auto", 0755, true);
            mkdir($path . "/log", 0755, true);
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



    private function buildAutoLogItem( $temp, $humidity, $weight)
    {
        return[
            "timestamp" => time(),
            "temp" => $temp,
            "humidity" => $humidity,
            "weight" => $weight,
        ];
    }



    public function writeLogJson($unit, $brood, $food, $emptycombs, $queen, $gentleness, $varroa, $honeyspace, $swarm,  $treatment,$latitude, $longitude)
    {
        $givenpath = "Data";
        $this->checkAndCreateDirectory($unit, $givenpath);
        $data = [];
        $data = $this->buildLogItem($unit, $brood, $food, $emptycombs, $queen, $gentleness, $varroa, $honeyspace, $swarm,  $treatment, $latitude, $longitude);
        $newJson = json_encode($data);
        $file = $givenpath . "/" . $unit . "/log/" .date('d-m-Y-h-i-s') .".json";
        file_put_contents($file, $newJson);

    }


    public function writeAutoLogItem($unit, $temp, $humidity, $weight)
    {
        $givenpath = "../Data/";
        $this->checkAndCreateDirectory($unit, $givenpath);
        $data = [];
        $data = $this->buildAutoLogItem($temp, $humidity, $weight );
        $newJson = json_encode($data);
        $file = $givenpath . $unit . "/auto/" .date('d-m-Y-h-i-s') .".json";
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


    //maybe not needed anymore...
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
