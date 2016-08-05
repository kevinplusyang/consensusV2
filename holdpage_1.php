
<?php
session_start();
require_once "dbaccess.php";
?>

<!doctype html>
<!--
  Material Design Lite
  Copyright 2015 Google Inc. All rights reserved.

  Licensed under the Apache License, Version 2.0 (the "License");
  you may not use this file except in compliance with the License.
  You may obtain a copy of the License at

      https://www.apache.org/licenses/LICENSE-2.0

  Unless required by applicable law or agreed to in writing, software
  distributed under the License is distributed on an "AS IS" BASIS,
  WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
  See the License for the specific language governing permissions and
  limitations under the License
-->
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="A front-end template that helps you build fast, modern mobile web apps.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <title>ConsensUs Pilot Study</title>

    <!-- Add to homescreen for Chrome on Android -->
    <meta name="mobile-web-app-capable" content="yes">
    <link rel="icon" sizes="192x192" href="images/android-desktop.png">

    <!-- Add to homescreen for Safari on iOS -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Material Design Lite">
    <link rel="apple-touch-icon-precomposed" href="images/ios-desktop.png">

    <!-- Tile icon for Win8 (144x144 + tile color) -->
    <meta name="msapplication-TileImage" content="images/touch/ms-touch-icon-144x144-precomposed.png">
    <meta name="msapplication-TileColor" content="#3372DF">

    <link rel="shortcut icon" href="images/favicon.png">

    <!-- SEO: If your mobile URL is different from the desktop URL, add a canonical link to the desktop page https://developers.google.com/webmasters/smartphone-sites/feature-phones -->
    <!--
    <link rel="canonical" href="http://www.example.com/">
    -->

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.1.3/material.teal-red.min.css">
    <link rel="stylesheet" href="styles.css">
    <style>
        #view-source {
            position: fixed;
            display: block;
            right: 0;
            bottom: 0;
            margin-right: 40px;
            margin-bottom: 40px;
            z-index: 900;
        }
    </style>
</head>




<?php


$result = mysql_query("select * from participate where real_user_id = '".$_GET['user_id']."' ");
$row = mysql_fetch_array($result);
$decision_id = $row['decision_id'];
$user_id = $row['user_id'];



$result = mysql_query("select * from user where id = '".$_GET['user_id']."' ");
$row = mysql_fetch_array($result);
$user_name = $row['user_name'];
$email = $row['email'];



?>



<body>
<div class="demo-layout mdl-layout mdl-layout--fixed-header mdl-js-layout mdl-color--grey-100">
    <!--    <header class="demo-header mdl-layout__header mdl-layout__header--scroll mdl-color--green-1000 mdl-color-text--white-800">-->
    <!--        <div class="mdl-layout__header-row">-->
    <!--            <span class="mdl-layout-title">ConsensUs</span>-->
    <!--            <div class="mdl-layout-spacer"></div>-->
    <!--        </div>-->
    <!--    </header>-->
    <div class="demo-ribbon"></div>
    <main class="demo-main mdl-layout__content">
        <div class="demo-container mdl-grid">
            <div class="mdl-cell mdl-cell--2-col mdl-cell--hide-tablet mdl-cell--hide-phone"></div>
            <div class="demo-content mdl-color--white mdl-shadow--4dp content mdl-color-text--grey-800 mdl-cell mdl-cell--8-col">
                <div class="demo-crumbs mdl-color-text--grey-500">
                    ConsensUs &gt; Survey
                </div>
                <h3>Survey</h3>

