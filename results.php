<?php

include("common.php");

if(!$logged_in) {
    header("Location: /start.php"); 
}

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
            if(isset($votes->$key)) {
                $judges[$team][$key][] = $votes->$key;
            }
        }
    } else {
        if(!isset($audience[$team])) {
            $audience[$team] = array();
        }
        
        foreach($criteria as $key=>$label) {
            if(isset($votes->$key)) {
                $audience[$team][$key][] = $votes->$key;
            }
        }
    } 
}

$who = array("judges"=>"Judges", "audience"=>"Audience");

ksort($judges);
ksort($audience);

?>
<html>
<head>
    <title>Results</title>
    <link href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.0/css/bootstrap-combined.min.css" rel="stylesheet">
    <script type="text/javascript" src="/jquery-latest.js"></script> 
    <script type="text/javascript" src="/jquery.metadata.js"></script> 
    <script type="text/javascript" src="/jquery.tablesorter.min.js"></script> 
    <style>
    body {
       padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
    }
    table .header {
      cursor: pointer;
    }
    table .header:after {
      content: "";
      float: right;
      margin-top: 7px;
      border-width: 0 4px 4px;
      border-style: solid;
      border-color: #000000 transparent;
      visibility: hidden;
    }
    table .headerSortUp, table .headerSortDown {
      background-color: #f7f7f9;
      text-shadow: 0 1px 1px rgba(255, 255, 255, 0.75);
    }
    table .header:hover:after {
      visibility: visible;
    }
    table .headerSortDown:after, table .headerSortDown:hover:after {
      visibility: visible;
      filter: alpha(opacity=60);
      -moz-opacity: 0.6;
      opacity: 0.6;
    }
    table .headerSortUp:after {
      border-bottom: none;
      border-left: 4px solid transparent;
      border-right: 4px solid transparent;
      border-top: 4px solid #000000;
      visibility: visible;
      -webkit-box-shadow: none;
      -moz-box-shadow: none;
      box-shadow: none;
      filter: alpha(opacity=60);
      -moz-opacity: 0.6;
      opacity: 0.6;
    }
    </style>
    <script type="text/javascript">
    $(document).ready(function() { 
        alert("here")
        $("table#Judges").tablesorter({ sortList: [[1,0]] });
        $("table#Audience").tablesorter({ sortList: [[1,0]] });
    }); 
    </script>
</head>
<body>
    <div class="navbar navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="#">NYUAD Hackathon 2013 Results</a>          
        </div>
      </div>
    </div>

    <div class="container">
        <?php foreach($who as $var => $label): ?>
        <h1><?php print($label); ?></h1>
        <table id="<?php print($label); ?>" class="table">
            <thead>
            <tr>
                <th>Team</th>
                <?php foreach($criteria as $key=>$label): ?>
                <th><?php print($label); ?></th>
                <?php endforeach; ?>
            </tr>
            </thead>
            <tbody>
            <?php foreach($$var as $team => $scores): ?>
            <tr>
                <td><?php print($team); ?></td>
                <?php foreach($criteria as $key=>$label): ?>
                <th><?php print(round(array_sum($scores[$key]) / count($scores[$key]), 2)); ?></th>
                <?php endforeach; ?>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <?php endforeach; ?>
    </div>
</body>
            
