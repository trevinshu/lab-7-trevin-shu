<?php
include("includes/header.php");
?>

<div class="jumbotron clearfix">
    <h1>Display Image</h1>
</div>

<?php
$cd_id = $_GET["id"];
?>

<?php
$result = mysqli_query($con, "SELECT * FROM tsh_gallery WHERE id = '$cd_id'");
?>
<div class="display-container">
    <?php while ($row = mysqli_fetch_array($result)) : ?>
        <h2><?php echo $row["tsh_title"]; ?></h2><br>
        <img src="admin/uploads/display/<?php echo $row["tsh_filename"]; ?>">
        <p>Description: <?php echo $row["tsh_description"]; ?></p>
    <?php endwhile; ?>
</div>
<?php
include("includes/footer.php");
?>