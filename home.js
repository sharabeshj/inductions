load_ann();

function load_ann() {
    document.getElementById("ann_loader").style.display="block";
    document.getElementById("announcement").style.display="none";
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
            document.getElementById("announcement").style.display="block";
            document.getElementById("announcement").innerHTML="";
            if(string=="no") {
                document.getElementById("announcement").innerHTML="<center style=\"text-transform:uppercase\"><br><h2>No Annoucements to show</h2></center>";
            }
            else if(string=="fail") {
                document.getElementById("announcement").innerHTML="<center style=\"text-transform:uppercase\"><br><h2>Problem loading Announements. Please refresh the page</h2></center>";
            }
            else {
                str="";
                for(i=0;i<string.length;i++) {
                    str="";
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
                    document.getElementById("announcement").innerHTML+=str;
                }
            }
        }
    };
    xmlhttp.open("GET","./load_announcement.php?q=home",true);
    xmlhttp.send();
}

var coll = document.getElementsByClassName("collapsible");
var i;

for (i = 0; i < coll.length; i++) {
  coll[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var content = this.nextElementSibling;
    if (content.style.maxHeight) {
        content.style.maxHeight = null;
    } else {
      content.style.maxHeight = content.scrollHeight + "px";
    } 
  });
}

function load_task() {
    load_ee_task();
}

function load_ee_task() {
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
            document.getElementById("ee_task0_cont").innerHTML="";
            document.getElementById("ee_task1_electronics_cont").innerHTML="";
            document.getElementById("ee_task1_embedded_cont").innerHTML="";
            document.getElementById("ee_task1_iot_cont").innerHTML="";
            if(string=="0row") {
                document.getElementById("ee_task0_cont").innerHTML="The Task will be added soon.";
                document.getElementById("ee_task1_electronics_cont").innerHTML="The Task will be added soon.";
                document.getElementById("ee_task1_embedded_cont").innerHTML="The Task will be added soon.";
                document.getElementById("ee_task1_iot_cont").innerHTML="The Task will be added soon.";
            }
            else if(string=="false"){
                document.getElementById("ee_task0_cont").innerHTML="Problem loading Task. Please refresh after some time.";
                document.getElementById("ee_task1_electronics_cont").innerHTML="Problem loading Task. Please refresh after some time.";
                document.getElementById("ee_task1_embedded_cont").innerHTML="Problem loading Task. Please refresh after some time.";
                document.getElementById("ee_task1_iot_cont").innerHTML="Problem loading Task. Please refresh after some time.";
            }
            else {
                document.getElementById("ee_task0_cont").innerHTML="The Task will be added soon.";
                document.getElementById("ee_task1_electronics_cont").innerHTML="The Task will be added soon.";
                document.getElementById("ee_task1_embedded_cont").innerHTML="The Task will be added soon.";
                document.getElementById("ee_task1_iot_cont").innerHTML="The Task will be added soon.";
                for(i=0;i<string.length;i++) {
                    if(string[i].TaskNo<2) {
                        if(string[i].SubD=="Basic Hardware") {
                            document.getElementById("ee_task0_cont").innerHTML=string[i].PS;
                        }
                        else if(string[i].SubD=="Electronics") {
                            document.getElementById("ee_task1_electronics_cont").innerHTML=string[i].PS;
                        }
                        else if(string[i].SubD=="Embedded Systems") {
                            document.getElementById("ee_task1_embedded_cont").innerHTML=string[i].PS;
                        }
                        else if(string[i].SubD=="IOT") {
                            document.getElementById("ee_task1_iot_cont").innerHTML=string[i].PS;
                        }
                    } 
                }
            }
        }
    };
    xmlhttp.open("POST","./task_manager.php",true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("q=Fetch&dom=Embedded and Electronics");
}
