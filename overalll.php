<?php
session_start();
require_once "dbaccess.php";
?>





<!DOCTYPE html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="http://d3js.org/d3.v3.min.js"></script>

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://code.getmdl.io/1.1.3/material.teal-green.min.css">
<link rel="stylesheet" href="buttons.css">


<html lang="en">
<head>
    <link href="style.css" rel="stylesheet">
    <meta charset="UTF-8">
    <title>Consensus</title>
</head>


<br>


<!--<button onclick="location='http://goo.gl/forms/2Bk1cmcva4Flvh2j2'" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" style="margin-left: 10px">-->
<!--    Finish This Study-->
<!--</button>-->

<p style="padding-left: 10px">
   <b>
       Group Page
   </b> <br>

    Your task is to come to a consensus on the best candidate.

</p>






<a href="holdpage_3.php?decision_id=<?php echo $_GET['decision_id']?>&user_id=<?php echo $_GET['user_id'];?>" class="button button-rounded button-raised" style="margin-left: 10px;  margin-top: 5px; float:left">Next</a>




<body>


</body>
<script src="https://code.getmdl.io/1.1.3/material.min.js"></script>

</html>






