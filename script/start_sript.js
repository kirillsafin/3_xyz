var browserHoehe;
var browserBreite;
//var menu_elem;
//var menu_rule;
//var alle_styles;

//Funtionen
function bestimmenBrowserGroesse(){
    var menu_elem=new Array();
    var menu_rule=new Array();
    var alle_styles=new Array();
    browserBreite=window.outerWidth;
    browserHoehe=window.outerHeight;
    if(browserBreite<=360){
        menu_elem=document.getElementById("menu_hidden");
        alle_styles=document.styleSheets;
        for(var i=0; i<alle_styles.length; i++){
            menu_rule=alle_styles[i].cssRules;
            for(var j=0; j<menu_rule.length; j++){
                if(menu_rule[j].selectorText=".menu_show"){
                    menu_rule[j].style.width="100%";
                    menu_rule[j].style.height="100%";
                    menu_rule[j].style.position="absolute";
                    menu_rule[j].style.top="0px";
                    menu_rule[j].style.left="0px";
                    menu_rule[j].style.zIndex="50";
                }
            }

        }
    }
    else if(browserBreite>360 && browserBreite<=768){
        menu_elem=document.getElementById("menu_hidden");
        alle_styles=document.styleSheets;
        for(var i=0; i<alle_styles.length; i++){
            menu_rule=alle_styles[i].cssRules;
            for(var j=0; j<menu_rule.length; j++){
                if(menu_rule[j].selectorText=".menu_show"){
                    menu_rule[j].style.width="50%";
                    menu_rule[j].style.height="100%";
                    menu_rule[j].style.position="absolute";
                    menu_rule[j].style.top="0px";
                    var temp_verschiebung=(browserBreite*0.5)-40;
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
                    var temp_verschiebung=(browserBreite*0.5)-40;
                    menu_rule[j].style.left=temp_verschiebung+"px";
                    menu_rule[j].style.zIndex="50";
                }
            }

        }    
    }

}

function toogle_background_pic(wahl){
    var bilder=document.getElementsByClassName("pic_background");
    var klassenNamen;
    if(wahl<2){ 
        for(var i=bilder.length-1; i>=0; i--){
            if(bilder[i].classList.contains("active")){
                if(i==2){
                    bilder[0].classList.remove("disable");
                    bilder[0].classList.add("active");
                    bilder[i].classList.remove("active");
                    bilder[i].classList.add("disable");
                    
                }
                else{
                    bilder[i].classList.remove("active");
                    bilder[i].classList.add("disable");
                    bilder[i+1].classList.remove("disable");
                    bilder[i+1].classList.add("active");
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
            }
            else{
                bilder[0].classList.remove("active");
                bilder[0].classList.add("disable");
            }
        }
    }
}

bestimmenBrowserGroesse();
var varInterval;
varInterval=window.setInterval(toogle_background_pic, 5000, 0);