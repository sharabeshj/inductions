function edit_profile(x) {
    document.getElementById("modal_box").style.display="block";
    document.getElementById("edit_profile").style.display="block";
    document.getElementById("mdl_content").classList.add("mdl_container");
    document.getElementById("modal_head_cont").innerHTML="Edit Profile";
    document.getElementById("call_id").value=x;
    setTimeout(function(){
        document.getElementById("mdl_content").classList.remove("mdl_container");
    }, 400);
    let ele=document.getElementById("new_edit_sec");
    str="";
    if(x=="name") {
        document.getElementById("head_edit").innerHTML="New Name";
        str="<input type=\"textbox\" placeholder=\"John Doe\" class=\"ui_text\" title=\"New Name Here\" value=\"\" id=\"new_name\">";
    }
    else if(x=="dept"){
        document.getElementById("head_edit").innerHTML="New Department";
        str="<select class=\"ui_text\" id=\"new_dept\" name=\"dept\"><option value=\"None\" selected>Choose:</option>"+
            "<option value=\"CHEM\">CHEM</option>"+
            "<option value=\"CIVIL\">CIVIL</option>"+
            "<option value=\"CSE\">CSE</option>"+
            "<option value=\"EEE\">EEE</option>"+
            "<option value=\"ECE\">ECE</option>"+
            "<option value=\"ICE\">ICE</option>"+
            "<option value=\"MECH\">MECH</option>"+
            "<option value=\"META\">META</option>"+
            "<option value=\"PROD\">PROD</option>"+
        "</select>";
    }
    else if(x=="gend"){
        document.getElementById("head_edit").innerHTML="New Gender";
        str="<div class=\"gender_sec\">"+
            "<label class=\"form_label custom_checkbox\" for=\"gender_male\" style=\"text-transform:none;transition:all 0.5s;font-weight:bold\" id=\"gender_caption_m\">Male"+
            "<input type=\"radio\" id=\"gender_male\" name=\"gender\" value=\"Male\">"+
            "<span class=\"radiomark\"></span>"+
        "</div>"+
        "<div class=\"gender_sec\">"+
            "<label class=\"form_label custom_checkbox\" for=\"gender_female\" style=\"text-transform:none;transition:all 0.5s;font-weight:bold\" id=\"gender_caption_f\">Female"+
            "<input type=\"radio\" id=\"gender_female\" name=\"gender\" value=\"Female\">"+
            "<span class=\"radiomark\"></span>"+
        "</div>";
    }
    else if(x=="phone"){
        document.getElementById("head_edit").innerHTML="New Phone";
        str="<input type=\"number\" placeholder=\"10 Digit Mobile Number\" class=\"ui_text\" title=\"New Phone Number Here\" value=\"\" id=\"new_phone\">";
    }
    else if(x=="email"){
        document.getElementById("head_edit").innerHTML="New Email";
        str="<input type=\"email\" placeholder=\"xyz@abc.com\" class=\"ui_text\" title=\"New Name Here\" value=\"\" id=\"new_email\">";
    }
    else if(x=="psw") {
        document.getElementById("head_edit").innerHTML="Change Password";
        str="<input type=\"password\" placeholder=\"New password (Atleast 8 characters long)\" class=\"ui_text\" title=\"New Password\" value=\"\" id=\"new_pass\"><br><br>"+
        "<input type=\"password\" placeholder=\"Re-enter Password\" class=\"ui_text\" title=\"Re-enter Password\" value=\"\" id=\"new_chk_pass\">";
    }
    ele.innerHTML=str;
}

function validateEmail(mail) 
{
 if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(mail))
  {
    return (true)
  }
 else 
    return (false)
}

