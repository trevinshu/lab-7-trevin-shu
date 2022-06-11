<?php

include("includes/header.php");

?>

<div class="jumbotron clearfix">
  <h1><?php echo APP_NAME ?></h1>
</div>
<?php
$result = mysqli_query($con, "SELECT * FROM tsh_gallery");
?>
<div class="box">
  <?php while ($row = mysqli_fetch_array($result)) : ?>
    <div class="thumb">
      <a href="display.php?id=<?php echo $row['id'] ?> ">
        <img src="admin/uploads/thumbs/<?php echo $row["tsh_filename"]; ?>">
      </a>
      <p class="caption"> <?php echo substr($row["tsh_title"], 0, 12); ?></p>
    </div>
  <?php endwhile; ?>
</div>
<?php
include("includes/footer.php");
?>