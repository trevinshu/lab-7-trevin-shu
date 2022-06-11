<?php
include("../includes/mysql_connect.php");

$pictureID = $_GET["id"];

if (is_numeric($pictureID)) {
    mysqli_query($con, "delete from tsh_gallery where id = $pictureID") or die(mysqli_error($con));
    header("Location:edit.php");
}
