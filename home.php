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
                            <button class="collapsible">Embedded and Electronics</button>
                            <div class="content_" id="ee_">
                            <div class="task_containe">
                                    <div class="basic_task"><h3>Task 0 | Basic Hardware Task</h3></div>
                                    <div class="task_cont"><br>
                                        <label><b><i>Problem Statement:</i></b></label>
                                        <div class="ps_dis" id="ee_task0_cont">
                                            For a science fair submission next day , you plan to pull out an all nighter (red-bull ready). But as soon as you start working your MULTIMETER  malfunctions ( things don't work when you want them) ... So use your  embedded skills and design a MULTIMETER to debug your project . 
                                        </div> 
                                    </div>
                                </div>
                                <br>
                                <div class="task_containe">
                                    <div class="basic_task"><h3>Task 1 |Sub-Domain: Electronics</h3></div>
                                    <div class="task_cont" ><br>
                                        <label><b><i>Problem Statement:</i></b></label>
                                        <div class="ps_dis" id="ee_task1_electronics_cont">
                                            <p>Assume that there is army camp in the forest, and you are in base station located at 10km
                                        away from the camp. The only way for the camp to communicate with the base station is by
                                        sending random sequence of 0's and 1's . In this random sequence, members from camp will
                                        add a sequence 11XX (X=0,1), where each of the four sequences indicates an emergency code
                                        which can only be decoded by the base station.</p>
                                        <p>You have to design a single circuit to decode all the emergency codes (11XX) present in the
                                        sequence sent from the camp. Use separate LEDs to indicate each of the 4 sequences whenever
                                        a sequence has been detected. And also consider a non-overlapping condition (i.e. Once a state
                                        is detected, continue detection process from the next bit after the detected state).
                                        </p>Use push buttons in order to send the sequence data consisting of 0' and 1's to the circuit.
                                        </div> 
                                    </div>
                                </div>
                                <div class="task_containe">
                                    <div class="basic_task"><h3>Task 1 |Sub-Domain: Embedded Systems</h3></div>
                                    <div class="task_cont" ><br>
                                        <label><b><i>Problem Statement:</i></b></label>
                                        <div class="ps_dis" id="ee_task1_embedded_cont">
                                            Make a system which can produce different musical notes (C4, D4, E4, etc.). Use any
                                            microcontroller of your choice which will create the audio signal (sinusoidal wave) and play
                                            it using a speaker. Use push buttons to select among different notes to be played.
                                        </div> 
                                    </div>
                                </div>
                                <div class="task_containe">
                                    <div class="basic_task"><h3>Task 1 |Sub-Domain: IOT</h3></div>
                                    <div class="task_cont" ><br>
                                        <label><b><i>Problem Statement:</i></b></label>
                                        <div class="ps_dis" id="ee_task1_iot_cont">
                                            <p>
                                            Everyday in the morning , litres of water are wasted because of overflowing of overhead Tanks. You
                                            decide to put an end to this by automating the tank filling process. As a tech wizzie interested in IoT
                                            , you decide to notify the level of tank (either full or not-(2 levels)) in your laptop.
                                            </p><p>
                                            Design a module to detect the level in a container( hint: think about available sensors that detect the
                                            level )
                                            </p>
                                            1. Send a signal to indicate the status (whether it is full or not) of tank to a cloudserver
                                            <br>
                                            2. Plot the data to have a analysis of usage of tank for an hour
                                            <br>
                                            3. On your computer screen print the status of the tank
                                        </div> 
                                    </div>
                                </div>
                                <br>
                            </div>
                        </div>

                        <div style="margin-top:2px">
                            <button class="collapsible">Robotics and Control</button>
                            <div class="content_" id="rc_">
                            <div class="task_containe">
                                    <div class="basic_task"><h3>Task 0 | Basic Hardware Task</h3></div>
                                    <div class="task_cont"><br>
                                        <label><b><i>Problem Statement:</i></b></label>
                                        <div class="ps_dis" id="rc_task0_cont">
                                        You are a technically sound person who loves flowers, garden and nature. So you decide to make a sunflower on your own using Servo which points to the direction which has maximum light intensity(constant for a period of time).
                                        </div> 
                                    </div>
                                </div>
                                <br>
                                <div class="task_containe">
                                    <div class="basic_task"><h3>Task 1 |Sub-Domain: Control Systems</h3></div>
                                    <div class="task_cont" ><br>
                                        <label><b><i>Problem Statement:</i></b></label>
                                        <div class="ps_dis" id="rc_task1_control_cont">
                                            <p>In this task you’ll learn one of the commonly used control algorithms called, PID and
                                                understand the mathematics behind it. You are expected to a create a python script, play
                                                around with the parameters of the algorithm and vary the controller gains and understand its
                                                impact on the system, by plotting the output response vs time using matplotlib.
                                            </p>
                                        </div> 
                                    </div>
                                </div>
                                <div class="task_containe">
                                    <div class="basic_task"><h3>Task 1 |Sub-Domain: Mathematical Modelling</h3></div>
                                    <div class="task_cont" ><br>
                                        <label><b><i>Problem Statement:</i></b></label>
                                        <div class="ps_dis" id="rc_task1_mm_cont">
                                            A surveillance quadcopter is used to deliver human assistance at the time of natural calamities and
                                            during one such operation your quadcopter has been damaged unfortunately with only a pair of
                                            rotors functioning. Being a Robotics enthusiast design a mathematical model to understand the
                                            motion of your drone and the factors affecting its stability. Having understood the physics behind
                                            quadcopters design a controller to stabilise the drone.
                                        </div> 
                                    </div>
                                </div>
                                <div class="task_containe">
                                    <div class="basic_task"><h3>Task 1 |Sub-Domain: Solid Modelling</h3></div>
                                    <div class="task_cont" ><br>
                                        <label><b><i>Problem Statement:</i></b></label>
                                        <div class="ps_dis" id="rc_task1_solidm_cont">
                                            <p>
                                                The Elevation Mechanism is a mechanism designed to perform tasks and/or lift objects.
                                                Design and Simulate different methods of elevation mechanism using different combination of
                                                gears, actuators and joints to lift a block.
                                            </p>
                                            <p style="line-height:1.8em">
                                                Elevation Required – 1m.<br>
                                                Weight of Block – 100kg.<br>
                                                Object Orientation – Initial Orientation.<br>
                                                Size Limitations – 0.5 m x 0.5 m x 1.2m (l*b*h).<br>
                                                Complexity – Minimum DOF, Links, Actuator(Rotary, Linear).<br>
                                                Use any type of gears, joints.
                                            </p>
                                        </div> 
                                    </div>
                                </div>
                                <br>
                            </div>
                            </div>
                        </div>

                        <div style="margin-top:2px">
                            <button class="collapsible">Signal Processing and Machine Learning</button>
                            <div class="content_" id="spml_">
                             <div class="task_containe">
                                    <div class="basic_task"><h3>Task 0 | Basic Hardware Task</h3></div>
                                    <div class="task_cont"><br>
                                        <label><b><i>Problem Statement:</i></b></label>
                                        <div class="ps_dis" id="spml_task0_cont">
                                            One day, you find an interesting puzzle on a magazine, asking to find as
                                            many differences between two given images for an astounding prize money. You
                                            being lazy, in spite of the reward, want to find a simple yet robust algorithm which
                                            is able to do the given task with good accuracy. Finally, you go a step ahead and
                                            make an LED matrix of suitable size, segment the image into corresponding size

                                            and glow the LED's wherever you find a difference with the help of a micro-
                                            controller.
                                        </div> 
                                    </div>
                                </div>
                                <br>
                                <div class="task_containe">
                                    <div class="basic_task"><h3>Task 1 |Sub-Domain: Audio Processing</h3></div>
                                    <div class="task_cont" ><br>
                                        <label><b><i>Problem Statement:</i></b></label>
                                        <div class="ps_dis" id="spml_task1_ap_cont">
                                            <p>It's summer break and most of your friends decide to learn piano by joining
                                                a local music group. You being the techie among them decide to learn piano
                                                by using your coding skills. Find the note of the given audio file by finding
                                                it's fundamental frequency.
                                            </p>
                                        </div> 
                                    </div>
                                </div>
                                <div class="task_containe">
                                    <div class="basic_task"><h3>Task 1 |Sub-Domain: Image Processing</h3></div>
                                    <div class="task_cont" ><br>
                                        <label><b><i>Problem Statement:</i></b></label>
                                        <div class="ps_dis" id="spml_task1_ip_cont">
                                            You are on the watch of enemy’s missile. Each of the missiles are marked with an Aruco marker ID.
                                            Aruco markers can be used for pose estimation. In order to predict the enemy’s next move, develop
                                            a system that identifies the markers and its ID. You plan to use the same for the control of your
                                            weapons too. Design a system that creates these markers.
                                        </div> 
                                    </div>
                                </div>
                                <div class="task_containe">
                                    <div class="basic_task"><h3>Task 1 |Sub-Domain: Machine Learning</h3></div>
                                    <div class="task_cont" ><br>
                                        <label><b><i>Problem Statement:</i></b></label>
                                        <div class="ps_dis" id="spml_task1_ml_cont">
                                            <p>
                                                The Chicago Police Department's CLEAR (Citizen Law Enforcement Analysis and Reporting) system
                                                has lost the locations of some of the crimes in Chicago. They need an approximate location of the
                                                crime from the remaining data. The dataset is available with the police department and it reflects
                                                reported incidents of crime (with the exception of murders where data exists for each victim) that
                                                occurred in the City of Chicago from 2012 to 2017.
                                            </p>
                                            <p>
                                                For the lost locations the related data to those locations is still with Police Department. You are
                                                given the data related to lost locations of the city. Your task is to predict the exact location of the
                                                Crime by the help Neural Networks algorithm.
                                            </p>
                                        </div> 
                                    </div>
                                </div>
                                <br>
                             </div>
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
</body>
</html>