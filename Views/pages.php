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
            if(empty($value['id'])){
                break;
            }
            echo $value['name_geo']." <a href=\"".baseurl."/update/".$value['id']."\" class=\"glyphicon glyphicon-pencil\">edit</a><br>";
        }
    ?>
</p>
    <?php
        echo $this->url->browser_info();
    ?>
    <br>
    <?php
        echo $this->url->os_info();
    ?>
<p>
    <?php
    echo $pagination;
    ?>
</p>
</div>
