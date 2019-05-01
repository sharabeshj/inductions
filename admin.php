<?php

require 'database.php';

require 'session.php';

require 'cookies.php';

if(isset($_SESSION['SPIDERTRONIX_USER_ID'])) {
    $user_name=grab_data("Name");
    $user_dept=grab_data("Dept");
    $user_roll=grab_data("Roll_No");
    $user_sec=grab_data("Sec");
    $gender=grab_data("Gender");
    $pos=grab_data("Access"); 
}
else {
    header("Location:./index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Admin | Tronix Inductions</title>
    <link rel="icon" type="image/ico" href="./favicon.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="./main.css">
    <link rel="stylesheet" type="text/css" href="./home.css">
    <link rel="stylesheet" type="text/css" href="./header_ac.css">
    <link rel="stylesheet" type="text/css" href="./body_ac.css">
    <link rel="stylesheet" type="text/css" href="./body_admin.css">
    <link rel="stylesheet" type="text/css" href="./modal.css">
    <link rel="stylesheet" type="text/css" href="./footer.css">
    <link rel="stylesheet" type="text/css" href="./announcements.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <?php
     if($pos=="stu") {
        header("Location:./index.php");
     }
    ?>
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

        <div class="body_container">   
            <div class="body_cover">
                <div class="tabs_">
                    <div class="_welcome user_none">
                        Welcome<span class="_wel_user"><?php echo $user_name;?></span>
                    </div>
                    <div class="tab_header">
                        <a href="./index.php"><div class="tab_cont" >
                            Dashboard
                        </div></a>
                        <?php 
                        if($pos=="adm" || $pos=="admin") {
                            echo "<a href=\"./grade.php\"><div class=\"tab_cont\">";
                            echo "Grade";            
                            echo "</div></a>";
                            echo "<a href=\"./admin.php\"><div class=\"tab_cont tab_active\">";
                            echo "Admin";            
                            echo "</div></a>";
                        }
                        ?>
                    </div>
                    <div class="tab_desc">
                        <div class="tab_col">
                            <div class="_div_sec" style="border-right: 2px solid #bfbaba;">
                                <input type="hidden" id="user_roll_number" value="<?php echo $user_roll?>">
                                <div class="_cr_sec">
                                    <div class="_crs_head">
                                        <span style="font-weight:bold;">Announcements</span>
                                    </div>
                                    <div style="padding:10px 20px 10px 20px">
                                        <button class="elec_button" onclick="add_announcement();">Add Announcement</button>
                                        <button class="elec_button del_req">Edit Announcement</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab_col">
                            <div class="_div_sec" style="border:none !important">
                                <div class="_cr_sec">
                                    <div class="_crs_head">
                                        <span style="font-weight:bold;">Manage Task(s)</span>
                                    </div>
                                    <div style="padding:10px 20px 10px 20px">
                                        <button class="elec_button" onclick="add_task();">Add Task</button>
                                        <button class="elec_button del_req">Edit Task</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    if($pos=="admin") {
                        echo "<fieldset class=\"admin_privilege_content\">
                        <legend>Admin Privillage</legend>
                        <div id=\"ap_loader\" style=\"display:;\">
                            <center>
                                <img src=\"./loader.gif\" style=\"width:100px;height:100px;\">
                            </center>
                        </div>
                        <div class=\"user_list_cont\" id=\"user_list\">
                            
                        </div>
                    </fieldset>";
                    }
                    ?>
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
        <div id="modal_cover" style="position:relative;height:100%;overflow-y:scroll">
            <div style="position:relative;width:90%;height:auto;top:100px;margin:auto;padding:20px;">
                <div class="modal_head" id="modal_head_cont">Announcement</div>
                <div class="cross_" title="Close" onclick="close_edit_modal();">
                    <div id="close1" class="bar_com"></div>
                    <div id="close2" class="bar_com"></div>
                </div>
                <div class="modal_cont_box" id="add_announcement" style="display:none">
                        <div class="form_container">
                           <div class="div_text_cont">
                                <div class="div_text_head" id="title_head">Title</div>
                                <div class="ui_text div_text" id="title_cont" contenteditable="true" oninput="adjust_head('title');"></div>
                           </div>
                           <div class="div_text_cont">
                                <div class="div_text_head" id="ann_head">Body</div>
                                <div class="ui_text div_text" id="ann_cont" contenteditable="true" aria-multiline="true" role="textbox" oninput="adjust_head('ann');"></div>
                           </div>
                           <div class="panel_">
                                <span>
                                   <input type="checkbox" id="important_ann"> <label for="important_ann" style="user-select:none;cursor:pointer;">Important</label>
                                </spaN>
                                <span style="float:right">
                                      <button class="elec_button add_ann_but" onclick="announcement_add();">Add</button>
                                </span>
                           </div>
                        </div>
                 </div>
                <div class="modal_cont_box" id="add_task" style="display:none">
                    <div class="form_container">
                           <div class="div_text_cont">
                                <div class="div_text_head" id="task_no_head">Task Number</div>
                                <div class="ui_text div_text" id="task_no_cont" contenteditable="true" role="textbox" oninput="adjust_head('task_no');"></div>
                           </div>
                           <div class="div_text_cont">
                                <div class="div_text_head" id="deadline_head">Deadline</div>
                                <div class="ui_text div_text" id="deadline_cont" role="date" contenteditable="true" oninput="adjust_head('deadline');"></div>
                           </div>
                           <div class="div_text_cont" style="min-height:50px;">
                                <div class="div_text_head" id="domain_head">
                                    Domain
                                    <select name="dom_select" value="" id="dom_select" onchange="validate_domain();">
                                            <option value="">Choose</option>
                                            <option value="Embedded and Electronics">Embedded and Electronics</option>
                                            <option value="Robotics and Control">Robotics and Control</option>
                                            <option value="Signal Processing and Machine Learning">Signal Processing and Machine Learning</option>
                                    </select>
                                    <input type="hidden" id="sel_domain" value="">
                                </div>
                           </div>
                           <div class="div_text_cont" style="min-height:50px;">
                                <div class="div_text_head" id="subdomain_head">
                                    Sub-Domain
                                    <select name="subdom_select" style="cursor:not-allowed;" value="" id="subdom_select" onchange="validate_subdomain();"disabled >
                                            <option value="">Choose</option>
                                    </select>
                                    <input type="hidden" id="sel_sub_domain" value="">
                                </div>
                           </div><br>
                           <div class="div_text_cont">
                                <div class="div_text_head" id="link_head">Link for ReadMe</div>
                                <div class="ui_text div_text" id="link_cont" contenteditable="true" role="textbox" oninput="adjust_head('link');"></div>
                           </div>
                           <div class="div_text_cont">
                                <div class="div_text_head" id="ps_head">Problem Statement</div>
                                <div class="ui_text div_text" id="ps_cont" contenteditable="true" role="textbox" oninput="adjust_head('ps');"></div>
                           </div>
                           <div class="panel_">
                                
                                <span style="float:right">
                                      <button class="elec_button add_ann_but" onclick="task_add();">Add</button>
                                </span><br><br>
                           </div>
                    </div> 
                </div>
            </div>
        </div>
    </div>

    <div id="popup"></div>
<script src="./admin.js"></script>
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
        if (event.target == document.getElementById("modal_box")||event.target == document.getElementById("modal_cover")) {
            document.getElementById("modal_cover").classList.add("modal_zoomout");
            setTimeout(function(){
                document.getElementById("add_announcement").style.display="none";
                document.getElementById("add_task").style.display="none";
                document.getElementById("modal_box").style.display="none";
                document.getElementById("modal_cover").classList.remove("modal_zoomout");
            }, 400);
        }
    }
    
    function close_edit_modal() {
        document.getElementById("modal_cover").classList.add("modal_zoomout");
            setTimeout(function(){
                document.getElementById("add_announcement").style.display="none";
                document.getElementById("add_task").style.display="none";
                document.getElementById("modal_box").style.display="none";
                document.getElementById("modal_cover").classList.remove("modal_zoomout");
            }, 400);
    }

 let roll=document.getElementById("user_roll_number").value;
 let adm_year=roll.charAt(4)+roll.charAt(5);
 adm_year=Number(adm_year);
 let year=new Date();
 month=year.getMonth();
 year=year.getFullYear().toString();
 year=year.charAt(2)+year.charAt(3);
 year=Number(year);
 let y=year-adm_year;
 if(month>=6) {
     ++y;
 }
 document.getElementById("user_year").value=y;
 <?php 
 if($pos=="admin") {
     echo "load_users_privilage();";
 }
 ?>
</script>
</body>
</html>