<?php
/**
 * Created by PhpStorm.
 * User: archil
 * Date: 16.03.2017
 * Time: 10:06
 */
?>
<div class="container">
    <p>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="text" class="form-control" value="<?php echo $info[0]->name_geo; ?>" name="name_geo">
        <br>
        <input type="text" class="form-control" value="<?php echo $info[0]->name_eng; ?>" name="name_eng">
        <br>
        <input type="submit" class="btn btn-success" value="Update" name="submit">
        <a class="btn btn-danger glyphicon glyphicon-trash" href="<?php echo baseurl;?>/delete/<?php echo $id; ?>"> Delete</a>
    </form>
    </p>
</div>
