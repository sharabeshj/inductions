<?php
 $flag_fill_form="true";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Spider Tronix Inductions</title>
    <link rel="icon" type="image/ico" href="./favicon.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="./main.css">
    <link rel="stylesheet" type="text/css" href="./home.css">
    <link rel="stylesheet" type="text/css" href="./header.css">
    <link rel="stylesheet" type="text/css" href="./footer.css">
    <link rel="stylesheet" type="text/css" href="./announcements.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
</head>
<body onload="start_page()">
    <div>
        <div class="header">
            <div class="header_inner">
            <a href="./index.php"><div class="header_logo user_none">Tronix Inductions</div></a>
                <div class="header_controller">
                    <a href="./SignIn.php"><button class="cr_button">Sign In</button></a>
                    <?php 
                       if($flag_fill_form=="true") {
                           echo "<span style=\"color: #a9a5a5;font-weight: bold;\">or</span>
                           <a  href=\"./SignUp.php\"><button class=\"cr_button\">Sign Up</button></a>";
                       }
                    ?>
                    
                </div>
                <div class="header_controller_menu" onclick="toggle_responsive();">
                    <div class="menu_bar">
                        <div class="_bar" id="bar1"></div>
                        <div class="_bar" id="bar2"></div>
                        <div class="_bar" id="bar3"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header_responsive fade_in" id="header_responsive" style="display:none;">
            <div class="menu_1 user_none">
                <a href="./SignIn.php"><button class="cr_button">Sign In</button></a>
            </div>
            <?php
             if($flag_fill_form=="true") {
                echo "<div class=\"menu_1 user_none\">
                     <a  href=\"./SignUp.php\"><button class=\"cr_button\">Sign Up</button></a>
                  </div>";
             }
            
            ?>
        </div>
        <div class="body_container">
            <div class="ann_cover">
                <div class="annotice">
                    <div class="ann_cont">
                        <div class="row">
                            <div class="column">
                                <div class="col_cont intro_impr" style="margin-top:-40px">
                                    <div class="_built">Spider Tronix</div>
                                   <div class="anim_text" id="intro_for"></div>
                                </div>
                            </div>
                            <div class="column">
                                <div class="col_cont">
                                    <div class="col_head user_none">Announcements</div>
                                    <div class="_container" id="announce_panel">
                                        <div id="ann_loader" style="display:;">
                                            <center>
                                                <img src="./loader.gif" style="width:100px;height:100px;">
                                            </center>
                                        </div>
                                        <div id="announcement" style="display:none">
                                         
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br><br><br><br>
                </div>
            </div>

            <div class="getting_started_cont">
                <div class="ann_cont">
                    <div class="task_container">
                        <div div class="_built font_temp task_head" style="text-align:center;">Tasks</div>
                        <br>
                        <div style="margin-top:2px">
                            <button class="collapsible">Computer Vision and Machine Learning</button>
                            <div class="content_" id="cvml_">
                                <p>Lorem ipsum...</p>
                            </div>
                        </div>
                        <div style="margin-top:2px">
                            <button class="collapsible">Embedded and Electronics</button>
                            <div class="content_" id="ee_">
                            <div class="task_containe">
                                    <div class="basic_task"><h3>Task 0 | Basic Hardware Task</h3></div>
                                    <div class="task_cont">
                                        <label><b><i>Problem Statement:</i></b></label>
                                        <div class="ps_dis" id="ee_task0_cont">
                                            <div id="ee_task1_loader" style="display:;">
                                                <center>
                                                    <img src="./loader.gif" style="width:100px;height:100px;">
                                                </center>
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                                <br>
                                <div class="task_containe">
                                    <div class="basic_task"><h3>Task 1 |Sub-Domain: Electronics</h3></div>
                                    <div class="task_cont" >
                                        <label><b><i>Problem Statement:</i></b></label>
                                        <div class="ps_dis" id="ee_task1_electronics_cont">
                                            <div id="ee_task1_electronics_loader" style="display:;">
                                                <center>
                                                    <img src="./loader.gif" style="width:100px;height:100px;">
                                                </center>
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                                <div class="task_containe">
                                    <div class="basic_task"><h3>Task 1 |Sub-Domain: Embedded Systems</h3></div>
                                    <div class="task_cont" >
                                        <label><b><i>Problem Statement:</i></b></label>
                                        <div class="ps_dis" id="ee_task1_embedded_cont">
                                            <div id="ee_task1_embedded_loader" style="display:;">
                                                <center>
                                                    <img src="./loader.gif" style="width:100px;height:100px;">
                                                </center>
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                                <div class="task_containe">
                                    <div class="basic_task"><h3>Task 1 |Sub-Domain: IOT</h3></div>
                                    <div class="task_cont" >
                                        <label><b><i>Problem Statement:</i></b></label>
                                        <div class="ps_dis" id="ee_task1_iot_cont">
                                            <div id="ee_task1_iot_loader" style="display:;">
                                                <center>
                                                    <img src="./loader.gif" style="width:100px;height:100px;">
                                                </center>
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                                <br>
                            </div>
                        </div>
                        <div style="margin-top:2px">
                            <button class="collapsible">Robotics and Control</button>
                            <div class="content_" id="rc_">
                                <p>Lorem ipsum...</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="getting_started_cont" style="padding-top: 0;background: url(./projects.jpg);background-size: cover;width: 100%;background-attachment: fixed;background-position: center;padding-bottom: 0px;height: 100%;">
             <div style="background:rgba(0,0,0,0.9);">
                <div class="ann_cont">
                        <div class="row">
                            <div class="column">
                                <div class="col_cont">
                                    <div class="_built font_temp" style="text-align:center;color:#fff !important;">Inductions</div>
                                    <div class="anim_text font_temp induc_greet" style="color:#fff !important;">Greetings First years. The tronix induction presents you with three domains to work on. You can choose one or more domains. To participate in inductions please click on the button and fill the form. Deadline is <b><i>5th May, 2019</i></b>. For giving you a better 
                                        clarity on each of the domains here is a short intro about them:- 

                                        <ol style="font-size:17px;">
                                            <li><b><i>Computer Vision and Machine Learning:</b></i> </li>
                                            <li><b><i>Embedded and Electronics:</b></i> </li>
                                            <li><b><i>Robotics and Control:</b></i> </li>
                                        </ol>
                                        <p style="font-size:17px;">
                                            We will get you in touch with the details regarding mentors and future works once you submit the form. We really look forward to amazing thigs you will learn this summer. Good luck!
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="column">
                                <div class="col_cont">
                                    <div class="fill_but_cont" style="">
                                    <?php
                                        if($flag_fill_form=="true") {
                                            echo "<a href=\"./SignUp.php\"><button class=\"elec_button \" style=\"width:80%;\">Apply for Inductions | Sign Up</button></a>";
                                        }
                                        else {
                                            echo "<button class=\"elec_button del_req \" style=\"width:80%;cursor:not-allowed;\" disabled>Application Request is Closed Now</button>";
                                        }
                                    ?>
                                     
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                 </div>
                </div>
        </div>
        <div class="footer">
            <div class="footer_cont user_none">
                <div class="foot_col">
                    Tronix Inductions<br>
                    <div class="_copy">&copy&nbsp;<?php echo date('Y');?></div>
                </div>
                <div class="img_con">
                <a href="./index.php"><img src="./logo_white.png" class="f_logo"></a>
                </div>
            </div>
        </div>
    </div>
    <div id="modal_box" style="display:none;">
        <div id="loader" style="display:none;"></div>
    </div>
<script src="./header_responsive.js"></script>
<script>
</script>
<script src="./home.js"></script>
<script>
    load_task();
</script>
</body>
</html>