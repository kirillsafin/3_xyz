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
    var matched=ziel.match(/.*html.*\.html/);
    if(matched){
        window.location.href="search.html";
    }
    else{
        window.location.href="html/search.html";
    }
}

var aufrufSuchenAll=function(){
    var ziel=window.location.href;
    var matched=ziel.match(/.*html.*\.html/);
    if(matched){
        window.location.href="search.html?varnam1=10";
    }
    else{
        window.location.href="html/search.html?varnam1=10";
    }
}

var aufrufSearchDetail=function(){
    var ziel=window.location.href;
    var matched=ziel.match(/.*html.*\.html/);
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

var aufrufChange=function(){
    var ziel=window.location.href;
    var matched=ziel.match(/.*html.*\.html/);
    if(matched){
        matched=ziel.match(/output.html/);
        if(!matched){
            window.location.href="change.html";
        }
    }
    else{
        window.location.href="html/change.html";
    }
}


var days_button=document.getElementsByClassName("activeK");
for(var i=0; i<days_button.length; i++){
    days_button[i].addEventListener("click", function(){aufrufOutput(event);}, false);
}