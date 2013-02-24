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
			<h1>NYUAD Hackathon Project Upload Form</h1>
			<p>Thanks for your hard work! You can upload a ZIP file of your project here.</p>
			<div class="panel">
				<b>Important!</b>
				<p>Your project ZIP file must contain the following:</p>
				<ul>
					<li>Your code</li>
					<li>A README file describing your project and instructions for setting it up</li>
					<li>Your presentation files that you will be showing judges</li>
				</ul>
			</div>

			<form action="upload.php" method="post"
			enctype="multipart/form-data">
			<label for="file">Project ZIP File:</label>
			<input type="file" name="file" id="file">
			<input type="submit" name="submit" value="Submit" class="button medium secondary">
			</form>
		</div>
	</div>

</body>
</html>
