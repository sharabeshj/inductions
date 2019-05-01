<?php
require 'database.php';

require 'session.php';

require 'cookies.php';
date_default_timezone_set("Asia/Kolkata");
$date=date("Y-m-d H:i:s");
$popup=false;
$poup_msg="";
$sub_msg="No submissions till now :";
$upload=true;

function final_touch($field) {
    $field = trim($field);
    $field = stripslashes($field);
    $field = htmlspecialchars($field);
    return $field ;
}

if(isset($_SESSION['SPIDERTRONIX_USER_ID'])) {
    $user_name=grab_data("Name");
    $user_dept=grab_data("Dept");
    $user_roll=grab_data("Roll_No");
    $user_sec=grab_data("Sec");
    $phone=grab_data("Phone");
    $email=grab_data("Email");
    $gender=grab_data("Gender");
    $pos=grab_data("Access"); 
    $dom=grab_data("Domain");
}
else {
    header("Location:./index.php");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if(isset($_POST["link"]) && isset($_POST["sub_domain"])) {
        $popup=true;
        $val=final_touch($_POST["link"]);
        $sub_domain=final_touch($_POST["sub_domain"]);
        $query="INSERT INTO submissions (Roll_No, Domain, Sub_Domain, Link, Date, Task_No) VALUES ('$user_roll','$dom','$sub_domain','$val','$date', '1')";
        if($connection->query($query)===TRUE) {
            $poup_msg="Successfully Uploaded.";
        }
        else {
            $poup_msg="Failed to Upload";
        }
    }
}

$task_arr=array();
$quer="SELECT * FROM tasks WHERE Domain='$dom' AND Task_No='1'";
if($res=$connection->query($quer)) {
    if($res->num_rows>0) {
        while($rw=$res->fetch_array()) {
            $link=$rw['Link'];
            $deadline=$rw['Deadline'];
            $sudb=$rw['Sub_Domain'];
            $date = str_replace('/', '-', $deadline);
            $deadline=date('d-m-Y', strtotime($date));  
            $task_arr[]=array("Link"=>$link,"Ddl"=>$deadline,"Subd"=>$sudb);
        }
    }
}
else {
}


