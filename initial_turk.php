<!DOCTYPE html>


<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Evaluation</title>

</head>

<body>

<?php
require_once "dbaccess.php";


echo $_POST['username'];
echo $_POST['email'];
echo $_POST['password'];
echo $_POST['participate'];

$user_name = "Yuan";
$user_email = "yuan@ucsd.edu";
$password = "1234";
$participant_num = 5;




$user_name2 = "Brian";
$user_email2 = "Brian@ucsd.edu";

$user_name3 = "Tom";
$user_email3 = "Tom@ucsd.edu";

$user_name4 = "Rose";
$user_email4 = "Rose@ucsd.edu";

$user_name5 = "Cindy";
$user_email5 = "Cindy@ucsd.edu";

$user_name6 = "Jake";
$user_email6 = "Jake@ucsd.edu";






mysql_query("insert into reason values('','1','No Data') ");
mysql_query("insert into reason values('','1','No Data') ");





mysql_query("insert into user values ('','".$user_name."','".$user_email."','".md5($password)."') ");

$result = mysql_query("select * from user where email = '".$user_email."' ");
$row = mysql_fetch_array($result);
$user_id = $row['id'];



mysql_query("insert into decision values ('', 'Test1', 'No', '1', '4','3','1','0')");
mysql_query("insert into participate values('','1','1','1')");




mysql_query("insert into score values('','1','1','1','1','-1','A')");
mysql_query("insert into score values('','1','1','2','1','-1','A')");
mysql_query("insert into score values('','1','1','3','1','-1','A')");
mysql_query("insert into score values('','1','1','4','1','-1','A')");
mysql_query("insert into score values('','1','1','1','2','-1','A')");
mysql_query("insert into score values('','1','1','2','2','-1','A')");
mysql_query("insert into score values('','1','1','3','2','-1','A')");
mysql_query("insert into score values('','1','1','4','2','-1','A')");
mysql_query("insert into score values('','1','1','1','3','-1','A')");
mysql_query("insert into score values('','1','1','2','3','-1','A')");
mysql_query("insert into score values('','1','1','3','3','-1','A')");
mysql_query("insert into score values('','1','1','4','3','-1','A')");


mysql_query("insert into score values('','1','1','0','1','-1','A')");
mysql_query("insert into score values('','1','1','0','2','-1','A')");
mysql_query("insert into score values('','1','1','0','3','-1','A')");


mysql_query("insert into score_backup values('','1','1','1','1','-1')");
mysql_query("insert into score_backup values('','1','1','2','1','-1')");
mysql_query("insert into score_backup values('','1','1','3','1','-1')");
mysql_query("insert into score_backup values('','1','1','4','1','-1')");
mysql_query("insert into score_backup values('','1','1','1','2','-1')");
mysql_query("insert into score_backup values('','1','1','2','2','-1')");
mysql_query("insert into score_backup values('','1','1','3','2','-1')");
mysql_query("insert into score_backup values('','1','1','4','2','-1')");
mysql_query("insert into score_backup values('','1','1','1','3','-1')");
mysql_query("insert into score_backup values('','1','1','2','3','-1')");
mysql_query("insert into score_backup values('','1','1','3','3','-1')");
mysql_query("insert into score_backup values('','1','1','4','3','-1')");


mysql_query("insert into score_backup values('','1','1','0','1','-1')");
mysql_query("insert into score_backup values('','1','1','0','2','-1')");
mysql_query("insert into score_backup values('','1','1','0','3','-1')");






mysql_query("insert into user values ('','".$user_name2."','".$user_email2."','".md5($password)."') ");


$sql_count = "select count(*) from user ";
$result_count = mysql_query($sql_count);
$row_count = mysql_fetch_array( $result_count );
$user_count = $row_count[0];




mysql_query("insert into participate values('','1','".$user_count."','".$user_count."')");

mysql_query("update decision set user_num = user_num + 1 where id = '1'");

