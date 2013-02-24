<?php
include("common.php");
?>
<!DOCTYPE html>
<html>
<head>
    <title>NYUAD Hack Voting</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <link rel="stylesheet" href="nyuad.min.css" />
    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.0/jquery.mobile.structure-1.3.0.min.css" />
    <script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
    <script src="http://code.jquery.com/mobile/1.3.0/jquery.mobile-1.3.0.min.js"></script>
</head>
<body>
    <div data-role="page" id="scorecard">  
        <!-- ====== main content starts here ===== -->  
        <div data-role="header" id="hdrMain" name="hdrMain" data-nobackbtn="true">
            <h1 style="text-align:center;">NYUAD 2013 <?php if(isset($judge) && $judge): ?>Judge <?php endif; ?></h1>
            <h2><?php print($email); ?></h2>
        </div>  
        <div data-role="content" id="contentMain" name="contentMain">  
	<?php if(isset($flash_message) && $flash_message): ?>
            <h3 style="color:darkgreen" id="status"><?php print($flash_message); ?></h3>
            <script text="text/javascript">
                $('#status').fadeOut(5000, function() {});
            </script>
        <?php endif; ?>
            <form method="post" action="index.php">
		<input type="hidden" name="action" value="vote">  
                <fieldset data-role="controlgroup">
                    <label for="team"><strong>Team</strong></label>
                    <select name="team" id="team">
			<?php foreach($teams as $id=>$name): ?>
			<option value="<?php print($id); ?>" <?php if($current_team == $id): ?>selected="selected"<?php endif; ?>><?php print($name); ?></option>
			<?php endforeach; ?>
                    </select>
                </fieldset>

                <?php foreach($criteria as $key=>$label): ?>
                <fieldset data-role="controlgroup" data-type="horizontal">
                    <legend><strong><?php print($label); ?></strong></legend>
                    <?php for($i=1;$i<=5;$i++): ?>
                    <input style="width:10px" type="radio" name="<?php print($key); ?>" id="<?php print($key . $i); ?>" value="<?php print($i); ?>">
                    <label for="<?php print($key . $i); ?>"><?php print($i); ?></label>
                <?php endfor; ?>
                </fieldset>
                <?php endforeach; ?>
                <fieldset>
                    <p><input type="submit" value="Submit"></p>
                </fieldset>
        </form>
    </div>    
</body>
</html>
