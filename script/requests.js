var aufrufIndex=function(){
    var ziel=window.location.href;
    var matched=ziel.match(/.*html.*\.php/);
    if(matched){
        window.location.href="../index.html";
    }
    else{
        window.location.href="index.html";
    }
}

var aufrufSearch=function(){
    var ziel=window.location.href;
    var matched=ziel.match(/.*html.*\.php/);
    if(matched){
        window.location.href="search.php";
    }
    else{
        window.location.href="html/search.php";
    }
}

var aufrufSearchDetail=function(){
    var ziel=window.location.href;
    var matched=ziel.match(/.*html.*\.php/);
    if(matched){
        var tempHref="search.html?varnam1=10";
        window.location.href="search.html?varnam1=-10";
    }
    else{
        window.location.href="html/search.html?varnam1=100&varnam2=20";
    }
    ziel=window.location.href;
}


var aufrufOutput=function(event){
    var monate=new Array("Januar", "Februar", "März", "April", "Mai", "Juni", "Juli", "August", "September", "Oktober", "November", "Dezember");
    var objMonat=document.getElementById("month_text");
    var monat=objMonat.innerHTML;
    var objYear=document.getElementById("year_text");
    var jahr=parseInt(objYear.innerText);
    var tag=event.target.innerHTML;
    for(var i=0; i<monate.length; i++){
        if(monate[i]==monat){
            monatInd=i+1;
            break;
        }
    }
    monat=monatInd;

    var ziel=window.location.href;
    var matched=ziel.match(/.*html.*\.php/);
    if(matched){
        matched=ziel.match(/output.php/);
        if(!matched){
            window.location.href="output.php"+"?monat="+monat+"&jahr="+jahr+"&tag="+tag;
        }
    }
    else{
        window.location.href="html/output.php"+"?monat="+monat+"&jahr="+jahr+"&tag="+tag;
    }
}

var aufrufMonth=function(){
    var ziel=window.location.href;
    var matched=ziel.match(/.*html.*\.php/);
    var datumJezt=new Date();
    var monat=datumJezt.getMonth()+1;
    var jahr=datumJezt.getFullYear();
    var objText=document.getElementById("month_text");
    if(matched){
        window.location.href="month.php"+"?monat="+monat+"&jahr="+jahr;
    }
    else{
        window.location.href="html/month.php"+"?monat="+monat+"&jahr="+jahr;
    }
}

var aufrufNextMonth=function(){
    var monate=new Array("Januar", "Februar", "März", "April", "Mai", "Juni", "Juli", "August", "September", "Oktober", "November", "Dezember");
    var ziel=window.location.href;
    var matched=ziel.match(/.*html.*\.php/);
    var objMonat=document.getElementById("month_text");
    var monat=objMonat.innerHTML;
    var objYear=document.getElementById("year_text");
    var jahr=parseInt(objYear.innerText);
    var monatInd;
    for(var i=0; i<monate.length; i++){
        if(monate[i]==monat){
            monatInd=i+1;
            break;
        }
    }
    if(monatInd==12){
        monat=1;
        jahr++;
    }
    else{
        monat=monatInd+1;
    }
    if(matched){
        window.location.href="month.php"+"?monat="+monat+"&jahr="+jahr;
    }
    else{
        window.location.href="html/month.php"+"?monat="+monat+"&jahr="+jahr;
    }
}

var aufrufLastMonth=function(){
    var monate=new Array("Januar", "Februar", "März", "April", "Mai", "Juni", "Juli", "August", "September", "Oktober", "November", "Dezember");
    var ziel=window.location.href;
    var matched=ziel.match(/.*html.*\.php/);
    var objMonat=document.getElementById("month_text");
    var monat=objMonat.innerHTML;
    var objYear=document.getElementById("year_text");
    var jahr=parseInt(objYear.innerText);
    var monatInd;
    for(var i=0; i<monate.length; i++){
        if(monate[i]==monat){
            monatInd=i+1;
            break;
        }
    }
    if(monatInd==1){
        monat=12;
        jahr--;
    }
    else{
        monat=monatInd-1;
    }
    if(matched){
        window.location.href="month.php"+"?monat="+monat+"&jahr="+jahr;
    }
    else{
        window.location.href="html/month.php"+"?monat="+monat+"&jahr="+jahr;
    }
    ziel=window.location.href;
}

var aufrufChange=function(event){
    var ziel=window.location.href;
    var matched=ziel.match(/.*html.*\.php/);
    if((typeof event)!="undefined"){
        var objParent=event.target.parentNode;
        var objReihe=objParent.childNodes;
        var id; 
        for(var i=0; i<objReihe.length; i++){
            if(objReihe[i].classList.contains("row_hidden")){
                id=objReihe[i].innerHTML;
            }
        }
    }
    
    if(matched){
        matched=ziel.match(/output.html/);
        if(!matched){
            if((typeof id)!="undefined"){
                window.location.href="change.php?id="+id;
            }
            else{
                window.location.href="change.php";
            }
            
        }
    }
    else{
        if((typeof id)!="undefined"){
            window.location.href="html/change.php?id="+id;
        }
        else{
            window.location.href="html/change.php";
        }
    }
}

var check=function(event){
   var objValidate=event.target;
   var objChild=objValidate.childNodes;
   for(var i=0; i<objChild.length; i++){
       if(objChild[i].tagName=="LABEL"){
            var objChild2=objChild[i].childNodes;
            for(var j=0; j<objChild2.length; j++){
                if(objChild2[j].tagName=="INPUT"){
                    if(objChild2[j].name=="datum"){
                        var valueInput=objChild2[j].value;
                        var ok=valueInput.match(/^[1-9][0-9]{3}-[0-9]{2}-[0-9]{2}$/);
                        if(ok==null){
                            alert("Falsche Eingabe");
                            return false;
                        }
                    }
                    else if(objChild2[j].name=="uhrzeit"){
                        var valueInput=objChild2[j].value;
                        var ok=valueInput.match(/^[0-9]{1,2}:[0-9]{2}$/);
                        if(ok==null){
                            alert("Falsche Eingabe");
                            return false;
                        }
                    }
                    else if(objChild2[j].name=="terminname"){
                        if(objChild2[j].value==""){
                            alert("Falsche Eingabe");
                            return false;
                        }
                    }
                }
                
            }
        }
    }
    return true;
}

var aufruf_UpdateInsert=function(event){
    var objUpdate=event.target.parentNode.parentNode;
    var objChild=objUpdate.childNodes;
    for(var i=0; i<objChild.length; i++){
        if(objChild[i].type=="hidden"){
            if(objChild[i].name=="delupdate"){
                objChild[i].value="update";
            }
        }
        
    }
}

var aufruf_Del=function(event){
    var objUpdate=event.target.parentNode.parentNode;
    var objChild=objUpdate.childNodes;
    for(var i=0; i<objChild.length; i++){
        if(objChild[i].type=="hidden"){
            if(objChild[i].name=="delupdate"){
                objChild[i].value="delete";
            }
        }  
    }
}

var days_button=document.getElementsByClassName("activeK");
for(var i=0; i<days_button.length; i++){
    days_button[i].addEventListener("click", function(){aufrufOutput(event);}, false);
}

var tab_eintraege=document.getElementsByClassName("eintrag")
for(var i=0; i<tab_eintraege.length; i++){
    tab_eintraege[i].addEventListener("click", function(){aufrufChange(event);}, false);
}