mysql_query("insert into score values('','1','".$user_count."','1','1','7.91','ABC')");
mysql_query("insert into score values('','1','".$user_count."','2','1','5.42','A')");
mysql_query("insert into score values('','1','".$user_count."','3','1','5.10','A')");
mysql_query("insert into score values('','1','".$user_count."','4','1','8.80','A')");
mysql_query("insert into score values('','1','".$user_count."','1','2','5.85','A')");
mysql_query("insert into score values('','1','".$user_count."','2','2','5.12','A')");
mysql_query("insert into score values('','1','".$user_count."','3','2','1.85','A')");
mysql_query("insert into score values('','1','".$user_count."','4','2','4.75','A')");
mysql_query("insert into score values('','1','".$user_count."','1','3','7.30','A')");
mysql_query("insert into score values('','1','".$user_count."','2','3','5.85','A')");
mysql_query("insert into score values('','1','".$user_count."','3','3','8.10','A')");
mysql_query("insert into score values('','1','".$user_count."','4','3','4.95','A')");


mysql_query("insert into score values('','1','".$user_count."','0','1','6.81','Sam seems like a go-to guy who does well academically, is taking engineering classes and has family experience in engineering. Adam is a middle road guy who doesnppt excel at what he does but isnppt terrible either. A little more extra effort would help Adam become a more likely candidate. Jim is likely in second behind Sam, as he has ambitions to study engineering, but isnppt quite there yet. Jim is dedicated though.')");
mysql_query("insert into score values('','1','".$user_count."','0','2','4.39','A')");
mysql_query("insert into score values('','1','".$user_count."','0','3','6.55','A')");







mysql_query("insert into user values ('','".$user_name3."','".$user_email3."','".md5($password)."') ");


$sql_count = "select count(*) from user ";
$result_count = mysql_query($sql_count);
$row_count = mysql_fetch_array( $result_count );
$user_count = $row_count[0];




mysql_query("insert into participate values('','1','".$user_count."','".$user_count."')");

mysql_query("update decision set user_num = user_num + 1 where id = '1'");

mysql_query("insert into score values('','1','".$user_count."','1','1','1.65','ABC')");
mysql_query("insert into score values('','1','".$user_count."','2','1','7.35','A')");
mysql_query("insert into score values('','1','".$user_count."','3','1','3.75','A')");
mysql_query("insert into score values('','1','".$user_count."','4','1','2.05','A')");
mysql_query("insert into score values('','1','".$user_count."','1','2','7.40','A')");
mysql_query("insert into score values('','1','".$user_count."','2','2','4.10','A')");
mysql_query("insert into score values('','1','".$user_count."','3','2','5.30','A')");
mysql_query("insert into score values('','1','".$user_count."','4','2','6.62','A')");
mysql_query("insert into score values('','1','".$user_count."','1','3','8.60','A')");
mysql_query("insert into score values('','1','".$user_count."','2','3','8.68','A')");
mysql_query("insert into score values('','1','".$user_count."','3','3','6.20','A')");
mysql_query("insert into score values('','1','".$user_count."','4','3','8.05','A')");


mysql_query("insert into score values('','1','".$user_count."','0','1','3.70','Given the information provided I believe that I made the best decision possible... I believe that the choices I made for each are good and that they show a clear picture when you compare them with the information that was provided in the prior part of this survey, and I would not change how I have chosen to rate them. ')");
mysql_query("insert into score values('','1','".$user_count."','0','2','5.86','A')");
mysql_query("insert into score values('','1','".$user_count."','0','3','7.88','A')");





mysql_query("insert into user values ('','".$user_name4."','".$user_email4."','".md5($password)."') ");


$sql_count = "select count(*) from user ";
$result_count = mysql_query($sql_count);
$row_count = mysql_fetch_array( $result_count );
$user_count = $row_count[0];




mysql_query("insert into participate values('','1','".$user_count."','".$user_count."')");

mysql_query("update decision set user_num = user_num + 1 where id = '1'");

mysql_query("insert into score values('','1','".$user_count."','1','1','8.99','ABC')");
mysql_query("insert into score values('','1','".$user_count."','2','1','8.03','A')");
mysql_query("insert into score values('','1','".$user_count."','3','1','6.03','A')");
mysql_query("insert into score values('','1','".$user_count."','4','1','6.48','A')");
mysql_query("insert into score values('','1','".$user_count."','1','2','7.00','A')");
mysql_query("insert into score values('','1','".$user_count."','2','2','5.97','A')");
mysql_query("insert into score values('','1','".$user_count."','3','2','4.00','A')");
mysql_query("insert into score values('','1','".$user_count."','4','2','7.50','A')");
mysql_query("insert into score values('','1','".$user_count."','1','3','8.47','A')");
mysql_query("insert into score values('','1','".$user_count."','2','3','7.04','A')");
mysql_query("insert into score values('','1','".$user_count."','3','3','8.03','A')");
mysql_query("insert into score values('','1','".$user_count."','4','3','8.03','A')");


