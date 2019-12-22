<?php
    include_once "Partials/Header.php";
include_once "env.php";
    require_once "Classes/readData.php";
?>




<div class="container">
<div class="row">
    <div class="col">
        <div class="btn-group">
            <?php
            $content = new readData($dataDir);
            $content->printFolders($dataDir);
            ?>
        </div>
    </div>

</div>

</div>
<?php
include_once "Partials/Footer.php";
?>
