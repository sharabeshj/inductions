<?php

require 'database.php';

require 'session.php';

require 'cookies.php';


function final_touch($field) {
		$field = trim($field);
		$field = stripslashes($field);
		$field = htmlspecialchars($field);
		return $field ;
}

if(logged_in_cookie()){
	$sql="SELECT ID FROM user_basic_data WHERE ID='".$_COOKIE['SPIDERTRONIX_USER_ID']."'";
	if($result = $connection->query($sql)) {
		$row=$result->fetch_array();
		$user_id=$row['ID'];
		$_SESSION['SPIDERTRONIX_USER_ID']=$user_id;
		header("Location: index.php");
	}
}
else if(logged_in_session()){
	header("Location: index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Forgot Password?</title>
<link rel="icon" type="image/ico" href="./favicon.ico">
<link rel="stylesheet" type="text/css" href="./main.css">
<link href="./sign_main.css" rel="stylesheet">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style type="text/css">
.msg_com {
    margin:15% auto;
    max-width:500px;
    padding:15px;
    -webkit-animation: zoomin 0.6s;animation: zoomin 0.6s;
}

@-webkit-keyframes zoomin {
    from {-webkit-transform:scale(0)} 
    to {-webkit-transform:scale(1)}
}

@keyframes zoomin {
    from {transform:scale(0)} 
    to {transform:scale(1)}
}

.msg_cont {
    background:#fff;
    box-shadow: 0px 0px 10px 12px rgba(0,0,0,0.5);
    border-radius:5px;
    width:100%;
}

.okh_header {
    color:#fff;
    font-weight:bold;
    background:#28a745;
    padding:15px 10px;
    font-family:"HE";
    border-top-left-radius:5px;
    border-top-right-radius:5px;
    font-size:20px;
}

._cont {
    padding-top:20px;
    padding-bottom:40px;
    padding-left:10px;
    padding-right:10px;
}

.reffr {
    user-select:none;
    font-size:14px;
}

a,a:focus,a:active,a:visited {
    text-decoration:none;
    transition:all 0.5s;
    color:#000 !important;
    font-weight:bold;
}

a:hover {
    text-decoration:underline;
}
</style>
</head>
<body>
	<div>
		<div class="login_screen_container">
			<center>
			<div class="logo_container">
			<a href="./index.php"><img src="./logo.png" class="logo"></a>
			</div>
			<div class="heading_container">
			Reset your Password
			</div>
			</center>
			<div class="form_container">
				<div class="form_container_paint">
					<div class="form_">
						<div class="header_">
						Reset
						</div>
						<div class="input_container" id="inpt_basic_det">
                            <div class="user_box error" style="text-align:center;display:none;" id="err_head">
							</div>
							<div class="user_box">
							<label class="form_label" for="new_username_input">Roll No.</label>
							<div>
							<input type="number" id="new_username_input" autocomplete="off" name="new_username_input" class="ui_text" value="" required>
							</div>
							<div class="user_box error" id="err_user" style="text-align:center;display:none;border:0px;">
							</div>
							</div>

							<div class="user_box">
							<label class="form_label" for="sec_q">Security Question</label>
							<div>
								<select class="ui_text" id="sec_q" name="sec_q" style="width:100% !important;">
									<option value="">Choose:</option>
									<option value="What is your favourite colour ?">What is your favourite colour ?</option>
									<option value="What is your favourite book ?">What is your favourite book ?</option>
									<option value="What is your favourite sports ?">What is your favourite sports ?</option>
									<option value="What is your favourite cartoon ?">What is your favourite cartoon ?</option>
								</select>
							</div>
							<div class="user_box error" id="err_sq" style="text-align:center;display:none;border:0px;">
							</div>
							</div>
                            
							<div class="user_box">
							<label class="form_label" for="new_sa_input">Security Answer</label>
							<div>
								<input type="text" id="new_sa_input" autocomplete="off" name="new_sa_input" class="ui_text" value="" required>
							</div>
							<div class="user_box error" id="err_sa" style="text-align:center;display:none;border:0px;">
							</div>
							</div>
							
							<br><br>
							<div class="user_box" style="margin-top:30px">
								<input type="submit" onclick="submit_this(this);" id="submit_button" class="ui_button" value="SUBMIT">
							</div>
						</div>

                        <div class="input_container" id="chnge_psw" style="display:none;">
                            <div class="user_box error" style="text-align:center;display:none;" id="err_phead">
							</div>

							<div class="user_box">
							<label class="form_label" for="new_password_input">New Password</label>
							<div>
							<input type="password" id="new_password_input" autocomplete="off" class="ui_text" value="" required>
							</div>
							</div>

                            <div class="user_box">
							<label class="form_label" for="new_repassword_input">Re-Enter Password</label>
							<div>
							<input type="password" id="new_repassword_input" autocomplete="off" class="ui_text" value="" required>
							</div>
							</div>
							<br>
							<div class="user_box" style="margin-top:30px">
								<input type="submit" onclick="chnge_psw(this);" id="submit_pbutton" class="ui_button" value="CHANGE PASSWORD">
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
    <div id="modal_box" style="display:none;">
        <div id="loader" style="display:none;"></div>
        <div id="msg_ok" class="msg_com" style="display:none;">
            <div class="msg_cont">
                <div class="okh_header">
                    Password Successfully Changed
                </div>
                <div class="_cont">
                    Your password was successfully changed. But due to some security reasons you must Sign In again to
                    continue.
                    <br><br>
                    <span class="reffr">Click <a href="./SignIn.php">here</a> to Sign In again.</span>
                    <br><br>
                    <span class="reffr"> Click <a href="./index.php">here</a> to return to Home page.</span>
                </div>
            </div>
        </div>
        <div id="msg_not" class="msg_com" style="display:none;">
            <div class="msg_cont">
                <div class="okh_header" style="background:red">
                    Failed to change Password
                </div>
                <div class="_cont">
                    We are facing some problem right now. please try again after some time.
                    <br><br>
                    <span class="reffr"> Click <a href="./index.php">here</a> to return to Home page.</span>
                </div>
            </div>
        </div>
    </div>
<script>

function submit_this(x) {
    x.value="SUBMITTING...";
    document.getElementById("err_head").style.display="none";
    document.getElementById("err_user").style.display="none";
    document.getElementById("err_sq").style.display="none";
    document.getElementById("err_sa").style.display="none";
    let roll="";
    let sq="";
    let sa="";
    roll=document.getElementById("new_username_input").value;
    sq=document.getElementById("sec_q").value;
    sa=document.getElementById("new_sa_input").value;
    let flag=1;
    if(roll=="") {
        flag=0;
        document.getElementById("err_user").style.display="block";
        document.getElementById("err_user").innerHTML="Error: Roll Number is Required";
    }
    if(sq=="") {
        flag=0;
        document.getElementById("err_sq").style.display="block";
        document.getElementById("err_sq").innerHTML="Error: Security Question is Required";
    }
    if(sa=="") {
        flag=0;
        document.getElementById("err_sa").style.display="block";
        document.getElementById("err_sa").innerHTML="Error: Security Answer is Required";
    }


    if(flag==0) {
        x.value="SUBMIT";
    }
    else {
        check_with_database(roll,sq,sa);
    }
    
}

function check_with_database(roll,sq,sa) {
    document.getElementById("modal_box").style.display="block";
    document.getElementById("loader").style.display="block";
    let xmlhttp="";
        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        } 
        else {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                string=JSON.parse(this.responseText);
                if(string.a=="conn_error"||string.b=="conn_error") {
                    document.getElementById("err_head").style.display="block";
                    document.getElementById("err_head").innerHTML="Some Error occured, Please Try Again.";
                    hide_acc();
                }
                else if(string.a=="1") {
                        if(string.b=="1") {
                            document.getElementById("sec_q").value="";
                            document.getElementById("new_sa_input").value="";
                            document.getElementById("inpt_basic_det").style.display="none";
                            document.getElementById("chnge_psw").style.display="block";
                            hide_acc();
                        }
                        else {
                            document.getElementById("err_head").style.display="block";
                            document.getElementById("err_head").innerHTML="Error: Security Question and Answer doesn't match.";
                            document.getElementById("sec_q").value="";
                            document.getElementById("new_sa_input").value="";
                            hide_acc();
                        }
                }
                else {
                    document.getElementById("err_head").style.display="block";
                    document.getElementById("err_head").innerHTML="Error: Invalid Username.";
                    document.getElementById("sec_q").value="";
                    document.getElementById("new_sa_input").value="";
                    hide_acc();
                }
            }
        };
        xmlhttp.open("Get", "./val_forogt.php?q=true&u="+roll+"&sq="+sq+"&sa="+sa, true);
        xmlhttp.send();
}

