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
            array_push($judges[$team][$key], $votes[$key]);
        }
    } else {
        if(!isset($audience[$team])) {
            $audience[$team] = array();
        }
        
        foreach($criteria as $key=>$label) {
            array_push($audience[$team][$key], $votes[$key]);
        }
    } 
}

?>
<html>
<head>
    <title>Results</title>
</head>
<body>
    <table>
        <tr>
            <th>Team</th>
            <?php foreach($criteria as $key=>$label): ?>
            <th><?php print($label); ?></th>
            <?php endforeach; ?>
        </tr>
        <?php foreach($judges as $team => $scores): ?>
        <tr>
            <td><?php print($team); ?></td>
            <?php foreach($criteria as $key=>$label): ?>
            <th><?php print(round(array_sum($scores[$label]) / count($scores[$label]), 2)); ?></th>
            <?php endforeach; ?>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
            