mysql_query("insert into score values('','1','".$user_count."','0','1','7.38','Based on academic criteria, Sam Smith is the most qualified candidate, followed by Jim Jones and Adam Adams. Adam Adamspps recommendation letter is not particularly useful because his intern manager does not communicate much about Adampps strengths. Similarly, while Sam Smith received a glowing recommendation from his drama teacher, we want to know how heppd fare in an engineering course. Finally, in terms of program fit, both Jones and Smith are appropriate for the engineering program, but Jones edges Smith because Jones actually intends to major in a math related field whereas Smith is undecided. ')");
mysql_query("insert into score values('','1','".$user_count."','0','2','6.12','A')");
mysql_query("insert into score values('','1','".$user_count."','0','3','7.89','A')");



mysql_query("insert into user values ('','".$user_name5."','".$user_email5."','".md5($password)."') ");


$sql_count = "select count(*) from user ";
$result_count = mysql_query($sql_count);
$row_count = mysql_fetch_array( $result_count );
$user_count = $row_count[0];




mysql_query("insert into participate values('','1','".$user_count."','".$user_count."')");

mysql_query("update decision set user_num = user_num + 1 where id = '1'");

mysql_query("insert into score values('','1','".$user_count."','1','1','8.97','ABC')");
mysql_query("insert into score values('','1','".$user_count."','2','1','9.00','A')");
mysql_query("insert into score values('','1','".$user_count."','3','1','4.12','A')");
mysql_query("insert into score values('','1','".$user_count."','4','1','6.15','A')");
mysql_query("insert into score values('','1','".$user_count."','1','2','7.02','A')");
mysql_query("insert into score values('','1','".$user_count."','2','2','7.95','A')");
mysql_query("insert into score values('','1','".$user_count."','3','2','5.70','A')");
mysql_query("insert into score values('','1','".$user_count."','4','2','7.87','A')");
mysql_query("insert into score values('','1','".$user_count."','1','3','8.00','A')");
mysql_query("insert into score values('','1','".$user_count."','2','3','6.95','A')");
mysql_query("insert into score values('','1','".$user_count."','3','3','8.93','A')");
mysql_query("insert into score values('','1','".$user_count."','4','3','8.62','A')");


mysql_query("insert into score values('','1','".$user_count."','0','1','7.06','Starting with Sam, while the SAT, and GPA are good, the biggest drawback to the student is that the only recommendation is for acting, the suspension shows lack of discipline when oversight is relaxed. Adam did win first place in the annual statewide science fair, and does have – albeit very vague - does have a letter of recommendation. Adam is in many ways similar to Sam. Jim has a very strong math focus, took classes for the local community college during summer, won math competition, and has two letters of recommendation one of which is from a math professor.')");
mysql_query("insert into score values('','1','".$user_count."','0','2','7.13','A')");
mysql_query("insert into score values('','1','".$user_count."','0','3','8,12','A')");




mysql_query("insert into user values ('','".$user_name6."','".$user_email6."','".md5($password)."') ");


$sql_count = "select count(*) from user ";
$result_count = mysql_query($sql_count);
$row_count = mysql_fetch_array( $result_count );
$user_count = $row_count[0];




mysql_query("insert into participate values('','1','".$user_count."','".$user_count."')");

mysql_query("update decision set user_num = user_num + 1 where id = '1'");

mysql_query("insert into score values('','1','".$user_count."','1','1','9.35','ABC')");
mysql_query("insert into score values('','1','".$user_count."','2','1','3.48','A')");
mysql_query("insert into score values('','1','".$user_count."','3','1','3.02','A')");
mysql_query("insert into score values('','1','".$user_count."','4','1','8.95','A')");
mysql_query("insert into score values('','1','".$user_count."','1','2','6.70','A')");
mysql_query("insert into score values('','1','".$user_count."','2','2','3.35','A')");
mysql_query("insert into score values('','1','".$user_count."','3','2','3.00','A')");
mysql_query("insert into score values('','1','".$user_count."','4','2','7.10','A')");
mysql_query("insert into score values('','1','".$user_count."','1','3','7.93','A')");
mysql_query("insert into score values('','1','".$user_count."','2','3','3.60','A')");
mysql_query("insert into score values('','1','".$user_count."','3','3','9.43','A')");
mysql_query("insert into score values('','1','".$user_count."','4','3','8.90','A')");


