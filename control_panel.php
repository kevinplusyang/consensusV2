<?php
session_start();
require_once "dbaccess.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Consensus</title>
</head>
<body>


<?php
$result = mysql_query("select * from decision;");
while($row = mysql_fetch_array($result)) {
    $decision_id = $row['id'];
    ?>


    Pilot Study ID: <a href="overall.php?decision_id=<?php echo $decision_id;?>"><?php echo  $decision_id?></a>

    <br>
    <?php
    $result_2 = mysql_query("select * from participate where decision_id = '".$decision_id."'");
    while($row_2 = mysql_fetch_array($result_2)) {
        $user_id = $row_2['user_id'];
        $real_user_id = $row_2['real_user_id'];

        $result_3 = mysql_query("select * from user where id = '".$real_user_id."'");
        $row_3 = mysql_fetch_array($result_3);
        $user_name = $row_3['user_name'];

       ?>
        User: <a href="decision.php?decision_id=<?php echo $decision_id;?>&user=<?php echo $user_id;?>"><?php echo $user_name;?></a>
<br>
        <?php

    }

}

?>


<hr>
Add a New User:
<form action="register_user.php" method="post">

        <input class="form-control" placeholder="User Name" name="username" id="username" autofocus>

    <br>

        <input class="form-control" placeholder="E-mail" name="email" id="email" autofocus>


    <br>
        <input class="form-control" placeholder="Password" name="password" type="password" value="">

    <br>
    <br>
    How many fake users will play with this participant?
    <select name="participate">
        <option value="1">
            3
        </option>
        <option value="2">
            6
        </option>
        <option value="3">
            9
        </option>
        <option value="4">
            12
        </option>
        <option value="5">
            15
        </option>
        <option value="6">
            18
        </option>
    </select>
    <br>
    <br>

    What is the experiment type?
    <select name="type">
        <option value="0">
            Visualization with Variance Bar
        </option>
        <option value="1">
            Visualization without Variance Bar
        </option>
        <option value="2">
            None Visualization
        </option>
    </select>
    <br>
<br>

    <button type="submit">Register</button>
</form>








</body>
</html>