$ret_arr=array();
$query="SELECT * FROM submissions WHERE Roll_No='$user_roll' AND Task_No='1' ORDER BY Date DESC";
if($result=$connection->query($query)) {
    if($result->num_rows>0) {
        $sub_msg="We have received your submission:";
        while($row=$result->fetch_array()) {
            $link=$row['Link'];
            $date=$row['Date'];
            $sudb=$row['Sub_Domain'];
            $ret_arr[]=array("Link"=>$link,"Date"=>$date,"Subd"=>$sudb);
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Tasks | Task 1</title>
    <link rel="icon" type="image/ico" href="./favicon.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="./main.css">
    <link rel="stylesheet" type="text/css" href="./home.css">
    <link rel="stylesheet" type="text/css" href="./header_ac.css">
    <link rel="stylesheet" type="text/css" href="./body_ac.css">
    <link rel="stylesheet" type="text/css" href="./tasks.css">
    <link rel="stylesheet" type="text/css" href="./footer.css">
    <link rel="stylesheet" type="text/css" href="./announcements.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
</head>
<body>
    <div>
        <div class="header" id="header">
            <div class="header_inner">
                <a href="./index.php"><div class="header_logo user_none">Tronix Inductions</div></a>
                <div class="header_controller_menu" id="cover_menu" onclick="toggle_responsive();">
                    <div class="menu_bar" id="menu_">
                        <div class="_bar" id="bar1"></div>
                        <div class="_bar" id="bar2"></div>
                        <div class="_bar" id="bar3"></div>
                    </div>
                </div>
            </div>
        </div>


        <div class="header_responsive" id="header_responsive" style="display:none;">
            <div class="header_inner" id="header_inner" style="display:flex;">
                <div class="acn_menu user_none" id="menu_box" style="display:none">
                    <div class="ac_heading ">
                        Signed In as <br>
                        <b><span class="show_user"><?php echo $user_roll?></span></b>
                    </div>
                    <hr>
                    <a href="./settings.php">
                    <div class="menu_option">
                        Settings
                    </div></a>
                    <a href="./logout.php"><div class="menu_option">
                        Log Out
                    </div></a>
                </div>
            </div>
        </div>
        <?php 
            if(($dom=="none")||($pos=="adm" || $pos=="admin")) {
                header("Location:./index.php");
                }
        ?>
            <div class="body_container">   
                <div class="body_cover">
                    <div class="tabs_">
                        <div class="_welcome user_none">
                            Welcome<span class="_wel_user"><?php echo $user_name?></span>
                        </div>
                        <div class="tab_header">
                            <a href="./index.php"><div class="tab_cont" >
                                Dashboard
                                </div>
                            </a>
                            <?php 
                            if($pos=="stu") {
                                echo "<a href=\"./tasks.php\"><div class=\"tab_cont tab_active\">";
                                echo "Tasks > Task 1";            
                                echo "</div></a>";
                            }
                            ?>
                        </div>
                        <div class="tab_desc">
                            <div class="instruction_panel">
                                <div class="_head">Task 1</div>
                                <div class="inst_content">
                                     <?php
                                        foreach ($task_arr as $value) {
                                            if($dom=="Embedded and Analog Electronics") {
                                                echo "<div class=\"_head\" style=\"display:inline-block;padding:2px;font-size:16px;margin-top:20px;\">Sub-Domain: ".$value["Subd"]."</div>
                                                <div class=\"task_main_instructions\">
                                                    <blockquote>Last Date to submit the Task 1 is : <i><b>";
                                                echo $value["Ddl"];
                                                echo "</b></i><br>
                                                        Task submitted after the deadline will not be considered.
                                                        </blockquote>
                                                    </div><br>";
                                                echo "<div class=\"task_intro\">";
                                                if($value["Subd"]=="Electronics") {
                                                        echo "<p>Assume that there is army camp in the forest, and you are in base station located at 10km
                                                        away from the camp. The only way for the camp to communicate with the base station is by
                                                        sending random sequence of 0's and 1's . In this random sequence, members from camp will
                                                        add a sequence 11XX (X=0,1), where each of the four sequences indicates an emergency code
                                                        which can only be decoded by the base station.</p>
                                                        <p>You have to design a single circuit to decode all the emergency codes (11XX) present in the
                                                        sequence sent from the camp. Use separate LEDs to indicate each of the 4 sequences whenever
                                                        a sequence has been detected. And also consider a non-overlapping condition (i.e. Once a state
                                                        is detected, continue detection process from the next bit after the detected state).
                                                        </p>Use push buttons in order to send the sequence data consisting of 0' and 1's to the circuit.
                                                        ";
                                                }
                                                else if($value["Subd"]=="Embedded Systems") {
                                                        echo "Make a system which can produce different musical notes (C4, D4, E4, etc.). Use any
                                                        microcontroller of your choice which will create the audio signal (sinusoidal wave) and play
                                                        it using a speaker. Use push buttons to select among different notes to be played.
                                                        ";
                                                }
                                                else if($value["Subd"]=="IOT") {
                                                        echo "<p>
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
                                                        3. On your computer screen print the status of the tank";
                                                }
                                                echo "</div>";
                                                echo "<br><hr>
                                                        <div class=\"red_head\">
                                                                Download
                                                        </div>
                                                        <div>
                                                            <a href=\"".$value["Link"]."\" download target=\"_blank\">
                                                            <button class=\"elec_button\">
                                                                Download Task 1 to find out more 
                                                            <i class=\"fas fa-download down_ico\"></i>
                                                            </button>
                                                        </a>
                                                        </div>";
                                                echo " <br><hr><br>
                                                        <div class=\"task_main_instructions\" style=\"font-weight:bold;font-size:1.64rem;\">
                                                            <blockquote> Upload</blockquote>
                                                        </div>
                                                        <div class=\"upload_cont\">";
                                                if($upload) {
                                                    echo "<form action=\"";
                                                    echo htmlspecialchars($_SERVER["PHP_SELF"]);
                                                    echo "\" method=\"POST\">
                                                            <input type=\"text\" class=\"ui_text\" name=\"link\" value=\"\" placeholder=\"Link\" required><br>
                                                            <center><br>
                                                            <input type=\"hidden\" name=\"sub_domain\" value=\"".$value["Subd"]."\">
                                                            <button type=\"submit\" class=\"elec_button del_req\">
                                                                Upload Task
                                                                <i class=\"fas fa-upload down_ico\"></i>
                                                            </button>
                                                            </center>
                                                            </form>";
                                                } 
                                                else {
                                                    echo "<h2 style=\"color:#F44336\">Task 1 upload has been closed.</h2>";
                                                }
                                                echo "</div><br><br>";

                                            }
                                            else if($dom=="Robotics and Control") {
                                                echo "<div class=\"_head\" style=\"display:inline-block;padding:2px;font-size:16px;margin-top:20px;\">Sub-Domain: ".$value["Subd"]."</div>
                                                <div class=\"task_main_instructions\">
                                                    <blockquote>Last Date to submit the Task 1 is : <i><b>";
                                                echo $value["Ddl"];
                                                echo "</b></i><br>
                                                        Task submitted after the deadline will not be considered.
                                                        </blockquote>
                                                    </div><br>";
                                                echo "<div class=\"task_intro\">";
                                                if($value["Subd"]=="Control Systems") {
                                                        echo "<p>In this task you’ll learn one of the commonly used control algorithms called, PID and
                                                        understand the mathematics behind it. You are expected to a create a python script, play
                                                        around with the parameters of the algorithm and vary the controller gains and understand its
                                                        impact on the system, by plotting the output response vs time using matplotlib.
                                                        </p>";
                                                }
                                                else if($value["Subd"]=="Mathematical Modelling") {
                                                        echo "A surveillance quadcopter is used to deliver human assistance at the time of natural calamities and
                                                        during one such operation your quadcopter has been damaged unfortunately with only a pair of
                                                        rotors functioning. Being a Robotics enthusiast design a mathematical model to understand the
                                                        motion of your drone and the factors affecting its stability. Having understood the physics behind
                                                        quadcopters design a controller to stabilise the drone.";
                                                }
                                                else if($value["Subd"]=="Solid Modelling") {
                                                        echo "<p>
                                                        The Elevation Mechanism is a mechanism designed to perform tasks and/or lift objects.
                                                        Design and Simulate different methods of elevation mechanism using different combination of
                                                        gears, actuators and joints to lift a block.
                                                        </p>
                                                        <p style=\"line-height:1.8em\">
                                                            Elevation Required – 1m.<br>
                                                            Weight of Block – 100kg.<br>
                                                            Object Orientation – Initial Orientation.<br>
                                                            Size Limitations – 0.5 m x 0.5 m x 1.2m (l*b*h).<br>
                                                            Complexity – Minimum DOF, Links, Actuator(Rotary, Linear).<br>
                                                            Use any type of gears, joints.
                                                        </p>";
                                                }
                                                echo "</div>";
                                                echo "<br><hr>
                                                        <div class=\"red_head\">
                                                                Download
                                                        </div>
                                                        <div>
                                                            <a href=\"".$value["Link"]."\" download target=\"_blank\">
                                                            <button class=\"elec_button\">
                                                                Download Task 1 to find out more 
                                                            <i class=\"fas fa-download down_ico\"></i>
                                                            </button>
                                                        </a>
                                                        </div>";
                                                echo " <br><hr><br>
                                                        <div class=\"task_main_instructions\" style=\"font-weight:bold;font-size:1.64rem;\">
                                                            <blockquote> Upload</blockquote>
                                                        </div>
                                                        <div class=\"upload_cont\">";
                                                if($upload) {
                                                    echo "<form action=\"";
                                                    echo htmlspecialchars($_SERVER["PHP_SELF"]);
                                                    echo "\" method=\"POST\">
                                                            <input type=\"text\" class=\"ui_text\" name=\"link\" value=\"\" placeholder=\"Link\" required><br>
                                                            <center><br>
                                                            <input type=\"hidden\" name=\"sub_domain\" value=\"".$value["Subd"]."\">
                                                            <button type=\"submit\" class=\"elec_button del_req\">
                                                                Upload Task
                                                                <i class=\"fas fa-upload down_ico\"></i>
                                                            </button>
                                                            </center>
                                                            </form>";
                                                } 
                                                else {
                                                    echo "<h2 style=\"color:#F44336\">Task 1 upload has been closed.</h2>";
                                                }
                                                echo "</div><br><br>";
                                            }
                                            else if($dom=="Signal Processing and Machine Learning") {
                                                echo "<div class=\"_head\" style=\"display:inline-block;padding:2px;font-size:16px;margin-top:20px;\">Sub-Domain: ".$value["Subd"]."</div>
                                                <div class=\"task_main_instructions\">
                                                    <blockquote>Last Date to submit the Task 1 is : <i><b>";
                                                echo $value["Ddl"];
                                                echo "</b></i><br>
                                                        Task submitted after the deadline will not be considered.
                                                        </blockquote>
                                                    </div><br>";
                                                echo "<div class=\"task_intro\">";
                                                if($value["Subd"]=="Audio Processing") {
                                                        echo "<p>It's summer break and most of your friends decide to learn piano by joining
                                                        a local music group. You being the techie among them decide to learn piano
                                                        by using your coding skills. Find the note of the given audio file by finding
                                                        it's fundamental frequency.
                                                         </p>";
                                                }
                                                else if($value["Subd"]=="Image Processing") {
                                                        echo "You are on the watch of enemy’s missile. Each of the missiles are marked with an Aruco marker ID.
                                                        Aruco markers can be used for pose estimation. In order to predict the enemy’s next move, develop
                                                        a system that identifies the markers and its ID. You plan to use the same for the control of your
                                                        weapons too. Design a system that creates these markers.";
                                                }
                                                else if($value["Subd"]=="Machine Learning") {
                                                        echo "<p>
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
                                                        </p>";
                                                }
                                                echo "</div>";
                                                echo "<br><hr>
                                                        <div class=\"red_head\">
                                                                Download
                                                        </div>
                                                        <div>
                                                            <a href=\"".$value["Link"]."\" download target=\"_blank\">
                                                            <button class=\"elec_button\">
                                                                Download Task 1 to find out more 
                                                            <i class=\"fas fa-download down_ico\"></i>
                                                            </button>
                                                        </a>
                                                        </div>";
                                                echo " <br><hr><br>
                                                        <div class=\"task_main_instructions\" style=\"font-weight:bold;font-size:1.64rem;\">
                                                            <blockquote> Upload</blockquote>
                                                        </div>
                                                        <div class=\"upload_cont\">";
                                                if($upload) {
                                                    echo "<form action=\"";
                                                    echo htmlspecialchars($_SERVER["PHP_SELF"]);
                                                    echo "\" method=\"POST\">
                                                            <input type=\"text\" class=\"ui_text\" name=\"link\" value=\"\" placeholder=\"Link\" required><br>
                                                            <center><br>
                                                            <input type=\"hidden\" name=\"sub_domain\" value=\"".$value["Subd"]."\">
                                                            <button type=\"submit\" class=\"elec_button del_req\">
                                                                Upload Task
                                                                <i class=\"fas fa-upload down_ico\"></i>
                                                            </button>
                                                            </center>
                                                            </form>";
                                                } 
                                                else {
                                                    echo "<h2 style=\"color:#F44336\">Task 1 upload has been closed.</h2>";
                                                }
                                                echo "</div><br><br>";
                                            }
                                        }
                                     ?>
                                     <br><hr><br>
                                     <div class="sub_panel">
                                         <p>
                                            <label style="color:#F44336;"><b><?php echo $sub_msg?></b></label>
                                            Also you can re-upload your task link multiple times before deadline.
                                            <br> 
                                            Only the latest link received before deadline will be considered.
                                         </p>
                                         <hr>
                                         <strong>Your submitted tasks:</strong>
                                         <?php
                                          if($ret_arr) {
                                              echo "<ol>";
                                              foreach ($ret_arr as $value) {
                                                echo "<li>Sub-Domain: \"".$value["Subd"]."\"<br><a href=\"".$value["Link"]."\"><label>Link </label></a>".$value["Date"]."</li>";
                                              }
                                              echo "</ol>";
                                          }
                                         ?>
                                     </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        <div class="_bg_ header_responsive"></div>

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
        <input type="hidden" id="user_roll_number" value="<?php echo $user_roll?>">
        <input type="hidden" id="user_year" value="">    
        <input type="hidden" id="user_dept" value="<?php echo $user_dept?>">  
        <input type="hidden" id="user_sec" value="<?php echo $user_sec?>">  
        <input type="hidden" id="user_name" value="<?php echo $user_name?>"> 
        <input type="hidden" id="user_gender" value="<?php echo $gender?>">    
        <div id="loader" style="display:none;"></div>
    </div>

    <div id="popup">
        <?php echo $poup_msg; ?>
    </div>
<?php
 if($popup) {
     echo "<script>";
     echo "var x = document.getElementById(\"popup\");";
     echo "  x.className = \"show\";setTimeout(function(){ 
                x.className = x.className.replace(\"show\", \"\"); 
            }, 3000);";
     echo "</script>";
 }
?>
<script>
    function toggle_responsive() {
        let x=document.getElementById("menu_");
        x.classList.toggle("change");
        if(x.classList[1]) {
            document.getElementById("header_responsive").style.display="block";
            document.getElementById("menu_box").style.display="block";
            document.getElementById("menu_box").classList.toggle("show_menu");
            setTimeout(() => {
                document.getElementById("menu_box").classList.toggle("show_menu");
            }, 501);
        }
        else {
            document.getElementById("menu_box").classList.toggle("hide_menu");
            setTimeout(() => {
                document.getElementById("header_responsive").style.display="none";
                document.getElementById("menu_box").style.display="none";
                document.getElementById("menu_box").classList.toggle("hide_menu");
            }, 495);
        }
    }
    window.onclick = function(event) {
        if (event.target == document.getElementById("header_responsive")||event.target == document.getElementById("header_inner")||event.target == document.getElementById("header")) {
            document.getElementById("menu_box").classList.toggle("hide_menu");
            setTimeout(() => {
                document.getElementById("header_responsive").style.display="none";
                document.getElementById("menu_box").style.display="none";
                document.getElementById("menu_box").classList.toggle("hide_menu");
            }, 495);
            let x=document.getElementById("menu_");
            if(x.classList[1]) {
                x.classList.toggle("change");
            }
            
        }
	}

 let roll=document.getElementById("user_roll_number").value;
</script>
</body>
</html>