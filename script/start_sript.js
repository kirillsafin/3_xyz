var browserBreite=window.innerWidth;
var browserHoehe=window.innerHeight;


//Funtionen
function einstellenMenu(){
    browserBreite=window.innerWidth;
    browserHoehe=window.innerHeight;
    var menu_elem=new Array();
    var menu_rule=new Array();
    var alle_styles=new Array();

    if(browserBreite<=360){
        alle_styles=document.styleSheets;
        for(var i=0; i<alle_styles.length; i++){
            menu_rule=alle_styles[i].cssRules;
            for(var j=0; j<menu_rule.length; j++){
                if(menu_rule[j].selectorText==".menu_show"){
                    menu_rule[j].style.width="100%";
                    var tempHeight=browserHoehe-document.getElementById("header").offsetHeight;
                    menu_rule[j].style.height=tempHeight+"px";
                    menu_rule[j].style.position="absolute";
                    menu_rule[j].style.top=document.getElementById("header").offsetHeight+"px";
                    menu_rule[j].style.left="0px";
                    menu_rule[j].style.zIndex="50";
                }
            }

        }
    }
    else if(browserBreite>360 && browserBreite<=768){
        var header_elem=document.getElementById("header");
        var body_elem=document.getElementsByTagName("body");
        alle_styles=document.styleSheets;
        for(var i=0; i<alle_styles.length; i++){
            menu_rule=alle_styles[i].cssRules;
            for(var j=0; j<menu_rule.length; j++){
                if(menu_rule[j].selectorText==".menu_show"){
                    var temp_verschiebung=browserBreite-document.getElementById("pic_menu").clientWidth;
                    menu_rule[j].style.width=temp_verschiebung+"px";
                    menu_rule[j].style.height="100%";
                    menu_rule[j].style.position="absolute";
                    menu_rule[j].style.top="0px";
                    temp_verschiebung=-document.getElementById("pic_menu").clientWidth;
                    menu_rule[j].style.left=temp_verschiebung+"px";
                    menu_rule[j].style.zIndex="50";
                }
            }

        }
    }
    else{
        menu_elem=document.getElementById("menu_hidden");
        alle_styles=document.styleSheets;
        for(var i=0; i<alle_styles.length; i++){
            menu_rule=alle_styles[i].cssRules;
            for(var j=0; j<menu_rule.length; j++){
                if(menu_rule[j].selectorText==".menu_show"){
                    menu_rule[j].style.width="50%";
                    menu_rule[j].style.height="100%";
                    menu_rule[j].style.position="absolute";
                    menu_rule[j].style.top="0px";
                    var temp_verschiebung=(browserBreite*0.5)-50;
                    menu_rule[j].style.left=temp_verschiebung+"px";
                    menu_rule[j].style.zIndex="50";
                }
                
            }
        }    
    }
}

function postitionierenText(){
    browserBreite=window.innerWidth;
    browserHoehe=window.innerHeight;
    var elemText=document.getElementsByClassName("text");
    var elemPicture;
    if(typeof elemText[0] !="undefined"){
        var tempVar1;
        elemText[0].style.position="relative";
        elemPicture=document.getElementsByClassName("picture");
        tempVar1=elemPicture[0].clientHeight/2;
        if(tempVar1==0){
            tempVar1=browserHoehe/2-document.getElementById("header").clientHeight;
        }
        elemText[0].style.top=tempVar1+"px";
    }
}

function toogle_background_pic(wahl){
    browserBreite=window.innerWidth;
    browserHoehe=window.innerHeight;
    var bilder=document.getElementsByClassName("pic_background");
    var items=document.getElementsByClassName("button_item");
    var klassenNamen;
    if(wahl<2){ 
        for(var i=bilder.length-1; i>=0; i--){
            if(bilder[i].classList.contains("active")){
                if(i==2){
                    bilder[0].classList.remove("disable");
                    bilder[0].classList.add("active");
                    bilder[i].classList.remove("active");
                    bilder[i].classList.add("disable");

                    items[0].classList.remove("inactive_item");
                    items[0].classList.add("active_item");
                    items[i].classList.remove("active_item");
                    items[i].classList.add("inactive_item");
                    
                }
                else{
                    bilder[i].classList.remove("active");
                    bilder[i].classList.add("disable");
                    bilder[i+1].classList.remove("disable");
                    bilder[i+1].classList.add("active");

                    items[i].classList.remove("active_item");
                    items[i].classList.add("inactive_item");
                    items[i+1].classList.remove("inactive_item");
                    items[i+1].classList.add("active_item");
                }
                return;
            }
            
        }
    }
    else{
        for(var i=0; i<bilder.length; i++){
            if(i==wahl){
                bilder[i].classList.remove("disable");
                bilder[i].classList.add("active");
                items[i].classList.remove("inactive_item");
                items[i].classList.add("active_item");
            }
            else{
                bilder[0].classList.remove("active");
                bilder[0].classList.add("disable");
                items[0].classList.remove("active_item");
                items[0].classList.add("inactive_item");
            }
        }
    }
}

