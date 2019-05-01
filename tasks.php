<?php
require 'database.php';

require 'session.php';

require 'cookies.php';

$popup=false;
$poup_msg="";
function final_touch($field) {
    $field = trim($field);
    $field = stripslashes($field);
    $field = htmlspecialchars($field);
    return $field ;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if(isset($_POST["dom_select"])) {
        $val=final_touch($_POST["dom_select"]);
        $sql="UPDATE user_basic_data SET Domain='$val' WHERE ID='".$_SESSION['SPIDERTRONIX_USER_ID']."'";
        if($result = $connection->query($sql)) {
            $popup=true;
            $poup_msg="Saved";
        }
        else {
            $popup=true;
            $poup_msg="Oops! Try Again";
        }
    }
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
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Tasks</title>
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
                                echo "Tasks";            
                                echo "</div></a>";
                            }
                            ?>
                        </div>
                        <div class="tab_desc">
                            <div class="instruction_panel">
                                <div class="_head">Instructions</div>
                                <div class="inst_content">
                                    General Instruction goes here
                                </div>
                            </div>

                            <div class="task_card row_">
                                <div class="col_">
                                    <div class="task_wrapper">
                                      <a href="./task0.php" title="Click to open Task 0">
                                        <div class="flip-card">
                                            <div class="flip-card-inner">
                                                <div class="flip-card-front">
                                                    <h2>Task 0</h2> 
                                                    <img src="./logo_white.png" style="width:100px;height:100px;">
                                                </div>
                                                <div class="flip-card-back">
                                                    <h3>Difficulty Level: Very Easy</h3>
                                                    <p>Basic Hardware Task</p> 
                                                    <p>Stage 1</p> 
                                                    <p>Compulsory</p>
                                                </div>
                                            </div>
                                        </div>
                                      </a>
                                    </div>
                                </div>

                                <div class="col_">
                                    <div class="task_wrapper">
                                      <a href="./task1.php" title="Click to open Task 1">
                                        <div class="flip-card">
                                            <div class="flip-card-inner">
                                                <div class="flip-card-front">
                                                    <h2>Task 1</h2> 
                                                    <img src="./logo_white.png" style="width:100px;height:100px;">
                                                </div>
                                                <div class="flip-card-back">
                                                    <h3>Difficulty Level: Easy</h3>
                                                    <p>Stage 1</p>  
                                                    <p>3 sub-domains</p> 
                                                    <p>Compulsory</p>
                                                </div>
                                            </div>
                                        </div>
                                      </a>
                                    </div>
                                </div>

                                <div class="col_">
                                    <div class="task_wrapper">
                                     <a href="" title="Task 2 will open shortly" style="cursor:not-allowed">
                                        <div class="flip-card">
                                            <div class="flip-card-inner">
                                                <div class="flip-card-front">
                                                    <h2>Task 2</h2> 
                                                    <img src="./logo_white.png" style="width:100px;height:100px;">
                                                </div>
                                                <div class="flip-card-back">
                                                    <h3>Difficulty Level: Medium</h3> 
                                                    <p>Stage 2</p> 
                                                    <p>3 sub-domains</p> 
                                                    <p>Compulsory</p>
                                                </div>
                                            </div>
                                        </div>
                                      </a>
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