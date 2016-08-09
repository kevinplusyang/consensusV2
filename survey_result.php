<?php
require_once "dbaccess.php";
?>



<!DOCTYPE html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="http://d3js.org/d3.v3.min.js"></script>

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://code.getmdl.io/1.1.3/material.teal-red.min.css">



<html lang="en">
<head>
    <link href="style.css" rel="stylesheet">
    <meta charset="UTF-8">
    <title>Consensus</title>
</head>


<body>

<?php


$result = mysql_query("select * from participate where decision_id = '".$_GET['decision_id']."' ");
while($row = mysql_fetch_array($result)){
    $user_id = $row['user_id'];
    ?>
    User:<?php  echo $user_id?>
    <table border="1px">
        <tr>
            <td>1. How much confidence do you have to your vote?</td>
            <td><?php
                $result2 = mysql_query("select * from survey where decision_id = '".$_GET['decision_id']."' and user_id = '".$user_id."' and question_id = '1' ");
                $row = mysql_fetch_array($result2);
                echo $row['answer'];
                ?></td>
        </tr>

        <tr>
            <td>2. How much willingness do you have to change your vote?</td>
            <td><?php
                $result2 = mysql_query("select * from survey where decision_id = '".$_GET['decision_id']."' and user_id = '".$user_id."' and question_id = '2' ");
                $row = mysql_fetch_array($result2);
                echo $row['answer'];
                ?></td>
        </tr>

        <tr>
            <td>Academic: </td>
            <td><?php
                $result2 = mysql_query("select * from survey where decision_id = '".$_GET['decision_id']."' and user_id = '".$user_id."' and question_id = '3' ");
                $row = mysql_fetch_array($result2);
                if($row['answer']==1){
                    echo "Like";
                } if($row['answer']==2){
                    echo "Unlike";
                }

                ?></td>
        </tr>

        <tr>
            <td>Extracurricular: </td>
            <td><?php
                $result2 = mysql_query("select * from survey where decision_id = '".$_GET['decision_id']."' and user_id = '".$user_id."' and question_id = '4' ");
                $row = mysql_fetch_array($result2);
                if($row['answer']==1){
                    echo "Like";
                } if($row['answer']==2){
                    echo "Unlike";
                }
                ?></td>
        </tr>

        <tr>
            <td>Recommendation Letter: </td>
            <td><?php
                $result2 = mysql_query("select * from survey where decision_id = '".$_GET['decision_id']."' and user_id = '".$user_id."' and question_id = '5' ");
                $row = mysql_fetch_array($result2);
                if($row['answer']==1){
                    echo "Like";
                } if($row['answer']==2){
                    echo "Unlike";
                }
                ?></td>
        </tr>

        <tr>
            <td>Fit: </td>
            <td><?php
                $result2 = mysql_query("select * from survey where decision_id = '".$_GET['decision_id']."' and user_id = '".$user_id."' and question_id = '6' ");
                $row = mysql_fetch_array($result2);
                if($row['answer']==1){
                    echo "Like";
                }

                if($row['answer']==2){
                    echo "Unlike";
                }
                ?></td>
        </tr>


        <tr>
            <td>What other criteria would you like to add?</td>
            <td><?php
                $result2 = mysql_query("select * from survey where decision_id = '".$_GET['decision_id']."' and user_id = '".$user_id."' and question_id = '7' ");
                $row = mysql_fetch_array($result2);
                echo $row['answer'];
                ?></td>
        </tr>
    </table>

    <br>

    <?php

}



$result = mysql_query("select * from reason");

while($row = mysql_fetch_array($result)){
    echo $row['reason'];
    echo '<br>';
    echo '<br>';
}

?>




</body>
<script src="https://code.getmdl.io/1.1.3/material.min.js"></script>

</html>