function positionierenBackgrPic(){
   browserBreite=window.innerWidth;
   browserHoehe=window.innerHeight;

   var alleStyle;
   var styleRegeln;
   var checkWert;
   
   //Background Bildgröße eisntellen, die Größe .activate zuweisen
   alleStyle=document.styleSheets;
   for(var i=0; i<alleStyle.length; i++){
       styleRegeln=alleStyle[i].cssRules;
       for(var j=0; j<styleRegeln.length; j++){
           if(styleRegeln[j].selectorText==".active"){
               if(browserBreite<1250 || browserHoehe<550){
                   checkWert=browserBreite-20;
                   if(checkWert<1200){
                    styleRegeln[j].style.width=checkWert+"px";
                   }
                   checkWert=browserHoehe-document.getElementById("header").clientHeight-20;
                   if(checkWert<500){
                    styleRegeln[j].style.height=checkWert+"px";
                   }                 
               }
               
            }
        }
    }
    //.picture zentrieren
    for(var i=0; i<alleStyle.length; i++){
        styleRegeln=alleStyle[i].cssRules;
        for(var j=0; j<styleRegeln.length; j++){
            if(styleRegeln[j].selectorText==".picture"){
                var elem_backgPic=document.getElementsByClassName("picture");
                if(typeof elem_backgPic[0] !="undefined"){
                    var tempVar1=(browserBreite/2)-(elem_backgPic[0].clientWidth/2);
                    styleRegeln[j].style.position="absolute";
                    styleRegeln[j].style.left=tempVar1+"px";
                }
            }
        }
    }
    //slide_buttons_wrapper einstellen
    for(var i=0; i<alleStyle.length; i++){
        styleRegeln=alleStyle[i].cssRules;
        for(var j=0; j<styleRegeln.length; j++){
            if(styleRegeln[j].selectorText==".slide_buttons_wrapper"){
                var tempVar1;
                var tempVar2;
                tempVar=document.getElementsByClassName("slide_buttons");
                if(typeof tempVar[0]=="undefined"){
                    return;
                }
                var buttons_left=(browserBreite/2)-(tempVar[0].clientWidth/2);
                tempVar1=document.getElementsByClassName("picture");
                tempVar2=document.getElementsByClassName("slide_buttons");
                if(typeof tempVar1 == "undefined"){
                    return;
                }
                if(typeof tempVar2== "undefinded"){
                    return;
                }
                var buttons_top=document.getElementById("header").offsetHeight+tempVar1[0].offsetHeight-tempVar2[0].offsetHeight;
                styleRegeln[j].style.position="absolute";
                styleRegeln[j].style.left=buttons_left+"px";
                styleRegeln[j].style.top=buttons_top+"px";
                styleRegeln[j].style.zIndex="-90";
            }    
        }
    
    }
}

function positionierenContent(){
    browserBreite=window.innerWidth;
    browserHoehe=window.innerHeight;
    var pathnameSite=window.location.pathname;
    var matched=pathnameSite.match(/search.php|output.php|month.php|change.php$/);
    if(matched){
        var elemContent=document.getElementById("content");
        var elemHeader=document.getElementById("header");
        if(elemContent!="undefined" && elemHeader!="undefined"){
            var tempHoeheGesamt=elemContent.offsetHeight+elemHeader.offsetHeight+10;
            if(tempHoeheGesamt<browserHoehe){
                var tempHoehe=elemContent.clientHeight/2;
                tempHoehe=((browserHoehe/2)-elemHeader.clientHeight)-tempHoehe;
                elemContent.style.position="relative";
                elemContent.style.top=tempHoehe+"px";
            }  
        }
    }
}


//positionierenBackgrPic();
//postitionierenText();
//einstellenMenu();
//positionierenContent();

window.addEventListener("resize", positionierenBackgrPic);
window.addEventListener("resize", postitionierenText);
window.addEventListener("resize", einstellenMenu);
window.addEventListener("resize", positionierenContent);

window.addEventListener("load", positionierenBackgrPic);
window.addEventListener("load", postitionierenText);
window.addEventListener("load", einstellenMenu);
window.addEventListener("load", positionierenContent);

var varInterval;
varInterval=window.setInterval(toogle_background_pic, 5000, 0);