<?php

include("common.php");

$result = $mysql->query("SELECT team, votes, judge FROM votes", MYSQLI_USE_RESULT);

$audience = array();
$judges = array();

while ($row = $result->fetch_assoc()) {
    $team = $row["team"];
    $judge = $row["judge"];
    $votes = json_decode($row["votes"]);

    if($judge) {
        if(!isset($judges[$team])) {
            $judges[$team] = array();
        }
        
        foreach($criteria as $key=>$label) {
            $judges[$team][$key][] = $votes->$key;
        }
    } else {
        if(!isset($audience[$team])) {
            $audience[$team] = array();
        }
        
        foreach($criteria as $key=>$label) {
            $audience[$team][$key][] = $votes->$key;
        }
    } 
}

$who = array("judges"=>"Judges", "audience"=>"Audience");

asort($judges);
asort($audience);

?>
<html>
<head>
    <title>Results</title>
</head>
<body>
    <?php foreach($who as $var => $label): ?>
    <h1><?php print($label); ?></h1>
    <table>
        <tr>
            <th>Team</th>
            <?php foreach($criteria as $key=>$label): ?>
            <th><?php print($label); ?></th>
            <?php endforeach; ?>
        </tr>
        <?php foreach($$var as $team => $scores): ?>
        <tr>
            <td><?php print($team); ?></td>
            <?php foreach($criteria as $key=>$label): ?>
            <th><?php print(round(array_sum($scores[$key]) / count($scores[$key]), 2)); ?></th>
            <?php endforeach; ?>
        </tr>
        <?php endforeach; ?>
    </table>
    <?php endforeach; ?>
</body>
            
