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

$user_name = "Tori";
$user_email = "tori@ucsd.edu";
$password = "1234";
$participant_num = 5;





$user_name2 = "Mary";
$user_email2 = "Mary@ucsd.edu";

$user_name3 = "Samantha";
$user_email3 = "Samantha@ucsd.edu";

$user_name4 = "Kevin";
$user_email4 = "Rose@ucsd.edu";

$user_name5 = "John";
$user_email5 = "John@ucsd.edu";

$user_name6 = "Peter";
$user_email6 = "Peter@ucsd.edu";

$user_name7 = "Kim";
$user_email7 = "Kim@ucsd.edu";
$user_name8 = "Amy";
$user_email8 = "Amy@ucsd.edu";
$user_name9 = "Matt";
$user_email9 = "matt@ucsd.edu";
$user_name10 = "Slerra";
$user_email10 = "Slerra@ucsd.edu";
$user_name11 = "Haley";
$user_email11 = "Haley@ucsd.edu";
$user_name12 = "Wesley";
$user_email12 = "Wesley@ucsd.edu";
$user_name13 = "Tom";
$user_email13 = "Tom@ucsd.edu";







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

mysql_query("insert into score values('','1','".$user_count."','1','1','9.00','ABC')");
mysql_query("insert into score values('','1','".$user_count."','2','1','9.38','A')");
mysql_query("insert into score values('','1','".$user_count."','3','1','5.38','A')");
mysql_query("insert into score values('','1','".$user_count."','4','1','9.20','A')");
mysql_query("insert into score values('','1','".$user_count."','1','2','5.20','A')");
mysql_query("insert into score values('','1','".$user_count."','2','2','8.43','A')");
mysql_query("insert into score values('','1','".$user_count."','3','2','6.65','A')");
mysql_query("insert into score values('','1','".$user_count."','4','2','8.07','A')");
mysql_query("insert into score values('','1','".$user_count."','1','3','7.77','A')");
mysql_query("insert into score values('','1','".$user_count."','2','3','4.50','A')");
mysql_query("insert into score values('','1','".$user_count."','3','3','8.43','A')");
mysql_query("insert into score values('','1','".$user_count."','4','3','6.28','A')");


mysql_query("insert into score values('','1','".$user_count."','0','1','8.24','I think that overall, Sam had the best academics, activities and overall commitment to engineering. His team won the first award in a innovation challenge that is highly related to engineering abilities. Adam came in second because of his strong commitment to engineering (working over the summer at an engineering firm and being a leading member of the engineering club). Jim came in last because he has not shown a strong commitment to engineering or academics (handing in his assignments late). ')");
mysql_query("insert into score values('','1','".$user_count."','0','2','7.09','A')");
mysql_query("insert into score values('','1','".$user_count."','0','3','6.75','A')");







mysql_query("insert into user values ('','".$user_name3."','".$user_email3."','".md5($password)."') ");


$sql_count = "select count(*) from user ";
$result_count = mysql_query($sql_count);
$row_count = mysql_fetch_array( $result_count );
$user_count = $row_count[0];




mysql_query("insert into participate values('','1','".$user_count."','".$user_count."')");

mysql_query("update decision set user_num = user_num + 1 where id = '1'");

mysql_query("insert into score values('','1','".$user_count."','1','1','9.65','ABC')");
mysql_query("insert into score values('','1','".$user_count."','2','1','9.30','A')");
mysql_query("insert into score values('','1','".$user_count."','3','1','7.15','A')");
mysql_query("insert into score values('','1','".$user_count."','4','1','9.25','A')");
mysql_query("insert into score values('','1','".$user_count."','1','2','8.07','A')");
mysql_query("insert into score values('','1','".$user_count."','2','2','8.45','A')");
mysql_query("insert into score values('','1','".$user_count."','3','2','6.50','A')");
mysql_query("insert into score values('','1','".$user_count."','4','2','7.20','A')");
mysql_query("insert into score values('','1','".$user_count."','1','3','8.75','A')");
mysql_query("insert into score values('','1','".$user_count."','2','3','2.64','A')");
mysql_query("insert into score values('','1','".$user_count."','3','3','7.75','A')");
mysql_query("insert into score values('','1','".$user_count."','4','3','6.05','A')");


