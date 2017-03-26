<?php
/**
 * Created by PhpStorm.
 * User: archil
 * Date: 07.03.2017
 * Time: 10:47
 */
?>
<div class="container">
<p>
    <?php
        foreach ($selected AS $value){
            echo $value->name_geo."<br>";
        }
    ?>
</p>
</div>