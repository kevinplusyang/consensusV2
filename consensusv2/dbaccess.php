<?php
$link = mysql_connect('localhost', 'root', '123456')
//$link = mysql_connect('localhost', 'mingyang', 'Wugongyi21')

or die('Could not connect: ' . mysql_error());
mysql_select_db('consensus') or die('Could not select database');
mysql_query("SET NAMES 'utf8'");
 