mysql_query("insert into score values('','1','".$user_count."','0','1','6.20','Sam did very well with everything provided to him in life. He has probably not had to give as much effort. Jim did will with much less and has clearly put in lots of personal effort, also his references are encouraging and I would tend to believe them, Adam finishes third in sat and is generally the most mediocre of the three. ')");
mysql_query("insert into score values('','1','".$user_count."','0','2','5.04','A')");
mysql_query("insert into score values('','1','".$user_count."','0','3','7.46','A')");










mysql_query("insert into user values ('','".$user_name7."','".$user_email7."','".md5($password)."') ");


$sql_count = "select count(*) from user ";
$result_count = mysql_query($sql_count);
$row_count = mysql_fetch_array( $result_count );
$user_count = $row_count[0];




mysql_query("insert into participate values('','1','".$user_count."','".$user_count."')");

mysql_query("update decision set user_num = user_num + 1 where id = '1'");

mysql_query("insert into score values('','1','".$user_count."','1','1','9.93','ABC')");
mysql_query("insert into score values('','1','".$user_count."','2','1','8.35','A')");
mysql_query("insert into score values('','1','".$user_count."','3','1','7.46','A')");
mysql_query("insert into score values('','1','".$user_count."','4','1','9.08','A')");
mysql_query("insert into score values('','1','".$user_count."','1','2','8.45','A')");
mysql_query("insert into score values('','1','".$user_count."','2','2','8.95','A')");
mysql_query("insert into score values('','1','".$user_count."','3','2','8.82','A')");
mysql_query("insert into score values('','1','".$user_count."','4','2','8.20','A')");
mysql_query("insert into score values('','1','".$user_count."','1','3','8.78','A')");
mysql_query("insert into score values('','1','".$user_count."','2','3','9.43','A')");
mysql_query("insert into score values('','1','".$user_count."','3','3','9.62','A')");
mysql_query("insert into score values('','1','".$user_count."','4','3','8.93','A')");


mysql_query("insert into score values('','1','".$user_count."','0','1','8.70','When I was judging the candidates I put into perspective the academic status first as well as extra curricular activities that showpps the individuals private life and interestpps. Overall I felt that those two catagories were the most important in assessing the potential for the job. Candidate A and C were very strong overall in categories I felt like that would translate to success in the position.')");
mysql_query("insert into score values('','1','".$user_count."','0','2','8.61','A')");
mysql_query("insert into score values('','1','".$user_count."','0','3','9.19','A')");








mysql_query("insert into user values ('','".$user_name8."','".$user_email8."','".md5($password)."') ");


$sql_count = "select count(*) from user ";
$result_count = mysql_query($sql_count);
$row_count = mysql_fetch_array( $result_count );
$user_count = $row_count[0];




mysql_query("insert into participate values('','1','".$user_count."','".$user_count."')");

mysql_query("update decision set user_num = user_num + 1 where id = '1'");

mysql_query("insert into score values('','1','".$user_count."','1','1','7.35','ABC')");
mysql_query("insert into score values('','1','".$user_count."','2','1','5.38','A')");
mysql_query("insert into score values('','1','".$user_count."','3','1','4.67','A')");
mysql_query("insert into score values('','1','".$user_count."','4','1','6.72','A')");
mysql_query("insert into score values('','1','".$user_count."','1','2','2.94','A')");
mysql_query("insert into score values('','1','".$user_count."','2','2','3.66','A')");
mysql_query("insert into score values('','1','".$user_count."','3','2','4.67','A')");
mysql_query("insert into score values('','1','".$user_count."','4','2','3.08','A')");
mysql_query("insert into score values('','1','".$user_count."','1','3','6.35','A')");
mysql_query("insert into score values('','1','".$user_count."','2','3','8.51','A')");
mysql_query("insert into score values('','1','".$user_count."','3','3','8.65','A')");
mysql_query("insert into score values('','1','".$user_count."','4','3','8.57','A')");


