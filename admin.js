function add_announcement() {
    document.getElementById("modal_box").style.display="block";
    document.getElementById("modal_cover").style.display="block";
    document.getElementById("modal_cover").classList.add("mdl_container");
    document.getElementById("add_announcement").style.display="block";
    document.getElementById("modal_head_cont").innerHTML="Add Announcement";
    setTimeout(function(){
        document.getElementById("modal_cover").classList.remove("mdl_container");
    }, 400);
}

function add_task() {
    document.getElementById("modal_box").style.display="block";
    document.getElementById("modal_cover").style.display="block";
    document.getElementById("add_task").style.display="block";
    document.getElementById("modal_cover").classList.add("mdl_container");
    document.getElementById("modal_head_cont").innerHTML="Add Task";
    setTimeout(function(){
        document.getElementById("modal_cover").classList.remove("mdl_container");
    }, 400);
}

function adjust_head(x) {
    let head=document.getElementById(x+"_head");
    let cont=document.getElementById(x+"_cont");
    let val=cont.innerHTML;
    if(val.length>0) {
        head.style.marginTop="5px";
        head.style.fontSize="16px";
    }
    else {
        head.style.marginTop="27px";
        head.style.fontSize="20px";
    }
}

function announcement_add() {
    let title=document.getElementById("title_cont").innerHTML;
    let content=document.getElementById("ann_cont").innerHTML;
    if(title.length==0 || content.length==0) {
        alert("Please fill the required fields first..");
        return;
    }
    else {
        let imp=document.getElementById("important_ann").checked;
        let roll=document.getElementById("user_roll_number").value;
        document.getElementById("title_cont").innerHTML="";
        document.getElementById("ann_cont").innerHTML="";
        document.getElementById("important_ann").checked=false;
        document.getElementById("modal_cover").style.display="none";
        document.getElementById("loader").style.display="block";
        let xmlhttp="";
        if(window.XMLHttpRequest) {
            xmlhttp=new XMLHttpRequest();
        }
        else {
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.responseText);
                string=JSON.parse(this.responseText);
                document.getElementById("loader").style.display="none";
                document.getElementById("modal_box").style.display="none";
                var x = document.getElementById("popup");
                if(string=="false") {
                    x.innerHTML="Some Error Occurred."
                } 
                else if(string=="true") {
                    x.innerHTML="Successfully Added."
                }
                x.className = "show";
                setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
            }
        };
        xmlhttp.open("GET", "load_announcement.php?q=add&title="+title+"&body="+content+"&imp="+imp+"&roll="+roll, true);
        xmlhttp.send();
    }
}
function strip_html(str) {
    return str.replace(/(<([^>]+)>)/ig,"");
}
function task_add() {
    let deadline=document.getElementById("deadline_cont").innerHTML;
    let link=document.getElementById("link_cont").innerHTML;
    let no=document.getElementById("task_no_cont").innerHTML;
    let ps=document.getElementById("ps_cont").innerHTML;
    let dom=document.getElementById("sel_domain").value;
    let subdom=document.getElementById("sel_sub_domain").value;
    if(deadline.length==0 || link.length==0 || no.length==0 || ps.length==0 || dom.length0 || subdom.length==0) {
        alert("Please fill the required fields first..");
        return;
    }
    else {
        document.getElementById("deadline_cont").innerHTML="";
        document.getElementById("link_cont").innerHTML="";
        document.getElementById("task_no_cont").innerHTM="";
        document.getElementById("ps_cont").innerHTML="";
        document.getElementById("sel_domain").value="";
        document.getElementById("sel_sub_domain").value="";
        document.getElementById("modal_cover").style.display="none";
        document.getElementById("loader").style.display="block";
        let xmlhttp="";
        if(window.XMLHttpRequest) {
            xmlhttp=new XMLHttpRequest();
        }
        else {
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.responseText);
                string=JSON.parse(this.responseText);
                document.getElementById("loader").style.display="none";
                document.getElementById("modal_box").style.display="none";
                let x = document.getElementById("popup");
                if(string=="false") {
                    x.innerHTML="Some Error Occurred."
                } 
                else if(string=="true") {
                    x.innerHTML="Successfully Added."
                }
                x.className = "show";
                setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
            }
        };
        xmlhttp.open("POST", "task_manager.php", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("q=add&deadline="+strip_html(deadline)+"&link="+strip_html(link)+"&taskno="+strip_html(no)+"&ps="+strip_html(ps)+"&dom="+dom+"&subdom="+subdom);
    }
}

