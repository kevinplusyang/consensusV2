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
User ID:
<?php echo $_SESSION['user_id'];?>
<br>

User Name:
<?php echo $_SESSION['username'];?>


<br>

<hr>

<?php
$result = mysql_query("select * from decision;");
while($row = mysql_fetch_array($result)) {
    $decision_id = $row['id'];
    ?>

    ======================================================
    <br>
    Pilot Study ID: <?php echo  $decision_id?>

    <br>
    <?php
    $result_2 = mysql_query("select * from participate where decision_id = '".$decision_id."'");
    while($row_2 = mysql_fetch_array($result_2)) {
        $user_id = $row_2['user_id'];
        $real_user_id = $row_2['real_user_id'];
       ?>
        User ID: <?php echo $real_user_id;?>
<br>
        <?php

    }

}

?>

<hr>
Create a New Study:

<form action="create_study.php" method="post">

   <input type="text" placeholder="Study Name" name="studyname">
    <br>

    <input type="text" placeholder="Description" name="description">
    <br>


    <button type="submit">Creat Pilot Study</button>
</form>


<hr>
Add a New User:
<form action="register_user.php" method="post">

        <input class="form-control" placeholder="User Name" name="username" id="username" autofocus>

    <br>

        <input class="form-control" placeholder="E-mail" name="email" id="email" autofocus>


    <br>
        <input class="form-control" placeholder="Password" name="password" type="password" value="">

    <br>
    Select a Study:
    <select name="participate">
        <?php
        $result = mysql_query("select * from decision");
        while ($row = mysql_fetch_array($result)){
            $decision_name = $row['name'];
            $decision_id = $row['id'];
            ?>
            <option value="<?php echo $decision_id;?>">
                <?php
                echo $decision_name;
                ?>
            </option>
            <?php
        }
        ?>
    </select>
    <br>

    <button type="submit">Register</button>
</form>








</body>
</html>