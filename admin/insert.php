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

$originalsFolder = "uploads/originals/";
$thumbsFolder = "uploads/thumbs/";
$thumbEditfolder = "uploads/editthumbs/";
$displayFolder = "uploads/display/";

$title = trim($_POST['title']);
$description = trim($_POST['description']);
$filename =  $_FILES['file']['name'];
$imageFileType = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

function createThumbnail($file, $folder, $newWidth)
{
	list($width, $height) = getimagesize($file);

	$imgRatio = $width / $height;
	$newHeight = $newWidth / $imgRatio;

	$thumb = imagecreatetruecolor($newWidth, $newHeight);
	$source = imagecreatefromjpeg($file);
	$newFileName = basename($file);

	imagecopyresampled($thumb, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
	imagejpeg($thumb, $folder . $newFileName, 80);
	imagedestroy($thumb);
	imagedestroy($source);
}

function createThumbnailPNG($file, $folder, $newWidth)
{
	list($width, $height) = getimagesize($file);

	$imgRatio = $width / $height;
	$newHeight = $newWidth / $imgRatio;

	$thumb = imagecreatetruecolor($newWidth, $newHeight);
	$source = imagecreatefrompng($file);
	$newFileName = basename($file);

	imagecopyresampled($thumb, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
	imagepng($thumb, $folder . $newFileName, 2);
	imagedestroy($thumb);
	imagedestroy($source);
}

if (isset($_POST['submit'])) {
	$valid = 1;
	$msgPreError = "\n<div class=\"alert alert-danger\" role=\"alert\">";
	$msgPreSuccess = "\n<div class=\"alert alert-primary\" role=\"alert\">";
	$msgPost = "\n</div>";
	$allowed_extensions = array("image/png", "image/jpeg");

	if ((strlen($title) < 5) || (strlen($title) > 150)) {
		$valid = 0;
		$valTitleMsg .= "Please enter a title between 5 to 150 characters.";
	}

	if ((strlen($description) < 5) || (strlen($description) > 400)) {
		$valid = 0;
		$valDescriptionMsg .= "Please enter a description between 5 to 400 characters.";
	}

	if ($_FILES['file']['size'] / 1024 / 1024 > 10) {
		$valid = 0;
		$valMaxSizeMsg .= "File too large. Upload lesser than 10MB";
	}

	if ($imageFileType != "png" && $imageFileType != "jpg" && $imageFileType != "jpeg") {
		$valid = 0;
		$valFileTypeMsg .= "Only JPG, JPEG & PNG images are allowed";
	}

	if ($filename == "") {
		$valid = 0;
		$valNoFileMsg = "You have not selected a file. Please select a file.";
	}

	if ($valid == 1) {
		$temp = explode(".", $_FILES["file"]["name"]);
		$renameFile = uniqid() . '.' . end($temp);
		if (move_uploaded_file(($_FILES['file']['tmp_name']), $uploads . $originalsFolder . $renameFile)) {
			$thisFile =  $uploads . $originalsFolder . $renameFile;

			if ($imageFileType == "jpg" || $imageFileType == "jpeg" && $imageFileType != "png") {
				createThumbnail($thisFile, $thumbEditfolder, 50);
				createThumbnail($thisFile, $thumbsFolder, 150);
				createThumbnail($thisFile, $displayFolder, 600);

				mysqli_query($con, "INSERT INTO tsh_gallery(tsh_title, tsh_description, tsh_filename) VALUES('$title', '$description', '$renameFile')") or die(mysqli_error($con));
				$msgSuccess = "Success. A new image has been added to the gallery.";
			} else if ($imageFileType == "png" && $imageFileType != "jpeg" && $imageFileType != "jpg") {
				createThumbnailPNG($thisFile, $thumbEditfolder, 50);
				createThumbnailPNG($thisFile, $thumbsFolder, 150);
				createThumbnailPNG($thisFile, $displayFolder, 600);

				mysqli_query($con, "INSERT INTO tsh_gallery(tsh_title, tsh_description, tsh_filename) VALUES('$title', '$description', '$renameFile')") or die(mysqli_error($con));
				$msgSuccess = "Success. A new image has been added to the gallery.";
			}
		}
	}
}

?>
<div class="jumbotron clearfix">
	<h1>Insert Image</h1>
</div>
<?php
if ($msgSuccess) {
	echo $msgPreSuccess . $msgSuccess . $msgPost;
}
?>
<div class="insert-form">
	<form id="myform" name="myform" method="post" action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>" enctype="multipart/form-data">
		<div class="form-group">
			<label for="title">Image Title:</label>
			<input type="text" name="title" class="form-control">
			<?php
			if ($valTitleMsg) {
				echo $msgPreError . $valTitleMsg . $msgPost;
			}
			?>
		</div>
		<div class="form-group">
			<label for="description">Image Description:</label>
			<textarea class="form-control" name="description" class="form-control"></textarea>
			<?php
			if ($valDescriptionMsg) {
				echo $msgPreError . $valDescriptionMsg . $msgPost;
			}
			?>
		</div>
		<div class="form-group">
			<input type="file" name="file" class="form-control">
			<?php
			if ($valMaxSizeMsg) {
				echo $msgPreError . $valMaxSizeMsg . $msgPost;
			}

			if ($valFileTypeMsg) {
				echo $msgPreError . $valFileTypeMsg . $msgPost;
			}

			if ($valNoFileMsg) {
				echo $msgPreError . $valNoFileMsg . $msgPost;
			}
			?>
		</div>
		<div class="form-group">
			<label for="submit">&nbsp;</label>
			<input type="submit" name="submit" class="btn btn-info" value="Submit">
		</div>
	</form>
</div>
<?php
include("../includes/footer.php");
?>