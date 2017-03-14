<?php
/**
 * Created by PhpStorm.
 * User: archil
 * Date: 13.03.2017
 * Time: 16:35
 */
?>
<div class="container">
<p>
    <?php
        foreach ($list AS $value){
            echo $value['name_geo']."<br>";
        }
    ?>
</p>
<p>
    <?php
    echo $pagination;
    ?>
</p>
</div>
