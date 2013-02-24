<?php
include("common.php");
?>
<!DOCTYPE html>
<html>
<head>
    <title>NYUAD Judge Registration</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <link rel="stylesheet" href="nyuad.min.css" />
    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.0/jquery.mobile.structure-1.3.0.min.css" />
    <script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
    <script src="http://code.jquery.com/mobile/1.3.0/jquery.mobile-1.3.0.min.js"></script>
</head>
<body>
    <div data-role="page" id="judges">  
    <!-- ====== main content starts here ===== -->  
    <div data-role="header" id="hdrMain" name="hdrMain" data-nobackbtn="true"><h1>NYUAD 2013 Judge</h1></div>  
    <div data-role="content" id="contentMain" name="contentMain">  
    	<form method="post" action="index.php">
    		<label for="email">Email:</label>
    		<input type="text" name="email" id="email" value=""  />
    		<input type="hidden" name="judge" value="1">
        	<input type="hidden" name="action" value="start">
        	<input type="submit" value="Start judging">
    	</form>
	</div>
</body>
</html>