function hide_acc() {
    document.getElementById("err_user").style.display="none";
    document.getElementById("err_sq").style.display="none";
    document.getElementById("err_sa").style.display="none";
    document.getElementById("submit_button").value="SUBMIT";
    document.getElementById("modal_box").style.display="none";
    document.getElementById("loader").style.display="none";
}

function chnge_psw(x) {
    x.value="CHANGING...";
    document.getElementById("err_phead").style.display="none";
    let flag=1;
    let psw=rpsw="";
    psw=document.getElementById("new_password_input").value;
    rpsw=document.getElementById("new_repassword_input").value;
    if(psw=="") {
        flag=0;
        document.getElementById("err_phead").style.display="block";
        document.getElementById("err_phead").innerHTML="Error: Password is Required";
    }
    if(psw.length<8) {
        flag=0;
        document.getElementById("err_phead").style.display="block";
        document.getElementById("err_phead").innerHTML="Error: Password must be atleast 8 characters long.";
    }
    if(rpsw!=psw) {
        flag=0;
        document.getElementById("err_phead").style.display="block";
        document.getElementById("err_phead").innerHTML="Error: Password and Re-entered password doesn't match";
    }
    if(flag==0) {
        x.value="CHANGE PASSWORD";
        psw="";
        rpsw="";
        document.getElementById("new_password_input").value="";
        document.getElementById("new_repassword_input").value="";
        return;
    }
    else {
        alter_psw(psw,document.getElementById("new_username_input").value)
    }
        
}

function alter_psw(psw,user) {
    document.getElementById("modal_box").style.display="block";
    document.getElementById("loader").style.display="block";
    let xmlhttp="";
        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        } 
        else {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                string=this.responseText;
                console.log(this.responseText);
                document.getElementById("loader").style.display="none";  
                if(string=="true") {
                    document.getElementById("msg_ok").style.display="block";
                }    
                else {
                    document.getElementById("msg_not").style.display="block";
                }         
            }
        };
        xmlhttp.open("POST", "val_forogt.php", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("q=false&User="+user+"&Psw="+psw);
}

</script>
</body>
</html>
