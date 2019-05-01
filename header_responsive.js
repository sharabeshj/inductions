function toggle_responsive() {
    let x=document.getElementById("header_responsive").style.display;
    if(x=="none") {
        document.getElementById("header_responsive").style.display="block";
    }
    else {
        document.getElementById("header_responsive").classList.toggle("fade_out");
        setTimeout(function() {
            document.getElementById("header_responsive").style.display="none";
            document.getElementById("header_responsive").classList.toggle("fade_out");
        },290);
        
    }
}

function start_page() {
    anim_text();
}

function anim_text() {
    let For="Spider, the Research and Development club of NIT Trichy is a cluster of like-minded individuals pursuing projects in some of the booming sectors of technology. Tronix domain is a division of Spider, where we majorly work on the lines of embedded systems,  electronics,  robotics and control, computer vision,  artificial intelligence and so on. Interested to delve deep into these? Grab this opportunity to get your hands dirty and join a team of tronix enthusiasts!!!";
    type_text("intro_for",For,0);    
}

function type_text(id,text,val) {
    let x=document.getElementById(id);
    if(val==(text.length+1)) {
         return 1;
    }
    else {
     setTimeout(function() {
        x.innerHTML+=text.charAt(val);
        val++;
        type_text(id,text,val);
     },50);
    }  
}