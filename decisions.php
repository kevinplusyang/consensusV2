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
<?php echo $_SESSION['user_id'];?>
<form action="add_decision.php" method="post">
    <input type="text" name="decision_name" id="decision_name">
    <input type="text" name="description" id="description">
    <button type="submit">确认</button>
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


<div>
    <form action="join_decision.php" method="post">
        <input type="text" name="invitation_code" id="invitation_code" placeholder="Invitation Code">
        <button type="submit">OK</button>
    </form>
</div>
</body>
</html>