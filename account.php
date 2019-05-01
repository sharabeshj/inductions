<?php
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
    <title>Tronix Inductions</title>
    <link rel="icon" type="image/ico" href="./favicon.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="./main.css">
    <link rel="stylesheet" type="text/css" href="./home.css">
    <link rel="stylesheet" type="text/css" href="./header_ac.css">
    <link rel="stylesheet" type="text/css" href="./body_ac.css">
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
            if($dom=="none") {
                echo "<div class=\"body_container\">   
                <div class=\"body_cover\">
                    <div class=\"tabs_\">
                        <div class=\"_welcome user_none\">
                            Welcome<span class=\"_wel_user\">".$user_name."</span>
                        </div>
                        <div class=\"profile_fill_cont\">
                            <div class=\"profile_head\">
                                Domain Selection
                            </div>
                            <div class=\"domain_cont\">
                            Hi there! Now its time to select a domain on which you can work throughout this summer. Out of the three domains, you can select only one and will work on it. However, if after some time you feel that you don't want to take this domain further, you can easily change it. Changing of the domain can be only done before Stage 1 overs. Once we enter into Stage 2, no changing of the domains is allowed. However, we would also like to suggest you guys to wisely select your domain according to your area of interest so as to avoid changing of domain later on since changing of domain can increase work pressure. 
                            <br>
                            <p>Here we are providing short details about each of the domain so as to help you in deciding what we do inside that particular domain. If you have doubt regarding a particular domain, you can directly contact the POC of the domain or any one of us. We will be happy to help you out.</p>
                            <p>Best of Luck!</p>
                            </div>
                            <hr>
                            <div class=\"domain_form_cont\">
                                <form action=\"";
                                echo htmlspecialchars($_SERVER["PHP_SELF"]);
                                echo "\" method=\"POST\">
                                    <div class=\"div_row\">
                                        <div class=\"divp_col_domain\"><span style=\"font-family:'PP'\">Domain:</span></div>
                                        <div class=\"divp_col_sel\"><select name=\"dom_select\" value=\"\" id=\"dom_select\" onchange=\"validate_domain();\">
                                            <option value=\"\">Choose</option>
                                            <option value=\"Embedded and Electronics\">Embedded and Electronics</option>
                                            <option value=\"Robotics and Control\">Robotics and Control</option>
                                            <option value=\"Computer Vision and ML\">Computer Vision and ML</option>
                                        </select></div>
                                        <div class=\"divp_col_but\">
                                            <input type=\"submit\" style=\"display:inline;width:100px;cursor: not-allowed;margin-top: 0px;padding:9px 10px;float:right\" class=\"elec_button\"value=\"Submit\" id=\"but_domain\" disabled>
                                        </div>
                                    </div>
                                    </form>
                            </div>
                        </div>
                    </div>
                </div>
                </div>";

            }
            else {
                echo "<div class=\"body_container\">   
                <div class=\"body_cover\">
                    <div class=\"tabs_\">
                        <div class=\"_welcome user_none\">
                            Welcome<span class=\"_wel_user\">".$user_name."</span>
                        </div>
                        <div class=\"tab_header\">
                            <a href=\"./index.php\"><div class=\"tab_cont tab_active\" >
                                Dashboard
                            </div></a>";
                            if($pos=="adm" || $pos=="admin") {
                                echo "<a href=\"./grade.php\"><div class=\"tab_cont\">";
                                echo "Grade";            
                                echo "</div></a>";
                                echo "<a href=\"./admin.php\"><div class=\"tab_cont\">";
                                echo "Admin";            
                                echo "</div></a>";
                            }
                            if($pos=="stu") {
                                echo "<a href=\"./tasks.php\"><div class=\"tab_cont\">";
                                echo "Tasks";            
                                echo "</div></a>";
                            }
                echo    "</div>
                        <div class=\"tab_desc\">
                            <div class=\"tab_col\">
                                <div class=\"_div_sec\" style=\"border-right: 2px solid #bfbaba;\">
                                    <input type=\"hidden\" id=\"user_roll_number\" value=\"".$user_roll."\">";
                                        if($pos=="stu") {
                                            echo "<div class=\"_cr_sec\">
                                            <div class=\"_crs_head\">
                                                Your Mentor
                                            </div>
                                                <div class=\"_class_reps\">
                                                    <div id=\"cr_loader\" style=\"display:non;\">
                                                        <center>
                                                            <img src=\"./loader.gif\" style=\"width:100px;height:100px;\">
                                                        </center>
                                                     </div>
                                                    <div id=\"no_cr_\" style=\"padding:10px;width:100;display:none;\">
                                                        <div id=\"_no_cr\" class=\"_no_elec\">
                                                            No Mentor has been Allocated to You!
                                                        </div>
                                                    </div>
                                                    <div class=\"cr_row\" id=\"cr_row\" style=\"display:none;\">
                                                    </div>
                                                </div>
                                        </div>\"";
                                        }
                                        if($pos=="adm" || $pos=="admin") {
                                            echo "<div class=\"_cr_sec\">
                                            <div class=\"_crs_head\">
                                                Your Mentee(s)
                                            </div>
                                                <div class=\"_class_reps\">
                                                    <div id=\"mentee_loader\" style=\"display:non;\">
                                                        <center>
                                                            <img src=\"./loader.gif\" style=\"width:100px;height:100px;\">
                                                        </center>
                                                     </div>
                                                    <div id=\"no_mentee_\" style=\"padding:10px;width:100;display:none;\">
                                                        <div id=\"_no_cr_er\" class=\"_no_elec\" style=\"\">
                                                            No mentee(s) found for you!!!
                                                        </div>
                                                    </div>
                                                    <div class=\"cr_row\" id=\"mentee_row\" style=\"display:none;\">
                                                    </div>
                                                </div>
                                        </div>";
                                        }
                                    echo "<br>
                                    <div class=\"_cr_sec\">
                                        <div class=\"_ann_head\">
                                            Announcements
                                        </div>
                                        <div id=\"ann_loader\" style=\"display:block;\">
                                                <center>
                                                    <img src=\"./loader.gif\" style=\"width:100px;height:100px;\">
                                                </center>
                                        </div>
                                        <div style=\"width:100%;padding:10px 20px 0px 20px;height: 350px;overflow-y: scroll;display:none\" id=\"ann_cont\">
                                             
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class=\"tab_col\">
                                <div class=\"_div_sec\" style=\"border:none !important\">
                                    <center><h2 style=\"font-family:'PP'\">SCHEDULE</h2></center>
                                    <div class=\"timeline\">
                                        <div class=\"container left\">
                                            <div class=\"content\">
                                            <div class=\"tl_block_head\">Mentor Allocation</div>
                                            <hr>
                                            <p class=\"tm_desc\"><b style=\"color:#ff7a7a\">END:</b> 9<sup>th</sup> May, 2019</p>
                                            </div>
                                        </div>
                                        <div class=\"container right\">
                                            <div class=\"content\">
                                            <div class=\"tl_block_head\">Task 0</div>
                                            <hr>
                                            <p class=\"tm_desc\">
                                                <b style=\"color:#ff7a7a\">LAUNCH:</b> 10<sup>th</sup> May, 2019<br>
                                                <b style=\"color:#ff7a7a\">END:</b> 20<sup>th</sup> May, 2019
                                            </p>
                                            </div>
                                        </div>
                                        <div class=\"container left\">
                                            <div class=\"content\">
                                            <div class=\"tl_block_head\">Task 1</div>
                                            <hr>
                                            <p class=\"tm_desc\">
                                                <b style=\"color:#ff7a7a\">LAUNCH:</b> 10<sup>th</sup> May, 2019<br>
                                                <b style=\"color:#ff7a7a\">END:</b> 15<sup>th</sup> June, 2019
                                            </p></div>
                                        </div>
                                        <div class=\"container right\">
                                            <div class=\"content\">
                                            <div class=\"tl_block_head\">Task 2</div>
                                            <hr>
                                            <p class=\"tm_desc\">
                                                <b style=\"color:#ff7a7a\">LAUNCH:</b> 16<sup>th</sup> June, 2019<br>
                                                <b style=\"color:#ff7a7a\">END:</b> 16<sup>th</sup> July, 2019
                                            </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>";
            }
        ?>

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

<script src="./dashboard.js"></script>
<?php 
 echo "<script>";
 if($dom!="none") {
    echo "load_announcement();";
    if($pos=="adm" || $pos=="admin") {
        echo "load_mentee();";
    }
    else {
    echo "load_mentor();";
    }
 }
    
 echo "</script>";
?>    
</body>
</html>