function load_users_privilage() {
    let xmlhttp="";
    let loader=document.getElementById("ap_loader");
    let container=document.getElementById("user_list");
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } 
    else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    loader.style.display="block";
    container.innerHTML="";
    xmlhttp.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200) {
            string=JSON.parse(this.responseText);
            loader.style.display="none";
            if(string=="ECF") {
                container.innerHTML="<div style=\"text-align:center;padding:20px;width:100%;text-transform:uppercase;font-family:'PP';margin-bottom:20px;\">Couldn't Connect to Server now. Please Try again after some time.</div>";
            }
            else if(string=="NDF"){
                container.innerHTML="<div style=\"text-align:center;padding:20px;width:100%;text-transform:uppercase;font-family:'PP';margin-bottom:20px;\">No data found</div>";
            }
            else {
                container.innerHTML="";
                let str="";
                for(i=0;i<string.length;i++){
                    let x=string[i];
                    let com_class="";
                    let pos="";
                    if(x.Access=="stu") {
                        com_class="student_theme";
                        pos="Student";
                    }
                    else if(x.Access=="adm") {
                        com_class="adm_theme";
                        pos="Mentor";
                    }
                    else if(x.Access=="admin") {
                        com_class="admin_theme";
                        pos="Admin";
                    }
                    str+="<div class=\"col_card_priv\">"+
                    "<div class=\"card_content "+com_class+"\">"+
                        "<div class=\"username_legend\">"+x.Roll_No+"</div>"+
                        "<div class=\"userpos_legend\">Currently : "+pos+"</div>"+
                        "<div class=\"button_cont\">";
                    if(pos=="Student") {
                        str+="<button class=\"elec_button\" onclick=\"make_mentor("+x.Roll_No+");\">Make Mentor</button><button class=\"elec_button\" onclick=\"make_admin("+x.Roll_No+");\">Make Admin</button>";
                    }
                    else if(pos=="Mentor") {
                        str+="<button class=\"elec_button\" onclick=\"make_student("+x.Roll_No+");\">Make Student</button><button class=\"elec_button\" onclick=\"make_admin("+x.Roll_No+");\">Make Admin</button>";
                    }
                    else if(pos=="Admin") {
                        str+="<button class=\"elec_button del_req\" onclick=\"make_student("+x.Roll_No+");\">Make Student</button><button class=\"elec_button del_req\" onclick=\"make_mentor("+x.Roll_No+");\">Make Mentor</button>";
                    }
                    str+="</div></div></div>";
                }
                container.innerHTML=str;
            }
        }
    };
    xmlhttp.open("POST","./user_privilage.php",true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("change=False&loadprof=true");
}

function make_student(roll) {
    document.getElementById("modal_box").style.display="block";
    document.getElementById("modal_head_cont").style.display="none";
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
            document.getElementById("modal_head_cont").style.display="block";
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
    xmlhttp.open("POST","./user_privilage.php",true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("change=True&type=stu&roll="+roll);
}

function make_admin(roll) {
    document.getElementById("modal_box").style.display="block";
    document.getElementById("modal_head_cont").style.display="none";
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
            document.getElementById("modal_head_cont").style.display="block";
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
    xmlhttp.open("POST","./user_privilage.php",true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("change=True&type=admin&roll="+roll);
}

function make_mentor(roll) {
    document.getElementById("modal_box").style.display="block";
    document.getElementById("modal_head_cont").style.display="none";
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
            document.getElementById("modal_head_cont").style.display="block";
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
    xmlhttp.open("POST","./user_privilage.php",true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("change=True&type=adm&roll="+roll);
}

function validate_domain() {
    let x=document.getElementById("dom_select").value;
    if(x=="") {

    }
    else {
        document.getElementById("sel_domain").value=x;
        document.getElementById("subdom_select").style.cursor="";
        document.getElementById("subdom_select").disabled=false;
        document.getElementById("sel_sub_domain").value="";
        let temp="";
        temp="<option value=\"\">Choose</option><option value=\"Basic Hardware\">Basic Hardware</option>";
        if(x=="Embedded and Electronics") {
            temp+="<option value=\"Electronics\">Electronics</option>"+
                  "<option value=\"Embedded Systems\">Embedded Systems</option>"+
                  "<option value=\"IOT\">IOT</option>";
        }
        else if(x=="Robotics and Control") {
            temp+="<option value=\"Control Systems\">Control Systems</option>"+
                  "<option value=\"Mathematical Modelling\">Mathematical Modelling</option>"+
                  "<option value=\"Solid Modelling\">Solid Modelling</option>";
        }
        else if(x=="Signal Processing and Machine Learning") {
            temp+="<option value=\"Audio Processing\">Audio Processing</option>"+
                  "<option value=\"Image Processing\">Image Processing</option>"+
                  "<option value=\"Machine Learning \">Machine Learning</option>";
        }
        document.getElementById("subdom_select").innerHTML=temp;
    }
}

function validate_subdomain() {
    let x=document.getElementById("subdom_select").value;
    if(x=="") {

    }
    else {
        document.getElementById("sel_sub_domain").value=x;
    }
}