<!--                <p>-->
<!--                    Please full fill this survey and press submit.-->
<!--                </p>-->






                <form action="survey_process.php?decision_id=<?php echo $_GET['decision_id'];?>&user_id=<?php echo $_GET['user_id']?>" method="post">
                    1. How confident are you in your vote?<br>
                    &nbsp&nbsp&nbsp <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-1">
                        <input type="radio" id="option-1" class="mdl-radio__button" name="q1" value="1">
                        <span class="mdl-radio__label">Unconfident</span>
                    </label>
                    &nbsp&nbsp&nbsp &nbsp&nbsp&nbsp

                    <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-2">
                        <input type="radio" id="option-2" class="mdl-radio__button" name="q1" value="2">
                        <span class="mdl-radio__label">Somewhat Unconfident</span>
                    </label>
                    &nbsp&nbsp&nbsp &nbsp&nbsp&nbsp
                    <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-3">
                        <input type="radio" id="option-3" class="mdl-radio__button" name="q1" value="3">
                        <span class="mdl-radio__label">Neither Unconfident nor Confident</span>
                    </label>
                    <br>
                    &nbsp&nbsp&nbsp
                    <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-4">
                        <input type="radio" id="option-4" class="mdl-radio__button" name="q1" value="4">
                        <span class="mdl-radio__label">Somewhat Confident</span>
                    </label>
                    &nbsp&nbsp&nbsp &nbsp&nbsp&nbsp
                    <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-5">
                        <input type="radio" id="option-5" class="mdl-radio__button" name="q1" value="5">
                        <span class="mdl-radio__label">Confident</span>
                    </label>


                    <br>
                    <br>



                    2. How willing are you to change your vote?<br>
                    &nbsp&nbsp&nbsp <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-6">
                        <input type="radio" id="option-6" class="mdl-radio__button" name="q2" value="1">
                        <span class="mdl-radio__label">Not at all</span>
                    </label>
                    &nbsp&nbsp&nbsp &nbsp&nbsp&nbsp

                    <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-7">
                        <input type="radio" id="option-7" class="mdl-radio__button" name="q2" value="2">
                        <span class="mdl-radio__label">To a little extent</span>
                    </label>
                    &nbsp&nbsp&nbsp &nbsp&nbsp&nbsp
                    <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-8">
                        <input type="radio" id="option-8" class="mdl-radio__button" name="q2" value="3">
                        <span class="mdl-radio__label">To some extent</span>
                    </label>
                    <br>
                     &nbsp&nbsp&nbsp
                    <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-9">
                        <input type="radio" id="option-9" class="mdl-radio__button" name="q2" value="4">
                        <span class="mdl-radio__label">To a great extent</span>
                    </label>
                    &nbsp&nbsp&nbsp &nbsp&nbsp&nbsp
                    <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-10">
                        <input type="radio" id="option-10" class="mdl-radio__button" name="q2" value="5">
                        <span class="mdl-radio__label">To a very great extent</span>
                    </label>


                    <br>
                    <br>


                    3. Indicate whether or not you think these criteria are valuable in determining the best candidate.<br>
                    <br>
                    &nbsp&nbsp&nbsp Academic:
                    <br>&nbsp&nbsp&nbsp
                    <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-11">
                        <input type="radio" id="option-11" class="mdl-radio__button" name="q3" value="1">
                        <span class="mdl-radio__label">Like</span>
                    </label>
                    &nbsp&nbsp&nbsp &nbsp&nbsp&nbsp
                    <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-12">
                        <input type="radio" id="option-12" class="mdl-radio__button" name="q3" value="2">
                        <span class="mdl-radio__label">Unlike</span>
                    </label>

                    <br>

                    <br>
                    &nbsp&nbsp&nbsp
                    Extracurricular:
                    <br>&nbsp&nbsp&nbsp
                    <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-13">
                        <input type="radio" id="option-13" class="mdl-radio__button" name="q4" value="1">
                        <span class="mdl-radio__label">Like</span>
                    </label>
                    &nbsp&nbsp&nbsp &nbsp&nbsp&nbsp
                    <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-14">
                        <input type="radio" id="option-14" class="mdl-radio__button" name="q4" value="2">
                        <span class="mdl-radio__label">Unlike</span>
                    </label>


                    <br>

                    <br>
                    &nbsp&nbsp&nbsp Recommendation Letter:
                    <br>&nbsp&nbsp&nbsp
                    <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-15">
                        <input type="radio" id="option-15" class="mdl-radio__button" name="q5" value="1" >
                        <span class="mdl-radio__label">Like</span>
                    </label>
                    &nbsp&nbsp&nbsp &nbsp&nbsp&nbsp
                    <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-16">
                        <input type="radio" id="option-16" class="mdl-radio__button" name="q5" value="2">
                        <span class="mdl-radio__label">Unlike</span>
                    </label>

                    <br>
                    <br>
                    &nbsp&nbsp&nbsp Fit:
                    <br>&nbsp&nbsp&nbsp
                    <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-17">
                        <input type="radio" id="option-17" class="mdl-radio__button" name="q6" value="1">
                        <span class="mdl-radio__label">Like</span>
                    </label>
                    &nbsp&nbsp&nbsp &nbsp&nbsp&nbsp
                    <label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="option-18">
                        <input type="radio" id="option-18" class="mdl-radio__button" name="q6" value="2">
                        <span class="mdl-radio__label">Unlike</span>
                    </label>


                    <br>
                    <br>



                    4. What other criteria would you like to add that wasn’t listed above?<br>
                    &nbsp&nbsp&nbsp

                    <div class="mdl-textfield mdl-js-textfield">
                        <input class="mdl-textfield__input" type="text" id="sample1" name="q7">
                        <label class="mdl-textfield__label" for="sample1">Text...</label>
                    </div>



                    <br>


                    <input type="submit" value="Next" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" id="regBtn">


                </form>







                <script type="text/javascript" src="http://lib.sinaapp.com/js/jquery/1.9.0/jquery.min.js"></script>
                <script>

                    $(function(){
                        var regBtn = $("#regBtn");
                        $("#regText").change(function(){
                            var that = $(this);
                            that.prop("checked",that.prop("checked"));
                            if(that.prop("checked")){
                                regBtn.prop("disabled",false)
                            }else{
                                regBtn.prop("disabled",true)
                            }
                        });
                    });
                </script>


            </div>
        </div>

    </main>
</div>



<script src="https://code.getmdl.io/1.1.3/material.min.js"></script>
</body>
</html>




