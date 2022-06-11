<?php
session_start();
if (isset($_SESSION['auyfgigafa'])) {
    // echo "Logged in";
} else {
    // echo "Not logged In";
    header("Location: login.php");
}
?>
<?php
include("../includes/header.php");

$pageID = $_GET['id'];
if (!isset($pageID)) {
    $tmp = mysqli_query($con, "Select id from tsh_gallery limit 1");
    while ($row = mysqli_fetch_array($tmp)) {
        $pageID = $row['id'];
    }
}

if (isset($_POST['submit'])) {
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $valid = 1;
    $msgPreError = "\n<div class=\"alert alert-danger\" role=\"alert\">";
    $msgPreSuccess = "\n<div class=\"alert alert-primary\" role=\"alert\">";
    $msgPost = "\n</div>";

    if ((strlen($title) < 5) || (strlen($title) > 150)) {
        $valid = 0;
        $valTitleMsg .= "Please enter a title between 5 to 150 characters.";
    }

    if ((strlen($description) < 5) || (strlen($description) > 400)) {
        $valid = 0;
        $valDescriptionMsg .= "Please enter a description between 5 to 400 characters.";
    }

    if ($valid == 1) {
        mysqli_query($con, "update tsh_gallery set tsh_title = '$title',tsh_description = '$description' where id = '$pageID'") or die(mysqli_error($con));
        $msgSuccess = "Success. The image has been updated.";
    }
}

$result = mysqli_query($con, "Select * from tsh_gallery");

?>
<div class="jumbotron clearfix">
    <h1>Edit Image</h1>
</div>
<?php
if ($msgSuccess) {
    echo $msgPreSuccess . $msgSuccess . $msgPost;
}
?>
<div class="box">
    <?php while ($row = mysqli_fetch_array($result)) : ?>
        <div class="edit">
            <a href="edit.php?id=<?php echo $row['id'] ?> ">
                <img src="uploads/editthumbs/<?php echo $row["tsh_filename"]; ?>">
            </a>
            <h4 class="edit-h4"><?php echo substr($row["tsh_title"], 0, 10) ?></h4>
        </div>
    <?php endwhile; ?>
</div>
<?php
$result = mysqli_query($con, "Select * from tsh_gallery where id='$pageID'");
while ($row = mysqli_fetch_array($result)) {
    $title = $row['tsh_title'];
    $description = $row['tsh_description'];
}
?>
<div class="edit-form">
    <form id="myform" name="myform" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" name="title" class="form-control" value="<?php echo $title ?>">
            <?php
            if ($valTitleMsg) {
                echo $msgPreError . $valTitleMsg . $msgPost;
            }
            ?>
        </div>
        <div class=" form-group">
            <label for="description">Description:</label>
            <textarea name="description" class="form-control"><?php if ($description) {
                                                                    echo $description;
                                                                } ?></textarea>
            <?php
            if ($valDescriptionMsg) {
                echo $msgPreError . $valDescriptionMsg . $msgPost;
            }
            ?>
            <br>
        </div>
        <div class="form-group">
            <label for="submit"></label>
            <input type="submit" name="submit" class="btn btn-info" value="Update Picture">
            &nbsp;
            <a href="delete.php?id=<?php echo $pageID ?>" onclick="return confirm('Are you sure you want to delete this picture?')" class="btn btn-danger">Delete Picture</a>
        </div>
    </form>
</div>
<?php
include("../includes/footer.php");
?>