mysql_query("insert into score values('','1','".$user_count."','0','1','8.84',' Sam has the best academic, extracurricular and recommendations for the program. I think he would be a better fit given his skills, grades, and letters. Adam comes in next with solid academic grades and GPA. His activities reflect the experience he has. Jim has a less than stellar GPA, and the activities reflect he could improve his attitude regarding volunteering and work behaviors. The letter of recommendation helped him a lot -- he was highly praised by his high school principal saying that he is a hard working student. ')");
mysql_query("insert into score values('','1','".$user_count."','0','2','7.55','A')");
mysql_query("insert into score values('','1','".$user_count."','0','3','6.03','A')");





mysql_query("insert into user values ('','".$user_name4."','".$user_email4."','".md5($password)."') ");


$sql_count = "select count(*) from user ";
$result_count = mysql_query($sql_count);
$row_count = mysql_fetch_array( $result_count );
$user_count = $row_count[0];




mysql_query("insert into participate values('','1','".$user_count."','".$user_count."')");

mysql_query("update decision set user_num = user_num + 1 where id = '1'");

mysql_query("insert into score values('','1','".$user_count."','1','1','5.70','ABC')");
mysql_query("insert into score values('','1','".$user_count."','2','1','9.07','A')");
mysql_query("insert into score values('','1','".$user_count."','3','1','7.50','A')");
mysql_query("insert into score values('','1','".$user_count."','4','1','8.13','A')");
mysql_query("insert into score values('','1','".$user_count."','1','2','4.17','A')");
mysql_query("insert into score values('','1','".$user_count."','2','2','7.42','A')");
mysql_query("insert into score values('','1','".$user_count."','3','2','4.30','A')");
mysql_query("insert into score values('','1','".$user_count."','4','2','5.70','A')");
mysql_query("insert into score values('','1','".$user_count."','1','3','6.90','A')");
mysql_query("insert into score values('','1','".$user_count."','2','3','4.15','A')");
mysql_query("insert into score values('','1','".$user_count."','3','3','8.40','A')");
mysql_query("insert into score values('','1','".$user_count."','4','3','8.10','A')");


mysql_query("insert into score values('','1','".$user_count."','0','1','7.60','Adam has the lowest gpa and SAT scores and his recommendation letter is short which might signal that the person writing it for him did not have much good to say about him. Sam has a slight advantage due to higher scores and more activity involvement. However, he comes from a private school  and might have gotten more support than Jim. Jim did very well in terms of gpa and scores. His lack of activity involvement is a red flag but maybe there may be justifiable reasons. Sam is the most suitable but Jim should be given a chance.')");
mysql_query("insert into score values('','1','".$user_count."','0','2','5.40','A')");
mysql_query("insert into score values('','1','".$user_count."','0','3','6.89','A')");



mysql_query("insert into user values ('','".$user_name5."','".$user_email5."','".md5($password)."') ");


$sql_count = "select count(*) from user ";
$result_count = mysql_query($sql_count);
$row_count = mysql_fetch_array( $result_count );
$user_count = $row_count[0];




mysql_query("insert into participate values('','1','".$user_count."','".$user_count."')");

mysql_query("update decision set user_num = user_num + 1 where id = '1'");

mysql_query("insert into score values('','1','".$user_count."','1','1','8.63','ABC')");
mysql_query("insert into score values('','1','".$user_count."','2','1','9.22','A')");
mysql_query("insert into score values('','1','".$user_count."','3','1','7.47','A')");
mysql_query("insert into score values('','1','".$user_count."','4','1','8.07','A')");
mysql_query("insert into score values('','1','".$user_count."','1','2','5.66','A')");
mysql_query("insert into score values('','1','".$user_count."','2','2','4.02','A')");
mysql_query("insert into score values('','1','".$user_count."','3','2','0.70','A')");
mysql_query("insert into score values('','1','".$user_count."','4','2','2.60','A')");
mysql_query("insert into score values('','1','".$user_count."','1','3','7.70','A')");
mysql_query("insert into score values('','1','".$user_count."','2','3','2.45','A')");
mysql_query("insert into score values('','1','".$user_count."','3','3','5.03','A')");
mysql_query("insert into score values('','1','".$user_count."','4','3','6.72','A')");


