<?php
include_once "../env.php";
require_once "../Classes/readData.php";
require_once "../Classes/writeData.php";
$dataDir = "../Data/";
$content = new readData($dataDir);
echo $content->printFoldersToJson($dataDir);

