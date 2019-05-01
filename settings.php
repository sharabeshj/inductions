<?php
require 'database.php';

require 'session.php';

require 'cookies.php';

if(isset($_SESSION['SPIDERTRONIX_USER_ID'])) {
    $user_name=grab_data("Name");
    $user_dept=grab_data("Dept");
    $user_roll=grab_data("Roll_No");
    $gender=grab_data("Gender");
    $pos=grab_data("Access");
    $phone= grab_data("Phone");
    $mail= grab_data("Email");
    $domain= grab_data("Domain");
}
else {
    header("Location:./index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Settings | </title>
    <link rel="icon" type="image/ico" href="./favicon.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="./main.css">
    <link rel="stylesheet" type="text/css" href="./home.css">
    <link rel="stylesheet" type="text/css" href="./header_ac.css">
    <link rel="stylesheet" type="text/css" href="./body_ac.css">
    <link rel="stylesheet" type="text/css" href="./settings.css">
    <link rel="stylesheet" type="text/css" href="./modal.css">
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
                    <a href="./index.php">
                    <div class="menu_option">
                        Home
                    </div></a>
                    <a href="./logout.php"><div class="menu_option" id="log_but">
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
                        <a href="./index.php" title="General Settings"><div class="tab_cont tab_active" >
                            General Settings
                        </div></a>
                    </div>

                    <div class="tab_desc">
                        <div class="tab_col">
                            <div class="_div_sec" style="border-right: 2px solid #bfbaba;">
                                <input type="hidden" id="user_roll_number" value="<?php echo $user_roll?>">
                                <div class="_cr_sec" style="display:">
                                    <div class="_crs_head">
                                       Profile
                                    </div><br>
                                    <div class="profile_box">
                                            <div style="padding: 0px 20px 0px 20px;">
                                                  <div class="div_bar"></div>
                                            </div>
                                            <div class="tr_" onclick='edit_profile("name");' title="Click to Edit Name">
                                                <div class="display_settings_basics table_"><h3>Name </h3></div>
                                                <div class="display_settings_basics table_" style="color:#000;font-size:0.95rem;"><?php echo $user_name?></div>
                                            </div>
                                            <div style="padding: 0px 20px 0px 20px;">
                                                  <div class="div_bar"></div>
                                            </div>
                                            <div class="tr_" style="cursor: not-allowed;" title="Username can't be changed.">
                                                <div class="display_settings_basics table_"><h3>Roll No. </h3></div>
                                                <div class="display_settings_basics table_" style="color:#000;font-size:0.95rem;"><?php echo $user_roll?></div>
                                            </div>
                                            <div style="padding: 0px 20px 0px 20px;">
                                                  <div class="div_bar"></div>
                                            </div>
                                            <div class="tr_" onclick='edit_profile("psw");' title="Click to change password.">
                                                <div class="display_settings_basics table_"><h3>Password </h3></div>
                                                <div class="display_settings_basics table_" style="color:#000;font-size:0.95rem;"><input type="password" class="pssw" disabled value="<?php echo $user_roll?>"></div>
                                            </div>
                                            <div style="padding: 0px 20px 0px 20px;">
                                                  <div class="div_bar"></div>
                                            </div>
                                            <div class="tr_"  onclick='edit_profile("dept");' title="Click to Edit Department">
                                                <div class="display_settings_basics table_"><h3>Departmet </h3></div>
                                                <div class="display_settings_basics table_" style="color:#000;font-size:0.95rem;"><?php echo $user_dept?></div>
                                            </div>
                                            <div style="padding: 0px 20px 0px 20px;">
                                                  <div class="div_bar"></div>
                                            </div>
                                            <div class="tr_" onclick='edit_profile("gend");' title="Click to Edit Gender">
                                                <div class="display_settings_basics table_"><h3>Gender </h3></div>
                                                <div class="display_settings_basics table_" style="color:#000;font-size:0.95rem;"><?php echo $gender?></div>
                                            </div>
                                            <div style="padding: 0px 20px 0px 20px;">
                                                  <div class="div_bar"></div>
                                            </div>
                                            <div class="tr_" style="cursor: not-allowed;"  title="Year is automatically Calcuated.">
                                                <div class="display_settings_basics table_"><h3>Year </h3></div>
                                                <div class="display_settings_basics table_" style="color:#000;font-size:0.95rem;"><span id="js_year"></span></div>
                                            </div>
                                            <div style="padding: 0px 20px 0px 20px;">
                                                  <div class="div_bar"></div>
                                            </div>
                                            <div class="tr_"  onclick='edit_profile("phone");' title="Click to edit Phone Number">
                                                <div class="display_settings_basics table_"><h3>Phone </h3></div>
                                                <div class="display_settings_basics table_" style="color:#000;font-size:0.95rem;"><?php echo $phone?></span></div>
                                            </div>
                                            <div style="padding: 0px 20px 0px 20px;">
                                                  <div class="div_bar"></div>
                                            </div>
                                            <div class="tr_"  onclick='edit_profile("email");' title="Click to edit Email">
                                                <div class="display_settings_basics table_"><h3>Email </h3></div>
                                                <div class="display_settings_basics table_" style="color:#000;font-size:0.95rem;text-transform:lowercase"><?php echo $mail?></span></div>
                                            </div>
                                            <div style="padding: 0px 20px 0px 20px;">
                                                  <div class="div_bar"></div>
                                            </div>
                                            <div class="tr_" style="cursor: not-allowed;" title="Domain can't be changed right now.">
                                                <div class="display_settings_basics table_"><h3>Domain</h3></div>
                                                <div class="display_settings_basics table_" style="color:#000;font-size:0.95rem;text-transform:none;"><?php echo $domain?></span></div>
                                            </div>
                                    </div>
                                </div>
                                <br>

                            </div>
                        </div>
                        <div class="tab_col">
                            <div class="_div_sec" style="border:none !important">
                                <div class="_cr_sec">
                                    <div class="_ann_head" style="background:#cb2431;color:#fff;">
                                        Danger Zone
                                    </div>
                                    <div style="margin-top:10px;font-size:14px;padding:10px;">
                                    Once you delete your account, there is no going back. Please be certain.
                                    </div>
                                    <div  style="padding:10px;">
                                        <button class="elec_button del_r" onclick="del_accnt();" title="This will permanently delete your account.">Delete my Account</button>
                                    </div>
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
        <input type="hidden" id="user_name" value="<?php echo $user_name?>"> 
        <input type="hidden" id="user_gender" value="<?php echo $gender?>">    
        <div id="loader" style="display:none;"></div>
        <div id="modal_cover" style="position:relative;height:100%;overflow-y:scroll">
            <div class="modal-content" id="mdl_content">
                <div class="modal_head" id="modal_head_cont">Edit Profile</div>
                <div class="cross_" title="Close" onclick="close_edit_modal();">
                    <div id="close1" class="bar_com"></div>
                    <div id="close2" class="bar_com"></div>
                </div>
                <div class="modal_cont_box" id="edit_profile" style="display:none">
                        <div class="form_container">
                            <div class="profile_box">
                                <div style="padding: 0px 20px 0px 20px;">
                                        <div class="div_bar"></div>
                                </div>
                                <div class="tr_">
                                    <div class="display_settings_basics table_" ><h3 id="head_edit"> </h3></div>
                                    <input type="hidden" id="call_id" value="">
                                    <div class="display_settings_basics table_" style="color:#000;font-size:0.95rem;" id="new_edit_sec">
                                    
                                    </div>
                                </div>
                            </div>
                           <div class="panel_">
                                <span style="float:right">
                                      <button class="elec_button add_ann_but" onclick="validate_edit();">Update</button>
                                </span>
                           </div>
                           <br><br>
                        </div>
                </div>
            </div>
        </div>
    </div>
    <div id="popup"></div>
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
            document.getElementById("mdl_content").classList.add("modal_zoomout");
            setTimeout(function(){
                document.getElementById("edit_profile").style.display="none";
                document.getElementById("mdl_content").classList.remove("modal_zoomout");
                document.getElementById("modal_box").style.display="none";
            }, 400);
            
        }
    }
    
    function close_edit_modal() {
        document.getElementById("mdl_content").classList.add("modal_zoomout");
            setTimeout(function(){
                document.getElementById("edit_profile").style.display="none";
                document.getElementById("mdl_content").classList.remove("modal_zoomout");
                document.getElementById("modal_box").style.display="none";
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
 document.getElementById("js_year").innerHTML=y;
 document.getElementById("user_year").value=y;
</script>
<script src="./settings.js"></script>
</body>
</html>