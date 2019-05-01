function load_mentee() {
    document.getElementById("mentee_loader").style.display="block";
    document.getElementById("no_mentee_").style.display="none";
    document.getElementById("mentee_row").style.display="none";
    document.getElementById("mentee_row").innerHTML="";

    let roll=document.getElementById("user_roll_number").value;

    let xmlhttp="";
    if(window.XMLHttpRequest) {
        xmlhttp=new XMLHttpRequest();
    }
    else {
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            string=JSON.parse(this.responseText);
            document.getElementById("mentee_loader").style.display="none";
            if(string=="fail") {
                document.getElementById("mentee_row").style.display="none";
                document.getElementById("mentee_row").innerHTML="";
                document.getElementById("no_mentee_").style.display="block";
                document.getElementById("_no_cr_er").innerHTML="Some error occured.";
            } 
            else if(string=="none") {
                document.getElementById("mentee_row").style.display="none";
                document.getElementById("mentee_row").innerHTML="";
                document.getElementById("no_mentee_").style.display="block";
            }
            else {
                document.getElementById("mentee_row").style.display="flex";
                document.getElementById("mentee_row").innerHTML="";
                document.getElementById("no_mentee_").style.display="none";
                s="";
                for(i=0;i<string.length;i++) {
                    img=string[i].Img;
                    s="<div class=\"_cr_col\"><div class=\"_rep_container\"><div class=\"card\"><center><img src=\""+img+".png\" alt=\"John\" style=\"width:70%\"></center><div class=\"container\"><h3>"+string[i].Name+"</h3>"+string[i].Dept+"<br><p style=\"font-size:14px;\">"+string[i].Roll_No+"@nitt.edu</p></div></div></div></div>";
                    document.getElementById("mentee_row").innerHTML+=s;
                    s="";
                }
            }
        }
    };
    xmlhttp.open("GET", "cr.php?q=mentee&roll="+roll, true);
    xmlhttp.send();
}

function load_mentor() {
    document.getElementById("cr_loader").style.display="block";
    document.getElementById("no_cr_").style.display="none";
    document.getElementById("cr_row").style.display="none";
    document.getElementById("cr_row").innerHTML="";

    let roll=document.getElementById("user_roll_number").value;

    let xmlhttp="";
    if(window.XMLHttpRequest) {
        xmlhttp=new XMLHttpRequest();
    }
    else {
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            string=JSON.parse(this.responseText);
            document.getElementById("cr_loader").style.display="none";
            if(string=="fail") {
                document.getElementById("cr_row").style.display="none";
                document.getElementById("cr_row").innerHTML="";
                document.getElementById("no_cr_").style.display="block";
                document.getElementById("_no_cr").innerHTML="Some error occured.";
            } 
            else if(string=="none") {
                document.getElementById("cr_row").style.display="none";
                document.getElementById("cr_row").innerHTML="";
                document.getElementById("no_cr_").style.display="block";
            }
            else {
                document.getElementById("cr_row").style.display="flex";
                document.getElementById("cr_row").innerHTML="";
                document.getElementById("no_cr_").style.display="none";
                s="";
                for(i=0;i<string.length;i++) {
                    img=string[i].Img;
                    s="<div class=\"_cr_col\"><div class=\"_rep_container\"><div class=\"card\"><center><img src=\""+img+".png\" alt=\"John\" style=\"width:70%\"></center><div class=\"container\"><h3>"+string[i].Name+"</h3>"+string[i].Dept+"<br><p style=\"font-size:14px;\">"+string[i].Roll_No+"@nitt.edu</p></div></div></div></div>";
                    document.getElementById("cr_row").innerHTML+=s;
                    s="";
                }
            }
        }
    };
    xmlhttp.open("GET", "cr.php?q=mentor&roll="+roll, true);
    xmlhttp.send();
}

function load_announcement() {
    document.getElementById("ann_loader").style.display="block";
    document.getElementById("ann_cont").style.display="none";
    document.getElementById("ann_cont").innerHTML="";
    let xmlhttp="";
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } 
    else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200) {
            string=JSON.parse(this.responseText);
            document.getElementById("ann_loader").style.display="none";
            document.getElementById("ann_cont").style.display="block";
            if(string=="no") {
                document.getElementById("ann_cont").innerHTML="<center style=\"text-transform:uppercase\"><br><h2>No Annoucements to show</h2></center>";
            }
            else if(string=="fail") {
                document.getElementById("ann_cont").innerHTML="<center style=\"text-transform:uppercase\"><br><h2>Problem loading Announements. Please refresh the page</h2></center>";
            }
            else {
                str="";
                for(i=0;i<string.length;i++) {
                    let x=string[i].Imp;
                    imp=""
                    if(x=="true") {
                      imp="<div style=\"position:absolute;color:#ffbc00;right:10px;top:10px;\"><i class=\"fas fa-star\"></i></div>"
                    }
                    str+="<div class=\"announcement\">"+imp+"<div class=\"a_head_desc\"><div class=\"name_container desc_com\">";
                    str+=string[i].Title;
                    str+="</div><div class=\"name_container det_ desc_com\">";
                    str+=string[i].Date;
                    str+=" </div></div><div class=\"topic_desc\">";
                    str+=string[i].Body;
                    str+="</div><hr><div style=\"float:right;font-size:13px;user-select:none;margin-top:-5px;\">Updated by <i><b>"+string[i].Name+"</i></b></div></div>";
                    document.getElementById("ann_cont").innerHTML+=str;
                }
            }
        }
    };
    xmlhttp.open("GET","./load_announcement.php?q=accnt",true);
    xmlhttp.send();

}

function validate_domain() {
    let x=document.getElementById("dom_select").value;
    if(x=="") {

    }
    else {
        document.getElementById("but_domain").disabled=false;
        document.getElementById("but_domain").style.cursor="pointer";
    }
}