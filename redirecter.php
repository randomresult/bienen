<?php
 $unit = (int) $_GET['unit'];
 ?>

<body onload="document.redirect.submit()">
<form name="redirect" action="manualLog.php" method="POST">

    <input id="unit" name="unit" type="hidden" value="<?php echo $unit ?>"/>
        <input type="submit" value="submit" name="mem_type">

</form>
</body>