mysql_query("insert into score values('','1','".$user_count."','0','1','6.03','According to the information provided, it looked like Sam has a drinking behavior problem and I didnppt think his drama teacher recommendation is that relevant. I donppt think there was enough information about Adam to really make a good call, I feel like I donppt have a good sense about him at all. Adampps profile looked a little sparse to me. and Jim had the best in terms of recommendations and his lack of drinking and suspension. While itpps true that Sam has high SAT scores, I donppt get the sense that he is a very responsible or mature person.')");
mysql_query("insert into score values('','1','".$user_count."','0','2','3.59','A')");
mysql_query("insert into score values('','1','".$user_count."','0','3','8.02','A')");









mysql_query("insert into user values ('','".$user_name9."','".$user_email9."','".md5($password)."') ");


$sql_count = "select count(*) from user ";
$result_count = mysql_query($sql_count);
$row_count = mysql_fetch_array( $result_count );
$user_count = $row_count[0];




mysql_query("insert into participate values('','1','".$user_count."','".$user_count."')");

mysql_query("update decision set user_num = user_num + 1 where id = '1'");

mysql_query("insert into score values('','1','".$user_count."','1','1','9.35','ABC')");
mysql_query("insert into score values('','1','".$user_count."','2','1','3.48','A')");
mysql_query("insert into score values('','1','".$user_count."','3','1','3.02','A')");
mysql_query("insert into score values('','1','".$user_count."','4','1','8.95','A')");
mysql_query("insert into score values('','1','".$user_count."','1','2','6.70','A')");
mysql_query("insert into score values('','1','".$user_count."','2','2','3.35','A')");
mysql_query("insert into score values('','1','".$user_count."','3','2','3.00','A')");
mysql_query("insert into score values('','1','".$user_count."','4','2','7.10','A')");
mysql_query("insert into score values('','1','".$user_count."','1','3','7.93','A')");
mysql_query("insert into score values('','1','".$user_count."','2','3','3.60','A')");
mysql_query("insert into score values('','1','".$user_count."','3','3','9.43','A')");
mysql_query("insert into score values('','1','".$user_count."','4','3','8.90','A')");


mysql_query("insert into score values('','1','".$user_count."','0','1','6.20','Sam did very well with everything provided to him in life. He has probably not had to give as much effort. Jim did will with much less and has clearly put in lots of personal effort, also his references are encouraging and I would tend to believe them, Adam finishes third in sat and is generally the most mediocre of the three. ')");
mysql_query("insert into score values('','1','".$user_count."','0','2','5.04','A')");
mysql_query("insert into score values('','1','".$user_count."','0','3','7.46','A')");










mysql_query("insert into user values ('','".$user_name10."','".$user_email10."','".md5($password)."') ");


$sql_count = "select count(*) from user ";
$result_count = mysql_query($sql_count);
$row_count = mysql_fetch_array( $result_count );
$user_count = $row_count[0];




mysql_query("insert into participate values('','1','".$user_count."','".$user_count."')");

mysql_query("update decision set user_num = user_num + 1 where id = '1'");

mysql_query("insert into score values('','1','".$user_count."','1','1','9.35','ABC')");
mysql_query("insert into score values('','1','".$user_count."','2','1','3.48','A')");
mysql_query("insert into score values('','1','".$user_count."','3','1','3.02','A')");
mysql_query("insert into score values('','1','".$user_count."','4','1','8.95','A')");
mysql_query("insert into score values('','1','".$user_count."','1','2','6.70','A')");
mysql_query("insert into score values('','1','".$user_count."','2','2','3.35','A')");
mysql_query("insert into score values('','1','".$user_count."','3','2','3.00','A')");
mysql_query("insert into score values('','1','".$user_count."','4','2','7.10','A')");
mysql_query("insert into score values('','1','".$user_count."','1','3','7.93','A')");
mysql_query("insert into score values('','1','".$user_count."','2','3','3.60','A')");
mysql_query("insert into score values('','1','".$user_count."','3','3','9.43','A')");
mysql_query("insert into score values('','1','".$user_count."','4','3','8.90','A')");


mysql_query("insert into score values('','1','".$user_count."','0','1','6.20','Sam did very well with everything provided to him in life. He has probably not had to give as much effort. Jim did will with much less and has clearly put in lots of personal effort, also his references are encouraging and I would tend to believe them, Adam finishes third in sat and is generally the most mediocre of the three. ')");
mysql_query("insert into score values('','1','".$user_count."','0','2','5.04','A')");
mysql_query("insert into score values('','1','".$user_count."','0','3','7.46','A')");







?>


<!-- jQuery -->
<meta http-equiv=refresh content="0.00005; url=control_panel.php">

</body>

</html>
