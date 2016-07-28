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
<br>
======================================================<br>
<b>One click to create a pilot study:</b>
<form action="add_decision.php" method="post">
    Pilot Name:
    <input type="text" name="decision_name" id="decision_name">
    <br>
    Pilot Description:
    <input type="text" name="description" id="description">
    <br>
    <button type="submit">Start Piloting</button>
</form>



<div>
    <?php
    $result = mysql_query("select * from participate where user_id = '".$_SESSION['user_id']."'");
    while($row = mysql_fetch_array($result)) {
        $decision_id = $row['decision_id'];

        $result_decision = mysql_query("select * from decision where id = $decision_id");
        $row_decision = mysql_fetch_array($result_decision);
        $decision_name = $row_decision['name'];
        $decision_description = $row_decision['description'];

        ?>
        <a href="decision.php?decision_id=<?php echo $decision_id;?>&user=<?php echo $_SESSION['user_id'];?>"><?php echo $decision_name?></a>
        <?php
    }
    ?>
</div>

<br>

<div>
    <form action="join_decision.php" method="post">
        Participate to a study:
        <input type="text" name="invitation_code" id="invitation_code" placeholder="Pilot Study Code">
        <br>
        <button type="submit">OK</button>
    </form>
</div>
======================================================



<br>


<br>
<br>
======================================================<br>
<b>Create a decision:</b>
<form action="add_decision_general.php" method="post">
    Decision Name:
    <input type="text" name="decision_name" id="decision_name">
    <br>
    Decision Description:
    <input type="text" name="description" id="description">
    <br>
    <button type="submit">Start a New Decision</button>
</form>



<div>
    <?php
    $result = mysql_query("select * from participate where user_id = '".$_SESSION['user_id']."'");
    while($row = mysql_fetch_array($result)) {
        $decision_id = $row['decision_id'];

        $result_decision = mysql_query("select * from decision where id = $decision_id");
        $row_decision = mysql_fetch_array($result_decision);
        $decision_name = $row_decision['name'];
        $decision_description = $row_decision['description'];

        ?>
        <a href="decision.php?decision_id=<?php echo $decision_id;?>&user=<?php echo $_SESSION['user_id'];?>"><?php echo $decision_name?></a>
        <?php
    }
    ?>
</div>

<br>

<div>
    <form action="join_decision_general.php" method="post">
        Participate to a decision:
        <input type="text" name="invitation_code" id="invitation_code" placeholder="Invitation Code">
        <br>
        <button type="submit">OK</button>
    </form>
</div>
======================================================

</body>
</html>