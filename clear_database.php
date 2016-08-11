<?php
require_once "dbaccess.php";

mysql_query("truncate candidate;");
mysql_query("truncate conflict;");
mysql_query("truncate criteria;");
mysql_query("truncate decision;");
mysql_query("truncate overall;");
mysql_query("truncate participate;");
mysql_query("truncate score;");
mysql_query("truncate score_backup;");
mysql_query("truncate user;");
mysql_query("truncate survey;");
mysql_query("truncate reason;");

mysql_query("truncate score_pool_sam;");
mysql_query("truncate score_pool_adam;");
mysql_query("truncate score_pool_jim;");

mysql_query("truncate name;");