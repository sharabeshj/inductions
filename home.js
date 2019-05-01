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