mysql_query("insert into score values('','1','".$user_count."','0','1','8.35',' In terms of academics, Sam is, by far, the best of the three. Jim isnppt too far behind and Adam has good (but not great) grades. I rated Sam highly on activities as he is active in his schoolpps football team. Adam and Jim donppt seem to be all that active. As for recommendations, Jim is mixed, Sam get high marks, and Adam having no recommendations to speak of. I think Sam is highly fit for the programs because he is also taking some STEM related AP courses, with Jim being a reasonably close second. Adam, I feel, is not suited for this program. ')");
mysql_query("insert into score values('','1','".$user_count."','0','2','3.25','A')");
mysql_query("insert into score values('','1','".$user_count."','0','3','5.47','A')");




mysql_query("insert into user values ('','".$user_name6."','".$user_email6."','".md5($password)."') ");


$sql_count = "select count(*) from user ";
$result_count = mysql_query($sql_count);
$row_count = mysql_fetch_array( $result_count );
$user_count = $row_count[0];




mysql_query("insert into participate values('','1','".$user_count."','".$user_count."')");

mysql_query("update decision set user_num = user_num + 1 where id = '1'");

mysql_query("insert into score values('','1','".$user_count."','1','1','3.55','ABC')");
mysql_query("insert into score values('','1','".$user_count."','2','1','1.88','A')");
mysql_query("insert into score values('','1','".$user_count."','3','1','2.38','A')");
mysql_query("insert into score values('','1','".$user_count."','4','1','0.85','A')");
mysql_query("insert into score values('','1','".$user_count."','1','2','7.23','A')");
mysql_query("insert into score values('','1','".$user_count."','2','2','8.58','A')");
mysql_query("insert into score values('','1','".$user_count."','3','2','0.85','A')");
mysql_query("insert into score values('','1','".$user_count."','4','2','9.15','A')");
mysql_query("insert into score values('','1','".$user_count."','1','3','5.33','A')");
mysql_query("insert into score values('','1','".$user_count."','2','3','4.50','A')");
mysql_query("insert into score values('','1','".$user_count."','3','3','8.12','A')");
mysql_query("insert into score values('','1','".$user_count."','4','3','4.90','A')");


mysql_query("insert into score values('','1','".$user_count."','0','1','2.17','I based it on activities, interests, and background. Sam does not have any engineering background or interests. Adam has interests and experience in engineering. Jim is good at math but not specifically interested or experienced in engineering.  Overall, Adam seems like the best candidate, while Jim seems second best and Sam seems least. Sam seems to have good qualities that are a better fit for a different ')");
mysql_query("insert into score values('','1','".$user_count."','0','2','6.45','A')");
mysql_query("insert into score values('','1','".$user_count."','0','3','5.71','A')");







mysql_query("insert into user values ('','".$user_name7."','".$user_email7."','".md5($password)."') ");


$sql_count = "select count(*) from user ";
$result_count = mysql_query($sql_count);
$row_count = mysql_fetch_array( $result_count );
$user_count = $row_count[0];




mysql_query("insert into participate values('','1','".$user_count."','".$user_count."')");

mysql_query("update decision set user_num = user_num + 1 where id = '1'");

mysql_query("insert into score values('','1','".$user_count."','1','1','9.62','ABC')");
mysql_query("insert into score values('','1','".$user_count."','2','1','8.12','A')");
mysql_query("insert into score values('','1','".$user_count."','3','1','8.47','A')");
mysql_query("insert into score values('','1','".$user_count."','4','1','9.62','A')");
mysql_query("insert into score values('','1','".$user_count."','1','2','8.95','A')");
mysql_query("insert into score values('','1','".$user_count."','2','2','9.25','A')");
mysql_query("insert into score values('','1','".$user_count."','3','2','9.47','A')");
mysql_query("insert into score values('','1','".$user_count."','4','2','8.55','A')");
mysql_query("insert into score values('','1','".$user_count."','1','3','6.80','A')");
mysql_query("insert into score values('','1','".$user_count."','2','3','6.03','A')");
mysql_query("insert into score values('','1','".$user_count."','3','3','5.62','A')");
mysql_query("insert into score values('','1','".$user_count."','4','3','4.78','A')");


