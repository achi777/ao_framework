<?php
/**
 * Created by PhpStorm.
 * User: archil
 * Date: 13.03.2017
 * Time: 16:35
 */
?>
<h1>view test</h1>
<p>
    <?php
        foreach ($zauri AS $value){
            echo $value['name_geo']."<br>";
        }
    ?>
</p>
<p>
    <?php
    echo $pagination;
    ?>
</p>