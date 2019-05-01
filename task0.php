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
    $sub_domain="Basic Hardware";
}
else {
    header("Location:./index.php");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if(isset($_POST["link"])) {
        $popup=true;
        $val=final_touch($_POST["link"]);
        $query="INSERT INTO submissions (Roll_No, Domain, Sub_Domain, Link, Date, Task_No) VALUES ('$user_roll','$dom','$sub_domain','$val','$date', '0')";
        if($connection->query($query)===TRUE) {
            $poup_msg="Successfully Uploaded.";
        }
        else {
            $poup_msg="Failed to Upload";
        }
    }
}

$task_arr=array();
$quer="SELECT * FROM tasks WHERE Domain='$dom' AND Sub_Domain='$sub_domain'";
if($res=$connection->query($quer)) {
    if($res->num_rows>0) {
        while($rw=$res->fetch_array()) {
            $link=$rw['Link'];
            $deadline=$rw['Deadline'];
            $date = str_replace('/', '-', $deadline);
            $deadline=date('d-m-Y', strtotime($date));  
            $task_arr[]=array("Link"=>$link,"Ddl"=>$deadline);
        }
    }
}
else {
}


$ret_arr=array();
$query="SELECT * FROM submissions WHERE Roll_No='$user_roll' AND Sub_Domain='$sub_domain' ORDER BY Date DESC";
if($result=$connection->query($query)) {
    if($result->num_rows>0) {
        $sub_msg="We have received your submission:";
        while($row=$result->fetch_array()) {
            $link=$row['Link'];
            $date=$row['Date'];
            $ret_arr[]=array("Link"=>$link,"Date"=>$date);
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Tasks | Task 0</title>
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
                                echo "Tasks > Task 0";            
                                echo "</div></a>";
                            }
                            ?>
                        </div>
                        <div class="tab_desc">
                            <div class="instruction_panel">
                                <div class="_head">Task 0</div>
                                <div class="inst_content">
                                     <div class="task_main_instructions">
                                         <blockquote>
                                             Last Date to submit the Task 0 is : <i><b>
                                                 <?php 
                                                    foreach ($task_arr as $value) {
                                                        echo $value["Ddl"];;
                                                    }
                                                 ?>
                                            </b></i><br>
                                             Task submitted after the deadline will not be considered.
                                         </blockquote>
                                     </div><br>
                                     <div class="task_intro">
                                         <?php 
                                            if($dom=="Embedded and Analog Electronics") {
                                                echo "For a science fair submission next day , you plan to pull out an all nighter (red-bull ready). But as soon as you start working your MULTIMETER  malfunctions ( things don't work when you want them) ... So use your  embedded skills and design a MULTIMETER to debug your project.";
                                            }
                                            else if($dom=="Robotics and Control") {
                                                echo "You are a technically sound person who loves flowers, garden and nature. So you decide to make a sunflower on your own using Servo which points to the direction which has maximum light intensity(constant for a period of time).";
                                            }
                                            else if($dom=="Signal Processing and Machine Learning") {
                                                echo "One day, you find an interesting puzzle on a magazine, asking to find as
                                                many differences between two given images for an astounding prize money. You
                                                being lazy, in spite of the reward, want to find a simple yet robust algorithm which
                                                is able to do the given task with good accuracy. Finally, you go a step ahead and
                                                make an LED matrix of suitable size, segment the image into corresponding size
                                                and glow the LED's wherever you find a difference with the help of a micro-
                                                controller.";
                                            }
                                         ?>
                                     </div><br><hr>
                                     <div class="red_head">
                                             Download
                                     </div>
                                     <div >
                                         <a href="<?php 
                                             foreach ($task_arr as $value) {
                                                 echo $value["Link"];
                                             }
                                         ?>" download target="_blank">
                                         <button class="elec_button">
                                             Download Task 0 to find out more 
                                            <i class="fas fa-download down_ico"></i>
                                         </button>
                                        </a>
                                     </div>
                                     <br><hr><br>
                                     <div class="task_main_instructions" style="font-weight:bold;font-size:1.64rem;">
                                            <blockquote> Upload</blockquote>
                                     </div>
                                     <div class="upload_cont">
                                        <?php
                                            if($upload) {
                                                echo "<form action=\"";
                                                echo htmlspecialchars($_SERVER["PHP_SELF"]);
                                                echo "\" method=\"POST\">
                                                <input type=\"text\" class=\"ui_text\" name=\"link\" value=\"\" placeholder=\"Link\" required><br>
                                                <center><br>
                                                <button type=\"submit\" class=\"elec_button del_req\">
                                                   Upload Task
                                                   <i class=\"fas fa-upload down_ico\"></i>
                                               </button>
                                           </center>
                                           </form>";
                                            } 
                                            else {
                                                echo "<h2 style=\"color:#F44336\">Task 0 upload has been closed.</h2>";
                                            }
                                        ?>
                                         
                                     </div>
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
                                                echo "<li><a href=\"".$value["Link"]."\"><label>Link </label></a>".$value["Date"]."</li>";
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