mysql_query("insert into score values('','1','".$user_count."','0','1','8.96','Sam and Adam seem to be the most well rounded students that will be successful in the college.  They have the most drive and determination to work at their careers.  Sam seems to be the best fit based on his grades and SAT scores.  Adam doesnppt have the grades and SAT like the other two, but he seemed to take engineering seriously with his extracurricular activities.  Jim Jones lack the drive and could fail in college based on his lack of interest in taking courses. ')");
mysql_query("insert into score values('','1','".$user_count."','0','2','9.05','A')");
mysql_query("insert into score values('','1','".$user_count."','0','3','5.81','A')");






mysql_query("insert into user values ('','".$user_name8."','".$user_email8."','".md5($password)."') ");


$sql_count = "select count(*) from user ";
$result_count = mysql_query($sql_count);
$row_count = mysql_fetch_array( $result_count );
$user_count = $row_count[0];




mysql_query("insert into participate values('','1','".$user_count."','".$user_count."')");

mysql_query("update decision set user_num = user_num + 1 where id = '1'");

mysql_query("insert into score values('','1','".$user_count."','1','1','8.97','ABC')");
mysql_query("insert into score values('','1','".$user_count."','2','1','8.97','A')");
mysql_query("insert into score values('','1','".$user_count."','3','1','5.00','A')");
mysql_query("insert into score values('','1','".$user_count."','4','1','5.03','A')");
mysql_query("insert into score values('','1','".$user_count."','1','2','8.50','A')");
mysql_query("insert into score values('','1','".$user_count."','2','2','10.00','A')");
mysql_query("insert into score values('','1','".$user_count."','3','2','10.00','A')");
mysql_query("insert into score values('','1','".$user_count."','4','2','8.97','A')");
mysql_query("insert into score values('','1','".$user_count."','1','3','8.70','A')");
mysql_query("insert into score values('','1','".$user_count."','2','3','8.00','A')");
mysql_query("insert into score values('','1','".$user_count."','3','3','9.00','A')");
mysql_query("insert into score values('','1','".$user_count."','4','3','7.95','A')");


mysql_query("insert into score values('','1','".$user_count."','0','1','6.99','Adam might have slightly lower academic scores than the other two but he has done an internship at an engineering firm and has a really nice recommendation letter.  He seems to fit the program better than the others.  Jim has a good transcript but is lacking in activities because he really has nothing other than his home life.  Sam is the worst candidate because his recommendation and activities have very little to do with engineering.  Why would you get a drama teacher to give you a recommendation for engineering school?  ')");
mysql_query("insert into score values('','1','".$user_count."','0','2','9.37','A')");
mysql_query("insert into score values('','1','".$user_count."','0','3','8.41','A')");








mysql_query("insert into user values ('','".$user_name9."','".$user_email9."','".md5($password)."') ");


$sql_count = "select count(*) from user ";
$result_count = mysql_query($sql_count);
$row_count = mysql_fetch_array( $result_count );
$user_count = $row_count[0];




mysql_query("insert into participate values('','1','".$user_count."','".$user_count."')");

mysql_query("update decision set user_num = user_num + 1 where id = '1'");

mysql_query("insert into score values('','1','".$user_count."','1','1','8.75','ABC')");
mysql_query("insert into score values('','1','".$user_count."','2','1','5.12','A')");
mysql_query("insert into score values('','1','".$user_count."','3','1','3.42','A')");
mysql_query("insert into score values('','1','".$user_count."','4','1','4.50','A')");
mysql_query("insert into score values('','1','".$user_count."','1','2','6.58','A')");
mysql_query("insert into score values('','1','".$user_count."','2','2','9.26','A')");
mysql_query("insert into score values('','1','".$user_count."','3','2','5.39','A')");
mysql_query("insert into score values('','1','".$user_count."','4','2','9.70','A')");
mysql_query("insert into score values('','1','".$user_count."','1','3','7.67','A')");
mysql_query("insert into score values('','1','".$user_count."','2','3','4.17','A')");
mysql_query("insert into score values('','1','".$user_count."','3','3','7.22','A')");
mysql_query("insert into score values('','1','".$user_count."','4','3','7.70','A')");


