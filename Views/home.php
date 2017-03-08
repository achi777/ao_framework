<?php
/**
 * Created by PhpStorm.
 * User: archil
 * Date: 07.03.2017
 * Time: 10:47
 */
?>
<body>
<h1>view test</h1>
<p>
    <?php
        foreach ($zauri AS $value){
            echo $value['name_geo']."<br>";
        }
    ?>
</p>
</body>