<!DOCTYPE html>

<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if IE 8]> <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->

<head>
	<meta charset="utf-8" />

	<!-- Set the viewport width to device width for mobile -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<title>NYUAD Hackathon Project Upload</title>

	<!-- Included CSS Files -->
	<link rel="stylesheet" href="stylesheets/app.css">

	<script src="javascripts/foundation/modernizr.foundation.js"></script>

</head>
<body>
	
	<div class="row">
		<div class="ten columns offset-by-one">

<?php
$allowedExts = array("zip", "rar");
$extension = end(explode(".", $_FILES["file"]["name"]));
if ((($_FILES["file"]["type"] == "application/zip")
|| ($_FILES["file"]["type"] == "application/x-rar-compressed")
|| ($_FILES["file"]["type"] == "application/octet-stream")
|| ($_FILES["file"]["type"] == "application/zip"))
&& ($_FILES["file"]["size"] < (200 * 1024 * 1024))
&& in_array($extension, $allowedExts))
{
  if ($_FILES["file"]["error"] > 0) {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
  } else if(file_exists("/websites/nyuad.hack-day.net/uploads/" . basename($_FILES["file"]["name"]))) {
    echo "Please choose a different name for your zip file";
  } else {
    echo "Thank you! Your file has been submitted.";

    move_uploaded_file($_FILES["file"]["tmp_name"], "/websites/nyuad.hack-day.net/uploads/" . basename($_FILES["file"]["name"]));
  }
} else {
  echo "Invalid file. You must upload a ZIP file.";
}
?>
		</div>
	</div>

</body>
</html>