mysql_query("insert into score values('','1','".$user_count."','0','1','5.45','I chose Adam because he seems the best fit for an engineering program. Both his parents are engineers so they can help him learn in the field and he is also a leading member of the engineering club…His school also has a tough grading policy. He also has worked at engineering firms. Sam got drunk and seems reckless for an Engineering program. Also, Jim is okay but Adam is the best for an engineering program.

')");
mysql_query("insert into score values('','1','".$user_count."','0','2','7.73','A')");
mysql_query("insert into score values('','1','".$user_count."','0','3','6.69','A')");










mysql_query("insert into user values ('','".$user_name10."','".$user_email10."','".md5($password)."') ");


$sql_count = "select count(*) from user ";
$result_count = mysql_query($sql_count);
$row_count = mysql_fetch_array( $result_count );
$user_count = $row_count[0];




mysql_query("insert into participate values('','1','".$user_count."','".$user_count."')");

mysql_query("update decision set user_num = user_num + 1 where id = '1'");

mysql_query("insert into score values('','1','".$user_count."','1','1','7.52','ABC')");
mysql_query("insert into score values('','1','".$user_count."','2','1','6.83','A')");
mysql_query("insert into score values('','1','".$user_count."','3','1','6.03','A')");
mysql_query("insert into score values('','1','".$user_count."','4','1','6.85','A')");
mysql_query("insert into score values('','1','".$user_count."','1','2','5.03','A')");
mysql_query("insert into score values('','1','".$user_count."','2','2','8.02','A')");
mysql_query("insert into score values('','1','".$user_count."','3','2','5.03','A')");
mysql_query("insert into score values('','1','".$user_count."','4','2','6.11','A')");
mysql_query("insert into score values('','1','".$user_count."','1','3','7.03','A')");
mysql_query("insert into score values('','1','".$user_count."','2','3','5.03','A')");
mysql_query("insert into score values('','1','".$user_count."','3','3','9.00','A')");
mysql_query("insert into score values('','1','".$user_count."','4','3','7.65','A')");


mysql_query("insert into score values('','1','".$user_count."','0','1','6.81','Jim seems to most align with the STEM field in general and he got good recommendation from his principal, Sam seems like they would do well if they decide to follow through in it, and Adam seems like hepps following his parents. Sam is the most suitable in gpa and test scores, though Jim shows the most potential. Adam, on the other hand, is wholly average and uninspiring for the rigors of engineering. In terms of recommendation, Jim has the most personal and relevant information, Sam merely has personal appraisal outside the field, and Adam merely exists on a trend from the school itself.')");
mysql_query("insert into score values('','1','".$user_count."','0','2','6.05','A')");
mysql_query("insert into score values('','1','".$user_count."','0','3','7.18','A')");











mysql_query("insert into user values ('','".$user_name11."','".$user_email11."','".md5($password)."') ");


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


mysql_query("insert into score values('','1','".$user_count."','0','1','7.06','Starting with Sam, while the SAT, and GPA are good, the biggest drawback to the student is that the only recommendation is for acting, the suspension shows lack of discipline when oversight is relaxed. Adam did win first place in the annual statewide science fair, and does have _ albeit very vague - does have a letter of recommendation. Adam is in many ways similar to Sam. Jim has a very strong math focus, took classes for the local community college during summer, won math competition, and has two letters of recommendation one of which is from a math professor. ')");
mysql_query("insert into score values('','1','".$user_count."','0','2','7.13','A')");
mysql_query("insert into score values('','1','".$user_count."','0','3','8.12','A')");











mysql_query("insert into user values ('','".$user_name12."','".$user_email12."','".md5($password)."') ");


$sql_count = "select count(*) from user ";
$result_count = mysql_query($sql_count);
$row_count = mysql_fetch_array( $result_count );
$user_count = $row_count[0];




mysql_query("insert into participate values('','1','".$user_count."','".$user_count."')");

mysql_query("update decision set user_num = user_num + 1 where id = '1'");

mysql_query("insert into score values('','1','".$user_count."','1','1','8.89','ABC')");
mysql_query("insert into score values('','1','".$user_count."','2','1','8.75','A')");
mysql_query("insert into score values('','1','".$user_count."','3','1','3.00','A')");
mysql_query("insert into score values('','1','".$user_count."','4','1','7.50','A')");
mysql_query("insert into score values('','1','".$user_count."','1','2','6.11','A')");
mysql_query("insert into score values('','1','".$user_count."','2','2','8.10','A')");
mysql_query("insert into score values('','1','".$user_count."','3','2','5.96','A')");
mysql_query("insert into score values('','1','".$user_count."','4','2','6.01','A')");
mysql_query("insert into score values('','1','".$user_count."','1','3','7.83','A')");
mysql_query("insert into score values('','1','".$user_count."','2','3','6.78','A')");
mysql_query("insert into score values('','1','".$user_count."','3','3','7.47','A')");
mysql_query("insert into score values('','1','".$user_count."','4','3','8.49','A')");


mysql_query("insert into score values('','1','".$user_count."','0','1','7.04','Sam had the best academic scores and showed aptitude for engineering in his science project, however hepps unsure if he wants to go down that path. Adam came from an engineering background but his academic scores was weak. He also got very short recommendation letters from his employer of his summer interns. He seemed unfocused and lacked initiative(no AP/college course taken). Jim was in the middle of pack in term of academic performance. He was open to any fields related to engineering. His teacher was very high on his work ethics. Jim also came from a single parent family and probably had to overcome obstacles other students might not have to deal with.')");
mysql_query("insert into score values('','1','".$user_count."','0','2','6.54','A')");
mysql_query("insert into score values('','1','".$user_count."','0','3','7.64','A')");











mysql_query("insert into user values ('','".$user_name13."','".$user_email13."','".md5($password)."') ");


$sql_count = "select count(*) from user ";
$result_count = mysql_query($sql_count);
$row_count = mysql_fetch_array( $result_count );
$user_count = $row_count[0];




mysql_query("insert into participate values('','1','".$user_count."','".$user_count."')");

mysql_query("update decision set user_num = user_num + 1 where id = '1'");

mysql_query("insert into score values('','1','".$user_count."','1','1','8.49','ABC')");
mysql_query("insert into score values('','1','".$user_count."','2','1','6.00','A')");
mysql_query("insert into score values('','1','".$user_count."','3','1','5.03','A')");
mysql_query("insert into score values('','1','".$user_count."','4','1','7.51','A')");
mysql_query("insert into score values('','1','".$user_count."','1','2','6.65','A')");
mysql_query("insert into score values('','1','".$user_count."','2','2','8.02','A')");
mysql_query("insert into score values('','1','".$user_count."','3','2','3.52','A')");
mysql_query("insert into score values('','1','".$user_count."','4','2','6.00','A')");
mysql_query("insert into score values('','1','".$user_count."','1','3','7.50','A')");
mysql_query("insert into score values('','1','".$user_count."','2','3','7.00','A')");
mysql_query("insert into score values('','1','".$user_count."','3','3','7.95','A')");
mysql_query("insert into score values('','1','".$user_count."','4','3','8.01','A')");


mysql_query("insert into score values('','1','".$user_count."','0','1','6.76','Adam has not taken any AP or college level courses. His recommendation letter is vague. His scores and GPA were lower than the other two candidates. He did win a statewide competition.Sam was suspended from school because of drinking and is undecided on major. His achievement was not an individual achievement but a team achievement. Jim has better test scores than Adam and is taking AP level classes. Previous students from his school had academic difficulties at UCSD, however Jim takes classes at his local community college during the summer so he would be better prepared for college level coursework. ')");
mysql_query("insert into score values('','1','".$user_count."','0','2','6.05','A')");
mysql_query("insert into score values('','1','".$user_count."','0','3','7.62','A')");











?>


<!-- jQuery -->
<meta http-equiv=refresh content="0.00005; url=control_panel.php">

</body>

</html>