function validate_edit() {
    let x=document.getElementById("call_id").value;
    let error=0;
    let err_msg="";
    let ajax_val="";
    let ajax_key="";
    let ajax_ID=document.getElementById("user_roll_number").value;
    if(x=="name") {
        let _val=document.getElementById("new_name").value;
        _val=_val.trim();
        if(_val=="") {
            alert("Error: Name can't be Empty.");
            document.getElementById("new_name").focus();
            return;
        }
        else {
            ajax_val=_val;
            ajax_key="Name";
        }
    }
    else if(x=="dept"){
        let _val=document.getElementById("new_dept").value;
        _val=_val.trim();
        if(_val=="" || _val =="None") {
            alert("Error: Select a Department.");
            return;
        }
        else {
            ajax_val=_val;
            ajax_key="Department";
        }
    }
    else if(x=="gend"){
        let f=document.getElementById("gender_female").checked;
        let m=document.getElementById("gender_male").checked;
        if(f==m) {
            alert("Error: Please select Gender.");
            return;
        }
        else {
            _val="";
            if(f) {
                _val=document.getElementById("gender_female").value;
            }
            else {
                _val=document.getElementById("gender_male").value;
            }
            ajax_val=_val;
            ajax_key="Gender";
        }
    }
    else if(x=="phone"){
        let _val=document.getElementById("new_phone").value;
        _val=_val.trim();
        if(_val=="" || _val.length!=10) {
            alert("Error: Invalid Phone Number");
            document.getElementById("new_phone").focus();
            return;
        }
        else {
            ajax_val=_val;
            ajax_key="Phone";
        }
    }
    else if(x=="email"){
        let _val= document.getElementById("new_email").value;
        let chk= validateEmail(_val);
        if(!chk) {
            _val="";
        }
        _val=_val.trim();
        if(_val=="") {
            alert("Error: Invalid Email");
            document.getElementById("new_email").focus();
            return;
        }
        else {
            ajax_val=_val;
            ajax_key="Email";
        }
    }
    else if(x=="psw") {
        let psw=document.getElementById("new_pass").value;
        let chk_psw=document.getElementById("new_chk_pass").value;
        psw=psw.trim();
        chk_psw=chk_psw.trim();
        if(psw.length<8) {
            alert("Password must be 8 characters long.");
            document.getElementById("new_pass").focus;
            document.getElementById("new_chk_pass").value="";
            return;
        }
        else if(psw!=chk_psw){
            alert("Password and Check Password doesn't match.");
            document.getElementById("new_pass").focus;
            document.getElementById("new_chk_pass").value="";
            return;
        }
        else if(psw==chk_psw) {
            ajax_val=psw;
            ajax_key="Password";
        }
    }
    document.getElementById("edit_profile").style.display="none";
    document.getElementById("loader").style.display="block";
    let xmlhttp="";
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } 
    else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            string=JSON.parse(this.responseText);
            document.getElementById("loader").style.display="none";
            document.getElementById("modal_box").style.display="none";
            var x = document.getElementById("popup");
            if(string=="true") {
                x.innerHTML="Successfully Changed."
            }
            else {
                x.innerHTML="Some Error Occurred."
            }
            x.className = "show";
            setTimeout(function(){ 
                x.className = x.className.replace("show", ""); 
                setTimeout(function(){ 
                    document.location.reload();
                }, 1);
            }, 3000);
        }
    };
    xmlhttp.open("POST","./edit_profile.php",true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("id="+ajax_ID+"&key="+ajax_key+"&val="+ajax_val);
}

function del_accnt() {
    let sure = confirm("Are you Sure ? This will delete your account permanently.");
    if (sure) {
        let ajax_ID=document.getElementById("user_roll_number").value;
        let xmlhttp="";
        if (window.XMLHttpRequest) {
            xmlhttp = new XMLHttpRequest();
        } 
        else {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if(this.readyState == 4 && this.status == 200) {
                console.log(this.responseText);
                string=JSON.parse(this.responseText);
                document.getElementById("loader").style.display="none";
                document.getElementById("modal_box").style.display="none";
                var x = document.getElementById("popup");
                if(string=="true") {
                    x.innerHTML="Successfully Deleted."
                }
                else {
                    x.innerHTML="Some Error Occurred."
                }
                x.className = "show";
                setTimeout(function(){ 
                    x.className = x.className.replace("show", ""); 
                    setTimeout(function(){ 
                        if(string=="true") {
                        document.getElementById("log_but").click();
                        }
                    }, 1);
                }, 3000);
            }
        };
        xmlhttp.open("GET","./edit_profile.php?id="+ajax_ID+"&key=del",true);
        xmlhttp.send();
    }
    else {
        alert("Process terminated!!!");
    }
}