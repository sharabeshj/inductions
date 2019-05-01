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
		$user_ID=$row['ID'];
		$_SESSION['SPIDERTRONIX_USER_ID']=$user_ID;
		header("Location: index.php");
	}
}
else if(logged_in_session()){
	header("Location: index.php");
}

$name=$username=$password=$check_psw=$phone=$email=$gender=$dept=$sq=$sa="";
$encrypt_password="";
$flag_error=0;
$error_name=$error_username=$error_password=$error_phone=$error_email=$error_gender =$error_dept=$error_sq=$error_sa=$error_head="";
$error_display_name=$error_display_username=$error_display_password=$error_display_phone=$error_display_email=$error_display_gender =$error_display_dept=$error_display_sq=$error_display_sa=$error_display_head="none";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if(empty($_POST["new_name_input"])) {
		$error_display_name="block";
		$error_name="Error: Name is required";
		$flag_error=1;
	}
	else {
		$name = final_touch($_POST["new_name_input"]);
		if(ctype_space($_POST["new_name_input"])) {
		$error_display_name="block";
		$error_name="Error: Name can't start with a SPACE";
		$flag_error=1;
		}
	}
	
	if(empty($_POST["new_username_input"])) {
		$error_display_username="block";
		$error_username="Error: Username is required";
		$flag_error=1;
	}
	else {
		$username = final_touch($_POST["new_username_input"]);
		if(ctype_space($_POST["new_username_input"])) {
		$error_display_username="block";
		$error_username="Error: Username can't start with a SPACE";
		$flag_error=1;
		}
	}
	
	if(empty($_POST["new_password_input"])) {
		$error_display_password="block";
		$error_password="Error: Password is required";
		$flag_error=1;
	}
	else {
		$password = final_touch($_POST["new_password_input"]);
		if(strlen($password)<8) {
		$error_display_password="block";
		$error_password="Error: Password must be 8 characters long";
		$check_psw="";
		$flag_error=1;
		}
		else {
			if(empty($_POST["new_repassword_input"])) {
				$error_display_password="block";
				$error_password="Error: Password doesn't match.";
				$flag_error=1;
			}
			else {
				$check_psw = final_touch($_POST["new_repassword_input"]);
				if(strcmp($_POST["new_repassword_input"],$_POST["new_password_input"])==0) {
					$encrypt_password=password_hash($password,PASSWORD_BCRYPT);
				}
				else {
					$error_display_password="block";
					$error_password="Error: Password doesn't match.";
					$flag_error=1;
				}
		
			}
		}
	}
	
	if(empty($_POST["new_phone_input"])) {
		$error_display_phone="block";
		$error_phone="Error: Phone No. is Required";
		$flag_error=1;
	}
	else {
		$phone = final_touch($_POST["new_phone_input"]);
		if(ctype_space($_POST["new_phone_input"])) {
			$error_display_phone="block";
			$error_phone="Error: Phone Number can't start with a SPACE";
			$flag_error=1;
			}
	}

	if(empty($_POST["new_email_input"])) {
		$error_display_email="block";
		$error_email="Error: Email  is Required";
		$flag_error=1;
	}
	else {
		$email = final_touch($_POST["new_email_input"]);
		if(ctype_space($_POST["new_email_input"])) {
			$error_display_email="block";
			$error_email="Error: Email  can't start with a SPACE";
			$flag_error=1;
			}
	}
	
	if(empty($_POST["dept"])) {
		$error_display_dept="block";
		$error_dept="Error: Department is Required";
		$flag_error=1;
	}
	else {
		$dept = final_touch($_POST["dept"]);
	}

	if(empty($_POST["sec_q"])) {
		$error_display_sq="block";
		$error_sq="Error: Security Question is Required";
		$flag_error=1;
	}
	else {
		$sq = final_touch($_POST["sec_q"]);
	}

	if(empty($_POST["new_sa_input"])) {
		$error_display_sa="block";
		$error_sq="Error: Security Answer is Required";
		$flag_error=1;
	}
	else {
		$sa = final_touch($_POST["new_sa_input"]);
	}

	if(empty($_POST["gender"])) {
		$error_display_gender="block";
		$error_gender="Error: Select your gender";
		$flag_error=1;
	}
	else {
		$gender = final_touch($_POST["gender"]);
	}
}
 
 if($flag_error==0){
	 $error_display_name=$error_display_username=$error_display_password=$error_display_gender =$error_display_dob=$error_display_head="none";
	 if(isset($_POST['new_name_input']) && isset($_POST['new_username_input']) && isset($_POST['new_password_input']) && isset($_POST['new_repassword_input']) && isset($_POST['new_phone_input'])&& isset($_POST['new_email_input'])&& isset($_POST['gender']) && isset($_POST['dept']) && isset($_POST['sec_q']) && isset($_POST['new_sa_input'])) {
			$sql="SELECT * FROM user_basic_data WHERE Roll_No='$username'";
			if($result = $connection->query($sql)) {
				if($result->num_rows>0) {
					$flag_error=1;
					$error_display_username="block";
					$error_username="This username already exists.";
				}
			}
			if($flag_error==0) {
				$query = "INSERT INTO user_basic_data (Name, Roll_No, Password, Phone, Email, Gender, Dept, S_Q, S_A, Access, Domain) VALUES ('$name','$username','$encrypt_password', '$phone', '$email', '$gender','$dept','$sq','$sa','stu', 'none')";
				if($connection->query($query)===TRUE) {
					$sql="SELECT ID FROM user_basic_data WHERE Roll_No='$username' AND Password='$encrypt_password'";
					if($result = $connection->query($sql)) {
							ob_start();
							session_start();
							$row=$result->fetch_array();
							$user_ID=$row['ID'];
							$_SESSION['SPIDERTRONIX_USER_ID']=$user_ID;
							header('Location: index.php');	
					}
					else {
						echo "hahi";
					}
				}
				else {
				echo "Error: " . $query. "<br>" . $connection->error;
				}
			}
	 }	
 }
 if($flag_error==1) {
	 $error_display_head="block";
	 $error_head="There are one or more errors in your form. Correct them and register again !";
 }
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Sign Up | Tronix Inductions</title>
<link rel="icon" type="image/ico" href="./favicon.ico">
<link rel="stylesheet" type="text/css" href="./main.css">
<link href="./sign_main.css" rel="stylesheet">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
	<div>
		<div class="login_screen_container">
			<center>
			<div class="logo_container">
			<a href="./index.php"><img src="./logo.png" class="logo"></a>
			</div>
			<div class="heading_container">
			Sign Up for Tronix Inductions
			</div>
			</center>
			<div class="form_container">
				<div class="form_container_paint">
					<div class="form_">
						<div class="header_">
						Sign Up
						</div>
						<div class="input_container">
						  <form id="new_signup_form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
							<div class="user_box error" style="text-align:center;display:<?php echo $error_display_head ?>">
							<?php echo $error_head ?>
							</div>
							<div class="user_box">
							<label class="form_label" for="new_name_input">Name</label>
							<div>
							<input type="text" id="new_name_input" autocomplete="off" name="new_name_input" class="ui_text" autofocus="on" value="<?php echo $name ?>" required>
							</div>
							<div class="user_box error" style="text-align:center;display:<?php echo $error_display_name ?>;border:0px;">
							<?php echo $error_name ?>
							</div>
							</div>
							
							<div class="user_box">
							<label class="form_label" for="new_username_input">Roll No.</label>
							<div>
							<input type="number" id="new_username_input" autocomplete="off" name="new_username_input" class="ui_text" value="<?php echo $username ?>"required >
							</div>
							<div class="user_box error" style="text-align:center;display:<?php echo $error_display_username ?>;border:0px;">
							<?php echo $error_username ?>
							</div>
							</div>
							
							<div class="user_box">
							<label class="form_label" for="new_password_input">Password</label>
							<div>
							<input type="password" id="new_password_input" name="new_password_input" class="ui_text" value="<?php echo $password ?>" required>
							</div>
							</div>
							
							<div class="user_box">
							<label class="form_label" for="new_repassword_input">Re-Enter Password</label>
							<div>
							<input type="password" id="new_repassword_input" name="new_repassword_input" class="ui_text" value="" required>
							</div>
							<div class="user_box error" style="text-align:center;display:<?php echo $error_display_password ?>;border:0px;">
							<?php echo $error_password ?>
							</div>
							</div>
							
							<div class="user_box">
							<label class="form_label" for="new_name_input">Phone Number</label>
							<div>
							<input type="number" id="new_phone_input" autocomplete="off" name="new_phone_input" class="ui_text" autofocus="on" value="<?php echo $phone ?>" required>
							</div>
							<div class="user_box error" style="text-align:center;display:<?php echo $error_display_phone ?>;border:0px;">
							<?php echo $error_phone ?>
							</div>
							</div>
							
							<div class="user_box">
							<label class="form_label" for="new_name_input">E-mail</label>
							<div>
							<input type="email" id="new_email_input" autocomplete="off" name="new_email_input" class="ui_text" autofocus="on" value="<?php echo $email ?>" required>
							</div>
							<div class="user_box error" style="text-align:center;display:<?php echo $error_display_email ?>;border:0px;">
							<?php echo $error_email ?>
							</div>
							</div>

							<div class="user_box">
							<label class="form_label" for="dept">Department</label>
							<div>
								<select class="ui_text" style="width:100% !important;" id="dept" name="dept">
									<option value="">Choose:</option>
									<option <?php if($dept=="CHEM") echo "selected"?> value="CHEM">CHEM</option>
									<option <?php if($dept=="CIVIL") echo "selected"?> value="CIVIL">CIVIL</option>
									<option <?php if($dept=="CSE") echo "selected"?> value="CSE">CSE</option>
									<option <?php if($dept=="EEE") echo "selected"?> value="EEE">EEE</option>
									<option <?php if($dept=="ECE") echo "selected"?> value="ECE">ECE</option>
									<option <?php if($dept=="ICE") echo "selected"?> value="ICE">ICE</option>
									<option <?php if($dept=="MECH") echo "selected"?> value="MECH">MECH</option>
									<option <?php if($dept=="META") echo "selected"?> value="META">META</option>
									<option <?php if($dept=="PROD") echo "selected"?> value="PROD">PROD</option>
								</select>
							</div>
							<div class="user_box error" style="text-align:center;display:<?php echo $error_display_dept ?>;border:0px;">
							<?php echo $error_dept ?>
							</div>
							</div>

							<div class="user_box">
							<label class="form_label" for="sec_q">Security Question</label>
							<div>
								<select class="ui_text" id="sec_q" name="sec_q" style="width:100% !important;">
									<option value="">Choose:</option>
									<option <?php if($sq=="What is your favourite colour ?") echo "selected"?> value="What is your favourite colour ?">What is your favourite colour ?</option>
									<option <?php if($sq=="What is your favourite book ?") echo "selected"?> value="What is your favourite book ?">What is your favourite book ?</option>
									<option <?php if($sq=="What is your favourite sports ?") echo "selected"?> value="What is your favourite sports ?">What is your favourite sports ?</option>
									<option <?php if($sq=="What is your favourite cartoon ?") echo "selected"?> value="What is your favourite cartoon ?">What is your favourite cartoon ?</option>
								</select>
							</div>
							<div class="user_box error" style="text-align:center;display:<?php echo $error_display_sq ?>;border:0px;">
							<?php echo $error_sq ?>
							</div>
							</div>

							<div class="user_box">
							<label class="form_label" for="new_sa_input">Security Answer</label>
							<div>
								<input type="text" id="new_sa_input" autocomplete="off" name="new_sa_input" class="ui_text" value="<?php echo $sa ?>" required>
							</div>
							<div class="user_box error" style="text-align:center;display:<?php echo $error_display_sa ?>;border:0px;">
							<?php echo $error_sa ?>
							</div>
							</div>

							<div class="user_box">
							<label class="form_label" >Gender</label>
								<div class="gender_sec">
									<label class="form_label custom_checkbox" for="gender_male" style="text-transform:none;transition:all 0.5s;font-weight:bold" id="gender_caption_m">
										Male
									<input type="radio" id="gender_male" name="gender" onClick="check_loggedin(this.id);" value="Male" <?php if ($gender=="Male") echo "checked";?>>
									<span class="radiomark"></span>
								</div>
								<div class="gender_sec">
									<label class="form_label custom_checkbox" for="gender_female" style="text-transform:none;transition:all 0.5s;font-weight:bold" id="gender_caption_f">
										Female
									<input type="radio" id="gender_female" name="gender" onClick="check_loggedin(this.id);" value="Female" <?php if ($gender=="Female") echo "checked";?>>
									<span class="radiomark"></span>
								</div>
							<div class="user_box error" style="text-align:center;display:<?php echo $error_display_gender ?>;border:0px;">
							<?php echo $error_gender ?>
							</div>
							</div>
							
							
							<div class="user_box" style="margin-top:30px">
								<input type="submit" onclick="submit_this(this);" id="submit_button" class="ui_button" value="SIGN UP">
							</div>
						  </form>
							<br>
							<hr>
							<center>
							<div class="new_registered_user_help">
							Already have an account ? <b><a href="./SignIn.php">Sign In</a></b> here
							</div>
							</center>
						</div>
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<script>
	
function check_loggedin(id) {
	let gender=id.charAt(7);
	console.log(id);
	console.log(gender);
	if(document.getElementById(id).checked) {
		document.getElementById("gender_caption_m").style.color="#aaa";
		document.getElementById("gender_caption_f").style.color="#aaa";
		document.getElementById("gender_caption_"+gender).style.color="#fff";
	}
	else  {
		document.getElementById("gender_caption_"+gender).style.color="#aaa";

	}
}

function psw_toggle() {
	var psw=document.getElementById("password_input");
	var img=document.getElementById("toggle_psw");
	if (psw.type === "password") {
        psw.type = "text";
		img.src="./eye_check.png";
    } else {
        psw.type = "password";
		img.src="./eye.png";
   }
}

function submit_this(x) {
	x.value="SIGNING UP...";
}
</script>
</body>
</html>